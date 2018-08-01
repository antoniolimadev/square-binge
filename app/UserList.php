<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserList extends Model
{
    protected $fillable = ['name', 'private', 'user_id', 'description', 'removable'];
}
