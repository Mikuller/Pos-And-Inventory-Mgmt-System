<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePartDeposit extends Model
{
    protected $guarded = [];

    function sparePart(){
        $this->belongsTo(SparePart::class);
    }
    use HasFactory;
}
