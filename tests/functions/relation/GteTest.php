<?php

use Baethon\Phln\Phln as P;

class GteTest extends \PHPUnit\Framework\TestCase
{
    public function test_it_checks_if_value_is_greater_or_equal()
    {
        $this->assertTrue(P::gte(2, 2));
        $this->assertTrue(P::gte(2, 1));
        $this->assertFalse(P::gte(2, 3));
    }
}
