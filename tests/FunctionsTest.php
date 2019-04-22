<?php
declare(strict_types = 1);

namespace Tests\Innmind\Stack;

use function Innmind\Stack\{
    stack,
    pipe,
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

        $build = pipe(
            $three,
            $two,
            $one
        );

        $this->assertIsCallable($build);
        $this->assertSame([3, [2, [1]]], $build());
    }
}
