<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transportadora extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'transportadora';

    protected $guarded = ['id'];
    
    public function motoristas(): HasMany
    {
        return $this->hasMany(Motorista::class);
    }

    public function caminhoes(): HasMany
    {
        return $this->hasMany(Caminhao::class);
    }
}
