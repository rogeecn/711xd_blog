<?php
/** @var $model \App\Model\Post */
?>
<div class="card bg-white border-0 mb-4">
    <div class="card-header bg-white border-0">
        <a href="{{ route("read",['slug'=>$model->slug]) }}" class="article-title">
            <h2 class="m-0 h3">{{ $model->title }}</h2>
        </a>

        <div class="text-muted d-block mt-3">
            <span class="mr-3">发布时间:{{ $model->created_at->format("Y/m/d")}}</span>
            <span class="mr-3">作者:{{ $model->authorUser->name }}</span>
        </div>
    </div>
    <div class="card-body markdown-body">
        {!! $model->markdown_description !!}
    </div>
    <div class="card-body">
        <div class="row">

            <div class="col">
                @foreach($model->postTags as $tag)
                    {!! Html::link(route("tag.single", ['name'=>$tag->name]), $tag->name,['class'=>"badge badge-pill badge-light border"])  !!}
                @endforeach
            </div>

            <div class="col-auto">
                {!! Html::link(route("read", ['slug'=>$model->slug]), 'Read More...',['class'=>"badge badge-pill badge-light border"])  !!}
                @if(auth()->id() == $model->author)
                    {!! Html::link(route("post.edit", ['id'=>$model->id]), '编辑',['class'=>"badge badge-pill badge-info border"])  !!}
                @endauth
            </div>
        </div>
    </div>
</div>

