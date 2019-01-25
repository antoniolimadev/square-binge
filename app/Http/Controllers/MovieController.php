<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MovieDB\DataScraper;

class MovieController extends Controller
{
    public function index(){
        return view('movies.home');
    }

    public function search(){
        $searchResults = null;
        if (request(['query'])){
            $request = trim(request(['query'])['query']);
            if (!empty($request)) {
                $dataScraper = new DataScraper();
                $searchResults = $dataScraper->getMovieSearch($request);
            }
        }
        return view('movies.search', compact('searchResults'));
    }
}
