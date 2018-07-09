<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\MovieDB\DataScraper;

class ApiController extends Controller
{
    // -------------------- API --------------------

    public function headerLinks(){
        $headerLinks = array();
        array_push($headerLinks, ['link' => 'on-the-air', 'string' => 'On The Air']);
        array_push($headerLinks, ['link' => 'airing-today', 'string' => 'Airing Today']);
        array_push($headerLinks, ['link' => 'popular', 'string' => 'Popular']);
        array_push($headerLinks, ['link' => 'top-rated', 'string' => 'Top Rated']);
        $response = array();
        $response['links'] = $headerLinks;
        $response['search'] = ['link' => '/tv/search', 'string' => 'Search TV...'];
        return response()->json($response, 201);
    }

    public function onTheAir(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getOnTheAir(5);
        return response()->json($this->buildJsonResponse($showsDataArray), 201);
    }

    public function airingToday(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getAiringToday(5);
        return response()->json($this->buildJsonResponse($showsDataArray), 201);
    }

    public function popular(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getPopularShows(5);
        return response()->json($this->buildJsonResponse($showsDataArray), 201);
    }

    public function topRated(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getTopRatedShows(5);
        return response()->json($this->buildJsonResponse($showsDataArray), 201);
    }

    public function buildJsonResponse($showsDataArray){
        $response = array();
        foreach ($showsDataArray as $show){
            //array_push($headerLinks, ['link' => 'on-the-air', 'string' => 'On The Air']);
            $jsonShow = [
                'id' => $show->id,
                'nextAirDate' => $show->readableAirDate,
                'cover' => $show->posterPath,
                'title' => $show->name,
                'year' => Carbon::parse($show->firstAirDate)->year,
                'overview' => str_limit($show->overview,260)
            ];
            array_push($response, $jsonShow);
        }
        return $response;
    }
}
