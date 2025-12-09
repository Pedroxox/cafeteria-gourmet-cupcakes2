@extends('layout')

@section('conteudo')
<h2>Pedido confirmado!</h2>

<div class="card">
    <p>Obrigado, <strong>{{ $pedido->nome_cliente }}</strong> 😊</p>
    <p>Seu pedido foi registrado com sucesso.</p>

    <p><strong>Número do pedido:</strong> {{ $pedido->id }}</p>
    <p><strong>Data da entrega:</strong> {{ \Carbon\Carbon::parse($pedido->data_entrega)->format('d/m/Y') }}</p>
    <p><strong>Horário:</strong> {{ substr($pedido->hora_entrega, 0, 5) }}</p>
    <p><strong>Valor total:</strong> R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</p>
    <p><strong>Status:</strong> {{ ucfirst(str_replace('_', ' ', $pedido->status)) }}</p>
</div>

<br>

<a href="{{ route('avaliacao.form', $pedido->id) }}" class="btn">
    Avaliar experiência
</a>
&nbsp;
<a href="{{ route('vitrine') }}" class="btn btn-secondary">
    Voltar à vitrine
</a>
@endsection
