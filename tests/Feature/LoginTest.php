<?php

use Illuminate\Http\Response;

test('login', function () {
    $response = $this->post('api/login', [
        'email' => 'thiagobarros95@gmail.com',
        'password' => 'password',
    ])
        ->assertStatus(Response::HTTP_OK);

    expect($response->original)->toHaveKey('access_token');
});

test('unauthoried', function () {
    $response = $this->post('api/login', [
        'email' => 'thiagobarros95@gmail.com',
        'password' => 'wrongpassword',
    ])
        ->assertStatus(Response::HTTP_UNAUTHORIZED);
    expect($response->original)->toHaveKey('error');
    expect($response->original['error'])->toBe('Unauthorized');
});
