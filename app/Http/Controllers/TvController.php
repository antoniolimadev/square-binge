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
        return view('tv.home');
    }

    public function search(){
        $dataScraper = new DataScraper();
        $request = request(['query'])['query'];
        $searchResults = $dataScraper->getTvSearch($request);
        dd($searchResults);
        return view('tv.search');
    }
}
