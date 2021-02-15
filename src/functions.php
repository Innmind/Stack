<?php
declare(strict_types = 1);

namespace Innmind\Stack;

/**
 * @template T
 *
 * @param callable(T): T $function
 * @param callable(T): T $functions
 *
 * @return callable(T): T
 */
function stack(callable $function, callable ...$functions): callable {
    \array_unshift($functions, $function);
    $functions = \array_reverse($functions);

    /**
     * @psalm-suppress MissingClosureParamType
     * @psalm-suppress MissingClosureReturnType
     * @psalm-suppress MixedInferredReturnType
     */
    return static function($inner = null) use ($functions) {
        /** @var T $inner */

        /**
         * @psalm-suppress MissingClosureParamType
         * @psalm-suppress MissingClosureReturnType
         * @psalm-suppress MixedReturnStatement
         */
        return \array_reduce(
            $functions,
            static function($inner, callable $outer) {
                return $outer($inner);
            },
            $inner
        );
    };
}

/**
 * @template A
 * @template R
 *
 * @param callable(...A): R $fn
 * @param A $first
 *
 * @return callable(...A): R
 */
function curry(callable $fn, ...$first): callable {
    /** @psalm-suppress MissingClosureParamType */
    return static function(...$second) use ($fn, $first) {
        /** @var list<A> $second */
        return $fn(...$first, ...$second);
    };
}
