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
    return view('site.index');
});

Route::get('/testes/{id}', function () {
    return view('admin.posts.teste');
});

Route::get('/teste', function () {
    $post = App\Models\Category::find(2);
    
    dd($post->posts);
});


// -- Login
Route::get('/login', 'LoginController@index');
Route::get('/logout', function () {
    Auth::logout();
    return view('auth.login');
});


Auth::routes();

Route::get('/countries', 'CountriesController@getCountries');
//Route::get('/countries', 'CountriesController@getCountriesById');
Route::get('/states/{country}', 'StatesController@getStates');
Route::get('/cities/{state}', 'CitiesController@getCities');


Route::get('/admin', 'IndexController@index');

/// ---- POSTS
Route::get('/admin/posts/', 'PostsController@index')->name('posts');
Route::get('/admin/posts/add/{type}', 'PostsController@add')->name('addposts');
Route::get('/admin/posts/edit/{id}', 'PostsController@edit')->name('editpost');
Route::get('/admin/posts/del/{id}', 'PostsController@destroy');
Route::get('/admin/posts/show/{id}', 'PostsController@show');
Route::get('/datatables/posts', 'PostsController@getPosts');

// --- Tips
Route::get('/admin/dicas/', 'PostsController@index');
Route::get('/datatables/tips', 'PostsController@getTips');

// -- Users
Route::get('/admin/perfil', 'UsersController@edit');
Route::put('/user/update', 'UsersController@update')->name('saveUser');

// -- Categorias
Route::get('/admin/categorias', 'CategoryController@index');
//

// Site
Route::get('/', 'SiteController@index');
Route::get('/post/{id}', 'SiteController@post');
Route::get('/posts/pais/{param}', 'SiteController@postlst');
Route::get('/posts/cat/{param}', 'SiteController@postlst');
Route::get('/dicas', 'SiteController@postlst');
Route::get('/posts/pesquisa', 'SiteController@postlst');

//Comments
Route::post('/comentario/send', 'CommentsController@sendComment');
Route::get('/admin/comentarios', 'CommentsController@index');
Route::get('/datatables/comments', 'CommentsController@getComments');
Route::get('/admin/comentario/view/{id}', 'CommentsController@view');
Route::post('/comments/save', 'CommentsController@store');




Route::middleware(['auth'])->prefix('admin')->group(function() {

    Route::resource('posts', 'PostsController');
    Route::resource('categorias', 'CategoryController');
    Route::resource('blog', 'BlogController');
});


