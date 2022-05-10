<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standard extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function board(){
        return $this->belongsToMany(Board::class,'board_standards')->withTimestamps();
    }

    public function publication(){
        return $this->belongsToMany(Publication::class,'publication_standards')->withTimestamps();
    }

    public function school(){
        return $this->belongsToMany(School::class,'school_standards')->withTimestamps();
    }
}
