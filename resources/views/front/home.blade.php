@extends('layouts.blog-home')

@section('content')


<div class="container">



<div class="row">
    

    <!-- Blog Entries Column -->
    <div class="col-md-8">

    <h1 class="page-header">
        Page Heading
        <small>Secondary Text</small>
    </h1>


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
            
        <p><a href="{{route('home.categories', $post->category->slug)}}">#{{$post->category->name}}</a></p>
        <p>{{str_limit($post->body, 200)}}</p>                                
        <a href="{{route('home.post', $post->slug)}}" class="btn btn-primary">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

        <hr>  
        @endforeach
    @endif
     
    <div class="row">
	<div class="col-sm-6 col-sm-offset-5">
		{{$posts->render()}}
	</div>
    </div>

        <!-- Pager -->
        <!-- <ul class="pager">
            <li class="previous">
                <a href="#">&larr; Older</a>
            </li>
            <li class="next">
                <a href="#">Newer &rarr;</a>
            </li>
        </ul> -->

        </div>

        
    <!-- Blog Sidebar Widgets Column -->
    @include('includes.front_sidebar')

</div>
<!-- /.row -->
</div>
@endsection
