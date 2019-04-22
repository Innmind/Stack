<?php
declare(strict_types = 1);

namespace Innmind\Stack;

use Innmind\Immutable\Stream;

function pipe(callable $function, callable ...$functions): callable {
    $functions = Stream::of('callable', $function, ...$functions)->reverse();

    return static function() use ($functions) {
        return $functions->drop(1)->reduce(
            $functions->first()(),
            static function($inner, callable $outer) {
                return $outer($inner);
            }
        );
    };
}
