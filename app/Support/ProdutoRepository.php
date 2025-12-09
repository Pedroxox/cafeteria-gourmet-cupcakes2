<?php

namespace App\Support;

use App\Models\Produto;
use Illuminate\Support\Collection;

class ProdutoRepository
{
    public function ativos(): Collection
    {
        return $this->executarOuFallback(fn () => Produto::where('ativo', true)->get());
    }

    public function findAtivoOrFail(int $id): object
    {
        $produto = $this->ativos()->firstWhere('id', $id);

        abort_if(is_null($produto), 404);

        return $produto;
    }

    protected function executarOuFallback(callable $consulta): Collection
    {
        try {
            $resultado = $consulta();

            if ($resultado instanceof Collection && $resultado->isNotEmpty()) {
                return $resultado;
            }
        } catch (\Throwable $exception) {
        }

        return $this->produtosFicticios();
    }

    protected function produtosFicticios(): Collection
    {
        return collect([
            [
                'id' => 1,
                'nome' => 'Cupcake de Chocolate Belga',
                'descricao' => 'Massa de cacau 70% com recheio cremoso de ganache e cobertura de buttercream.',
                'preco' => 12.90,
                'ativo' => true,
            ],
            [
                'id' => 2,
                'nome' => 'Cupcake de Frutas Vermelhas',
                'descricao' => 'Baunilha com geleia artesanal de frutas vermelhas e chantilly de mascarpone.',
                'preco' => 13.50,
                'ativo' => true,
            ],
            [
                'id' => 3,
                'nome' => 'Cupcake de Pistache',
                'descricao' => 'Massa macia de pistache, recheio de creme diplomata e praliné crocante.',
                'preco' => 14.00,
                'ativo' => true,
            ],
        ])->map(fn (array $produto) => (object) $produto);
    }
}
