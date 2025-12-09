<?php
use App\Http\Controllers\VitrineController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\Admin\ProdutoController as AdminProdutoController;
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

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/produtos', [AdminProdutoController::class, 'index'])->name('produtos.index');
    Route::get('/produtos/novo', [AdminProdutoController::class, 'create'])->name('produtos.create');
    Route::post('/produtos', [AdminProdutoController::class, 'store'])->name('produtos.store');
    Route::get('/produtos/{produto}/editar', [AdminProdutoController::class, 'edit'])->name('produtos.edit');
    Route::put('/produtos/{produto}', [AdminProdutoController::class, 'update'])->name('produtos.update');
    Route::delete('/produtos/{produto}', [AdminProdutoController::class, 'destroy'])->name('produtos.destroy');
});

