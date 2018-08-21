<?php

namespace App\Http\Controllers;

use App\ItemType;
use App\ListItem;
use App\MovieDB\DataScraper;
use Illuminate\Http\Request;
use App\UserList;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserListsController extends Controller
{
    /**
     * UserListsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['store']]);
    }

    // shows public lists
    public function index(){

        $followingList = null; //User::find(auth()->id())->following();
        return view('lists.index', compact('followingList'));
    }

    // adds an item (show, movie, etc) to a list
    public function store(){
        $id = request('id');
        $type = request('type');
        User::find(Auth::guard('web')->id())->follow($id, $type);
        return response()->json('Followed', 201);
    }

    //user/{user}/lists
    public function lists($user_id){
        // get all lists from user with $id
        $userLists = User::find($user_id)->userLists();

        foreach ($userLists as $list){
            $listItems = $this->getListItems($list->id);
            $listThumbnails = $this->createThumbnailArray($listItems);
            $list->setAttribute('thumbnails', $listThumbnails);
            $list->setAttribute('total', $listItems->count());
        }
        //dd($userLists);
        return view('lists.lists', compact('user_id', 'userLists'));
    }

    //user/{user}/lists/list_id
    public function list($user_id, $user_list_id){
        $listItems = $this->getListItems($user_list_id);
        return view('lists.list', compact('user_id','listItems'));
    }

    public function getListItems($listId){
        return UserList::find($listId)
            ->items();
    }

    public function createThumbnailArray($listItems, $howMany = 5){
        $dataScrapper = new DataScraper();
        $thumbnails = collect();
        $tvTypeId = ItemType::where('keyword', 'tv')->get()->first()->id;
        $movieTypeId = ItemType::where('keyword', 'movie')->get()->first()->id;

        $lastFiveListItems = $listItems->take(-$howMany);
        foreach ($lastFiveListItems as $item){
            $currentTitle = null;
            switch ($item->item_type_id) {
                case $tvTypeId:
                    $currentTitle = $dataScrapper->getShow($item->moviedb_id);
                    break;
                case $movieTypeId:
                    $currentTitle = $dataScrapper->getMovie($item->moviedb_id);
                    break;
            }
            $posterUrl = 'https://image.tmdb.org/t/p/w200'. $currentTitle['poster_path'];
            $thumbnails->prepend($posterUrl);
        }
        if ($thumbnails->count() < $howMany){
            for ($i = $thumbnails->count(); $i < $howMany; $i++){
                $posterUrl = null;
                $thumbnails->push($posterUrl);
            }
        }
        return $thumbnails;
    }
}
