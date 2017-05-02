<?php

use function phln\fn\pipe;

class PipeTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_composes_functions()
    {
        $f = function ($a, $b) {
            return $a + $b;
        };
        $g = function ($i) {
            return $i * 2;
        };
        $h = pipe($f, $g);

        $expected = $g($f(2, 3));
        $this->assertEquals($expected, $h(2, 3));
    }

    /** @test */
    public function it_composes_one_function()
    {
        $f = function ($a, $b) {
            return $a + $b;
        };
        $g = pipe($f);

        $this->assertEquals($f(2, 3), $g(2, 3));
    }

    /** @test */
    public function it_fails_when_composing_without_functions()
    {
        $this->expectException(\UnderflowException::class);
        pipe();
    }
}
