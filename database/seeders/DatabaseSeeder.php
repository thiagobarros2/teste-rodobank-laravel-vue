<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::insert(
            [
                [
                    'name' => 'Alexandre Barroso Costa',
                    'email' => 'alexandre.barroso@rodobank.com.br',
                    'password' => Hash::make('password'),
                ],
                [
                    'name' => 'Thiago Barros',
                    'email' => 'thiagobarros95@gmail.com',
                    'password' => Hash::make('password'),
                ],
            ]
        );
        \App\Models\User::factory()->count(5)->create();
        \App\Models\Transportadora::factory()->count(5)->create();
        \App\Models\Motorista::factory()->count(5)->create();
        \App\Models\Modelo::factory()->count(5)->create();
        \App\Models\Caminhao::factory()->count(5)->create();
    }
}
