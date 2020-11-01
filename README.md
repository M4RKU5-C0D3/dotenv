# Dotenv

[![Latest Version on Packagist](https://img.shields.io/packagist/v/m4rku5/dotenv.svg?style=flat-square)](https://packagist.org/packages/m4rku5/dotenv)
[![Total Downloads](https://img.shields.io/packagist/dt/m4rku5/dotenv.svg?style=flat-square)](https://packagist.org/packages/m4rku5/dotenv)

## Installation
Install package via composer:

```bash
composer require m4rku5/dotenv
```

## Usage

From `.env` ...
```
# DOCKER:
DOCKER_PORT=8001

# PROJECT:
#PROJECT_DOCUMENTROOT=public
#PROJECT_LOGS=logs
```

... doing ...
```php
$dotenv = new Dotenv('.env');
$dotenv->set('PROJECT_DOCUMENTROOT', 'test');
$dotenv->enable('PROJECT_DOCUMENTROOT');
$dotenv->set('HELLO', 'World');
$dotenv->disable('HELLO');
$dotenv->unset('DOCKER_PORT');
$dotenv->save();
```

... will result in ...
```
# DOCKER:

# PROJECT:
PROJECT_DOCUMENTROOT=test
#PROJECT_LOGS=logs

#HELLO=World
```

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
