<?php

namespace App\Http\Controllers;

use App\Support\ProdutoRepository;

class VitrineController extends Controller
{
    public function __construct(private readonly ProdutoRepository $produtos)
    {
    }

    public function index()
    {
        return view('vitrine.index', [
            'produtos' => $this->produtos->ativos(),
        ]);
    }

    public function detalhe($id)
    {
        return view('vitrine.detalhe', [
            'produto' => $this->produtos->findAtivoOrFail((int) $id),
        ]);
    }
}

