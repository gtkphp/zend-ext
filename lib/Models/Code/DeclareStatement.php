<?php

namespace Zend\Ext\Models\Code;

use Zend\Ext\Models\Code\Exception\InvalidArgumentException;

use function array_keys;
use function gettype;
use function implode;
use function is_string;
use function key;
use function lcfirst;
use function sprintf;
use function str_replace;
use function ucwords;

class DeclareStatement
{
    public const TICKS        = 'ticks';
    public const STRICT_TYPES = 'strict_types';
    public const ENCODING     = 'encoding';

    private const ALLOWED = [
        self::TICKS        => 'integer',
        self::STRICT_TYPES => 'integer',
        self::ENCODING     => 'string',
    ];

    /**
     * @var string
     */
    protected $directive;

    /** @var int|string */
    protected $value;

    /** @param int|string $value */
    private function __construct(string $directive, $value)
    {
        $this->directive = $directive;
        $this->value     = $value;
    }

    public function getDirective(): string
    {
        return $this->directive;
    }

    /**
     * @return int|string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public static function ticks($value): self
    {
        return new self(self::TICKS, $value);
    }

    /**
     * @param int $value
     */
    public static function strictTypes($value): self
    {
        return new self(self::STRICT_TYPES, $value);
    }

    /**
     * @param string $value
     */
    public static function encoding($value): self
    {
        return new self(self::ENCODING, $value);
    }

    /**
     * @deprecated this API is deprecated, and will be removed in the next major release. Please
     *             use the other constructors of this class instead.
     * @param mixed[] $config
     */
    public static function fromArray($config): self
    {
        $directive = key($config);
        $value     = $config[$directive];

        if (! isset(self::ALLOWED[$directive])) {
            throw new InvalidArgumentException(
                sprintf(
                    'Declare directive must be one of: %s.',
                    implode(', ', array_keys(self::ALLOWED))
                )
            );
        }

        if (gettype($value) !== self::ALLOWED[$directive]) {
            throw new InvalidArgumentException(
                sprintf(
                    'Declare value invalid. Expected %s, got %s.',
                    self::ALLOWED[$directive],
                    gettype($value)
                )
            );
        }

        $method = str_replace('_', '', lcfirst(ucwords($directive, '_')));

        return self::{$method}($value);
    }

    public function getStatement(): string
    {
        $value = is_string($this->value) ? '\'' . $this->value . '\'' : $this->value;

        return sprintf('declare(%s=%s);', $this->directive, $value);
    }
}