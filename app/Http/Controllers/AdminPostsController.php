<?php

namespace App\Http\Controllers;

use App\Post;

use App\Photo;
use App\Category;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\PostCreateRequest;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Post::paginate(2);

        $user = Auth::user();

        return view('admin.posts.index', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $category = Category::pluck('name', 'id')->all();

        return view('admin.posts.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        //

        $input = $request->all();

        $user = Auth::user();

        if($file = $request->file('photo_id')){

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;

        }

        $user->posts()->create($input);

        return redirect('/admin/posts');
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
        $post = Post::findOrFail($id);

        $category = Category::pluck('name', 'id')->all();

        return view('admin.posts.edit', compact('post', 'category'));
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
       

        $input = $request->all();

        if($file = $request->file('photo_id')) {

            $name = time() . $file->getClientOriginalName();

            $file->move('images', $name);

            $photo = Photo::create(['file'=>$name]);

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
    public function destroy($id)
    {
        //

        $postowner = Post::findOrFail($id);

        unlink(public_path() . $postowner->photo->file);

        $postowner->photo()->delete();

        $postowner->delete();

        Session::flash('deleted_post', 'The post has been deleted.');

        return redirect('/admin/posts');
    }

    public function post($slug) {

        $post = Post::whereSlug($slug)->first();

        $example = Category::all();

        $category = Category::limit(4)->get();

        $test = Category::take(count($example))->skip(4)->get();

        $comments = $post->comments()->whereIsActive(1)->get();

        return view('post', compact('post', 'comments', 'category', 'test'));

    }

    
}
