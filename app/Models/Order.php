<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function carts()
    {
        return $this->hasMany(Cart::class,'order_id','id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function getCreatedAtInPersian()
    {
        return verta($this->created_at)->format('Y/m/d');
    }

}
