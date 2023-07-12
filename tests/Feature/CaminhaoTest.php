<?php

use App\Models\Caminhao;
use App\Models\Modelo;
use App\Models\Motorista;
use App\Models\Transportadora;
use Database\Factories\CaminhaoFactory;
use Illuminate\Http\Response;

beforeEach(function () {
    $this->url = 'api/caminhoes/';
    $this->caminhaoId = Caminhao::factory()->create()->id;
});

test('index', function () {
    $this->withoutMiddleware()
        ->get($this->url)
        ->assertStatus(Response::HTTP_OK);
});

test('show', function () {
    $this->withoutMiddleware()
        ->get($this->url.$this->caminhaoId)
        ->assertStatus(Response::HTTP_OK);
});

test('store', function () {
    $this->withoutMiddleware()->post(
        $this->url,
        [
            'placa' => CaminhaoFactory::placa(),
            'motorista_id' => Motorista::factory()->create()->id,
            'modelo_id' => Modelo::factory()->create()->id,
            'cor' => fake()->colorName(),
            'transportadora_id' => Transportadora::factory()->create()->id,
        ]
    )
        ->assertStatus(Response::HTTP_CREATED);
});

test('update', function () {
    $this->withoutMiddleware()
        ->put(
            $this->url.$this->caminhaoId,
            [
                'placa' => CaminhaoFactory::placa(),
                'motorista_id' => Motorista::factory()->create()->id,
                'modelo_id' => Modelo::factory()->create()->id,
                'cor' => fake()->colorName(),
                'transportadora_id' => Transportadora::factory()->create()->id,
            ]
        )
        ->assertStatus(Response::HTTP_NO_CONTENT);
});

test('update com campos vazios', function () {
    $this->withoutMiddleware()
        ->put(
            $this->url.$this->caminhaoId,
            [
                'placa' => null,
                'motorista_id' => Motorista::factory()->create()->id,
                'modelo_id' => Modelo::factory()->create()->id,
                'cor' => fake()->colorName(),
                'transportadora_id' => Transportadora::factory()->create()->id,
            ],
        )
        ->assertStatus(Response::HTTP_FOUND);
});

test('destroy', function () {
    $this->withoutMiddleware()
        ->delete($this->url.$this->caminhaoId)
        ->assertStatus(Response::HTTP_NO_CONTENT);
});
