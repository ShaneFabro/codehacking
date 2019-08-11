<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@index');

Route::get('/home', function () {
    if(Auth::check()){
    return view('front.home');
    } else {
    return redirect()->back();
    }
});

// Route::group(['middleware'=>'admin'], function(){

//     Route::get('/admin', 'AdminController@index');

//     Route::resource('/admin/users', 'AdminUsersController', ['names'=>[

//         'index' => 'admin.users.index',
//         'create' => 'admin.users.create',
//         'store' => 'admin.users.show',
//         'edit' => 'admin.users.edit',
//         'update' => 'admin.users.update',
//         'destroy' => 'admin.users.destroy',

//     ]]);

//     Route::resource('/admin/posts', 'AdminPostsController', ['names'=>[

//         'index' => 'admin.posts.index',
//         'create' => 'admin.posts.create',
//         'store' => 'admin.posts.show',
//         'edit' => 'admin.posts.edit',
//         'update' => 'admin.posts.update',
//         'destroy' => 'admin.posts.destroy'

//     ]]);

//     Route::resource('/admin/categories', 'AdminCategoriesController', ['names'=>[

//         'index' => 'admin.categories.index',
//         'create' => 'admin.categories.create',
//         'store' => 'admin.categories.show',
//         'edit' => 'admin.categories.edit',
//         'update' => 'admin.categories.update',
//         'destroy' => 'admin.categories.destroy'

//     ]]);
    
//     Route::resource('/admin/media', 'AdminMediaController', ['names'=>[

//         'index' => 'admin.media.index',
//         'create' => 'admin.media.create',
//         'store' => 'admin.media.show',
//         'edit' => 'admin.media.edit',
//         'update' => 'admin.media.update',
//         'destroy' => 'admin.media.destroy'

//     ]]);

//     Route::delete('admin/delete/media', 'AdminMediaController@deleteMedia');

//     Route::resource('/admin/comments', 'PostCommentsController', ['names'=>[

//         'index' => 'admin.comments.index',
//         'create' => 'admin.comments.create',
//         'store' => 'admin.comments.show',
//         'edit' => 'admin.comments.edit',
//         'update' => 'admin.comments.update',
//         'destroy' => 'admin.comments.destroy'

//     ]]);

//     Route::resource('/admin/comment/replies', 'CommentRepliesController', ['names'=>[

//         'index' => 'admin.comment.replies.index',
//         'create' => 'admin.comment.replies.create',
//         'store' => 'admin.comment.replies.show',
//         'edit' => 'admin.comment.replies.edit',
//         'update' => 'admin.comment.replies.update',
//         'destroy' => 'admin.comment.replies.destroy',
//         'show' => 'admin.comment.replies.show',

//     ]]);

//     Route::get('/post/{slug}', ['as'=>'home.post', 'uses'=>'AdminPostsController@post']);

//     Route::get('/create/reply', ['as'=>'create.reply', 'uses'=>'CommentRepliesController@createReply']);
// });

Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function (){

    Route::resource('users', 'AdminUsersController');
    Route::resource('posts', 'AdminPostsController');
    Route::resource('categories', 'AdminCategoriesController');
    Route::resource('media', 'AdminMediaController');
    Route::resource('/comment/replies', 'CommentRepliesController');
    Route::resource('/comments', 'PostCommentsController');
    Route::get('/', 'AdminController@index')->name('dashboard');
    Route::get('/create/reply', 'CommentRepliesController@createReply');

});

Route::get('/post/{slug}', 'HomeController@post')->name('home.post');