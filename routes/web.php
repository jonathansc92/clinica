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


// -- Login
Route::get('/login', 'LoginController@index');
Route::get('/logout', function () {
    Auth::logout();
    return view('auth.login');
});

Auth::routes();

// -- Index
Route::get('/', 'IndexController@index');

// -- Users
Route::get('/perfil', 'UsersController@edit');
Route::post('/user/update/{$id}', 'UsersController@update');

//Route::middleware(['auth'])->prefix('admin')->group(function() {
    
// ----------------------- Agendamentos
Route::get('/agendamentos', 'AgendamentosController@index');
Route::get('/agendamentos/data', 'AgendamentosController@data');
Route::get('/agendamentos/add', 'AgendamentosController@add');
Route::post('/plaagendamentosnos/store', 'AgendamentosController@store');
Route::get('/agendamentos/edit/{id}', 'AgendamentosController@edit');
Route::post('/agendamentos/update/{id}', 'AgendamentosController@update');
Route::get('/agendamentos/delete/{id}', 'AgendamentosController@destroy');
Route::get('/agendamentos/show/{id}', 'AgendamentosController@show');
Route::get('/agendamentos/relatorio', 'AgendamentosController@relatorio');
Route::get('/agendamentos/emitirRelatorio', 'AgendamentosController@emitirRelatorio');

// ----------------------- Especialidades
Route::get('/especialidades', 'EspecialidadesController@index');
Route::get('/especialidades/data', 'EspecialidadesController@data');
Route::get('/especialidades/add', 'EspecialidadesController@add');
Route::post('/especialidades/store', 'EspecialidadesController@store');
Route::get('/especialidades/edit/{id}', 'EspecialidadesController@edit');
Route::post('/especialidades/update/{id}', 'EspecialidadesController@update');
Route::get('/especialidades/delete/{id}', 'EspecialidadesController@destroy');
Route::get('/especialidades/show/{id}', 'EspecialidadesController@show');

// ----------------------- Pacientes
Route::get('/pacientes', 'PacientesController@index');
Route::get('/pacientes/data', 'PacientesController@data');
Route::get('/pacientes/add', 'PacientesController@add');
Route::post('/pacientes/store', 'PacientesController@store');
Route::get('/pacientes/edit/{id}', 'PacientesController@edit');
Route::post('/pacientes/update/{id}', 'PacientesController@update');
Route::get('/pacientes/delete/{id}', 'PacientesController@destroy');
Route::get('/pacientes/show/{id}', 'PacientesController@show');

// ----------------------- Médicos
Route::get('/medicos', 'MedicosController@index');
Route::get('/medicos/data', 'MedicosController@data');
Route::get('/medicos/add', 'MedicosController@add');
Route::post('/medicos/store', 'MedicosController@store');
Route::get('/medicos/edit/{id}', 'MedicosController@edit');
Route::post('/medicos/update/{id}', 'MedicosController@update');
Route::get('/medicos/delete/{id}', 'MedicosController@destroy');
Route::get('/medicos/show/{id}', 'MedicosController@show');
    
   // ----------------------- Planos
Route::get('/planos', 'PlanosController@index');
Route::get('/planos/data', 'PlanosController@data');
Route::get('/planos/add', 'PlanosController@add');
Route::post('/planos/store', 'PlanosController@store');
Route::get('/planos/edit/{id}', 'PlanosController@edit');
Route::post('/planos/update/{id}', 'PlanosController@update');
Route::get('/planos/delete/{id}', 'PlanosController@destroy');
Route::get('/planos/show/{id}', 'PlanosController@show');
//});


