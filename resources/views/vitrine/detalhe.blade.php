@extends('layout')

@section('conteudo')
<h2>{{ $produto->nome }}</h2>
<p>{{ $produto->descricao }}</p>
<p><strong>R$ {{ number_format($produto->preco, 2, ',', '.') }}</strong></p>

<form method="post" action="{{ route('carrinho.adicionar') }}">
    @csrf
    <input type="hidden" name="produto_id" value="{{ $produto->id }}">

    <label>Quantidade:
        <input type="number" name="quantidade" value="1" min="1">
    </label>

    <br><br>
    <button class="btn" type="submit">Adicionar ao carrinho</button>
</form>

<br>
<a class="btn btn-secondary" href="{{ route('vitrine') }}">Voltar</a>
@endsection
