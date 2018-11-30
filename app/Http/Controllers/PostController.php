<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post;
use App\Model\Content;
use App\Model\Post as PostModel;
use App\Model\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     *
     * - Title:  如何去做一个有
     * - Slug：
     * - Tags: MySQL,GoLang,阅读,书法，
     * - Layout: Page
     * - Type: article
     * - Status: publish
     * ----------------------
     */


    public function create()
    {
        return view("post.create", ['model' => new PostModel()]);
    }

    public function store(Post $request)
    {

        /** @var PostModel $model */
        $model = $request->getModel();

        DB::transaction(function () use ($model, $request) {

            $model->author = 0;//auth()->user()->id;
            if (!$model->save()) {
                throw new \Exception("save post fail");
            }

            Content::updateOrInsert(
                ['post_id' => $model->id],
                ['content' => $request->get('content')]
            );

            $tagIdList = (new Tag())->getIdListByTagName($request->tags());
            $model->postTags()->sync($tagIdList);

        });

        return redirect(route('post.edit', ['id' => $model->id]));
    }

    public function edit($id)
    {
        $model = \App\Model\Post::whereId($id)
            //->whereAuthor(app()->user()->id)
            ->first();

        abort_if(!$model, 404, '文章不存在');

        return view("post.edit", ['model' => $model]);
    }

    public function update($id, Post $request)
    {
        $model = $request->getModel();
        DB::transaction(function () use ($model, $request, $id) {

            $data = collect($request->validated());
            $model->fill($request->validated());
            $model->save();

            Content::updateOrInsert(
                ['post_id' => $model->id],
                ['content' => $request->get('content')]
            );

            $tagIdList = (new Tag())->getIdListByTagName($request->tags());
            $model->postTags()->sync($tagIdList);

        });
        return redirect(route('post.edit', ['id' => $id]));
    }
}
