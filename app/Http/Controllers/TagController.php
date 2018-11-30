<?php

namespace App\Http\Controllers;

use App\Model\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function single($name)
    {
        /** @var Tag $model */
        $model = Tag::newModelInstance()->setKeyName("name")->findOrFail($name);

        $pageModels = $model->posts()->orderByDesc('id')->simplePaginate(15);

        return view("tag.list", [
            'pageModels' => $pageModels,
            'tagName' => $name,
        ]);
    }

    public function index()
    {
        $tagModels = Tag::orderByDesc('id')->simplePaginate(200);
        return view("tag.index", [
            'tagModels' => $tagModels
        ]);
    }
}
