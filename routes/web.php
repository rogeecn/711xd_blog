<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', "IndexController@index")->name("index");

Route::get('/p/{slug}', "ReadController@index")->name("read");

Route::get('/search', "SearchController@index")->name("search");

Route::prefix("/tag")->name('tag.')->group(function () {

    Route::get("/", "TagController@index")->name('list');
    Route::get("{name}", "TagController@single")->name('single');

});

Route::prefix("/post")->name('post.')->middleware("auth")->group(function () {

    Route::get("create", "PostController@create")->name('create');
    Route::post("store", "PostController@store")->name('store');

    Route::get("edit/{id}", "PostController@edit")->name('edit');
    Route::post("update/{id}", "PostController@update")->name('update');

    Route::post("image/upload", "ImageController@upload")->name('image_upload');

});


Route::get("/{year}/{month}/{day}/{slug}", function ($year, $month, $day, $slug) {
    return redirect()->route("read", ['slug' => $slug]);
}, 301);
