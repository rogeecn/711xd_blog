<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', "IndexController@index")->name("index");
Route::get('/read/{id}', "ReadController@index")->name("read");
Route::get('/tag/{name}', "TagController@index")->name("tag");

Route::prefix("/post")->name('post.')->middleware("auth")->group(function () {
    Route::get("create", "PostController@create")->name('create');
    Route::post("store", "PostController@store")->name('store');

    Route::get("edit/{id}", "PostController@edit")->name('edit');
    Route::post("update/{id}", "PostController@update")->name('update');

    Route::post("image/upload", "ImageController@upload")->name('image_upload');
});
