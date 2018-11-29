@include('_components.errors')


{!! Form::open(['url'=>route('post.store')]) !!}
<div class="card bg-transparent border-0">
    <div id='post-content'>
        {!! Form::textarea("raw_content",$model->raw_content) !!}
    </div>

    <div class="card-body text-right px-0">
        {!! Form::submit("Save",['class'=>'btn btn-primary']) !!}
    </div>

</div>
{!! Form::close() !!}

