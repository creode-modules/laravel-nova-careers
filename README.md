# Laravel Nova Careers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/creode/laravel-nova-careers.svg?style=flat-square)](https://packagist.org/packages/creode/laravel-nova-careers)
[![Total Downloads](https://img.shields.io/packagist/dt/creode/laravel-nova-careers.svg?style=flat-square)](https://packagist.org/packages/creode/laravel-nova-careers)

Exposes functionality within the Laravel Careers module to Laravel Nova.

## Installation

You can install the package via composer:

```bash
composer require creode/laravel-nova-careers
```

### Setup Page Builder Model
The default Career model has to be replaced to utilise some of the new page builder features, so ensure that you use the new model by editing the existing careers config:

```php
// config/careers.php
return [
    ...
    'model' => Creode\LaravelNovaCareers\Models\NovaCareer::class,
    ...
];
```

### Publishing Config

You can publish the config file with:

```bash
php artisan vendor:publish --tag="nova-careers-config"
```

This is the contents of the published config file:

```php
// config for Creode/LaravelNovaCareers
return [

    /*
    |--------------------------------------------------------------------------
    | Job Types
    |--------------------------------------------------------------------------
    |
    | Job types that can be selected with each job posting.
    |
    */
    'job_types' => [
        'Full Time' => 'Full Time',
        'Part Time' => 'Part Time',
        'Contract' => 'Contract',
        'Freelance' => 'Freelance',
        'Internship' => 'Internship',
        'Temporary' => 'Temporary',
        'Volunteer' => 'Volunteer',
        'Apprenticeship' => 'Apprenticeship',
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Email
    |--------------------------------------------------------------------------
    |
    | This value is the email address that careers applications will be sent
    | to.
    |
    */
    'application_email' => env('CAREERS_EMAIL', ''),

];
```

### Publishing Views

You can publish the views this module utilises with:

```bash
php artisan vendor:publish --tag="nova-careers-views"
```

### Registering Vacancies Page Block
This module supports the ability to expose a new optional page block within your site. This can be used in line with the `creode/nova-page-builder` module.

The block will display a list of vacancies that are currently active. To register the block add the following service provider to your `config/app.php` file:

```php

// config/app.php
'providers' => [
    ....
    Creode\LaravelNovaCareers\Providers\CareersPageBlockProvider::class,
    ...
];

```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Creode](https://github.com/creode)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
