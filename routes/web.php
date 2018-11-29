<?php

use Illuminate\Support\Facades\Route;

Route::get('/', "IndexController@index")->name("index");
Route::post('/logout', function () {
    auth()->logout();
    redirect(route('index'));
});

Route::prefix("/post")->name('post.')->group(function () {
    Route::get("create", "PostController@create")->name('create');
    Route::post("store", "PostController@store")->name('store');

    Route::get("edit/{id}", "PostController@edit")->name('edit');
    Route::post("update/{id}", "PostController@update")->name('update');

    Route::post("image/upload", "ImageController@upload")->name('image_upload');
});
