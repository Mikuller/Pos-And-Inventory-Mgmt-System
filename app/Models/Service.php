<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $guarded = [];
    public function serviceTypes(){
        return $this->belongsToMany(ServiceType::class, 'pending_type')->withTimestamps();
     }
    use HasFactory;
}
