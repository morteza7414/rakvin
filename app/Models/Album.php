<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function architect()
    {
        return $this->belongsTo(User::class,'architect_id','id');
    }

    public function images()
    {
        return $this->hasMany(Images::class,'album_id','id');
    }

    public function albumAccessibleUsers()
    {
        return $this->belongsToMany(User::class, 'architect_users_accessible', 'user_id', 'album_id');
    }

}
