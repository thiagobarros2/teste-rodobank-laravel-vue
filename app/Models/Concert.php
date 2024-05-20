<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class Concert extends Model
{
    use HasFactory;

    protected $connection = 'mongodb';
    protected $fillable = [
        'performer',
        'venue',
        'genres',
        'ticketsSold',
        'performanceDate'
    ];
    protected $casts = ['performanceDate' => 'datetime'];
}
