# Simple route file

This example is just a laravel route file showing the possible methods and how to use the api.
 
 
 ```php
<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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
```