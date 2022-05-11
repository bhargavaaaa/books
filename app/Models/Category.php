<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function board(){
        return $this->belongsToMany(Board::class,'board_categories')->withTimestamps();
    }

    public function publication(){
        return $this->belongsToMany(Publication::class,'category_publications')->withTimestamps();
    }

    public function school(){
        return $this->belongsToMany(School::class,'category_schools')->withTimestamps();
    }

    public function product()
    {
        return $this->belongsToMany(Product::class,'category_products');
    }

    public function scopeActive($q) {
        return $q->where('is_active',1);
    }
}
