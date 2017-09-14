# Laravel api client for ckan

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

Example to create a resource into a package

```php
$data = [
    'url' => 'https://recursos-data.buenosaires.gob.ar/ckan2/distritos-escolares/distritos-escolares.csv',
    'clear_upload' => true,
    'package_id' => 'ckan-api-test-338',
    'name' => 'Buenos Aires - Distritos Escolares',
    'format' => 'CSV',
    'description' => 'Límites y ubicación geográfica de los distritos escolares de la Ciudad que surgieron a partir de la Ley de Educación Común (Ley N° 1.420/1884). Actualmente rige la división establecida por el Decreto Nº 7.475/80.',
];

CkanApi::resource()->create($data);
```

Example to create a resource uploading a file

```php
$data = [
    'upload' => fopen(storage_path('app/catalogo-bibliotecas.csv'), 'r'),
//  'mimetype' => 'text/csv',
    'package_id' => 'ckan-api-test-338',
    'name' => 'Buenos Aires - Bibliotecas',
    'format' => 'CSV',
    'description' => 'Listado con ubicación geográfica de las bibliotecas de la Red del gobierno de la Ciudad Autónoma de Buenos Aires.',
];

CkanApi::resource()->create($data);
```

All possibles resources are:

```php
CkanApi::dataset()
CkanApi::resource()
CkanApi::group()
CkanApi::tag()
CkanApi::revision()
CkanApi::license()
CkanApi::organization()
CkanApi::user()
```

All resources has the following methods enabled, `all, show, create, update, delete`, but some endpoints has only a few of those methods enabled.

See more examples at [docs/simple_routing.md](docs/simple_routing.md)

For more information read [http://docs.ckan.org/en/latest/api/](http://docs.ckan.org/en/latest/api/)
