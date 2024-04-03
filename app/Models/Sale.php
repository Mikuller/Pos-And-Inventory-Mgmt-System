<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\BelongsToRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sale extends Model
{
    protected $guarded = [];

    public function depositBank()
    {
        return $this->belongsTo(DepositBank::class,'deposit_bank_id');
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sale')
            ->withPivot('amount')
            ->withTimestamps();
    }
    use HasFactory;
}
