<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];
     
    public function products(){
        return $this->belongsToMany(Product::class,"category_product")->withTimestamps();
    }
    
    function getImageURL()
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        }
        return url('img/defaultImages/category_image.jpg') ;
    }

    use HasFactory;
}
