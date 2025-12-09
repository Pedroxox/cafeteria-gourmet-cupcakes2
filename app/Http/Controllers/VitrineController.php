<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Support\ProdutoRepository;

class VitrineController extends Controller
{
    public function __construct(private readonly ProdutoRepository $produtos)
    {
    }

    public function index()
    {
        $produtos = Produto::where('ativo', true)->get();
        return view('vitrine.index', compact('produtos'));
        
    }

    public function detalhe($id)
    {
        $produto = Produto::where('ativo', true)->findOrFail($id);
        return view('vitrine.detalhe', compact('produto'));
        
    }
}


