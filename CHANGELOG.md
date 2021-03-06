# Changelog

All Notable changes to `Config` will be documented in this file.

## 3.0.1

### Fixed
- Tests

### Removed
- Obsolete files

## 3.0.0

Dropping PHP 5.6 support for these fancy type hints.
Adding PHP 7.2 tests.

Targeting a breaking change because of the interface changes.

### Added
- Type Hinting
- PHP 7.2

### Removed
- PHP 5.6

## 2.1.0

### Added
- new API
- setDelimiter
- getDelimiter
- setConfig

### Deprecated
- Nothing

### Fixed
- Nothing

### Removed
- load()
- ArrayHelper::class

### Security
- Nothing

## 2.0.1

### Added
- ConfigInterface
- Some Real World Example

### Deprecated
- Nothing

### Fixed
- Wrong FQN Namespace in the README, thanks to [/u/yanickl88](https://www.reddit.com/user/yannickl88)

### Removed
- Nothing

### Security
- Nothing


## 2.0.0

### Added
- You can now recursively search your config files, for example:

```php

// config/app.php
<?php

return [
    'name' => 'foo',
    'software' => [
        'version' => 'v2.0',
    ],
];
````

```php
<?php

$config->get('app.software.version') // v2.0 
```


### Deprecated
- Nothing

### Fixed
- Nothing

### Removed
- Public API for instantiation has changed to this:

```php

<?php

$config = new PascaleBeier\Config(__DIR__.'/../config');
$config->load();
```

- Exceptions have been removed - I found them to be an overhead
- StringFormatter has been replaced by ArrayHelper
- Removed PR and Issue Templates

### Security
- Nothing

## 1.0.4

### Added
- Nothing

### Deprecated
- Nothing

### Fixed
- PSR Icons

### Removed
- Nothing

### Security
- Nothing

## 1.0.3

### Added
- Added PHP Compat. Notice
- Added PSR Compat. Notice

### Deprecated
- Nothing

### Fixed
- Code Coverage

### Removed
- Nothing

### Security
- Nothing

## 1.0.2

### Added
- Usage and API Instructions
- packagist package

### Deprecated
- Nothing

### Fixed
- README Icons

### Removed
- Nothing

### Security
- Nothing

## 1.0.1

### Added
- Nothing

### Deprecated
- Nothing

### Fixed
- Nothing

### Removed
- PHP 5.6 lowest and HHVM Support

### Security
- Nothing