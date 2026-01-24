<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    protected $guarded = [];

    function SparePartWithdraws(){
        return $this->hasMany(SparePartWithdraws::class);
    }
    function SparePartDeposits(){
        return $this->hasMany(SparePartDeposit::class);
    }
     
    function getImageURL()
    {
        if ($this->photo) {
            return url('storage/' . $this->photo);
        }

        return url('img/defaultImages/defaultImage.jpg') ;
    }
    use HasFactory;
}
