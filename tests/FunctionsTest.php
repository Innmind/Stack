<?php
declare(strict_types = 1);

namespace Tests\Innmind\Stack;

use function Innmind\Stack\{
    stack,
    curry,
};
use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    public function testBuildStack()
    {
        $three = static function($value) {
            return [3, $value];
        };
        $two = static function($value) {
            return [2, $value];
        };
        $one = static function() {
            return [1];
        };

        $build = stack(
            $three,
            $two,
            $one
        );

        $this->assertIsCallable($build);
        $this->assertSame([3, [2, [1]]], $build());
    }

    public function testBuildStackWithInnermostSpecifiedAtBuildTime()
    {
        $three = static function($value) {
            return [3, $value];
        };
        $two = static function($value) {
            return [2, $value];
        };

        $build = stack(
            $three,
            $two
        );

        $this->assertIsCallable($build);
        $this->assertSame([3, [2, [1]]], $build([1]));
    }

    public function testCurry()
    {
        $add = function($a, $b, $c) {
            return $a + $b + $c;
        };

        $add4 = curry($add, 1, 3);

        $this->assertIsCallable($add4);
        $this->assertSame(5, $add4(1));
    }
}
