<?php

namespace Tests\Unit;

use Mockery;
use Exception;
use App\Interfaces\CRUD;
use Illuminate\Http\Response;
use App\Models\Transportadora;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PaginacaoRequest;
use Avlima\PhpCpfCnpjGenerator\Generator;
use App\Http\Requests\CriarTransportadoraRequest;
use App\Http\Controllers\TransportadoraController;
use App\Http\Requests\AtualizarTransportadoraRequest;

test('Index', function () {
    $request = new PaginacaoRequest();
    $resource = (object) [];
    $resultadoEsperado = new JsonResponse($resource);
    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('obterTodos')->andReturn($resource);

    $resultado = (new TransportadoraController($servico))->index($request);

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Show', function () {
    $resource = new Transportadora();
    $resultadoEsperado = new JsonResponse($resource);
    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('obterPor')->andReturn($resource);

    $resultado = (new TransportadoraController($servico))->show('1');

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Create', function () {

    $resultadoEsperado = new JsonResponse(
        'Transportadora criada com sucesso.',
        Response::HTTP_CREATED
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('criar');

    $resultado = (new TransportadoraController($servico))->store(new CriarTransportadoraRequest([
        'nome' => fake()->name(),
        'cnpj' => Generator::cnpj(),
    ]));

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Update', function () {
    $resultadoEsperado = new JsonResponse(
        null,
        Response::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('atualizar');

    $resultado = (new TransportadoraController($servico))->update(new AtualizarTransportadoraRequest([
        'nome' => fake()->name(),
        'cnpj' => Generator::cnpj(),
    ]), '1');

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Delete', function () {
    $resultadoEsperado = new JsonResponse(
        null,
        Response::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('deletar');

    $resultado = (new TransportadoraController($servico))->destroy('1');

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Delete em massa', function () {
    $resultadoEsperado = new JsonResponse(
        null,
        Response::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('deletar');

    $resultado = (new TransportadoraController($servico))->destroy('1,2,3,4');

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Erro', function () {
    $request = new PaginacaoRequest();
    $ErroEsperado = new JsonResponse("Message", JsonResponse::HTTP_BAD_REQUEST);
    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('obterTodos')->andThrow(new Exception("Message"));
    $servico->shouldReceive('obterPor')->andThrow(new Exception("Message"));
    $servico->shouldReceive('criar')->andThrow(new Exception("Message"));
    $servico->shouldReceive('atualizar')->andThrow(new Exception("Message"));
    $servico->shouldReceive('deletar')->andThrow(new Exception("Message"));

    $resultadoIndex = (new TransportadoraController($servico))->index($request);
    $resultadoShow = (new TransportadoraController($servico))->show($request);
    $resultadoCreate = (new TransportadoraController($servico))->store(new CriarTransportadoraRequest);
    $resultadoUpdate = (new TransportadoraController($servico))->update(new AtualizarTransportadoraRequest, 1);
    $resultadoDelete = (new TransportadoraController($servico))->destroy(1);

    expect($resultadoIndex)->toEqual($ErroEsperado);
    expect($resultadoShow)->toEqual($ErroEsperado);
    expect($resultadoCreate)->toEqual($ErroEsperado);
    expect($resultadoUpdate)->toEqual($ErroEsperado);
    expect($resultadoDelete)->toEqual($ErroEsperado);
});