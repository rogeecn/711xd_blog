@extends('_layouts.app')
@section('title',  "首页")


@section('content')
    @each("_item",$pageModels,"model",'empty')
    {{ $pageModels->links() }}
@endsection
