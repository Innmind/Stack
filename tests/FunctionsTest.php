<?php
declare(strict_types = 1);

namespace Tests\Innmind\Stack;

use function Innmind\Stack\{
    stack,
    pipe,
    compose,
    curry,
};
use PHPUnit\Framework\TestCase;

class FunctionsTest extends TestCase
{
    public function testStackReturnsPipelineBuilder()
    {
        $this->assertIsCallable(stack());
    }

    public function testBuildStack()
    {
        $build = stack()
            (static function() {
                return [1];
            })
            (static function($value) {
                return [2, $value];
            })
            (static function($value) {
                return [3, $value];
            });

        $this->assertIsCallable($build);
        $this->assertSame([3, [2, [1]]], $build());
    }

    public function testReturnFunctionWhenPipingAFunction()
    {
        $this->assertIsCallable(
            pipe(function() {
                return 1;
            })
        );
    }

    public function testReturnValueWhenCallingPipedFunction()
    {
        $this->assertSame(
            1,
            pipe(function() {
                return 1;
            })()
        );
    }

    public function testCompose()
    {
        $value = compose(
            function($inner) {
                return 3 - $inner;
            },
            function() {
                return 2;
            }
        );

        $this->assertIsCallable($value);
        $this->assertSame(1, $value());
    }

    public function testCurry()
    {
        $add1 = curry(
            function($a, $b) {
                return $a + $b;
            },
            1
        );

        $this->assertIsCallable($add1);
        $this->assertSame(3, $add1(2));
    }
}
