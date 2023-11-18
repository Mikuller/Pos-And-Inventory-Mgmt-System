<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function categories(){
       return $this->belongsToMany(Category::class,"category_product")->withTimestamps();
    }

    function getImageURL()
    {
        if ($this->image) {
            return url('storage/' . $this->image);
        }

        return url('img/defaultImages/product_image.jpg') ;
    }
    use HasFactory;
}
