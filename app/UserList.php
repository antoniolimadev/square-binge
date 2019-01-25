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
        return $this->hasMany(ListItem::class)->orderBy('created_at')->get();
    }

    public function lastUpdated(){
        $lastItem = $this->hasMany(ListItem::class)
            ->orderBy('created_at')
            ->get()->first();
        return $lastItem->created_at->diffForHumans();
    }

    public function contains($id, $type_id){
        return $this->hasMany(ListItem::class)
            ->where([
                ['moviedb_id', $id],
                ['item_type_id', $type_id],
            ])->get()->first();
    }
}
