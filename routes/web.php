<?php

use App\Http\Controllers\ConsultorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

//Login
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');


Route::group(['middleware' => 'auth'], function () {

    //Usuarios
    Route::get('/index-users', [UserController::class, 'index'])->name('user.index');
    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/edit-user-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password');
    Route::put('/update-user-password/{user}', [UserController::class, 'updatePassword'])->name('user.update-password');
    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    //Consultores
    Route::get('/index-consultores', [ConsultorController::class, 'index'])->name('consultor.index');
    Route::get('/create-consultores', [ConsultorController::class, 'create'])->name('consultor.create');
    Route::post('/store-consultores', [ConsultorController::class, 'store'])->name('consultor.store');
    Route::get('/edit-consultores/{consultor}', [ConsultorController::class, 'edit'])->name('consultor.edit');
    Route::put('/update-consultores/{consultor}', [ConsultorController::class, 'update'])->name('consultor.update');
    Route::delete('/destroy-consultores/{consultor}', [ConsultorController::class, 'destroy'])->name('consultor.destroy');

    //Produtos
    Route::get('/index-produtos/{consultor}', [ProdutoController::class, 'index'])->name('produto.index');
    Route::get('/create-produtos/{consultor}', [ProdutoController::class, 'create'])->name('produto.create');
    Route::post('/store-produtos', [ProdutoController::class, 'store'])->name('produto.store');
    Route::get('/edit-produtos/{produto}', [ProdutoController::class, 'edit'])->name('produto.edit');
    Route::put('/update-produtos/{produto}', [ProdutoController::class, 'update'])->name('produto.update');
    Route::delete('/destroy-produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produto.destroy');

    //Logout 
    Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');

});
