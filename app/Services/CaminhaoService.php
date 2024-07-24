<?php

namespace App\Services;

use App\Interfaces\CRUD;
use App\Models\Caminhao;
use Illuminate\Pagination\LengthAwarePaginator;

class CaminhaoService implements CRUD
{
    public function __construct(
        private Caminhao $caminhao
    ) {
    }

    public function obterTodos(?int $offset = null): LengthAwarePaginator
    {
        $offset = $offset ?: Caminhao::count();

        return $this->caminhao::select(
            'id',
            'motorista_id',
            'modelo_id',
            'placa',
            'cor'
        )->paginate($offset);
    }

    public function obterPor(string $id): ?Caminhao
    {
        return $this->caminhao::select(
            'id',
            'motorista_id',
            'modelo_id',
            'placa',
            'cor'
        )
            ->find($id);
    }

    public function criar(array $request): void
    {
        $this->caminhao::create($request);
    }

    public function atualizar(string $id, array $request): void
    {
        $this->caminhao::where('id', $id)->update($request);
    }

    public function deletar(string $id): void
    {
        $this->caminhao::destroy(explode(',', $id));
    }
}
