<?php

namespace App\Http\Controllers;

use App\Model\Post;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    public function index($slug)
    {
        return view("read", [
            'model' => Post::newModelInstance()->setKeyName("slug")->findOrFail($slug),
        ]);
    }
}
