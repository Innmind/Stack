<?php
declare(strict_types = 1);

namespace Innmind\Stack;

function stack(): callable {
    return static function(callable $inner): callable {
        return pipe($inner);
    };
}

function pipe(callable $inner): callable
{
    return static function(callable $outer = null) use ($inner) {
        if (\is_null($outer)) {
            return $inner();
        }

        $inner = compose($outer, $inner);

        return pipe($inner);
    };
}

function compose(callable $outer, callable $inner): callable {
    return static function() use ($outer, $inner) {
        return $outer($inner());
    };
}

function curry(callable $call, $first): callable {
    return static function($second) use ($call, $first) {
        return $call($first, $second);
    };
}
