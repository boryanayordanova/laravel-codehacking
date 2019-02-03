@extends("layouts.admin")


@section("content")


<h2>Edit User</h2>

<div class="row">

    <div class="col-sm-3">
        <img src="{{$user->photo ? $user->photo->file : 'http://placehold.it/400x400'}}" alt="" class="img-responsive img-rounded"/>
    </div>


    <div class="col-sm-9">

        <!-- PATCH -->
        <!-- PATCH, model and $user !!! -->
        {!! Form::model($user, ['method'=>"PATCH", 'action'=> ["AdminUsersController@update", $user->id], 'files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('name', "Name:") !!}
            {!! Form::text('name', null, ["class"=>'form-control']) !!}
        </div>    

        <div class="form-group">
            {!! Form::label('email', "Email:") !!}
            {!! Form::text('email', null, ["class"=>'form-control']) !!}
        </div>  

        <div class="form-group">
            {!! Form::label('role_id', "Role:") !!}
            {!! Form::select('role_id', [''=>'Choose Options'] + $roles, null, ["class"=>'form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::label('is_active', "Status:") !!}
            {!! Form::select('is_active', array(1 => 'Active', 0 => 'Not active'), null, ["class"=>'form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::label('photo_id', "Photo:") !!}
            {!! Form::file('photo_id', null, ["class"=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', "Password:") !!}
            {!! Form::password('password',  ["class"=>'form-control']) !!}
        </div> 

        <div class="form-group">
            {!! Form::submit('create post', ['class'=>"btn btn-primary col-sm-6"]) !!}
        </div>  

        {!! Form::close() !!}


        <!-- DELETE: -->

        {!! Form::open(["method"=>"DELETE", "action"=>['AdminUsersController@destroy', $user->id]])!!}

        <div class="form-group">
            {!! Form::submit('Delete User', ['class'=>"btn btn-danger col-sm-6"]) !!}
        </div>  

        {!! Form::close() !!}

    </div>

</div>
<!-- errors list -->
@include('includes.form_error')

@stop