<div>
    <label>Nome:<br>
        <input type="text" name="nome" value="{{ old('nome', $produto->nome ?? '') }}" required>
    </label>
</div><br>

<div>
    <label>Descrição:<br>
        <textarea name="descricao" rows="3">{{ old('descricao', $produto->descricao ?? '') }}</textarea>
    </label>
</div><br>

<div>
    <label>Preço:<br>
        <input type="number" step="0.01" name="preco" value="{{ old('preco', $produto->preco ?? '') }}" required>
    </label>
</div><br>

<div>
    <label>Tipo:<br>
        <input type="text" name="tipo" value="{{ old('tipo', $produto->tipo ?? '') }}" placeholder="kit, cafe, doce etc.">
    </label>
</div><br>

<div>
    <label>
        <input type="checkbox" name="ativo" {{ old('ativo', $produto->ativo ?? true) ? 'checked' : '' }}>
        Produto ativo
    </label>
</div><br>
