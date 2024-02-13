# Factory without events

![Latest Version on Packagist](https://img.shields.io/packagist/v/rogermedico/factory-without-events)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/:vendor_slug/:package_slug/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/:vendor_slug/:package_slug/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/:vendor_slug/:package_slug/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
![Total Downloads](https://img.shields.io/packagist/dt/rogermedico/factory-without-events)

---
This repo can be used to make or create Laravel factories without execution of previously created afterMaking and afterCreating callbacks.

## Installation

You can install the package via composer:

```bash
composer require rogermedico/factory-without-events
```

## Usage

Make your factory as usual and add the WithoutEvents trait to it. Then in your code if you want to make/create a factory without executing afterMake or afterCreate callbacks do it like this:

```php
$user = User::factory()
    ->withoutEvents()
    ->create();
```

## Credits

- [Roger Medico](https://github.com/rogermedico)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
