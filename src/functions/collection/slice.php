<?php

declare(strict_types=1);

use Baethon\Phln\Phln as P;

P::macro('slice', function (int $offset, int $length, $collection) {
    return P::apply(
        P::typeCond([
            ['array', P::partialRight('\\array_slice', [$offset, $length])],
            ['string', P::partialRight('\\substr', [$offset, $length])],
            [P::otherwise(), P::throwException(\InvalidArgumentException::class, [])],
        ]),
        [$collection]
    );
});
