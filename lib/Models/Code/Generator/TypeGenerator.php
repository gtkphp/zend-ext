<?php

declare(strict_types=1);

namespace Zend\Ext\Models\Code\Generator;

use Zend\Ext\Models\Code\Generator\Exception\InvalidArgumentException;
use Zend\Ext\Models\Code\Generator\TypeGenerator\AtomicType;
use Zend\Ext\Models\Code\Generator\TypeGenerator\CompositeType;
use Zend\Ext\Models\Code\Generator\TypeGenerator\IntersectionType;
use Zend\Ext\Models\Code\Generator\TypeGenerator\UnionType;
use ReflectionClass;
use ReflectionIntersectionType;
use ReflectionNamedType;
use ReflectionUnionType;

use function array_map;
use function sprintf;
use function str_contains;
use function str_starts_with;
use function substr;

/** @psalm-immutable */
final class TypeGenerator implements GeneratorInterface
{
    private const NULL_MARKER = '?';
    
    /** @var string $internal_type c type declaration : unsigned int(* foo[12][3];) */
    public $internal_type;

    /** @var string $explicite_type doc type declaration : int callable(int $foo) */
    public $explicite_type;

    /** @var UnionType|IntersectionType|AtomicType $type */
    private $type;

    /** @var bool $nullable */
    private $nullable = false;

    private function __construct(
        $type,
        $nullable = false
    ) {
        $this->type = $type;
        $this->nullable = $nullable;
        if ($nullable && $type instanceof AtomicType) {
            $type->assertCanBeStandaloneNullable();
        }
    }

    public function atomic() {
        if ($this->type instanceof AtomicType) {
            return $this->type;
        }
        return null;
    }

    /**
     * @internal
     *
     * @psalm-pure
     */
    public static function fromReflectionType(
        /*ReflectionNamedType|ReflectionUnionType|ReflectionIntersectionType|null*/ $type,
        /*?ReflectionClass*/ $currentClass
    ): ?self {
        if (null === $type) {
            return null;
        }


        if ($type instanceof ReflectionUnionType) {
            if ($type instanceof ReflectionNamedType) {
                $array = array_map('AtomicType::fromReflectionNamedTypeAndClass', $type->getTypes(), array_fill(0, count($type->getTypes()), $currentClass));
            } else {
                $array = array_map('self::fromIntersectionType', $type->getTypes(), array_fill(0, count($type->getTypes()), $currentClass));
            }
            return new self(new UnionType($array), false);
        }

        if ($type instanceof ReflectionIntersectionType) {
            return new self(self::fromIntersectionType($type, $currentClass), false);
        }

        $atomicType = AtomicType::fromReflectionNamedTypeAndClass($type, $currentClass);

        return new self(
            $atomicType,
            $atomicType->type !== 'mixed' && $atomicType !== 'null' && $type->allowsNull()
        );
    }

    /** @psalm-pure */
    private static function fromIntersectionType(
        ReflectionIntersectionType $intersectionType,
        ?ReflectionClass $currentClass
    ): IntersectionType {

        return new IntersectionType(array_map(
            function (ReflectionNamedType $type, $currentClass) {return AtomicType::fromReflectionNamedTypeAndClass($type, $currentClass);},
            $intersectionType->getTypes(),
            array_fill(0, count($intersectionType->getTypes()), $currentClass)
        ));
    }

    /**
     * @throws InvalidArgumentException
     * @psalm-pure
     */
    public static function fromTypeString(string $type): self
    {
        [$nullable, $trimmedNullable] = self::trimNullable($type);
        
        if (
            false===strstr($trimmedNullable, CompositeType::INTERSECTION_SEPARATOR)
            && false===strstr($trimmedNullable, CompositeType::UNION_SEPARATOR)
        ) {
            return new self(CompositeType::fromString($trimmedNullable), $nullable);
        }

        if ($nullable) {
            throw new InvalidArgumentException(sprintf(
                'Type "%s" is a union type, and therefore cannot be also marked nullable with the "?" prefix',
                $type
            ));
        }

        return new self(CompositeType::fromString($trimmedNullable));
    }

    /**
     * {@inheritDoc}
     *
     * Generates the type string, including FQCN "\\" prefix, so that
     * it can directly be used within any code snippet, regardless of
     * imports.
     *
     * @psalm-return non-empty-string
     */
    public function generate(): string
    {
        return ($this->nullable ? self::NULL_MARKER : '') . $this->type->fullyQualifiedName();
        //return ($this->nullable ? self::NULL_MARKER : '') . $this->internal_type;
    }

    public function equals(TypeGenerator $otherType): bool
    {
        return $this->generate() === $otherType->generate();
    }

    public function nullable(): bool
    {
        return $this->nullable;
    }

    /**
     * @return non-empty-string the cleaned type string. Note that this value is not suitable for code generation,
     *                          since the returned value does not include any root namespace prefixes, when applicable,
     *                          and therefore the values cannot be used as FQCN in generated code.
     */
    public function __toString(): string
    {
        return $this->type->toString();
    }

    /**
     * @return bool[]|string[] ordered tuple, first key represents whether the type is nullable, second is the
     *                         trimmed string
     * @psalm-return array{bool, string}
     * @psalm-pure
     */
    private static function trimNullable(string $type): array
    {
        
        if (0===strpos($type, self::NULL_MARKER)) {
            return [true, substr($type, 1)];
        }

        return [false, $type];
    }
}
