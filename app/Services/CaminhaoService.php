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

    public function obterTodos(int $offset = null): LengthAwarePaginator
    {
        $offset = isset($offset) ? $offset : Caminhao::count();

        return $this->caminhao::select('id', 'motorista_id', 'modelo_id', 'placa', 'cor')->paginate($offset);
    }

    public function obterPor(string $id): ?Caminhao
    {
        return $this->caminhao::select('id', 'motorista_id', 'modelo_id', 'placa', 'cor')
            ->find($id);
    }

    public function criar(array $request): void
    {
        $this->caminhao::create(
            [
                'placa' => $request['placa'],
                'cor' => $request['cor'],
                'modelo_id' => $request['modelo_id'],
                'motorista_id' => $request['motorista_id'],
                'transportadora_id' => $request['transportadora_id'],
            ]
        );
    }

    public function atualizar(string $id, array $request): void
    {
        $caminhao = $this->caminhao::find($id);
        $caminhao->placa = isset($request['placa']) ? $request['placa'] : $caminhao->placa;
        $caminhao->cor = isset($request['cor']) ? $request['cor'] : $caminhao->cor;
        $caminhao->modelo_id = isset($request['modelo_id']) ? $request['modelo_id'] : $caminhao->modelo_id;
        $caminhao->motorista_id = isset($request['motorista_id']) ? $request['motorista_id'] : $caminhao->motorista_id;
        $caminhao->transportadora_id = isset($request['transportadora_id']) ? $request['transportadora_id'] : $caminhao->transportadora_id;
        $caminhao->save();
    }

    public function deletar(string $id): void
    {
        $this->caminhao::whereIn('id', explode(',', $id))->delete();
    }
}