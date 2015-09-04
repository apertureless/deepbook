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

    public function friendRequests()
    {
        return $this->friendsOfMine()
                    ->wherePivot('accepted', false)
                    ->get();
    }

    public function friendRequestPending()
    {
        return $this->friendOf()->wherePivot('accepted', false)->get();
    }

    public function hasFriendRequestPending(User $user)
    {
        return (bool) $this->friendRequestPending()->where('id', $user->id)->count();
    }

    public function hasReceivedFriendRequest(User $user)
    {
        return (bool) $this->friendRequests()->where('id', $user->id)->count();
    }

    public function addFriend(User $user)
    {
        $this->friendOf()->attach($user->id);
    }

    public function acceptFriend(User $user)
    {
        $this->friendRequests()
            ->where('id', $user->id)
            ->first()
            ->pivot
            ->update([
                'accepted' => true,
            ]);
    }

    public function isFriendsWith(User $user)
    {
        return (bool) $this->friends()->where('id', $user->id)->count();
    }
}
