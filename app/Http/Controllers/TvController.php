<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\MovieDB\DataScraper;

class TvController extends Controller
{
    protected $api;
    protected $dataScraper;

    public function index(){
        return redirect('tv/on-the-air');
    }

    public function onTheAir()
    {
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getOnTheAir(5);
        //dd($showsDataArray);
        $headerLink = 'On The Air';
        return view('tv.on-the-air', compact('showsDataArray', 'headerLink'));
    }

    public function airingToday(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getAiringToday(5);
        //dd($showsDataArray);
        $headerLink = 'Airing Today';
        return view('tv.on-the-air', compact('showsDataArray', 'headerLink'));
    }

    public function popular(){
    $dataScraper = new DataScraper();
    $showsDataArray = $dataScraper->getPopularShows(5);
    //dd($showsDataArray);
    $headerLink = 'Popular';
    return view('tv.on-the-air', compact('showsDataArray', 'headerLink'));
}

    public function topRated(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getTopRatedShows(5);
        //dd($showsDataArray);
        $headerLink = 'Top Rated';
        return view('tv.on-the-air', compact('showsDataArray', 'headerLink'));
    }

    public function test(){
        return view('tv.home');
    }

    // -------------------- API --------------------

    public function headerLinks(){
        $headerLinks = array();
        array_push($headerLinks, ['link' => 'on-the-air', 'string' => 'On The Air']);
        array_push($headerLinks, ['link' => 'airing-today', 'string' => 'Airing Today']);
        array_push($headerLinks, ['link' => 'popular', 'string' => 'Popular']);
        array_push($headerLinks, ['link' => 'top-rated', 'string' => 'Top Rated']);
        //array_push($headerLinks, ['link' => '/tv/search', 'string' => 'Search TV...']);

        $response = array();
        $response['links'] = $headerLinks;
        $response['search'] = ['link' => '/tv/search', 'string' => 'Search TV...'];
        return response()->json($response, 201);
    }

    public function onTheAirJson(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getOnTheAir(5);
        $headerLink = 'On The Air';
        $response = array();
        foreach ($showsDataArray as $show){
            array_push($response, $show);
        }
        return response()->json($response, 201);
    }

    public function airingTodayJson(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getAiringToday(5);
        $headerLink = 'Airing Today';
        $response = array();
        foreach ($showsDataArray as $show){
            array_push($response, $show);
        }
        return response()->json($response, 201);
    }

    public function popularJson(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getPopularShows(5);
        $headerLink = 'Top Rated';
        $response = array();
        foreach ($showsDataArray as $show){
            array_push($response, $show);
        }
        return response()->json($response, 201);
    }

    public function topRatedJson(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getTopRatedShows(5);
        $headerLink = 'Top Rated';
        $response = array();
        foreach ($showsDataArray as $show){
            array_push($response, $show);
        }
        return response()->json($response, 201);
    }
}
