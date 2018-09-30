<?php

use Baethon\Phln\Phln as P;

class MaxTest extends \PHPUnit\Framework\TestCase
{
    public function test_it_returns_bigger_value()
    {
        $this->assertEquals(1, P::max(-1, 1));
        $this->assertEquals(1, P::max(1, -1));
    }

    public function test_it_is_curried()
    {
        $f = P::max(1);
        $this->assertEquals(1, $f(-1));
    }
}
