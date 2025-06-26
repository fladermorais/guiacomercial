<?php

use App\Http\Controllers\Admin\CatBlogController;
use App\Http\Controllers\Admin\MenuConfigController;
use App\Http\Controllers\Admin\NoticiasController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/categoria/{alias}', 'HomeController@categoria')->name('categoria');
Route::get('/subcategoria/{alias}', 'HomeController@subcategoria')->name('subcategoria');
Route::get('/empresas', 'HomeController@categorias')->name('categorias');
Route::get('/anuncio/{alias}', 'HomeController@anuncio')->name('anuncio');
Route::get('/like/{id}', 'HomeController@like')->name('like');
Route::get('/sobre', 'HomeController@sobre')->name('sobre');
Route::post('/search', 'HomeController@search')->name('search');
Route::get('/resultado', 'HomeController@resultado')->name('resultado');

Route::get('/admin', 'HomeController@logado')->name('logado')->middleware('auth');

Route::get('/admin/impersonate/destroy', 'Admin\ImpersonateController@destroy')->name('impersonate.destroy');
Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {

    Route::get('/impersonate/user/{id}', 'ImpersonateController@index')->name('impersonate');
    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/', 'UserController@index')->name('usuarios.index');
        Route::get('/novo', 'UserController@create')->name('usuarios.create');
        Route::post('/store', 'UserController@store')->name('usuarios.store');
        Route::get('/edit/{id}', 'UserController@edit')->name('usuarios.edit');
        Route::post('/update/{id}', 'UserController@update')->name('usuarios.update');
        Route::get('/delete/{id}', 'UserController@delete')->name('usuarios.delete');
        Route::get('/active/{id}', 'UserController@active')->name('usuarios.active');
        Route::post('/search', 'UserController@search')->name('usuarios.search');

        Route::get('/role/{user}', 'UserController@role')->name('userRole.index');
        Route::post('/role/{user}', 'UserController@roleStore')->name('userRole.store');
        Route::delete('/role/{user}/{role}', 'UserController@roleDelete')->name('userRole.delete');

    });

    Route::group(['prefix' => 'roles'], function() {
        Route::get('/', 'RoleController@index')->name('roles.index');
        Route::get('/create', 'RoleController@create')->name('roles.create');
        Route::post('/store', 'RoleController@store')->name('roles.store');
        Route::get('/edit/{id}', 'RoleController@edit')->name('roles.edit');
        Route::put('/update/{id}', 'RoleController@update')->name('roles.update');

        Route::get('/permission/{role}', 'RoleController@permission')->name('rolePermission.index');
        Route::post('/permission/{role}', 'RoleController@permissionStore')->name('rolePermission.store');
        Route::delete('/permission/{role}/{permission}', 'RoleController@permissionDelete')->name('rolePermission.delete');
    });

    Route::group(['prefix' => 'permissions'], function() {
        Route::get('/', 'PermissionController@index')->name('permissions.index');
        Route::get('/create', 'PermissionController@create')->name('permissions.create');
        Route::post('/store', 'PermissionController@store')->name('permissions.store');
        Route::get('/edit/{id}', 'PermissionController@edit')->name('permissions.edit');
        Route::put('/update/{id}', 'PermissionController@update')->name('permissions.update');
    });

    Route::group(['prefix' => 'categorias'], function() {
        Route::get('/', 'CategoriaController@index')->name('categorias.index');
        Route::get('/create', 'CategoriaController@create')->name('categorias.create');
        Route::post('/store', 'CategoriaController@store')->name('categorias.store');
        Route::get('/edit/{id}', 'CategoriaController@edit')->name('categorias.edit');
        Route::put('/update/{id}', 'CategoriaController@update')->name('categorias.update');
        Route::get('/active/{id}', 'CategoriaController@active')->name('categorias.active');
        Route::post('search', 'CategoriaController@search')->name('categorias.search');
    });

    Route::group(['prefix' => 'subcategorias'], function() {
        Route::get('/', 'SubCategoriaController@index')->name('subCategorias.index');
        Route::get('/create', 'SubCategoriaController@create')->name('subCategorias.create');
        Route::post('/store', 'SubCategoriaController@store')->name('subCategorias.store');
        Route::get('/edit/{id}', 'SubCategoriaController@edit')->name('subCategorias.edit');
        Route::put('/update/{id}', 'SubCategoriaController@update')->name('subCategorias.update');
        Route::get('/active/{id}', 'SubCategoriaController@active')->name('subCategorias.active');
        Route::post('search', 'SubCategoriaController@search')->name('subCategorias.search');
    });

    Route::group(['prefix' => 'empresas'], function() {
        Route::get('/', 'EmpresaController@index')->name('empresas.index');
        Route::get('/create', 'EmpresaController@create')->name('empresas.create');
        Route::post('/store', 'EmpresaController@store')->name('empresas.store');
        Route::get('/edit/{id}', 'EmpresaController@edit')->name('empresas.edit');
        Route::put('/update/{id}', 'EmpresaController@update')->name('empresas.update');
        Route::delete('/delete/{id}', 'EmpresaController@delete')->name('empresas.delete');
        Route::post('/search', 'EmpresaController@search')->name('empresas.search');


        // Route::get('subcategoria/{id}', 'EmpresaController@subcategoria')->name('empresas.subcategoria');
        // Route::get('edit/subcategoria/{id}', 'EmpresaController@subcategoria')->name('empresas.subcategoria');

        Route::get('/alterClient/{id}', 'EmpresaController@alterClient')->name('empresas.alterClient');
        Route::put('/alterClient/{id}', 'EmpresaController@alterClientUpdate')->name('empresas.alterClientUpdate');

    });

    Route::group(['prefix' => 'sites'], function() {
        Route::get('/', 'SiteController@index')->name('sites.index');
        Route::put('/update/{id}', 'SiteController@update')->name('sites.update');
    });

    Route::group(["prefix" => "galeria"], function() {
        Route::get('/show/{empresa}', [\App\Http\Controllers\Admin\GaleriaFotosController::class, 'show'])->name('galeria.show');
        Route::post('/store/{empresa}', [\App\Http\Controllers\Admin\GaleriaFotosController::class, 'store'])->name('galeria.store');
        Route::delete('/{galeria}', [\App\Http\Controllers\Admin\GaleriaFotosController::class, 'destroy'])->name('galeria.destroy');
    });

    Route::resource('categoriaBlog', CatBlogController::class);
    Route::post('categoriaBlog/search', [CatBlogController::class, 'search'])->name('categoriaBlog.search');

    Route::resource('noticias', NoticiasController::class);
    
    Route::resource('menus', MenuConfigController::class);
});