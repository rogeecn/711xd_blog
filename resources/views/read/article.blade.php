@extends('_layouts.read.'.$model->layout)

@section('content')
    <?php
    /** @var $model \App\Model\Post */
    ?>
    <div class="card bg-white border-0 mb-4">

        <div class="card-body">
            <h1>{{ $model->title }}</h1>

            <div class="text-muted d-block mt-3">
                <span class="mr-3">发布时间:{{ $model->created_at->format("Y/m/d")}}</span>
                <span class="mr-3">作者:{{ $model->authorUser->name }}</span>
                @if(auth()->id() == $model->author)
                    <span class="mr-3">
                        {!! Html::link(route("post.edit", ['id'=>$model->id]), '编辑',['class'=>"badge badge-pill badge-info border"])  !!}
                    </span>
                @endauth
            </div>
        </div>

        <div class="card-body markdown-body">
            {!! $model->markdown_content !!}
        </div>

        <div class="card-body">
            @foreach($model->postTags as $tag)
                {!! Html::link(route("tag.single", ['name'=>$tag->name]), $tag->name,['class'=>"badge badge-pill badge-light border"])  !!}
            @endforeach
        </div>

    </div>

@endsection
