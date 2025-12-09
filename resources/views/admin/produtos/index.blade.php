@extends('layout')

@section('conteudo')
<h2>Admin – Produtos</h2>

<a href="{{ route('admin.produtos.create') }}" class="btn">Novo produto</a>
<br><br>

<table style="width:100%; border-collapse:collapse;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Tipo</th>
            <th>Ativo?</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
    @foreach($produtos as $produto)
        <tr>
            <td>{{ $produto->id }}</td>
            <td>{{ $produto->nome }}</td>
            <td>R$ {{ number_format($produto->preco, 2, ',', '.') }}</td>
            <td>{{ $produto->tipo }}</td>
            <td>{{ $produto->ativo ? 'Sim' : 'Não' }}</td>
            <td>
                <a href="{{ route('admin.produtos.edit', $produto->id) }}" class="btn btn-secondary">Editar</a>

                <form method="post" action="{{ route('admin.produtos.destroy', $produto->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-secondary" type="submit" onclick="return confirm('Remover produto?')">
                        Excluir
                    </button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<br>
{{ $produtos->links() }}
@endsection
