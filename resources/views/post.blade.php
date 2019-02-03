@extends('layouts.blog-home')


@section('content')

<div class="container">

    <div class="row">

        <div class="col-lg-8">
        

            <!-- Blog Post -->

            <!-- Title -->
            <h1>{{$post->title}}</h1>

            <!-- Author -->
            <p class="lead">
                by {{$post->user->name}}
            </p>
            

            <!-- @foreach($categories as $c)
            @if($c->name == $post->category->name)
           
            @endif
            @endforeach -->

            <p><a href="{{route('home.categories', $post->category->slug)}}">#{{$post->category->name}}</a></p>
            <hr>

            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

            <hr>

            <!-- Preview Image -->
            <!-- <img class="img-responsive" src="{{$post->photo ? $post->photo->file : null}}" alt=""> -->
            <img class="img-responsive" src="{{$post->photo ? $post->photo->file : $post->photoPlaceholder()}}" alt="">

            <hr>



            <!-- Post Content -->
    
            <p>{!! $post->body !!}</p>

            <hr>

  
                <!-- DISQUS -->
                    <!-- <div id="disqus_thread"></div>
                    <script>

                    /**
                    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
                    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
                    /*
                    var disqus_config = function () {
                    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
                    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
                    };
                    */
                    (function() { // DON'T EDIT BELOW THIS LINE
                    var d = document, s = d.createElement('script');
                    s.src = 'https://codehacking-0yex1dswqr.disqus.com/embed.js';
                    s.setAttribute('data-timestamp', +new Date());
                    (d.head || d.body).appendChild(s);
                    })();
                    </script>
                    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                                                
                    activate the site first -->
                    <!-- <script id="dsq-count-scr" src="//codehacking-0yex1dswqr.disqus.com/count.js" async></script>  -->

                <!-- DISQUS ends (scritp below also needed!) -->
                    
                
            

                <!-- REGULAR Blog Comments -->
          
                    @if(count($comments) > 0)


                        @foreach($comments as $comm)

                        <!-- Posted Comments -->


                        <!-- COMMENT -->
                        <div class="media">
                            <a class="pull-left" href="#">
                                <!-- <img class="media-object" src="http://placehold.it/64x64" alt=""> -->
                                <!-- <img height="64" class="media-object" src="{{$comm->photo}}" alt=""> -->
                                <img height="64" class="media-object" src="{{$comm->photo ? $comm->photo : Auth::user()->gravatar}}" alt="">
                                <!-- <img height="64" class="media-object" src="{{Auth::user()->gravatar}}" alt=""> -->
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{$comm->author}}
                                    <small>{{$comm->created_at->diffForHumans()}}</small>
                                </h4>
                                
                                {{$comm->body}}
                                
                                <div class="comment-reply-container"> 
                                        
                                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                                        <div class="comment-reply col-sm-6">

                                            {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                                            
                                                <input type="hidden" name="comment_id" value="{{$comm->id}}">

                                                <div class="form-group">
                                                    {!! Form::label('body', 'Body:')!!}
                                                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1])!!}
                                                </div>

                                                <div class="form-group">
                                                    {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                                                </div>

                                            {!! Form::close() !!}

                                        </div>

                                </div>
                                       


                                @if(count($comm->replies) > 0)    

                                    @foreach($comm->replies as $reply)

                                        @if($reply->is_active == 1)

                                        <!-- Nested Comment -->
                                        <div id="nested-comment" class="media">
                                            <a class="pull-left" href="#">
                                                <!-- <img class="media-object" src="{{$reply->photo}}" alt="" height="64"> -->
                                                <img class="media-object" src="{{Auth::user()->gravatar}}" alt="" height="64">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">{{$reply->author}}
                                                    <small>{{$reply->created_at->diffForHumans()}}</small>
                                                </h4>
                                                {{$reply->body}}
                                            </div>



                                            <div class="comment-reply-container"> 
                                        
                                                <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                                                <div class="comment-reply col-sm-6">

                                                    {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
                                                    
                                                        <input type="hidden" name="comment_id" value="{{$comm->id}}">

                                                        <div class="form-group">
                                                            {!! Form::label('body', 'Body:')!!}
                                                            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1])!!}
                                                        </div>

                                                        <div class="form-group">
                                                            {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
                                                        </div>

                                                    {!! Form::close() !!}

                                                </div>

                                            </div>
                                            <!-- End Nested Comment -->                       

                                        </div>  

                                        @else

                                            <!-- <h1 class="text-center">No replies</h1> -->

                                        @endif 

                                    @endforeach

                                @endif    


                            </div> <!--end media body-->

                        </div> <!--end media-->

                        @endforeach

                    @endif

                    <hr>

                    <!-- if the user is loged in -->    
                    @if(Auth::check())
                        <!-- Comments Form -->
                        <div class="well">
                            <h4>Leave a Comment:</h4>
            
                            {!! Form::open(['method'=>'POST', 'action'=>'PostCommentController@store']) !!}
    
                            <input type="hidden" name="post_id" value="{{$post->id}}">
    
                                {!! Form::label('body', 'Body:') !!}
                            <div class="form-group">
                                {!! Form::textarea('body', null, ['class'=>'form-contol', 'rows'=>3]) !!}                    
                            </div>
    
                            <div class="form-group">
                                {!! Form::submit('Submit comment', ['class'=>'btn btn-primary']) !!}                    
                            </div>
                            {!! Form::close() !!}
    
                        </div>
    
                    @endif    

                <!-- end REGULAR blog comment-->

        </div> <!-- end col-dm-8-->

        @include('includes.front_sidebar')

    </div> <!--end row-->

</div> <!--end container-->

@endsection

<!-- THIS SECTION IS NEEDED FOR DISQUS: -->
<!-- @section('scripts')

     <script>

         $('.comment-reply-container .toggle-reply').click(function(){
             $(this).next().slideToggle('slow');
         })

     </script>

@endsection -->