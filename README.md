# Config

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]
![PSR 2][ico-psr2]
![PSR 4][ico-psr4]

Simple Configuration. If you think Symfony/YAML is an overkill or you prefer using .php files. 
Organize your Application Configuration like `config/app.php`.

Tested for PHP 5.6, PHP 7.0 and PHP 7.1, implementing PSR-2 and PSR-4.

## Install

Via Composer

``` bash
$ composer require pascaleBeier/config
```

## Usage

``` php
// config/app.php
// return a key => value array

<?php

return [
    'url' => 'awesome.app',
];

```

``` php
// somewhere.php
// In the real world you would want to bind a configured Config Class Instance to your container or singleton

<?php

$config = new PascaleBeier\Config(__DIR__.'/../config/');
$config->load();

echo $config->get('app.url'); // 'awesome.app'
echo $config->get('app.url', 'production.app'); // 'awesome.app'
echo $config->get('app.name', 'Awesome App'); // 'Awesome App'

```

*Starting with v2.0.0 you can organize your arrays multidimensional.*

## API

### `get(string $key, string|null $default = null)`

`get('app.name')` looks for `app.php` in the configured path and returns the value of the key `name`.
Returns the default parameter if the key is not found.

Yeah, pretty inspired by Laravel.

### `has(string $key)`

`has('app.name')` checks if the key `name` exists in `app.php`. Just a convenience wrapper around `array_key_exists()`.

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

If you discover any security related issues, please email mail@pascalebeier.de instead of using the issue tracker.

## Credits

- [Pascale Beier][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/PascaleBeier/Config.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/PascaleBeier/Config/master.svg?style=flat-square
[ico-scrutinizer]: https://scrutinizer-ci.com/g/PascaleBeier/Config/badges/coverage.png?b=master
[ico-code-quality]: https://img.shields.io/scrutinizer/g/PascaleBeier/Config.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/PascaleBeier/Config.svg?style=flat-square
[ico-psr2]: https://img.shields.io/badge/psr-2-brightgreen.svg
[ico-psr4]: https://img.shields.io/badge/psr-4-brightgreen.svg

[link-packagist]: https://packagist.org/packages/PascaleBeier/Config
[link-travis]: https://travis-ci.org/PascaleBeier/Config
[link-scrutinizer]: https://scrutinizer-ci.com/g/PascaleBeier/Config/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/PascaleBeier/Config
[link-downloads]: https://packagist.org/packages/PascaleBeier/Config
[link-author]: https://github.com/PascaleBeier
[link-contributors]: ../../contributors
