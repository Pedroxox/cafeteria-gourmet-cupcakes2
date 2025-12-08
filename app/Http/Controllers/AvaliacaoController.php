<?php

namespace App\Http\Controllers;

use App\Models\Avaliacao;
use App\Models\Pedido;
use Illuminate\Http\Request;

class AvaliacaoController extends Controller
{
    public function form(Pedido $pedido)
    {
        return view('avaliacao.form', compact('pedido'));
    }

    public function salvar(Request $request, Pedido $pedido)
    {
        $dados = $request->validate([
            'nota'      => 'required|integer|min:1|max:5',
            'comentario'=> 'nullable|string',
        ]);

        Avaliacao::create([
            'pedido_id' => $pedido->id,
            'nota'      => $dados['nota'],
            'comentario'=> $dados['comentario'] ?? null,
        ]);

        return redirect()->route('vitrine')->with('sucesso', 'Obrigado pela sua avaliação!');
    }
}

