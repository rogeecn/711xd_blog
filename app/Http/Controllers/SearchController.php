<?php

namespace App\Http\Controllers;

use App\Model\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = strtolower($request->get("keyword"));
        $keywordList = explode(" ", $keyword);

        $conditions = collect($keywordList)->filter()->unique()->map(function ($singleKeyword) {
            return ['title', 'like', "%{$singleKeyword}%"];
        })->toArray();

        $pageModels = Post::orderByDesc('id')->where($conditions)->simplePaginate(10);

        return view('search', [
            'keyword' => $keyword,
            'pageModels' => $pageModels,
        ]);
    }
}
