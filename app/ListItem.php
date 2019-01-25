<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    protected $fillable = ['user_list_id', 'moviedb_id', 'item_type_id'];
}
