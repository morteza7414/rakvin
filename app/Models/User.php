<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slut',
        'mobile',
        'phone',
        'role',
        'building',
        'address',
        'city',
        'postalcode',
        'email',
        'username',
        'thumbnail',
        'email_verified_at',
        'password',
        'identifier_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function architects()
    {
        if (auth()->user()->role == "admin"){
            $architects = User::where('role','architect')->get();
            return $architects;
        }else{
            return null;
        }
    }
    public function customers()
    {
            $customers = User::where('role','user')->where('identifier_id',$this->id)->get();
            return $customers;
    }

    public function identifier_id()
    {
        return $this->identifier_id;
    }
    public function architect()
    {
        if (auth()->user()->role == "user"){
            return User::where('role','architect')
                ->where('id',auth()->user()->identifier_id())->first();
        }else{
            return null;
        }
    }

    public function identifier($id)
    {
//        $user = User::findOrFail($id);
        return User::where('role','architect')
            ->where('id',$this->identifier_id())->first();
    }

    public function images()
    {
        return Images::where('user_id',$this->id)->get();
    }

    public function albums()
    {
        return $this->hasMany(Album::class,'architect_id','id');
    }

    public function customerAccessibleAlbums()
    {
        return $this->belongsToMany(Album::class, 'users_albums_accessable', 'user_id', 'album_id');
    }

    public function customerAccessibleimagesCount()
    {

        $albums = $this->customerAccessibleAlbums()->get();
        $imagesCount = 0;

        foreach ($albums as $album){
            $imagesCount += count($album->images);
        }
        return $imagesCount;
    }

    public function isAccessToAlbum($id)
    {
        foreach ($this->customerAccessibleAlbums as $album){
            if ($album->id == $id){
                return true;
            }
        }
        return  false;
    }

    public function carts()
    {
        return $this->hasMany(Cart::class,'user_id','id')->where('status',1);
    }
    public function orders()
    {
        return $this->hasMany(Order::class,'user_id','id');
    }

    public function uploads()
    {
        return $this->hasMany(UserUpload::class,'user_id','id');
    }

    public function getCreatedAtInPersian()
    {
        return verta($this->created_at)->format('Y/m/d');
    }


}
