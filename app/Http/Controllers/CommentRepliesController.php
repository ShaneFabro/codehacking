<?php

namespace App\Http\Controllers;

use App\Comment;

use App\CommentReply;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CommentReplyRequest;

class CommentRepliesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    public function createReply(CommentReplyRequest $request) {

        $user = Auth::user();

        if($user->photo_id == 0){

            $data = [

                'comment_id' => $request->comment_id,
                'is_active' => $user->is_active,
                'author' => $user->name,
                'photo' => 'placeholder.jpg',
                'email' => $user->email,
                'body' => $request->body
    
            ];

            CommentReply::create($data);

            $request->session()->flash('reply_message', 'Your reply has been sent.');

            return redirect()->back();
    

        } else {

            $data = [

                'comment_id' => $request->comment_id,
                'is_active' => $user->is_active,
                'author' => $user->name,
                'photo' => $user->photo->file,
                'email' => $user->email,
                'body' => $request->body
    
            ];

            CommentReply::create($data);

            $request->session()->flash('reply_message', 'Your reply has been sent.');

            return redirect()->back();

        }
        

        
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
        $comment = Comment::findOrFail($id);
        
        $replies = $comment->replies;

        return view('admin.comments.replies.show', compact('replies'));

        
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
        CommentReply::findOrFail($id)->update($request->all());

        return redirect()->back();
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
        CommentReply::findOrFail($id)->delete();

        return redirect()->back();
    }
}
