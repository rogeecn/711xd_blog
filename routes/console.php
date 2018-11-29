<?php

use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command("test", function () {
    \App\Model\Post::first()->tags()->sync([1, 2]);
    dd(\App\Model\Post::first()->tags->toArray());
    dd(\App\Model\Tag::first()->posts->toArray());
});