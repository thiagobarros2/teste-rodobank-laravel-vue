<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Concert;

class CriacaoLeituraRegistroMongoDb extends TestCase
{
    public function testCriacaoLeitura(): void
    {
        Concert::query()->delete();

        Concert::create([
            'performer' => 'Gabizinha',
            'vanue' => 'Carnegie Hall',
            'genres' => ['classical'],
            'ticketsSold' => 2121,
            'performanceDate' => Carbon::now()
        ]);

        $concert = Concert::where('performer', 'Gabizinha')->get();

        $this->assertSame(1, $concert->count());

        $this->assertSame('Gabizinha', $concert->first()->performer);
    }
}
