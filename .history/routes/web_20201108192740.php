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

// 非会員限定
// 記事一覧表示画面(トップページ)
Route::get('/', 'BooksController@index')->name('books');
// 記事詳細表示画面のルーティング
Route::get('/books/{id}', 'BooksController@show')->name('books.show');

// 会員限定
 Route::group(['middleware' => 'auth'], function () {
     // 記事投稿画面表示
     Route::get('/new', 'BooksController@new')->name('books.new');
     // 記事投稿ルーティング
     Route::post('/new', 'BooksController@create')->name('books.create');

     // マイページ画面
     // 自分が投稿した本一覧表示
     Route::get('/mypage', 'BooksController@mypage')->name('books.mypage');
     // いいねしたフレーズ一覧画面表示
     Route::get('/like_book', 'BooksController@like')->name('books.like');
     // 会員編集ルーティング
     Route::get('/profile_edit', 'UserController@edit')->name('profile.edit');
     Route::post('/profile_edit', 'UserController@update')->name('profile.update');
     // パスワード変更のルーティング
     Route::get('/password_edit','UserController@passEdit')->name('pass.edit');
     Route::post('/password_edit', 'UserController@passUpdate')->name('pass.update');
     // 記事削除のルーティング
     Route::post('/books/{id}/delete', 'BooksController@destroy')->name('books.delete');
     // 会員削除のルーティング
     Route::get('/delete','UserController@delete')->name('user.delete');
     Route::post('/delete', 'UserController@destroy')->name('delete');

 });
 
Auth::routes();
 
// Route::get('/home', 'HomeController@index')->name('home');


