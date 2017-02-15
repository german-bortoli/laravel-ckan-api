# Laravel api client for ckan

## WIP

This package is under development

**TODO:**

 - Implement latest api endpoints (http://docs.ckan.org/en/latest/api/) rather than rest
 - Implement unit tests.

## Installation

### Add to composer

`composer require germanazo/laravel-ckan-api`

### Load service provider

Register the service provider in `config/app.php`

```php
    'provider' => [
        ...
        Germanazo\CkanApi\CkanServiceProvider::class,
        ...
    ]
```

And register facade alias in the same config file. 


```php
    'aliases' => [
        ...
        'CkanApi' => Germanazo\CkanApi\Facades\CkanApi::class,
        ...
    ]
```

### Publish vendor 

```sh
php artisan vendor:publish --provider="Germanazo\CkanApi\CkanServiceProvider"
```

### Configure Ckan API

Configure the file located into `config/ckan_api.php` or if you prefer use env variables:
 
```txt
CKAN_API_URL=https://data.myckan.com
CKAN_API_KEY={{MY SUPER SECRET API KEY}
``` 

And if you know what are you doing, then it is possible to configure the api version too:

`CKAN_API_VERSION=2`

CKAN_API_KEY can be found inside your ckan user profile.

### Use it:

```php
use CkanApi

CkanApi::dataset()->all();
CkanApi::dataset()->find('ref-id');
CkanApi::dataset()->create(['owner_org' => 'my-org', 'name' => 'super-title','title' => 'SUPER API TITLE']);
CkanApi::dataset()->update([...]);
CkanApi::dataset()->delete('super-title');
```

All possibles resources are:

```php
CkanApi::dataset()
CkanApi::group()
CkanApi::tag()
CkanApi::revision()
CkanApi::license()
CkanApi::util()
```

All resources has enabled the methods, all, find, create, update, delete, but not every endpoint allows it, so it will throw an exception.

For more information read [http://docs.ckan.org/en/latest/api/legacy-api.html#model-resources](http://docs.ckan.org/en/latest/api/legacy-api.html#model-resources)