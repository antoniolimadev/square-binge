<?php

namespace App\Http\Controllers;

use App\MovieDB\DataScraper;
use Illuminate\Http\Request;

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
        $dataArray = $dataScraper->getOnTheAir(5);
        //dd($dataArray);
        return view('welcome', compact('dataArray'));
    }

    public function home()
    {
        return view('home');
    }



    public function movies()
    {
        return view('movies');
    }
}
