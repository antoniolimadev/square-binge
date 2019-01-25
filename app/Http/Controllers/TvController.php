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
}
