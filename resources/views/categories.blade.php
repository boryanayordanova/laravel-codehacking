@extends('layouts.blog-home')


@section('content')

<div class="container">

    <div class="row">

        <div class="col-lg-8">
        
          
         <h1>#{{$category->name}}</h1>
         <hr>
 
        @if($posts)
            @foreach($posts as $post)
      
         
            <!-- First Blog Post -->
            <h2>
                <a href="{{route('home.post', $post->slug)}}">{{$post->title}}</a>
            </h2>
            <p class="lead">
                <!-- by <a href="{{route('admin.users.index', $post->id)}}">{{$post->user->name}}</a> -->
                by <span>{{$post->user->name}}</span>           
            </p>  
            
            <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>
            <hr>
            <!-- <img class="img-responsive" src="http://placehold.it/900x300" alt=""> -->
            <!-- <img class="img-responsive" src="{{$post->photo ? $post->photo->file : 'http://placehold.it/900x300'}}" alt=""> -->
            <img class="img-responsive" src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder()}}" alt="">
            <hr>
            
            <p>{{str_limit($post->body, 200)}}</p>                                
            <a href="{{route('home.post', $post->slug)}}" class="btn btn-primary">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>         
           
            @endforeach          
        
        @endif

        @unless(count($posts) > 0)
            <h2>None Posts In This Category yet! :( </h2>
        @endunless


        </div> <!-- end col-dm-8-->

        @include('includes.front_sidebar')

    </div> <!--end row-->

</div> <!--end container-->

@endsection
