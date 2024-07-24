<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface CRUD
{
    public function obterTodos(?int $offset = null): object;

    public function obterPor(string $id): ?Model;

    public function criar(array $request): void;

    public function atualizar(string $id, array $request): void;

    public function deletar(string $id): void;
}
