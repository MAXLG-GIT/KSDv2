<?php

/*
|--------------------------------------------------------------------------
| Backpack\BackupManager Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the Backpack\BackupManager package.
|
*/

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
], function () {

    Route::group([
        'namespace' => 'Backpack\BackupManager\app\Http\Controllers',
    ], function () {
        Route::get('backup', 'BackupController@index')->name('backup.index');
        Route::put('backup/create', 'BackupController@create')->name('backup.store');
        Route::get('backup/download/', 'BackupController@download')->name('backup.download');
        Route::delete('backup/delete/', 'BackupController@delete')->name('backup.destroy');
    });

    Route::group([
        'namespace' => 'App\Http\Controllers',
    ], function () {
        Route::put('backup/create-db', 'BackupControllerDB@createDB')->name('backup.store-db');
    });
});