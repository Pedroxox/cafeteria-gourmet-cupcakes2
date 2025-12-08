<?php
use App\Http\Controllers\VitrineController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AvaliacaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [VitrineController::class, 'index'])->name('vitrine');
Route::get('/produto/{id}', [VitrineController::class, 'detalhe'])->name('produto.detalhe');

Route::post('/carrinho/adicionar', [CarrinhoController::class, 'adicionar'])->name('carrinho.adicionar');
Route::get('/carrinho', [CarrinhoController::class, 'ver'])->name('carrinho.ver');
Route::post('/carrinho/remover', [CarrinhoController::class, 'remover'])->name('carrinho.remover');

Route::get('/checkout', [CheckoutController::class, 'form'])->name('checkout.form');
Route::post('/checkout', [CheckoutController::class, 'processar'])->name('checkout.processar');

Route::get('/pedido/{pedido}/confirmacao', [CheckoutController::class, 'confirmacao'])->name('pedido.confirmacao');

Route::get('/pedido/{pedido}/avaliar', [AvaliacaoController::class, 'form'])->name('avaliacao.form');
Route::post('/pedido/{pedido}/avaliar', [AvaliacaoController::class, 'salvar'])->name('avaliacao.salvar');

