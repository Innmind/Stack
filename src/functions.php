<?php
declare(strict_types = 1);

namespace Innmind\Stack;

use Innmind\Immutable\Sequence;

function stack(callable $function, callable ...$functions): callable {
    $functions = Sequence::of($function, ...$functions)->reverse();

    return static function() use ($functions) {
        return $functions->drop(1)->reduce(
            $functions->first()(),
            static function($inner, callable $outer) {
                return $outer($inner);
            }
        );
    };
}

function curry(callable $fn, ...$first): callable {
    return static function(...$second) use ($fn, $first) {
        return $fn(...$first, ...$second);
    };
}
