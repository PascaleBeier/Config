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

## Example

In the following, I'll give a brief overview of the API:


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

$config = new PascaleBeier\Config\Config(__DIR__.'/../config/');

echo $config->get('app.url'); // 'awesome.app'
echo $config->get('app.url', 'production.app'); // 'awesome.app'
echo $config->get('app.name', 'Awesome App'); // 'Awesome App'

echo $config->has('app.bla'); // false
echo $config->has('app.url'); // true
```

You can even use whitespace or change the '.' delimiter to something else! Read the API below.

## Usage

This tiny library simplifies working with configurational arrays. 
Usually, an Application has something like a 'config' directory with .php files returning arrays.

A real-world example might be Database Credentials: In that case, you would create a database.php file containing the following:

```php
// config/database.php

<?php

return [
	'hostname' => 'localhost',
	'username' => 'user',
	'password' => 'secret',
	'database' => 'app'
];
```

Using PascaleBeier\Config\Config you can easily retrieve anything stored in these arrays. (You can even nest those. Like super deep.)

You might be thinking of a tiny DatabaseConnection Class:


```php
// src/DatabaseConnection.php
<?php

class DatabaseConnection
{
	protected $config;

	protected $pdo;

	public function __construct()
	{
		$this->config = new \PascaleBeier\Config\Config(__DIR__.'/../config/');
	}

	public function connect()
	{
		$dsn = sprintf('mysql:host=%s;dbname=%s', $this->config->get('database.hostname'), $this->config->get('database.name')); 
		$this->pdo = new PDO($dsn, $this->config->get('database.username'), $this->config->get('database.password'));
	}
}
```

*Starting with v2.0.0 you can organize your arrays multidimensional.*

## API

### `get(string $key, string|null $default = null)`

`get('app.name')` looks for `app.php` in the configured path and returns the value of the key `name`.
Returns the default parameter if the key is not found.

Yeah, pretty inspired by Laravel.

You can even try ('app.abstract.foo.bar.baz.factory'), which will look after ['app']['abstract']['foo']['bar']['baz']['factory'].


### `has(string $key): bool`

`has('app.name')` checks if the key `name` exists in `app.php`. Think about it between the lines of `array_key_exists()`. (But recursive)

### `setDelimiter(string $delimiter): void`

Maybe you prefer writing `$config->get('app!software!version)` or `$config->get('app->software->version)`?

Simply call `setDelimiter('!')` and go ahead!

### `getDelimiter(): string`

Returns the current delimiter.

### `getConfig(): array`

Returns the raw configuration array.

### `setConfig(array $config): void`

Overwrite the configuration array.

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
