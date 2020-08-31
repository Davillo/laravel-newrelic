
## Requirements

- PHP >= 7.2
- [Composer](http://getcomposer.org)

## Usage

### Installation
Run the following command to install the package through Composer:
```
composer require davillo/laravel-newrelic
```

### Bootstrapping

This will ensure that exceptions are correctly reported to New Relic.
Now, add the middleware too:

```php
$app->middleware([
    ...
   Davillo\NewRelic\NewRelicMiddleware::class
]);
```
register the service provider:
```php
  $app->register(Davillo\NewRelic\NewRelicServiceProvider::class);
```

### ENV
finally, on the .env of the lumen/laravel app, register two new key-value variables
NEWRELIC_APP_NAME='The name of the app on new relic dashboard'
NEWRELIC_APP_LICENSE='new relic dashboard key'
