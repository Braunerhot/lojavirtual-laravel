<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

Route::resource('produtos', ProdutoController::class);

Route::get('/', [SiteController::Class,  'index'])->name('site.index');

Route::get('/produto/{slug}', [SiteController::class, 'details'])->name('site.details');

Route::get('/categoria/{id}', [SiteController::class, 'categoria'])->name('site.categoria');

Route::get('/carrinho', [CarrinhoController::class, 'carrinhoLista'])->name('site.carrinho');

Route::post('/carrinho', [CarrinhoController::class, 'carrinhoAdicionar'])->name('site.addcarrinho');

Route::post('/remove', [CarrinhoController::class, 'carrinhoRemove'])->name('site.removecarrinho');

Route::post('/atualizar', [CarrinhoController::class, 'carrinhoAtualiza'])->name('site.atualizacarrinho');

Route::get('/limpar', [CarrinhoController::class, 'carrinhoLimpar'])->name('site.limparcarrinho');

Route::view('/login', 'login.form')->name('login.form');

Route::post('/auth', [LoginController::class, 'auth'])->name('login.auth');

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
