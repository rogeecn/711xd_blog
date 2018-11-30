<?php

namespace App\Http\Controllers;

use App\Model\Post;
use Illuminate\Http\Request;

class ReadController extends Controller
{
    public function index($id)
    {
        return view("read", [
            'model' => Post::findOrFail($id)
        ]);
    }
}
