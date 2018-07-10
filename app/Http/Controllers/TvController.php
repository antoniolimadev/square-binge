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
        $searchResults = null;
        if (request(['query'])){
            $request = trim(request(['query'])['query']);
            if (!empty($request)) {
                $dataScraper = new DataScraper();
                $searchResults = $dataScraper->getTvSearch($request);
            }
        }
        return view('tv.search', compact('searchResults'));
    }
}
