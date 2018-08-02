<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userLists(){
        return $this->hasMany(UserList::class);
    }

    public function following(){
        $followingList = $this->hasMany(UserList::class)->where('name','Following')->get()->first();
        return UserList::find($followingList->id)->items()->get();
    }

    public function watchlist(){
        $watchlist = $this->hasMany(UserList::class)->where('name','Watchlist')->get()->first();
        return UserList::find($watchlist->id)->items()->get();
    }
}
