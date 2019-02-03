<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\UserEditRequest;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UsersCreateRequest;

class AdminUsersController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
		$users = User::all();
		return view('admin.users.index', compact('users'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
		//$roles = Role::lists('name','id')->all(); //lists depricated
		$roles = Role::pluck('name','id')->all();		
		return view('admin.users.create', compact('roles'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(UsersCreateRequest $request) {
		//change the function param from Request to UsersRequest
		//use App\Http\Requests\UsersCreateRequest;
		//return $request->all();

		// User::create($request->all());
		// return redirect('/admin/users');

		if(trim($request->password) == ""){ //white space problem resolve
			$input = $request->axcept('password');
		}
		else {
			$input = $request->all();
			$input['password'] = bcrypt($request->password);
		}


		if($file = $request->file("photo_id")){
			//return "photo exist";
			$name = time() . $file->getClientOriginalName();

			$file->move('images', $name);

			$photo = Photo::create(['file'=>$name]);

			$input['photo_id'] = $photo->id;
		}
		$input['password'] = bcrypt($request->password);	

		User::create($input);

		//return "added to the db";
		return redirect("/admin/users");
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
		return view('admin.users.show');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
		// return view('admin.users.edit');
		
		$user = User::findOrFail($id);
		//$roles = Role::lists('name', 'id')->all(); //lists is depricated
		$roles = Role::pluck('name', 'id')->all(); //lists is depricated
		return view('admin.users.edit', compact('user', 'roles'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(UserEditRequest $request, $id) {
		//	
		$user = User::findOrFail($id);
		
		if(trim($request->password) == ""){ //white space problem resolve
			$input = $request->except('password');
		}
		else {
			$input = $request->all();
			$input['password'] = bcrypt($request->password);
		}

		if($file = $request->file('photo_id')){
			$name = time() . $file->getClientOriginalName();
			$file->move('images', $name);
			$photo = Photo::create(['file'=>$name]);
			$input['photo_id'] = $photo->id;
		}

		$user->update($input);
		return redirect('/admin/users');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
		// return "destroy";
		
		//delete user but not and the image
		//User::findOrFail($id)->delete();

		//if we wanna delete the image too:
		$user = User::findOrFail($id);
		unlink(public_path() . $user->photo->file);

		$user->delete();

		Session::flash('deleted_user', 'The user has been deleted');

		return redirect ("/admin/users");
	}
}
	