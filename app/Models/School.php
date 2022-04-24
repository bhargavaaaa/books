<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function board(){
        return $this->belongsToMany(Board::class,'board_schools')->withTimestamps();
    }

    public function publication(){
        return $this->belongsToMany(Publication::class,'publication_schools')->withTimestamps();
    }
}
