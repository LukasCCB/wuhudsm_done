<?php
/*
 * Copyright (c) 08-09/08/23, 11:51.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

// API Version = 1
Route::prefix('v1')->middleware('cors')->group(function () {

    // Auth
    Route::middleware(['api'])->group(function () {

        // Authentication
        Route::prefix('auth')->group(function () {
            Route::post('login', '\App\Http\Controllers\Backend\AuthController@login');
        });

        // Accounts
        Route::prefix('accounts')->group(function () {
            Route::get('/all', '\App\Http\Controllers\Backend\ApiAccountsController@index');
            Route::get('/show/{param}', '\App\Http\Controllers\Backend\ApiAccountsController@show');
            Route::get('/show_all_loots', '\App\Http\Controllers\Backend\ApiAccountsController@showAllLootID');
            Route::post('/create', '\App\Http\Controllers\Backend\ApiAccountsController@store');
            Route::post('/update/{id}', '\App\Http\Controllers\Backend\ApiAccountsController@update');
            Route::post('/delete/{id}', '\App\Http\Controllers\Backend\ApiAccountsController@destroy');
        });

        // Skilltree
        Route::prefix('skilltree')->group(function () {
            Route::post('/all', '\App\Http\Controllers\Backend\ApiSkilltreeController@index');
            Route::get('/show/{id}', '\App\Http\Controllers\Backend\ApiSkilltreeController@show');
            Route::post('/update/{id}', '\App\Http\Controllers\Backend\ApiSkilltreeController@update');
        });

        // Characters
        Route::prefix('characters')->group(function () {
            Route::get('/all', '\App\Http\Controllers\Backend\ApiCharacterController@index');
            Route::get('/show/{id}', '\App\Http\Controllers\Backend\ApiCharacterController@show');
            Route::post('/update/{id}', '\App\Http\Controllers\Backend\ApiCharacterController@update');
        });

        // Items
        Route::prefix('marketplace')->group(function () {
            Route::get('/all', '\App\Http\Controllers\Backend\ApiMarketplaceController@index');
            Route::get('/show/{id}', '\App\Http\Controllers\Backend\ApiMarketplaceController@show');
            Route::post('/update/{id}', '\App\Http\Controllers\Backend\ApiMarketplaceController@update');

            // By category
            Route::get('/weapons', '\App\Http\Controllers\Backend\ApiMarketplaceController@weapons');
            Route::get('/meeles', '\App\Http\Controllers\Backend\ApiMarketplaceController@meeles');
            Route::get('/medicals', '\App\Http\Controllers\Backend\ApiMarketplaceController@medicals');
            Route::get('/eats', '\App\Http\Controllers\Backend\ApiMarketplaceController@eats');
            Route::get('/gears', '\App\Http\Controllers\Backend\ApiMarketplaceController@gears');
            Route::get('/attachments', '\App\Http\Controllers\Backend\ApiMarketplaceController@attachments');
            Route::get('/ammo', '\App\Http\Controllers\Backend\ApiMarketplaceController@ammo');
        });

        // LootData
        Route::prefix('lootdata')->group(function () {
            Route::get('/all', '\App\Http\Controllers\Backend\ApiLootDataController@index');
            Route::get('/show/{param}', '\App\Http\Controllers\Backend\ApiLootDataController@show');
            Route::get('/show_all_loots', '\App\Http\Controllers\Backend\ApiLootDataController@showAllLootID');
            Route::post('/create', '\App\Http\Controllers\Backend\ApiLootDataController@store');
            Route::post('/update/{id}', '\App\Http\Controllers\Backend\ApiLootDataController@update');
            Route::post('/delete/{id}', '\App\Http\Controllers\Backend\ApiLootDataController@destroy');
        });

        // Github Update
        Route::prefix('github')->group(function () {
            Route::post('/new', '\App\Http\Controllers\Backend\WebhookController@handleGitHubWebhook');
            Route::post('/notify/read', '\App\Http\Controllers\Backend\WebhookController@clicked');
        });

        // Accounts
        Route::prefix('panel')->group(function () {
            Route::prefix('license')->group(function () {
                Route::post('/check', '\App\Http\Controllers\Backend\ApiLicenseController@check');
            });
        });

    });
});
