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
    }

    public function index(){

        $followingList = User::find(auth()->id())->following();
        return view('lists.index', compact('followingList'));
    }

    public function store(){
        $test = request('title');
        return response()->json('Received: ' . $test, 201);
    }
}
