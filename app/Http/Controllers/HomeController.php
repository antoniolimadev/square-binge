<?php

namespace App\Http\Controllers;

use App\MovieDB\DataScraper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $api;
    protected $dataScraper;

    public function __construct()
    {
        // $this->middleware('auth', ['only' => ['getSomeAuthStuff', 'postSomeAuthStuff']]);
        $this->middleware('auth', ['only' => ['home']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $dataScraper = new DataScraper();
        $showArray = $dataScraper->getOnTheAir(4);
        $movieArray = $dataScraper->getNowPlaying(4);
        //dd($showArray);
        return view('welcome', compact('showArray', 'movieArray'));
    }

    public function home()
    {
        $user_id = Auth::id();

        return view('dashboard', compact('user_id'));
    }

    public function profile($user_id)
    {
        return view('dashboard', compact('user_id'));
    }

}
