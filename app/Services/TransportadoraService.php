<?php

namespace App\Services;

use App\Interfaces\CRUD;
use App\Models\Transportadora;
use Illuminate\Pagination\LengthAwarePaginator;

class TransportadoraService implements CRUD
{
    public function __construct(
        private Transportadora $transportadora,
    ) {
    }

    public function obterTodos(?int $offset = null): LengthAwarePaginator
    {
        $offset = $offset ?: Transportadora::count();

        return $this->transportadora::with('motoristas:id,transportadora_id,nome')
            ->select(
                'id',
                'nome',
                'cnpj',
                'status'
            )
            ->paginate($offset);
    }

    public function obterPor(string $id): ?Transportadora
    {
        return $this->transportadora::select(
            'nome',
            'cnpj',
            'status'
        )
            ->find($id);
    }

    public function criar(array $request): void
    {
        $this->transportadora::create($request);
    }

    public function atualizar(string $id, array $request): void
    {
        $this->transportadora::where('id', $id)->update($request);
    }

    public function deletar(string $id): void
    {
        $this->transportadora::destroy(explode(',', $id));
    }
}
