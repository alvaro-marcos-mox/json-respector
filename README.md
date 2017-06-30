# json-respector

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

A Validator which transforms JSON Schemas to respect/validation instances.

## Supported Rules

Draft 6

## Install

Via Composer

``` bash
$ composer require augusthur/json-respector
```

## Usage

``` php
// Create the Validator Service instance
$validation = new Augusthur\JsonRespector\ValidatorService();

// Generate a Respect Validator instance from a JSON schema string
$v = $validation->fromSchema('{"type": "string", "minLength": 3}');

// Returns true
$v->validate('abcde');

// To use the plain Respect Validator use start()
// Returns true
$validation->start()->numeric()->validate(123);
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, just use the issue tracker.

## Credits

- [Augusto Mathurin][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/augusthur/json-respector.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/augusthur/json-respector/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/augusthur/json-respector.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/augusthur/json-respector.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/augusthur/json-respector.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/augusthur/json-respector
[link-travis]: https://travis-ci.org/augusthur/json-respector
[link-scrutinizer]: https://scrutinizer-ci.com/g/augusthur/json-respector/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/augusthur/json-respector
[link-downloads]: https://packagist.org/packages/augusthur/json-respector
[link-author]: https://github.com/augusthur
[link-contributors]: ../../contributors
