<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\PostCreateRequest;
use App\Photo;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminPostsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//$posts = Post::all();
		$posts = Post::paginate(2); //show just 2 items, for the rest add to the index view a new div
		return view("admin.posts.index", compact("posts"));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//$categories = Category::lists('name', 'id')->all(); //lists depricated
		$categories = Category::pluck('name', 'id')->all();
		return view("admin.posts.create", compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(PostCreateRequest $request) {
		//return $request->all();

		$input = $request->all();
		$user = Auth::user();

		if ($file = $request->file('photo_id')) {
			//return "it works";
			$name = time() . $file->getClientOriginalName();
			$file->move('images', $name);
			$photo = Photo::create(['file' => $name]);
			$input['photo_id'] = $photo->id;
		}

		$user->posts()->create($input);
		return redirect('admin/posts');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$post = Post::findOrFail($id);
		//$categories = Category::lists('name', 'id')->all(); //lists depricated
		$categories = Category::pluck('name', 'id')->all();
		return view("admin.posts.edit", compact("post", 'categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$input = $request->all();

		if ($file = $request->file('photo_id')) {
			//return "it works";
			$name = time() . $file->getClientOriginalName();
			$file->move('images', $name);
			$photo = Photo::create(['file' => $name]);
			$input['photo_id'] = $photo->id;
		}

		Auth::user()->posts()->whereId($id)->first()->update($input);

		return redirect('/admin/posts');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$post = Post::findOrFail($id);
		unlink(public_path() . $post->photo->file);
		$post->delete();
		return redirect('/admin/posts');
	}

	public function post($slug) {

		$post = Post::findBySlugOrFail($slug); //version 3.0
		//$post = Post::where('slug', $slug)->get();

		//$post = Post::with('posts.comments')->find($slug);
	
		$comments = $post->comments()->whereIsActive(1)->get();
		

		return view('post', compact('post', 'comments'));
		//return view('post', compact('post', 'posts.comments'));
		
		
		
		//in case of error in line 1185 in Builder.php :
		// Laravel 5.2, php 7.2
		// change error Line 1185 in 'vendor\laravel\framework\src\Illuminate\Database\Eloquent\Builder.php' to:
		// $originalWhereCount = is_array($query->wheres) ? count($query->wheres) : 0;

		//So, this line:
		// count($query->wheres)
		// Became:
		// count((array)$query->wheres)

	}


	
	
}
