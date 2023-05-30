<?php

namespace Zend\Ext\Models\Code\Generator\EnumGenerator\Cases;

use InvalidArgumentException;

use function in_array;
use function sprintf;

/**
 * @internal
 *
 * @psalm-immutable
 */
final class BackedCases
{
    /** @var string $type */
    public $type;

    /** @var string[]|array<string, int|string> $cases */
    public $cases;

    /**
     * @param 'int'|'string'         $type
     * @param list<non-empty-string> $cases
     */
    private function __construct(string $type, array $cases)
    {
        $this->type = $type;
        $this->cases = $cases;
    }

    /**
     * @param array<non-empty-string, int>|array<non-empty-string, string> $backedCases
     * @param 'int'|'string'                                               $type
     */
    public static function fromCasesWithType(array $backedCases, string $type): self
    {
        if (! ($type === 'int' || $type === 'string')) {
            throw new InvalidArgumentException(sprintf(
                '"%s" is not a valid type for Enums, only "int" and "string" types are allowed.',
                $type
            ));
        }

        $cases = [];
        foreach ($backedCases as $case) {
            $cases[] = ['name'=>$case['name'], 'value'=>$case['value']];
        }

        return new self($type, $cases);
    }
}
