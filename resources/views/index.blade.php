@extends('_layouts.app')

@section('content')
    @each("_item",$pageModels,"model",'empty')

    {{ $pageModels->links() }}
@endsection
