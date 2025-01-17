<?php

declare(strict_types=1);

use Baethon\Phln\Phln as P;

P::macro('sortBy', function (callable $mapper, array $list): array {
    $column = array_map($mapper, $list);
    array_multisort($column, \SORT_REGULAR, $list);

    return $list;
});
