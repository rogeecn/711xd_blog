@extends('_layouts.read.'.$model->layout)

@section('content')

    <h1 class="mb-3">
        {{ $model->title }}
    </h1>

    <div class="card bg-white border-0">
        <div class="card-body markdown-body">
            @if(auth()->id() == $model->author)
                {!! Html::link(route("post.edit", ['id'=>$model->id]), '编辑',['class'=>"badge badge-pill badge-info border"])  !!}
            @endauth

            {!! $model->markdown_content !!}
        </div>
    </div>


@endsection
