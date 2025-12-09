<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::orderBy('id', 'desc')->paginate(10);
        return view('admin.produtos.index', compact('produtos'));
    }

    public function create()
    {
        return view('admin.produtos.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'tipo' => 'nullable|string|max:100',
            'ativo' => 'nullable|boolean',
        ]);

        $dados['ativo'] = $request->has('ativo');

        Produto::create($dados);

        return redirect()->route('admin.produtos.index')->with('sucesso', 'Produto criado com sucesso!');
    }

    public function edit(Produto $produto)
    {
        return view('admin.produtos.edit', compact('produto'));
    }

    public function update(Request $request, Produto $produto)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'nullable|string',
            'preco' => 'required|numeric',
            'tipo' => 'nullable|string|max:100',
            'ativo' => 'nullable|boolean',
        ]);

        $dados['ativo'] = $request->has('ativo');

        $produto->update($dados);

        return redirect()->route('admin.produtos.index')->with('sucesso', 'Produto atualizado com sucesso!');
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();
        return redirect()->route('admin.produtos.index')->with('sucesso', 'Produto removido!');
    }
}
