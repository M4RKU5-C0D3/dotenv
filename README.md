# Dotenv editing toolset

[![Latest Version on Packagist](https://img.shields.io/packagist/v/m4rku5/dotenv.svg?style=flat-square)](https://packagist.org/packages/m4rku5/dotenv)
[![Total Downloads](https://img.shields.io/packagist/dt/m4rku5/dotenv.svg?style=flat-square)](https://packagist.org/packages/m4rku5/dotenv)
[![Build Status](https://img.shields.io/travis/m4rku5/dotenv/master.svg?style=flat-square)](https://travis-ci.org/m4rku5/dotenv)
[![Quality Score](https://img.shields.io/scrutinizer/g/m4rku5/dotenv.svg?style=flat-square)](https://scrutinizer-ci.com/g/m4rku5/dotenv)
[![Code Coverage](https://scrutinizer-ci.com/g/m4rku5/dotenv/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/m4rku5/dotenv/?branch=master)
[![StyleCI](https://github.styleci.io/repos/145056191/shield)](https://github.styleci.io/repos/145056191)

This package provides some basic tools for editing dotenv files.

## Installation
You can install the package via composer:

```bash
> composer require m4rku5/dotenv
```

## Usage

### Add a section
Given we have an existing file at `base_path('.env')`.
```
APP_KEY=supersecret
APP_FOO=BAR
```

We can add a new section to the existing configuration file.
``` php
$editor = new DotenvEditor;

$editor->load(base_path('.env'));
$editor->heading('Examples');
$editor->set('FOO', 'bar');
$editor->set('BAZ', 'bax');
$editor->unset('APP_FOO');
$editor->save();
```

This will result in the following changes.
```
APP_KEY=supersecret

# Examples
FOO=bar
BAZ=bax
```

## Testing
```bash
> vendor/bin/phpunit
```

## Code Style
In addition to the php-cs-fixer rules, StyleCI will apply the [Laravel preset](https://docs.styleci.io/presets#laravel).
```bash
> composer styles:lint
> composer styles:fix
```

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing
Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security
If you discover any security related issues, please email oss@tjmiller.co instead of using the issue tracker.


## Credits
- [TJ Miller](https://github.com/m4rku5)
- [All Contributors](../../contributors)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
