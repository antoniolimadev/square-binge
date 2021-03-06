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

    public function rollApiKey(){
        do{
            $this->api_token = str_random(60);
        }while($this->where('api_token', $this->api_token)->exists());
        $this->save();
    }

    public function userLists(){
        return $this->hasMany(UserList::class)->get();
    }

    public function following(){
        return $this->hasMany(UserList::class)->where('name','Following')->get()->first();
        //return UserList::find($followingList->id)->items()->get();
    }

    // follow or unfollow a title
    public function follow($id, $type){
        // user's following list id
        $followListId = $this->hasMany(UserList::class)
            ->where('name','Following')
            ->get()->first()->id;

        // item type id
        $typeId = ItemType::where('keyword', $type)->get()->first()->id;

        //find if user already follows the title
        $item = ListItem::where([
            ['user_list_id', $followListId],
            ['moviedb_id', $id],
            ['item_type_id', $typeId],
        ])->get()->first();

        if (!$item){
            // store the item if it doesn't exist
            ListItem::firstOrCreate([
                'user_list_id' => $followListId,
                'moviedb_id' => $id,
                'item_type_id' => $typeId
            ]);
        } else{
            ListItem::destroy($item->id);
        }
    }

    public function watchlist(){
        $watchlist = $this->hasMany(UserList::class)->where('name','Watchlist')->get()->first();
        return UserList::find($watchlist->id)->items()->get();
    }
}
