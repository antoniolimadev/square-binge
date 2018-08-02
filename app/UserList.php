<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    protected $fillable = ['name', 'private', 'user_id', 'description', 'removable'];

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function items(){
        return $this->hasMany(ListItem::class);
    }
}
