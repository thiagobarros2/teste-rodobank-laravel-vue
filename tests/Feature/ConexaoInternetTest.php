<?php

test('verifica se há conexão com a internet')
    ->get('https://www.google.com')
    ->assertOk();
