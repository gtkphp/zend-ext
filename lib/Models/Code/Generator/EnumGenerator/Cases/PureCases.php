<?php

namespace Zend\Ext\Models\Code\Generator\EnumGenerator\Cases;

/**
 * @internal
 *
 * @psalm-immutable
 */
final class PureCases
{
    /** @var array $cases */
    public $cases;

    /** @param list<non-empty-string> $cases */
    private function __construct(array $cases)
    {
        $this->cases = $cases;
    }

    /**
     * @param list<non-empty-string> $pureCases
     */
    public static function fromCases(array $pureCases): self
    {
        return new self($pureCases);
    }
}
