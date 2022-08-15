<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function customer()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function album()
    {
        return $this->belongsTo(Album::class,'album_id','id');
    }

    public function image()
    {
        return $this->belongsTo(Images::class,'image_id','id');
    }
}
