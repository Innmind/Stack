# Stack

[![codecov](https://codecov.io/gh/Innmind/Stack/branch/develop/graph/badge.svg)](https://codecov.io/gh/Innmind/Stack)
[![Build Status](https://github.com/Innmind/Stack/workflows/CI/badge.svg?branch=master)](https://github.com/Innmind/Stack/actions?query=workflow%3ACI)
[![Type Coverage](https://shepherd.dev/github/Innmind/Stack/coverage.svg)](https://shepherd.dev/github/Innmind/Stack)

Simple function to stack elements on top of each others. Useful to create object stacks.

## Installation

```sh
composer require innmind/stack
```

## Usage

```php
use function Innmind\Stack\stack;

$decorate = stack(
    static function(RequestHandler $handler) {
        return new ValidateRequest($handler);
    },
    static function(RequestHandler $handler) {
        return new Security($handler);
    }
);
$handler = $decorate(new MyRequestHandler);
```

The above example is equivalent to:

```php
$handler = new ValidateRequest(
    new Security(
        new MyRequestHandler
    )
);
```
**Note**: the classes uses do not exist, they're only meant as an example.
