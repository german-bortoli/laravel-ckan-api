# Laravel api client for ckan

## WIP

This package is under development

**TODO:**
 - Implement unit tests.
 - Package documentation.

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

// Get paginated results
CkanApi::dataset()->all(['start' => $start]); // Start variable works only for datasets for now

// Second argument is to define extra params from *_show
CkanApi::dataset()->show('ref-id', ['include_tracking' => true]);
CkanApi::dataset()->create(['owner_org' => 'my-org', 'name' => 'super-title','title' => 'SUPER API TITLE']);
CkanApi::dataset()->update(['id' => 'ref-id', ...]);
CkanApi::dataset()->delete('ref-id');

//Only for dataset 
CkanApi::dataset()->revision_list('ref-id');
```

All possibles resources are:

```php
CkanApi::dataset()
CkanApi::group()
CkanApi::tag()
CkanApi::revision()
CkanApi::license()
CkanApi::organization()
```

All resources has enabled the methods, all, show, create, update, delete, but not every endpoint allows it, so it will throw an exception.

See more examples at [docs/simple_routing.md](docs/simple_routing.md)

For more information read [http://docs.ckan.org/en/latest/api/](http://docs.ckan.org/en/latest/api/)