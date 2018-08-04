<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\MovieDB\DataScraper;

class ApiController extends Controller
{
    // -------------------- API --------------------

    public function tv_headerLinks(){
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

    public function tv_onTheAir(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getOnTheAir(5);
        return response()->json($this->buildJsonResponse($showsDataArray), 201);
    }

    public function tv_airingToday(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getAiringToday(5);
        return response()->json($this->buildJsonResponse($showsDataArray), 201);
    }

    public function tv_popular(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getPopularShows(5);
        return response()->json($this->buildJsonResponse($showsDataArray), 201);
    }

    public function tv_topRated(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getTopRatedShows(5);
        return response()->json($this->buildJsonResponse($showsDataArray), 201);
    }

    public function movie_headerLinks(){
        $headerLinks = array();
        array_push($headerLinks, ['link' => 'now-playing', 'string' => 'Now Playing']);
        array_push($headerLinks, ['link' => 'upcoming', 'string' => 'Upcoming']);
        array_push($headerLinks, ['link' => 'popular', 'string' => 'Popular']);
        array_push($headerLinks, ['link' => 'top-rated', 'string' => 'Top Rated']);
        $response = array();
        $response['links'] = $headerLinks;
        $response['search'] = ['link' => '/movies/search', 'string' => 'Search Movies...'];
        return response()->json($response, 201);
    }

    public function movie_nowPlaying(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getNowPlaying(5);
        return response()->json($this->buildMovieJsonResponse($showsDataArray), 201);
    }

    public function movie_upcoming(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getUpcoming(5);
        return response()->json($this->buildMovieJsonResponse($showsDataArray), 201);
    }

    public function movie_popular(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getPopularMovies(5);
        return response()->json($this->buildMovieJsonResponse($showsDataArray), 201);
    }

    public function movie_topRated(){
        $dataScraper = new DataScraper();
        $showsDataArray = $dataScraper->getTopRatedMovies(5);
        return response()->json($this->buildMovieJsonResponse($showsDataArray), 201);
    }

    public function buildJsonResponse($showsDataArray){
        $response = array();
        foreach ($showsDataArray as $show){
            //array_push($headerLinks, ['link' => 'on-the-air', 'string' => 'On The Air']);
            $jsonShow = [
                'id' => $show->id,
                'type' => 'tv',
                'date' => $show->readableAirDate,
                'cover' => $show->posterPath,
                'title' => $show->name,
                'year' => Carbon::parse($show->firstAirDate)->year,
                'overview' => str_limit($show->overview,260)
            ];
            array_push($response, $jsonShow);
        }
        return $response;
    }

    public function buildMovieJsonResponse($moviesDataArray){
        $response = array();
        foreach ($moviesDataArray as $movie){
            //array_push($headerLinks, ['link' => 'on-the-air', 'string' => 'On The Air']);
            $jsonShow = [
                'id' => $movie->id,
                'type' => 'movie',
                'date' => Carbon::parse($movie->releaseDate)->year,
                'cover' => $movie->posterPath,
                'title' => $movie->name,
                'year' => Carbon::parse($movie->releaseDate)->year,
                'overview' => str_limit($movie->overview,260)
            ];
            array_push($response, $jsonShow);
        }
        return $response;
    }
}
