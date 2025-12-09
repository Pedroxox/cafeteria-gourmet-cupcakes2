@extends('layout')

@section('conteudo')
<h2>Finalizar Pedido</h2>

@if ($errors->any())
    <div class="card" style="border-left:4px solid #c62828; margin-bottom:12px;">
        <strong>Ops, há erros no formulário:</strong>
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h3>Resumo do Carrinho</h3>
<table style="width:100%; border-collapse: collapse; margin-bottom:16px;">
    <thead>
    <tr>
        <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">Produto</th>
        <th style="text-align:center; border-bottom:1px solid #ddd; padding:8px;">Qtd</th>
        <th style="text-align:right; border-bottom:1px solid #ddd; padding:8px;">Subtotal</th>
    </tr>
    </thead>
    <tbody>
    @foreach($carrinho as $item)
        @php
            $subtotal = $item['preco'] * $item['quantidade'];
        @endphp
        <tr>
            <td style="padding:8px;">{{ $item['nome'] }}</td>
            <td style="text-align:center; padding:8px;">{{ $item['quantidade'] }}</td>
            <td style="text-align:right; padding:8px;">
                R$ {{ number_format($subtotal, 2, ',', '.') }}
            </td>
        </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="2" style="text-align:right; padding:8px; font-weight:bold;">
            Total:
        </td>
        <td style="text-align:right; padding:8px; font-weight:bold;">
            R$ {{ number_format($total, 2, ',', '.') }}
        </td>
    </tr>
    </tfoot>
</table>

<h3>Dados para Entrega e Contato</h3>

<form action="{{ route('checkout.processar') }}" method="post">
    @csrf

    <div style="margin-bottom:8px;">
        <label>Nome completo<br>
            <input type="text" name="nome_cliente" value="{{ old('nome_cliente') }}" style="width:100%;">
        </label>
    </div>

    <div style="margin-bottom:8px;">
        <label>E-mail<br>
            <input type="email" name="email_cliente" value="{{ old('email_cliente') }}" style="width:100%;">
        </label>
    </div>

    <div style="margin-bottom:8px;">
        <label>Telefone/WhatsApp<br>
            <input type="text" name="telefone" value="{{ old('telefone') }}" style="width:100%;">
        </label>
    </div>

    <div style="margin-bottom:8px;">
        <label>Endereço de entrega<br>
            <textarea name="endereco_entrega" rows="3" style="width:100%;">{{ old('endereco_entrega') }}</textarea>
        </label>
    </div>

    <div style="display:flex; gap:8px; margin-bottom:8px; flex-wrap:wrap;">
        <div style="flex:1;">
            <label>Data da entrega<br>
                <input type="date" name="data_entrega" value="{{ old('data_entrega') }}" style="width:100%;">
            </label>
        </div>

        <div style="flex:1;">
            <label>Horário da entrega<br>
                <input type="time" name="hora_entrega" value="{{ old('hora_entrega') }}" style="width:100%;">
            </label>
        </div>
    </div>

    <h3>Método de pagamento (simulado)</h3>
    <div style="margin-bottom:12px;">
        <label>
            <input type="radio" name="metodo_pagamento" value="cartao" checked>
            Cartão de crédito
        </label><br>
        <label>
            <input type="radio" name="metodo_pagamento" value="pix">
            Pix
        </label><br>
        <label>
            <input type="radio" name="metodo_pagamento" value="carteira">
            Carteira digital
        </label>
    </div>

    <button type="submit" class="btn">Confirmar pedido</button>
    &nbsp;
    <a href="{{ route('carrinho.ver') }}" class="btn btn-secondary">Voltar ao carrinho</a>
</form>
@endsection
