<?php
declare(strict_types = 1);

namespace Innmind\Stack;

function stack(callable $function, callable ...$functions): callable {
    $functions = \array_reverse([$function, ...$functions]);

    return static function($inner = null) use ($functions) {
        return \array_reduce(
            $functions,
            static function($inner, callable $outer) {
                return $outer($inner);
            },
            $inner
        );
    };
}

function curry(callable $fn, ...$first): callable {
    return static function(...$second) use ($fn, $first) {
        return $fn(...$first, ...$second);
    };
}
