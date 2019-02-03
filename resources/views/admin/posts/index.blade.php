@extends("layouts.admin")

@section("content")

<h1>Posts</h1>

<table class="table">
	<thead>
		<tr>
			<th>id</th>
			<th>photo</th>
			<th>title</th>
			<th>owner</th>
			<th>category</th>			
			<!-- <th>body</th> -->
			<th>post Link</th>
			<th>comments</th>
			<th>created_at</th>
			<th>updated_at</th>
		</tr>
	</thead>
	<tbody>
		@if($posts)
			@foreach($posts as $post)
			<tr>
				<td>{{$post->id}}</td>
				<!-- <td>{{$post->photo_id}}</td> -->
				<td><img height="50" src="{{$post->photo ? $post->photo->file: "http://placehold.it/400"}}" alt=""/></td>
				<td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
				<td>{{$post->user->name}}</td>
				<!-- <td>{{$post->category_id}}</td> -->
				<td>{{$post->category ? $post->category->name : "Uncategorized"}}</td>
				<!-- <td>{{str_limit($post->body, 30)}}</td>  //shows just the first 30 symbold of the body-->				 -->
				<td><a href="{{route('home.post', $post->slug)}}">View Post </a></td> 
				<td><a href="{{route('admin.comments.show', $post->id)}}"> View Comments </a></td> 
				<td>{{$post->created_at->diffForHumans()}}</td>
				<td>{{$post->updated_at->diffForHumans()}}</td>
			</tr>
			@endforeach
		@endif			
	</tbody>
</table>


<div class="row">
	<div class="col-sm-6 col-sm-offset-5">
		{{$posts->render()}}
	</div>
</div>


@endsection