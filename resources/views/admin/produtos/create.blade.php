@extends('layout')

@section('conteudo')
<h2>Novo Produto</h2>

@if ($errors->any())
    <div class="card" style="border-left:4px solid #c62828;">
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{ route('admin.produtos.store') }}">
    @csrf

    @include('admin.produtos.partials.form', ['produto' => null])

    <button class="btn" type="submit">Salvar</button>
    <a href="{{ route('admin.produtos.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
