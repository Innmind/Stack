# Stack

| `develop` |
|-----------|
| [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Innmind/Stack/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/Innmind/Stack/?branch=develop) |
| [![Code Coverage](https://scrutinizer-ci.com/g/Innmind/Stack/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/Innmind/Stack/?branch=develop) |
| [![Build Status](https://scrutinizer-ci.com/g/Innmind/Stack/badges/build.png?b=develop)](https://scrutinizer-ci.com/g/Innmind/Stack/build-status/develop) |

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
