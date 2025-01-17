<?php

declare(strict_types=1);

namespace Baethon\Phln;

use Baethon\Phln\Phln as P;

final class RegExp
{
    /**
     * @var string
     */
    private $pattern;

    /**
     * @var string
     */
    private $modifiers;

    /**
     * @var bool
     */
    private $global = false;

    public function __construct(string $pattern, string $modifiers = '')
    {
        $this->pattern = $this->wrapInDelimiters($pattern);
        $this->modifiers = str_replace('g', '', $modifiers);
        $this->global = (false !== strstr($modifiers, 'g'));
    }

    public function isGlobal(): bool
    {
        return $this->global;
    }

    public function __toString(): string
    {
        return $this->pattern . $this->modifiers;
    }

    private function wrapInDelimiters(string $pattern): string
    {
        return $this->hasDelimiters($pattern) ? $pattern : sprintf(
            '/%s/',
            preg_quote($pattern, '/')
        );
    }

    /**
     * Checks if pattern has valid delimiter
     *
     * @param string $pattern
     * @return bool
     * @see https://secure.php.net/manual/en/regexp.reference.delimiters.php
     */
    private function hasDelimiters(string $pattern): bool
    {
        if (mb_strlen($pattern) < 2) {
            return false;
        }

        $start = substr($pattern, 0, 1);
        $end = substr($pattern, -1);

        if ($start !== $end) {
            return false;
        }

        return static::isValidDelimiter($start) && static::isValidDelimiter($end);
    }

    private static function isValidDelimiter(string $char): bool
    {
        return (bool) preg_match('/^[^a-z0-9\s]$/', $char);
    }

    /**
     * Creates RegExp instance based on passed regular expression.
     *
     * @param string $regexp
     * @return RegExp
     * @example
     *      RegExp::fromString('/foo/gi'); // -> new RegExp('/foo/', 'gi');
     */
    public static function fromString(string $regexp): RegExp
    {
        $start = substr($regexp, 0, 1);

        if (false === static::isValidDelimiter($start)) {
            return new static($regexp);
        }

        $endPosition = strrpos($regexp, $start);
        $pattern = substr($regexp, 0, $endPosition + 1);
        $modifiers = substr($regexp, $endPosition + 1);

        return new static($pattern, $modifiers);
    }

    /**
     * @param string|RegExp $regexp
     * @return RegExp
     */
    public static function of($regexp): RegExp
    {
        if ($regexp instanceof static) {
            return $regexp;
        }

        /** @var string $regexp */
        return static::fromString($regexp);
    }

    /**
     * @param string $test
     * @return string[]
     */
    public function matchAll(string $test): array
    {
        $matches = [];
        preg_match_all((string) $this, $test, $matches, PREG_SET_ORDER);

        $slice = function ($list) {
            return count($list) > 1
                ? array_slice($list, 1)
                : $list;
        };

        return P::flatMap($slice, $matches);
    }

    public function test(string $string): bool
    {
        return (bool) preg_match((string) $this, $string);
    }
}
