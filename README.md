## Requirements

- PHP 8.1 or higher.
- ext-simplexml (psalm requirement)

## Installation

The package could be installed with composer:

```shell
composer require kafkiansky/forbid --dev
```

## Why

I'm tired of code that is hard to **maintain**, hard to **read**, hard to **understand**, and hard to **extend**.
And that's why this plugin forbids traits, non-final classes, non-exhaustive abstraction, and other code smells.

## Testing

``` bash
$ composer codeception
```  

## License

The MIT License (MIT). See [License File](LICENSE.md) for more information.