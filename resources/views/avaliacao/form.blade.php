@extends('layout')

@section('conteudo')
<h2>Avaliar Pedido #{{ $pedido->id }}</h2>

<p>Entrega em: {{ \Carbon\Carbon::parse($pedido->data_entrega)->format('d/m/Y') }}
    às {{ substr($pedido->hora_entrega, 0, 5) }}</p>
<p>Total: R$ {{ number_format($pedido->valor_total, 2, ',', '.') }}</p>

@if ($errors->any())
    <div class="card" style="border-left:4px solid #c62828;">
        <ul>
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post" action="{{ route('avaliacao.salvar', $pedido->id) }}">
    @csrf

    <label>Nota (1 a 5):<br>
        <select name="nota" required>
            <option value="">Selecione</option>
            @for($i = 1; $i <= 5; $i++)
                <option value="{{ $i }}">{{ $i }}</option>
            @endfor
        </select>
    </label><br><br>

    <label>Comentário (opcional):<br>
        <textarea name="comentario" rows="4">{{ old('comentario') }}</textarea>
    </label><br><br>

    <button type="submit" class="btn">Enviar avaliação</button>
</form>

<br>
<a href="{{ route('vitrine') }}" class="btn btn-secondary">Voltar à página inicial</a>
@endsection
