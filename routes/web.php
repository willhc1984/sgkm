<?php

use App\Http\Controllers\ConsultorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProdutoController;
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

//Login
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');

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
