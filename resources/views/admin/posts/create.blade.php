@extends("layouts.admin")


@section("content")


@include ("includes.tinyeditor")


<h2>Create Post</h2>

<div class="row">

    {!! Form::open(['method'=>"POST", 'action'=> "AdminPostsController@store", 'files'=>true]) !!}

    <div class="form-group">
        {!! Form::label('title', "Title:") !!}
        {!! Form::text('title', null, ["class"=>'form-control']) !!}
    </div>    

    <div class="form-group">
        {!! Form::label('category_id', "Category:") !!}
        {!! Form::select('category_id', [''=>'Choose a category'] + $categories ,null, ["class"=>'form-control']) !!}
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
        {!! Form::submit('create post', ['class'=>"btn btn-primary"]) !!}
    </div>  

    {!! Form::close() !!}

</div>

<!-- errors list -->
@include('includes.form_error')

@stop