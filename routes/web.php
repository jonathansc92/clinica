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
Route::get('/teste', function(){
   dd(bcrypt('admin'));
});
Route::get('/logout', function () {
    Auth::logout();
    return view('auth.login');
});

Auth::routes();

Route::get('/admin', 'IndexController@index');

// -- Users
Route::get('/admin/perfil', 'UsersController@edit');
Route::put('/user/update', 'UsersController@update')->name('saveUser');

    Route::get('/planos', 'PlanosController@index');


Route::middleware(['auth'])->prefix('admin')->group(function() {

    Route::resource('planos', 'PlanosController');

});


