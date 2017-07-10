<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function()
{
	//==============backend================
	Route::group(['prefix' => 'backend'], function() 
	{
		//--------------User--------------
		Route::resource('user', 'Backend\UserController');
		Route::get('/user/{user}/name_edit', 'Backend\UserController@name_edit');
		Route::put('/user/{user}/name_edit', 'Backend\UserController@name_update');

		//---------------Blog--------------
		Route::resource('blog', 'Backend\BlogController');
		Route::group(['prefix' => 'blog/{blog}'], function()
		{
			Route::post('/', 'Backend\BlogController@comment_store');
			Route::group(['prefix' => '{comment}'], function()
			{
				Route::get('/edit', 'Backend\BlogController@comment_edit');
				Route::put('/', 'Backend\BlogController@comment_update');
				Route::delete('/', 'Backend\BlogController@comment_destroy');
				Route::get('/reply', 'Backend\BlogController@reply_create');
				Route::post('/reply', 'Backend\BlogController@reply_store');
				Route::get('/reply/{reply}', 'Backend\BlogController@reply_edit');
				Route::put('/reply/{reply}', 'Backend\BlogController@reply_update');
				Route::delete('/reply/{reply}', 'Backend\BlogController@reply_destroy');
			});
		});

		//-------------Comment---------------
		Route::resource('comment', 'Backend\CommentController');
		Route::group(['prefix' => 'comment/{comment}'], function()
		{
			Route::get('/reply', 'Backend\CommentController@reply_create');
			Route::post('/reply', 'Backend\CommentController@reply_store');
			Route::get('/reply/{reply}/edit', 'Backend\CommentController@reply_edit');
			Route::put('/reply/{reply}', 'Backend\CommentController@reply_update');
			Route::delete('/reply/{reply}', 'Backend\CommentController@reply_destroy');
		});

		//---------------Link------------------
		Route::resource('link', 'Backend\LinkController', ['except' => [
   		'show', 'delete']]);
		Route::get('/link/destroy', 'Backend\LinkController@link');
		Route::delete('/link/destroy', 'Backend\LinkController@destroy');
	});


	//==================Guest====================

	Route::get('/error', 'Guest\ErrorController@index');

	Route::group(['prefix' => '{user}'],function()
	{	
		Route::group(['middleware' => 'checkname'], function()
		{
			//---------user----------
			Route::get('/', 'Guest\IndexController@index');
			Route::get('/user', 'Guest\UserController@index');
			//---------blog----------
			Route::get('/blog', 'Guest\BlogController@index');
			Route::group(['prefix' => 'blog/{blog}'], function()
			{
				Route::get('/', 'Guest\BlogController@show');
				Route::post('/', 'Guest\BlogController@comment_store');
				Route::get('/{comment}/reply', 'Guest\BlogController@reply_create');
				Route::post('/{comment}/reply','Guest\BlogController@reply_store');
			});
			//----------comment---------
			Route::get('/comment', 'Guest\CommentController@index');
			Route::post('/comment', 'Guest\CommentController@store');
			Route::group(['prefix' => 'comment/{comment}'], function()
			{
				Route::get('/reply', 'Guest\CommentController@reply_create');
				Route::post('/reply', 'Guest\CommentController@reply_store');
			});
			//---------link----------
			Route::get('/link', 'Guest\LinkController@index');
		});
	});
});




