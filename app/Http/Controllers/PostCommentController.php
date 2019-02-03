<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return view('admin.comments.index', compact('comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // the comment will appear only if the user has an image
        // return $request->all();
        $user = Auth::user();

        //return $user->photo->file;
        $data = [
            'post_id' => $request->post_id,
            'author' => $user->name,
            'email' => $user->email,
            'photo' => $user->photo ? $user->photo->file : "" ,
            'body' => $request->body
        ];
        
        Comment::create($data);

        $request->session()->flash('comment_message', 'Your message has been submitted and is waiting moderation');

        return redirect()->back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        $comment = $post->comments;

        return view('admin.comments.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        Comment::findOrFail($id)->update($request->all());
        return redirect('/admin/comments');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Comment::findOrFail($id)->delete();
        return redirect()->back();
    }

    
    public function post($slug){

        
        $post = Post::findBySlugOrFail($slug);
                        
        $comments = $post->comments()->whereIsActive(1)->get();
        
        return view('post', compact('post', 'comments'));
        //return view('post', compact('post'));
        
        //in case of error in line 1185 in Builder.php :
        // Laravel 5.2, php 7.2
        // change error Line 1185 in 'vendor\laravel\framework\src\Illuminate\Database\Eloquent\Builder.php' to:
        // $originalWhereCount = is_array($query->wheres) ? count($query->wheres) : 0;

      

    }
}
