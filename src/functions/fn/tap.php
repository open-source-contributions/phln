<?php

declare(strict_types=1);

namespace baethon\phln;

const tap = 'baethon\\phln\\tap';

/**
 * Runs the given function with the supplied object, then returns the object.
 *
 * @param callable $fn
 * @param mixed $value
 * @return mixed
 */
function tap (callable $fn, $value) {
    $fn($value);
    return $value;
}
