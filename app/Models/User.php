<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory,HasApiTokens;

    protected $fillable = 
    [
        'first_name',

        'last_name',

        'email',

        'username',

        'password',
        
        'password_confirmation',

        'followings_id',

        'followers_id'
    ];

    public function tweet()
    {
        return $this->hasMany(Tweet::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function sender()
    {
        return $this->hasMany(Sender::class);
    }

    public function receiver()
    {
        return $this->hasMany(Receiver::class);
    }

    public function commentComment()
    {
        return $this->hasMany(commentComment::class);
    }
}
