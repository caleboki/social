<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/



/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
	Route::get('/', function () {
    return view('welcome');
	})->name('home');

    Route::post('/signup', [
    	'uses'=>'UserController@postSignup',
    	'as'=>'signup']);
    
    Route::post('/signin', [
    	'uses'=>'UserController@postSignin',
    	'as'=>'signin']);

    Route::get('/logout', [
        'uses'=>'UserController@getLogout',
        'as'=>'logout']);
	

    Route::get('/dashboard', [
		'uses'=>'PostController@getDashboard',
		'as'=>'dashboard',
        'middleware'=>'auth'
		]);

    Route::post('/createpost', [
        'uses' => 'PostController@CreatePost',
        'as'=>'createpost',
        'middleware'=>'auth']);

    Route::get('/delete-post/{post_id}', [
        'uses' => 'PostController@getDeletePost',
        'as' => 'post.delete',
        'middleware'=>'auth']);

    Route::post('/edit', function(\Illuminate\Http\Request $request) {
        return response()->json(['message' => $request['postId']]);
    })->name('edit');


    });
