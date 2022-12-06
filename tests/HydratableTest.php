<?php

namespace Battis\Hydratable\Tests;

use Battis\Hydratable\Tests\Fixtures\HydratableTest\A;
use PHPUnit\Framework\TestCase;

class HydratableTest extends TestCase
{
    public function testDecodeArray()
    {
        $fixtures = [
            [
                ['["a","1",false]'],
                ['a', 1, false]
            ],
            [
                ['a:3:{i:0;s:1:"a";i:1;i:1;i:2;b:0;}'],
                ['a', 1, false]
            ]
        ];
        $a = new A();

        foreach($fixtures as list($args, $expected)) {
            $this->assertEquals($expected, $a->fixtureDecodeArray(...$args));
        }
    }
}
