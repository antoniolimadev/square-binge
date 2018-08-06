<?php

namespace App\Http\Controllers;

use App\ListItem;
use Illuminate\Http\Request;
use App\UserList;
use App\User;

class UserListsController extends Controller
{
    /**
     * UserListsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['store']]);
    }

    public function index(){

        $followingList = null; //User::find(auth()->id())->following();
        return view('lists.index', compact('followingList'));
    }

    public function store(){
        $id = request('id');
        $type = request('type');
        User::find(auth()->id())->follow($id, $type);
        return response()->json('Followed', 201);
    }
}
