<?php
declare(strict_types=1);

use Baethon\Phln\Phln as P;

P::macro('pipe', function (...$fns): \Closure {
    $fnsCount = count($fns);

    if (1 === $fnsCount && is_array($fns[0])) {
        $fns = $fns[0];
        $fnsCount = count($fns);
    }

    if (0 === $fnsCount) {
        throw new \UnderflowException('pipe requires at least one argument');
    }

    return function (...$args) use ($fns) {
        $head = $fns[0];
        $tail = array_slice($fns, 1);

        return array_reduce($tail, function ($carry, callable $fn) {
            return $fn($carry);
        }, $head(... $args));
    };
});