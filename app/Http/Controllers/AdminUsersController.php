<?php

namespace App\Http\Controllers;

use App\Post;

use App\Role;
use App\User;
use App\Photo;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\UsersRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UsersEditRequest;
use Illuminate\Support\Facades\Session;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::orderBy('id', 'asc')->get();

        return view('admin.users.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::lists('name', 'id')->all();

        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        //
        // $user = $request->all();

        // $user['password'] = bcrypt($request->get('password'));

        // User::create($user);

        $input = $request->all();

        if($file = $request->file('photo_id')){

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }

        $input['password'] = bcrypt($request->password);

        User::create($input);


        return redirect('/admin/users');

       
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
        return view('admin.users.show');
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
        $user = User::findOrFail($id);

        $roles = Role::lists('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //

        if(trim($request->password) == ''){

            $input = $request->except('password');

        } else {

            $input = $request->all();

            $input['password'] = bcrypt($request->password);
        }

        $user = User::findOrFail($id);

        if($file = $request->file('photo_id')) {

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
    public function destroy($id)
    {
        //
        $user = User::findOrFail($id);

        // $postowner = Post::whereUserId($id)->get();

        // foreach($postowner as $post) {

        //     $post->delete();

        // }

        $postowner = Post::whereUserId($id)->get();

        foreach($postowner as $post) {

            unlink(public_path() . $post->photo->file);

        }

        unlink(public_path() . $user->photo->file);

        $user->delete();

        Session::flash('deleted_user', 'The User has been deleted');

        return redirect('/admin/users');

    }


}
