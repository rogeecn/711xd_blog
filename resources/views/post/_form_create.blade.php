@include('_components.errors')


{!! Form::open(['url'=>route('post.store')]) !!}
<div id='post-content'>
    {!! Form::textarea("raw_content",old('raw_content',$model->raw_content)) !!}
</div>
{!! Form::close() !!}
