<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $api;
    protected $imgUrlPrefix;

    public function __construct()
    {
        // $this->middleware('auth', ['only' => ['getSomeAuthStuff', 'postSomeAuthStuff']]);
        $this->middleware('auth', ['only' => ['home']]);
        $this->api = resolve('App\MovieDB\ApiRequest');

        $this->imgUrlPrefix = 'https://image.tmdb.org/t/p/w200';
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        dd($this->api->curlRequest());
        return view('welcome');
    }

    public function home()
    {
        return view('home');
    }

}
