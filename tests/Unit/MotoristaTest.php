<?php

namespace Tests\Unit;

use Mockery;
use DateTime;
use Exception;
use DateInterval;
use App\Interfaces\CRUD;
use App\Models\Motorista;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\PaginacaoRequest;
use Avlima\PhpCpfCnpjGenerator\Generator;
use App\Http\Requests\CriarMotoristaRequest;
use App\Http\Controllers\MotoristaController;
use App\Http\Requests\AtualizarMotoristaRequest;

test('Index', function () {
    $request = new PaginacaoRequest();
    $resource = (object) [];
    $resultadoEsperado = new JsonResponse($resource);
    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('obterTodos')->andReturn($resource);

    $resultado = (new MotoristaController($servico))->index($request);

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Show', function () {
    $resource = new Motorista();
    $resultadoEsperado = new JsonResponse($resource);
    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('obterPor')->andReturn($resource);

    $resultado = (new MotoristaController($servico))->show('1');

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Create', function () {
    $resultadoEsperado = new JsonResponse(
        'Motorista criado com sucesso.',
        JsonResponse::HTTP_CREATED
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('criar');

    $resultado = (new MotoristaController($servico))->store(new CriarMotoristaRequest([
        'nome' => fake()->name(),
        'cpf' => Generator::cpf(),
        'data_nascimento' => (new DateTime())->sub(new DateInterval('P18Y'))->format('d-m-Y'),
        'email' => fake()->email(),
    ]));

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Update', function () {
    $resultadoEsperado = new JsonResponse(
        null,
        JsonResponse::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('atualizar');

    $resultado = (new MotoristaController($servico))->update(new AtualizarMotoristaRequest([
        'nome' => fake()->name(),
        'cpf' => Generator::cpf(),
        'data_nascimento' => (new DateTime())->sub(new DateInterval('P18Y'))->format('d-m-Y'),
        'email' => fake()->email(),
    ]), '1');

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Delete', function () {
    $resultadoEsperado = new JsonResponse(
        null,
        JsonResponse::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('deletar');

    $resultado = (new MotoristaController($servico))->destroy('1');

    expect($resultado)->toEqual($resultadoEsperado);
});

test('Delete em massa', function () {
    $resultadoEsperado = new JsonResponse(
        null,
        JsonResponse::HTTP_NO_CONTENT
    );

    $servico = Mockery::mock(CRUD::class);
    $servico->shouldReceive('deletar');

    $resultado = (new MotoristaController($servico))->destroy('1,2,3,4');

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

    $resultadoIndex = (new MotoristaController($servico))->index($request);
    $resultadoShow = (new MotoristaController($servico))->show($request);
    $resultadoCreate = (new MotoristaController($servico))->store(new CriarMotoristaRequest);
    $resultadoUpdate = (new MotoristaController($servico))->update(new AtualizarMotoristaRequest, 1);
    $resultadoDelete = (new MotoristaController($servico))->destroy(1);

    expect($resultadoIndex)->toEqual($ErroEsperado);
    expect($resultadoShow)->toEqual($ErroEsperado);
    expect($resultadoCreate)->toEqual($ErroEsperado);
    expect($resultadoUpdate)->toEqual($ErroEsperado);
    expect($resultadoDelete)->toEqual($ErroEsperado);
});