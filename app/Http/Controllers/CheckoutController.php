<?php
namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\ItemPedido;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function form()
    {
        $carrinho = session()->get('carrinho', []);
        if (empty($carrinho)) {
            return redirect()->route('vitrine');
        }

        $total = collect($carrinho)->sum(fn ($item) => $item['preco'] * $item['quantidade']);

        return view('checkout.form', compact('carrinho', 'total'));
    }

    public function processar(Request $request)
    {
        $carrinho = session()->get('carrinho', []);
        if (empty($carrinho)) {
            return redirect()->route('vitrine');
        }

        $dados = $request->validate([
    'nome_cliente'     => 'required|string|max:255',
    'email_cliente'    => 'required|email',
    'endereco_entrega' => 'required|string',
    'data_entrega'     => 'required|date',
    'hora_entrega'     => 'required',
], [
    'nome_cliente.required'     => 'O nome deve ser preenchido.',
    'email_cliente.required'    => 'O e-mail deve ser preenchido.',
    'endereco_entrega.required' => 'O endereço deve ser preenchido.',
    'data_entrega.required'     => 'A data deve ser preenchida.',
    'hora_entrega.required'     => 'O horário deve ser preenchido.',
]);


        $total = collect($carrinho)->sum(fn ($item) => $item['preco'] * $item['quantidade']);

        $pedido = Pedido::create(array_merge($dados, [
            'valor_total' => $total,
            'status'      => 'confirmado', // você pode simular pagamento aqui
        ]));

        foreach ($carrinho as $produtoId => $item) {
            ItemPedido::create([
                'pedido_id'      => $pedido->id,
                'produto_id'     => $produtoId,
                'quantidade'     => $item['quantidade'],
                'preco_unitario' => $item['preco'],
            ]);
        }

        // limpa carrinho
        session()->forget('carrinho');

        return redirect()->route('pedido.confirmacao', $pedido->id);
    }

    public function confirmacao(Pedido $pedido)
    {
        return view('checkout.confirmacao', compact('pedido'));
    }
}

