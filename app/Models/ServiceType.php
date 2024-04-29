<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $guarded = [];

public function services(){
   return $this->belongsToMany(Service::class, 'pending_type')->withTimestamps();
}
function getImageURL()
{
    if ($this->image) {
        return url('storage/' . $this->image);
    }

    return url('img/defaultImages/service_type_img.png') ;
}
    use HasFactory;
}
