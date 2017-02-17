# Simple route file

This example is just a laravel route file showing the possible methods and how to use the api.
 
 
 ```php
<?php

use Illuminate\Http\Request;

/**
 * CKAN DATASET
 */
Route::group(['prefix' => 'datasets'], function () {
    Route::get('/', function (Request $request) {

        $data = [
            'start' => $request->input('offset', 0),
        ];

        return CkanApi::dataset()->all($data);
    });

    // Get revisions for a single package
    Route::get('/revisions', function (Request $request) {
        return CkanApi::dataset()->revision_list('ckan-api-test-338');
    });

    Route::get('/{id}', function ($id) {
        return CkanApi::dataset()->show($id, ['include_tracking' => true]);
    });

    Route::post('/', function () {
        return CkanApi::dataset()->create([
            'name' => 'ckan-api-test-' . rand(1, 1000),
            'title' => 'ckan-api-test-' . rand(1, 1000),
            'owner_org' => 'sample-org',
            'private' => 'True',
        ]);
    });

    Route::put('/', function () {
        return CkanApi::dataset()->update([
            'title' => 'ckan-api-test-update',
            'id' => 'ece9ed37-c88d-4b53-a8ab-3b466a8f63cd',
        ]);
    });

    Route::delete('/', function () {
        return CkanApi::dataset()->delete('ece9ed37-c88d-4b53-a8ab-3b466a8f63cd');
    });
});



/**
 * CKAN RESOURCES
 */
Route::group(['prefix' => 'resources'], function () {
    Route::get('/', function (Request $request) {

        $data = [
            'offset' => $request->input('offset', 0),
            'query' => 'name:buenos',
        ];

        return CkanApi::resource()->all($data);
    });


    Route::get('/{id}', function ($id) {
        return CkanApi::resource()->show($id, [
            'include_extras' => true,
            'include_users' => true,
            'include_tags' => true,
        ]);
    });

    Route::post('/', function () {

        $data = [
            'url' => 'https://recursos-data.buenosaires.gob.ar/ckan2/distritos-escolares/distritos-escolares.csv',
            'clear_upload' => true,
            'package_id' => 'ckan-api-test-338',
            'name' => 'Buenos Aires - Distritos Escolares',
            'format' => 'CSV',
            'description' => 'Límites y ubicación geográfica de los distritos escolares de la Ciudad que surgieron a partir de la Ley de Educación Común (Ley N° 1.420/1884). Actualmente rige la división establecida por el Decreto Nº 7.475/80.',
        ];

        return CkanApi::resource()->create($data);
    });

    // Example upload a csv file
    Route::post('/upload', function () {

        $data = [
            'upload' => fopen(storage_path('app/catalogo-bibliotecas.csv'), 'r'),
//            'mimetype' => 'text/csv',
            'package_id' => 'ckan-api-test-338',
            'name' => 'Buenos Aires - Bibliotecas',
            'format' => 'CSV',
            'description' => 'Listado con ubicación geográfica de las bibliotecas de la Red del gobierno de la Ciudad Autónoma de Buenos Aires.',
        ];

        return CkanApi::resource()->create($data);
    });

    Route::put('/', function () {
        return CkanApi::resource()->update([
            'id' => '1abe62c3-4347-409a-8a86-6f97f2057db3',
            'name' => 'Buenos Aires - Bibliotecas - Edited',
        ]);
    });

    Route::delete('/', function () {
        return CkanApi::resource()->delete('1abe62c3-4347-409a-8a86-6f97f2057db3');
    });
});

/**
 * CKAN GROUPS
 */
Route::group(['prefix' => 'groups'], function () {

    Route::get('/', function (Request $request) {

        $data = [
            'offset' => $request->input('offset', 0),
        ];

        return CkanApi::group()->all($data);
    });

    Route::get('/{id}', function ($id) {
        return CkanApi::group()->show($id);
    });

    Route::post('/', function () {
        return CkanApi::group()->create([
            'name' => 'my-group',
        ]);
    });

    Route::put('/', function () {
        return CkanApi::group()->update([
            'id' => 'my-group',
            'display_name' => 'Edited My Group',
            'description' => 'This group was edited and added a description'
        ]);
    });

    Route::delete('/', function () {
        return CkanApi::group()->delete('my-group');
    });

});

/**
 * CKAN LICENSES
 */
Route::group(['prefix' => 'licenses'], function () {

    Route::get('/', function (Request $request) {

        $data = [];


        return CkanApi::license()->all($data);
    });

});

/**
 * CKAN REVISION
 */
Route::group(['prefix' => 'revisions'], function () {

    Route::get('/', function (Request $request) {

        $data = ['sort' => 'time_desc'];

        return CkanApi::revision()->all($data);
    });

});

/**
 * CKAN TAGS
 */
Route::group(['prefix' => 'tags'], function() {
    Route::get('/', function (Request $request) {

        $data = ['limit' => '12', 'offset' => $request->input('offset', 0)];

        return CkanApi::tag()->all($data);
    });

    Route::get('/{id}', function ($id) {
        return CkanApi::tag()->show($id);
    });

    Route::post('/', function () {
        return CkanApi::tag()->create([
            'name' => 'api-tag',
        ]);
    });

    Route::delete('/', function() {
        return CkanApi::tag()->delete('c7d90db1-ad3e-4db3-a599-38b4588e90a8');
    });
});



/**
 * CKAN ORGANIZATIONS
 */
Route::group(['prefix' => 'organizations'], function () {
    Route::get('/', function (Request $request) {

        $data = [
            'offset' => $request->input('offset', 0),
        ];

        return CkanApi::organization()->all($data);
    });


    Route::get('/{id}', function ($id) {
        return CkanApi::organization()->show($id, [
            'include_extras' => true,
            'include_users' => true,
            'include_tags' => true,
        ]);
    });

    Route::post('/', function () {
        return CkanApi::organization()->create([
            'display_name' => 'Ckan Api Test' . rand(1, 1000),
            'name' => 'ckan-api-test-' . rand(1, 1000),
        ]);
    });

    Route::put('/', function () {
        return CkanApi::organization()->update([
            'id' => 'ckan-api-test-59',
            'display_name' => 'Org updated from api',
            'description' => 'This is an organization, was updated from api',
        ]);
    });

    Route::delete('/', function () {
        return CkanApi::organization()->delete('fbd4cdad-d31d-422a-8ad1-98ee03c2423c');
    });
});
```