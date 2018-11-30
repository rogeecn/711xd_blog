<?php

namespace App\Http\Controllers;

use App\Model\Post;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    public function index($slug)
    {
        $model = Post::newModelInstance()->setKeyName("slug")->findOrFail($slug);

        return view("read.{$model->type}", [
            'model' => $model,
        ]);
    }
}
