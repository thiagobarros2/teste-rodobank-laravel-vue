<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Modelo extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'modelo';

    protected $guarded = ['id'];

    public function caminhao(): BelongsToMany
    {
        return $this->belongsToMany(Caminhao::class);
    }
}
