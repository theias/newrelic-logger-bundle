# ias/newrelic-logger-bundle

This bundle logs to New Relic in Symfony apps.

Installation
============

Make sure Composer is installed globally, as explained in the
[installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Applications that use Symfony Flex
----------------------------------

Open a command console, enter your project directory and execute:

```console
$ composer require ias/newrelic-logger-bundle
```

Applications that don't use Symfony Flex
----------------------------------------

### Step 1: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```console
$ composer require ias/newrelic-logger-bundle
```

### Step 2: Enable the Bundle

Then, enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    IAS\NewRelicLoggerBundle\IASNewRelicLoggerBundle::class => ['all' => true],
];
```

Create a configuration file to change service defaults:

```yaml
# ias_new_relic_logger.yaml
ias_new_relic_logger:
    buffer_limit: 0
    level: !php/const Monolog\Logger::INFO
```

Options:
- buffer_limit: see Monolog\Handler\BufferHandler
- level: one of the levels defined in Monolog\Logger

Activate the log handler:

```yaml
monolog:
    handlers:
        newrelic:
            type: service
            id: ias_new_relic_logger.handler
```

## Developers

### Requirements

- PHP 7
- Composer

### Build

    composer build
