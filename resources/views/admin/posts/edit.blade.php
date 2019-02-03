@extends("layouts.admin")


@section("content")

@include ("includes.tinyeditor")

<h2>Edit Post</h2>



<div class="row">

    <div class="col-sm-3">

        <!-- <img class="img-responsive" src="{{$post->photo->file}}" /> -->
        <img src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder()}}" alt='' class="img-responsive img-rounded"/>
        
    </div>

    <div class="col-sm-9">

        {!! Form::model($post, ['method'=>"PATCH", 'action'=> ["AdminPostsController@update", $post->id], 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('title', "Title:") !!}
                {!! Form::text('title', null, ["class"=>'form-control']) !!}
            </div>    

            <div class="form-group">
                {!! Form::label('category_id', "Category:") !!}
                {!! Form::select('category_id', [''=>'Choose a category'] + $categories ,null, ["class"=>'form-control'])!!}
            </div>  

            <div class="form-group">
                {!! Form::label('photo_id', "File:") !!}
                {!! Form::file('photo_id', null, ["class"=>'form-control']) !!}
             
            </div> 

            <div class="form-group">
                {!! Form::label('body', "Body:") !!}
                {!! Form::textarea('body', null, ["class"=>'form-control', 'rows'=>5]) !!}
            </div> 

            <div class="form-group">
                {!! Form::submit('update post', ['class'=>"btn btn-primary col-sm-6"]) !!}
            </div>  

            {!! Form::close() !!}


            {!! Form::model($post, ['method'=>"DELETE", 'action'=> ["AdminPostsController@destroy", $post->id]]) !!}

            <div class="form-group">
                {!! Form::submit('delete post', ['class'=>"btn btn-danger col-sm-6"]) !!}
            </div>  

        {!! Form::close() !!}

    </div>    

</div>

<!-- errors list -->
@include('includes.form_error')

@stop