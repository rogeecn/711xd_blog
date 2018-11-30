@extends('_layouts.app')


@section('content')
    <h1 class="mb-5">Tag: {{ $tagName }}</h1>
    @each("_item",$pageModels,"model",'empty')

    {{ $pageModels->links() }}
@endsection