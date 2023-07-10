<?php

namespace App\Services;

use App\Interfaces\CRUD;
use App\Models\Modelo;
use Illuminate\Pagination\LengthAwarePaginator;

class ModeloService implements CRUD
{
    public function __construct(
        private Modelo $modelo,
    ) {
    }

    public function obterTodos(int $offset = null): LengthAwarePaginator
    {
        $offset = $offset ?: Modelo::count();

        return $this->modelo::select(
            'id',
            'nome'
        )->paginate($offset);
    }

    public function obterPor(string $id): ?Modelo
    {
        return $this->modelo::select(
            'id',
            'nome'
        )
            ->find($id);
    }

    public function criar(array $request): void
    {
        $this->modelo::create($request);
    }

    public function atualizar(string $id, array $request): void
    {
        $this->modelo::where('id', $id)->update($request);
    }

    public function deletar(string $id): void
    {
        $this->modelo::destroy(explode(',', $id));
    }
}