<?php
/** @var $model \App\Model\Tag */
?>
@extends('_layouts.app')


@section('content')
    <div class="card bg-white border-0 mb-4">
        <div class="card-body">
            @foreach($tagModels as $tagModel)
                <a href="{{ route('tag.single',['name'=>$tagModel->name]) }}"
                   class="btn btn-secondary btn-sm  mb-3 mr-3">
                    {{ $tagModel->name }}
                </a>
            @endforeach
        </div>
    </div>


    {{ $tagModels->links() }}
@endsection
