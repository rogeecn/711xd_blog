<?php

namespace App\Http\Controllers;

use App\Model\Post;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $pageModels = Post::orderByDesc("id")->simplePaginate(10);
        return view('index', [
            'pageModels' => $pageModels,
        ]);
    }
}
