<?php

declare(strict_types=1);

namespace baethon\phln;

const throw_exception = 'baethon\\phln\\throw_exception';

/**
 * Returns callback which throws given exception.
 *
 * *Note:* exceptions are considered as side-efects. Use it with caution.
 *
 * @param string $exception
 * @param array $args
 * @return callable
 */
function throw_exception (string $exception, array $args): callable {
    return function () use ($exception, $args) {
        throw new $exception(...$args);
    };
}
