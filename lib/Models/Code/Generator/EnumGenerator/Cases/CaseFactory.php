<?php

namespace Zend\Ext\Models\Code\Generator\EnumGenerator\Cases;

use ReflectionEnum;
use ReflectionEnumBackedCase;
use ReflectionEnumUnitCase;
use ReflectionNamedType;

use function array_combine;
use function array_key_exists;
use function array_map;
use function assert;

/** @internal */
final class CaseFactory
{
    /**
     * @psalm-param array{
     *      name: non-empty-string,
     *      pureCases: list<non-empty-string>,
     * }|array{
     *      name: non-empty-string,
     *      backedCases: array{
     *          type: 'int',
     *          cases: array<non-empty-string, int>,
     *      }|array{
     *          type: 'string',
     *          cases: array<non-empty-string, non-empty-string>,
     *      },
     * } $options
     * @return BackedCases|PureCases
     */
    public static function fromOptions(array $options)
    {
        if (array_key_exists('pureCases', $options) && ! array_key_exists('backedCases', $options)) {
            return PureCases::fromCases($options['pureCases']);
        }

        assert(! array_key_exists('pureCases', $options) && array_key_exists('backedCases', $options));
        return BackedCases::fromCasesWithType($options['backedCases']['cases'], $options['backedCases']['type']);
    }

    /**
     * @return BackedCases|PureCases
     */
    public static function fromReflectionCases(ReflectionEnum $enum)
    {
        $backingType = $enum->getBackingType();

        if ($backingType === null) {
            return PureCases::fromCases(array_map(
                /** @return non-empty-string */
                function (ReflectionEnumUnitCase $singleCase) { return $singleCase->getName();},
                $enum->getCases()
            ));
        }
        

        assert($backingType instanceof ReflectionNamedType);

        $cases = $enum->getCases();

        return BackedCases::fromCasesWithType(
            array_combine(
                array_map(
                    /** @return non-empty-string */
                    function (ReflectionEnumBackedCase $case) { return $case->getName();},
                    $cases
                ),
                array_map(function (ReflectionEnumBackedCase $case) { return $case->getBackingValue();}, $cases)
            ),
            $backingType->getName()
        );
        

    }
}
