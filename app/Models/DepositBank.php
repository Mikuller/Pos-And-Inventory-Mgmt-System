<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DepositBank extends Model
{
    protected $guarded = [];

    public function sales() : HasMany{
         return $this->hasMany(Sale::class);
    }
    use HasFactory;
}
