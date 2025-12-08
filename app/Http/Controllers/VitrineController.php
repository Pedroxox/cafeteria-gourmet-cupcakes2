<?php

namespace App\Http\Controllers;

use App\Models\Produto;

class VitrineController extends Controller
{
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

