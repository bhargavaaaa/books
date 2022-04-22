<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use jeremykenedy\LaravelRoles\Traits\HasRoleAndPermission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory;
    use HasRoleAndPermission;
    use SoftDeletes;
    protected $table = "roles";
    protected $guarded = [];
    protected $fillable = ['name', 'slug', 'description'];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }
}
