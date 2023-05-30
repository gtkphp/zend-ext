<?php

declare(strict_types=1);

namespace Zend\Ext\Models\Code\Generator;

use Zend\Ext\Models\Code\Reflection\Exception\RuntimeException;
use Zend\Ext\Models\Code\Reflection\ParameterReflection;

use function sprintf;

final class PromotedParameterGenerator extends ParameterGenerator
{
    public const VISIBILITY_PUBLIC    = 'public';
    public const VISIBILITY_PROTECTED = 'protected';
    public const VISIBILITY_PRIVATE   = 'private';

    /** @psalm-var PromotedParameterGenerator::VISIBILITY_*
     * @var string */
    private $visibility;

    /**
     * @psalm-param non-empty-string $name
     * @psalm-param ?non-empty-string $type
     * @psalm-param PromotedParameterGenerator::VISIBILITY_* $visibility
     */
    public function __construct(
        string $name,
        ?string $type = null,
        string $visibility = self::VISIBILITY_PUBLIC,
        ?int $position = null,
        bool $passByReference = false
    ) {
        parent::__construct($name, $type, null, $position, $passByReference);

        $this->visibility = $visibility;
    }

    /** @psalm-return non-empty-string */
    public function generate(): string
    {
        return $this->visibility . ' ' . parent::generate();
    }

    /**
     * @param \Laminas\Code\Reflection\ParameterReflection $reflectionParameter
     */
    public static function fromReflection($reflectionParameter): self
    {
        if (! $reflectionParameter->isPromoted()) {
            throw new RuntimeException(
                sprintf('Can not create "%s" from unprompted reflection.', self::class)
            );
        }

        $visibility = self::VISIBILITY_PUBLIC;

        if ($reflectionParameter->isProtectedPromoted()) {
            $visibility = self::VISIBILITY_PROTECTED;
        } elseif ($reflectionParameter->isPrivatePromoted()) {
            $visibility = self::VISIBILITY_PRIVATE;
        }

        return self::fromParameterGeneratorWithVisibility(
            parent::fromReflection($reflectionParameter),
            $visibility
        );
    }

    /** @psalm-param PromotedParameterGenerator::VISIBILITY_* $visibility
     * @param \Laminas\Code\Generator\ParameterGenerator $generator
     * @param string $visibility */
    public static function fromParameterGeneratorWithVisibility($generator, $visibility): self
    {
        $name = $generator->getName();
        $type = $generator->getType();

        if ('' === $name) {
            throw new \Laminas\Code\Generator\Exception\RuntimeException(
                'Name of promoted parameter must be non-empty-string.'
            );
        }

        if ('' === $type) {
            throw new \Laminas\Code\Generator\Exception\RuntimeException(
                'Type of promoted parameter must be non-empty-string.'
            );
        }

        return new self(
            $name,
            $type,
            $visibility,
            $generator->getPosition(),
            $generator->getPassedByReference()
        );
    }
}
