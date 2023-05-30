<?php

namespace Zend\Ext\Models\Code\Generator\EnumGenerator;


use Zend\Ext\Models\Code\Generator\FileGenerator;
use Zend\Ext\Models\Code\Generator\EnumGenerator\Cases\BackedCases;
use Zend\Ext\Models\Code\Generator\EnumGenerator\Cases\CaseFactory;
use Zend\Ext\Models\Code\Generator\EnumGenerator\Cases\PureCases;
use ReflectionEnum;

use function array_map;
use function implode;

/** @psalm-immutable */
final class EnumGenerator
{
    /**
     * Line feed to use in place of EOL
     */
    private const LINE_FEED = "\n";

    /**
     * spaces of indentation by default
     */
    private const INDENTATION = '    ';

    /** @var FileGenerator|null */
    protected $containingFileGenerator = null;

    /** @var Name $name */
    private $name;

    /** @var BackedCases|PureCases */
    private $cases;

    /**
     * @param BackedCases|PureCases $cases
     */
    private function __construct(Name $name, $cases)
    {
        $this->name  = $name;
        $this->cases = $cases;
    }
    public function getName()
    {
        return $this->name->getName();
    }
    public function getDocBlock()
    {
        return null;
    }

    // Todo namespace

    /**
     * @return static
     */
    public function setContainingFileGenerator(FileGenerator $fileGenerator)
    {
        $this->containingFileGenerator = $fileGenerator;
        return $this;
    }

    /**
     * @return ?FileGenerator
     */
    public function getContainingFileGenerator()
    {
        return $this->containingFileGenerator;
    }

    public function generate(): string
    {
        $output = '';

        if (null !== $this->name->getNamespace()) {
            $output .= 'namespace ' . $this->name->getNamespace() . ';' . self::LINE_FEED . self::LINE_FEED;
        }

        return $output . 'enum ' . $this->name->getName() . $this->retrieveType() . ' {'
            . self::LINE_FEED
            . $this->retrieveCases()
            . '}'
            . self::LINE_FEED;
    }

    private function retrieveType(): string
    {
        if ($this->cases instanceof BackedCases) {
            return ': ' . $this->cases->type;
        }

        return '';
    }

    private function retrieveCases(): string
    {
        return implode(
            '',
            array_map(
                function (string $case) { return self::INDENTATION . 'case ' . $case . ';' . self::LINE_FEED;},
                $this->cases->cases
            )
        );
    }

    /**
     * @return PureCases|BackedCases
     */
    public function getCases()
    {
        return $this->cases;
    }
    

    /**
     * @psalm-param array{
     *      name: non-empty-string,
     *      pureCases: list<non-empty-string>,
     * }|array{
     *      name: non-empty-string,
     *      backedCases: array{
     *          type: 'int'|'string',
     *          cases: array<non-empty-string, int|non-empty-string>,
     *      },
     * } $options
     */
    public static function withConfig(array $options): self
    {
        return new self(
            Name::fromFullyQualifiedClassName($options['name']),
            CaseFactory::fromOptions($options)
        );
    }

    public static function fromReflection(ReflectionEnum $enum): self
    {
        return new self(
            Name::fromFullyQualifiedClassName($enum->getName()),
            CaseFactory::fromReflectionCases($enum)
        );
    }
}
