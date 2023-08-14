<?php
/*
 * Copyright (c) 08-09/08/23, 16:47.
 * Created By WebZow Soluções Digitais.
 * Site: https://webzow.com
 * Discord: https://discord.gg/TgCccsKSYu
 */

/**
 * ************ Be aware of the rules! ************
 * Controllers are separated between Frontend and Backend.
 *
 * Any changes made here without proper knowledge, technical support will not be able to correct in the plan support package.
 * If you need new features or changes, get in contact to developers via admin@webzow.com
 */

Route::get('/', 'Frontend\DashboardController@landing')->name('landing');

// Authentication
Route::get('/logout', 'Frontend\AuthenticationController@logout')->name('logout');

// Admin access
Route::group(['prefix' => '/admin'], function () {

    // Authentication
    Route::get('/login', 'Frontend\AuthenticationController@page_login')->name('admin.login');
    Route::post('/login', 'Frontend\AuthenticationController@login');

    Route::middleware(['auth'])->group(function () {

        //Route::group(['middleware' => ['auth'], 'as' => 'admin.'], function () {
        Route::get('/dashboard', 'Frontend\DashboardController@index')->name('admin.dashboard');
        //});

        // Dashboard
        Route::get('/', 'Frontend\DashboardController@index')->name('admin');

        // Accounts
        Route::group(['prefix' => '/accounts'], function () {

            Route::get('/edit/{id}', 'Frontend\AccountsController@edit')->name('admin.account.edit');

            // List All
            Route::group(['prefix' => '/all'], function () {
                Route::get('/', 'Frontend\AccountsController@all')->name('admin.accounts.all');
                Route::get('/premium', 'Frontend\AccountsController@premium')->name('admin.accounts.all.premium');
                Route::get('/developers', 'Frontend\AccountsController@developers')->name('admin.accounts.all.developers');
                Route::get('/banneds', 'Frontend\AccountsController@banneds')->name('admin.accounts.all.banneds');
            });

            // Top users
            Route::group(['prefix' => '/top'], function () {
                Route::get('/gc', 'Frontend\AccountsController@gc')->name('admin.top.users.gc');
                Route::get('/gd', 'Frontend\AccountsController@gd')->name('admin.top.users.gd');
            });
        });

        // Prices Analytics
        Route::get('/analytics', 'Frontend\AnalyticsController@index')->name('admin.analytics');

        // Skilltree
        Route::group(['prefix' => '/skilltree'], function () {
            Route::get('/', 'Frontend\SkilltreeController@index')->name('admin.skilltree.list');
            Route::get('/edit/{id}', 'Frontend\SkilltreeController@edit')->name('admin.skilltree.edit');
        });

        // Characters
        Route::group(['prefix' => '/characters'], function () {
            Route::get('/', 'Frontend\CharacterController@index')->name('admin.characters.list');
            Route::get('/edit/{id}', 'Frontend\CharacterController@edit')->name('admin.characters.edit');
        });

        // Marketplace
        Route::group(['prefix' => '/marketplace'], function () {

            // All Items
            Route::get('/all', 'Frontend\MarketplaceController@all')->name('admin.marketplace.all');

            // Edit item
            Route::get('/edit/{id}', 'Frontend\MarketplaceController@edit')->name('admin.marketplace.edit');

            // Weapons
            Route::get('/weapons', 'Frontend\MarketplaceController@weapons')->name('admin.marketplace.weapons');

            // Meeles
            Route::get('/meeles', 'Frontend\MarketplaceController@meeles')->name('admin.marketplace.meeles');

            // Medicals
            Route::get('/medicals', 'Frontend\MarketplaceController@medicals')->name('admin.marketplace.medicals');

            // Foods & Waters
            Route::get('/eats', 'Frontend\MarketplaceController@eats')->name('admin.marketplace.eats');

            // Gears
            Route::get('/gears', 'Frontend\MarketplaceController@gears')->name('admin.marketplace.gears');

            // Attachments
            Route::get('/attachments', 'Frontend\MarketplaceController@attachments')->name('admin.marketplace.attachments');

            // Ammo
            Route::get('/ammo', 'Frontend\MarketplaceController@ammo')->name('admin.marketplace.ammo');

        });

        // Loot Spawn
        Route::group(['prefix' => '/loot'], function () {

            // All
            Route::get('/all', 'Frontend\LootDataController@all')->name('admin.loot.all');
            Route::get('/edit/{id}', 'Frontend\LootDataController@edit')->name('admin.loot.edit');
            Route::get('/add', 'Frontend\LootDataController@add')->name('admin.loot.add');
            Route::get('/delete/{id}', 'Frontend\LootDataController@delete')->name('admin.loot.delete');

        });

        // Panel Settings
        Route::group(['prefix' => '/panel'], function () {
            Route::get('/settings', 'Frontend\PanelSettingController@index')->name('admin.panel.settings');

            Route::group(['prefix' => '/license'], function () {
                Route::get('/check', 'Frontend\LicenseController@check')->name('admin.panel.license.check');
            });
        });
    });

});
