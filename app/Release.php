<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Release extends Model
{
    protected $fillable = ['moviedb_id', 'item_type_id', 'release_date'];
}
