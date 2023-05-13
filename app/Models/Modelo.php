<?php

namespace App\Models;

use Database\Factories\ModeloFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $table = 'modelo';

    protected $primaryKey = 'id';

    protected $fillable = [
        'id',
        'nome',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function factory()
    {
        return ModeloFactory::new();
    }
}