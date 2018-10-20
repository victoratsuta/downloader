<?php

Route::group(
    [
        'namespace' => 'Web'
    ], function () {

    Route::get('/', 'DownLoadController@index')->name('index');
    Route::post('/add', 'DownLoadController@add')->name('add');

});
