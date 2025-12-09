<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Support\ProdutoRepository;
use Illuminate\Http\Request;

class CarrinhoController extends Controller
{
    public function __construct(private readonly ProdutoRepository $produtos)
    {
    }

    public function adicionar(Request $request)
    {
        $produto = Produto::findOrFail($request->produto_id);
        $produto = $this->produtos->findAtivoOrFail((int) $request->produto_id);
        $quantidade = (int) $request->input('quantidade', 1);

        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$produto->id])) {
            $carrinho[$produto->id]['quantidade'] += $quantidade;
        } else {
            $carrinho[$produto->id] = [
                'nome' => $produto->nome,
                'preco' => $produto->preco,
                'quantidade' => $quantidade,
            ];
        }

        session()->put('carrinho', $carrinho);

        return redirect()->route('carrinho.ver')->with('sucesso', 'Produto adicionado ao carrinho!');
    }

    public function ver()
    {
        $carrinho = session()->get('carrinho', []);
        $total = collect($carrinho)->sum(fn ($item) => $item['preco'] * $item['quantidade']);

        return view('carrinho.index', compact('carrinho', 'total'));
    }
     public function remover(Request $request)
    {
 
        $id = $request->input('produto_id');

        $carrinho = session()->get('carrinho', []);

        if (isset($carrinho[$id])) {
            unset($carrinho[$id]);
            session()->put('carrinho', $carrinho);
        }

        return redirect()
            ->route('carrinho.ver')
            ->with('sucesso', 'Produto removido do carrinho!');
    }

}