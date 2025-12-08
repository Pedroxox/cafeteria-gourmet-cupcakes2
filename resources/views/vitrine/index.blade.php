@extends('layout')

@section('conteudo')
<h2>Vitrine de Produtos</h2>

@foreach($produtos as $produto)
    <div class="card">
        <h3>{{ $produto->nome }}</h3>
        <p>{{ $produto->descricao }}</p>
        <strong>R$ {{ number_format($produto->preco, 2, ',', '.') }}</strong><br><br>
        <a class="btn" href="{{ route('produto.detalhe', $produto->id) }}">Ver detalhes</a>
    </div>
@endforeach
@endsection
