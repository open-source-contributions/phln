<?php

use Baethon\Phln\Phln as P;

class JoinTest extends \PHPUnit\Framework\TestCase
{
    public function test_it_joins_array_elements()
    {
        $this->assertEquals('1,2,3', P::join(',', [1, 2, 3]));
    }
}