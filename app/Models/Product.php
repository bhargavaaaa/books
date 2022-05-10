<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function publication(){
        return $this->belongsToMany(Publication::class,'product_publications');//->withTimestamps();
    }

    public function school(){
        return $this->belongsToMany(School::class,'product_schools');//->withTimestamps();
    }

    public function category(){
        return $this->belongsToMany(Category::class,'category_products');//->withTimestamps();
    }

    public function board(){
        return $this->belongsToMany(Board::class,'board_products');//->withTimestamps();
    }

    public function standard()
    {
        return $this->belongsToMany(Standard::class,'product_standards');
    }

}
