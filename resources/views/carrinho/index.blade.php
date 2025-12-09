@extends('layout')

@section('conteudo')
<h2>Seu Carrinho</h2>

@if(empty($carrinho))
    <p>Seu carrinho está vazio.</p>
    <a href="{{ route('vitrine') }}" class="btn">Voltar à vitrine</a>
@else
    <table style="width:100%; border-collapse: collapse; margin-bottom:16px;">
        <thead>
        <tr>
            <th style="text-align:left; border-bottom:1px solid #ddd; padding:8px;">Produto</th>
            <th style="text-align:center; border-bottom:1px solid #ddd; padding:8px;">Qtd</th>
            <th style="text-align:right; border-bottom:1px solid #ddd; padding:8px;">Preço</th>
            <th style="text-align:right; border-bottom:1px solid #ddd; padding:8px;">Subtotal</th>
            <th style="border-bottom:1px solid #ddd; padding:8px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($carrinho as $id => $item)
            @php
                $subtotal = $item['preco'] * $item['quantidade'];
            @endphp
            <tr>
                <td style="padding:8px;">{{ $item['nome'] }}</td>
                <td style="text-align:center; padding:8px;">{{ $item['quantidade'] }}</td>
                <td style="text-align:right; padding:8px;">
                    R$ {{ number_format($item['preco'], 2, ',', '.') }}
                </td>
                <td style="text-align:right; padding:8px;">
                    R$ {{ number_format($subtotal, 2, ',', '.') }}
                </td>
                <td style="text-align:right; padding:8px;">
                    <form action="{{ route('carrinho.remover') }}" method="post" style="display:inline;">
                        @csrf
                        <input type="hidden" name="produto_id" value="{{ $id }}">
                        <button type="submit" class="btn btn-secondary">Remover</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <td colspan="3" style="text-align:right; padding:8px; font-weight:bold;">
                Total:
            </td>
            <td style="text-align:right; padding:8px; font-weight:bold;">
                R$ {{ number_format($total, 2, ',', '.') }}
            </td>
            <td></td>
        </tr>
        </tfoot>
    </table>

    <a href="{{ route('vitrine') }}" class="btn btn-secondary">Continuar comprando</a>
    &nbsp;
    <a href="{{ route('checkout.form') }}" class="btn">Prosseguir para checkout</a>
@endif
@endsection
