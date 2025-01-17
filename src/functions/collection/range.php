<?php

declare(strict_types=1);

use Baethon\Phln\Phln as P;

P::macro('range', function (int $from, int $to): array {
    if ($from === $to) {
        return [];
    }

    return ($from < $to) ? \range($from, $to - 1) : \range($from, $to + 1);
});
