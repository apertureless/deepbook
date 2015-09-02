<?php

namespace Deepbook\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['username', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function getUsername()
    {
        return $this->username;
    }

    public function getAvatarUrl()
    {
        return "http://www.gravatar.com/avatar/" . md5($this->email) . "?d=mm&s=40";
    }

    public function friendsOfMine()
    {
        return $this->belongsToMany(
                '\Deepbook\Models\User',
                'friends',
                'user_id',
                'friend_id'
        );
    }

    public function friendOf()
    {
        return $this->belongsToMany(
            '\Deepbook\Models\User',
            'friends',
            'friend_id',
            'user_id'
        );
    }

    public function friends()
    {
        return $this->friendsOfMine()
                    ->wherePivot('accepted', true)
                    ->get()
                    ->merge(
                        $this->friendOf()
                        ->wherePivot('accepted', true)
                        ->get()
                    );
    }
}
