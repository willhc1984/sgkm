<?php

use App\Http\Controllers\ConsultorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
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

//Login
Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/login', [LoginController::class, 'loginProcess'])->name('login.process');

Route::group(['middleware' => 'auth'], function () {

    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    Route::get('/', [DashboardController::class, 'inicio'])->name('dashboard.inicio');

    //Usuarios
    Route::get('/index-user', [UserController::class, 'index'])->name('user.index');
    Route::get('/show-user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/create-user', [UserController::class, 'create'])->name('user.create');
    Route::post('/store-user', [UserController::class, 'store'])->name('user.store');
    Route::get('/edit-user/{user}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/update-user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::get('/edit-user-password/{user}', [UserController::class, 'editPassword'])->name('user.edit-password');
    Route::put('/update-user-password/{user}', [UserController::class, 'updatePassword'])->name('user.update-password');
    Route::delete('/destroy-user/{user}', [UserController::class, 'destroy'])->name('user.destroy');

    //Perfil
    Route::get('/show-profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/edit-profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/update-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/edit-profile-password', [ProfileController::class, 'editPassword'])->name('profile.edit-password');
    Route::put('/update-profile-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    //Consultores
    Route::get('/index-consultores', [ConsultorController::class, 'index'])->name('consultor.index');
    Route::get('/create-consultores', [ConsultorController::class, 'create'])->name('consultor.create');
    Route::post('/store-consultores', [ConsultorController::class, 'store'])->name('consultor.store');
    Route::get('/edit-consultores/{consultor}', [ConsultorController::class, 'edit'])->name('consultor.edit');
    Route::put('/update-consultores/{consultor}', [ConsultorController::class, 'update'])->name('consultor.update');
    Route::delete('/destroy-consultores/{consultor}', [ConsultorController::class, 'destroy'])->name('consultor.destroy');

    //Produtos
    Route::get('/index-produtos', [ProdutoController::class, 'index'])->name('produto.index');
    Route::get('/create-produtos/{consultor}', [ProdutoController::class, 'create'])->name('produto.create');
    Route::post('/store-produtos', [ProdutoController::class, 'store'])->name('produto.store');
    Route::get('/edit-produtos/{produto}', [ProdutoController::class, 'edit'])->name('produto.edit');
    Route::put('/update-produtos/{produto}', [ProdutoController::class, 'update'])->name('produto.update');
    Route::delete('/destroy-produtos/{produto}', [ProdutoController::class, 'destroy'])->name('produto.destroy');
    Route::get('/generate-pdf-produtos', [ProdutoController::class, 'generatePdf'])->name('produto.generate-pdf');

    //Papéis
    Route::get('/index-role', [RoleController::class, 'index'])->name('role.index');
    Route::get('/create-role', [RoleController::class, 'create'])->name('role.create');
    Route::post('/store-role', [RoleController::class, 'store'])->name('role.store');
    Route::get('/edit-role/{role}', [RoleController::class, 'edit'])->name('role.edit');
    Route::put('/update-role/{role}', [RoleController::class, 'update'])->name('role.update');
    Route::delete('/destroy-roles/{role}', [RoleController::class, 'destroy'])->name('role.destroy');

    //Permissões
    Route::get('/index-permission', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/create-permission', [PermissionController::class, 'create'])->name('permissions.create');
    Route::get('/edit-permission/{permission}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/store-permission', [PermissionController::class, 'store'])->name('permissions.store');
    Route::put('/update-permission/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/destroy-permission/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

    //Permissões do papel
    Route::get('/index-role-permission/{role}', [RolePermissionController::class, 'index'])->name('role-permission.index');
    Route::get('/update-role-permission/{role}/{permission}', [RolePermissionController::class, 'update'])->name('role-permission.update');


    //Logout 
    Route::get('/logout', [LoginController::class, 'destroy'])->name('login.destroy');
});
