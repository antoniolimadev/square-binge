<?php


namespace App\MovieDB;
use App\MovieDB\TvShow;
use Carbon\Carbon;

class DataScraper
{
    protected $api;

    public function __construct() {
        $this->api = resolve('App\MovieDB\ApiRequest');
        //$this->imgUrlPrefix = 'https://image.tmdb.org/t/p/w200';
    }

    public function getOnTheAir($howMany = 10)
    {
        //$this->api->requestOnTheAir(); // TODO: uncomment this when in production
        $rawJson = \Storage::get('squarebinge/on_the_air.json');
        $json = json_decode($rawJson, true);
        $results = $json['results'];
        $onTheAirArray = array();

        foreach ($results as $show)
        {
            $currentShowInfo = $this->api->requestShow($show['id']);
            $newSHow = new TvShow(
                $show['id'],
                $show['name'],
                $show['first_air_date'],
                $show['original_language'],
                $show['vote_average'],
                $show['overview'],
                'https://image.tmdb.org/t/p/w200'. $show['poster_path'],
                $currentShowInfo->number_of_seasons,
                $currentShowInfo->last_air_date
            );
            array_push($onTheAirArray, $newSHow);
            if (sizeof($onTheAirArray) == $howMany){
                return $onTheAirArray;
            }
        }
        return $onTheAirArray;
    }

    public function getTop20Shows(){

        //$this->api->requestTop20Shows(); // TODO: uncomment this when in production
        $rawJson = \Storage::get('squarebinge/top-20-shows.json');
        $json = json_decode($rawJson, true);
        $top20 = $json['results'];

        $top20Array = array();

        foreach ($top20 as $show)
        {
            $currentShowInfo = $this->api->requestShow($show['id']);
            $newSHow = new TvShow(
                $show['id'],
                $show['name'],
                $show['first_air_date'],
                $show['original_language'],
                $show['vote_average'],
                $show['overview'],
                $show['poster_path'],
                $currentShowInfo->number_of_seasons,
                $currentShowInfo->last_air_date
            );
            array_push($top20Array, $newSHow);
        }
        return $top20Array;
    }

    public function getSeason($showId, $seasonNumber){
        return $this->api->requestSeason($showId, $seasonNumber); // TODO: uncomment this when in production
    }

    // status: ['Returning Series', 'Planned', 'In Production', 'Ended', 'Canceled', 'Pilot']
    public function getShow($showId){
        return $this->api->requestShow($showId); // TODO: uncomment this when in production
    }
}
