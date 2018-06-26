<?php

namespace App\MovieDB;

use Illuminate\Support\Facades\Storage;
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
        $onTheAirFilePath = 'squarebinge/on-the-air.json';
        // if file doesnt exist, request it
        if (!Storage::exists($onTheAirFilePath)){
            $this->api->requestOnTheAir();
        }
        // read from storage
        $rawJson = \Storage::get($onTheAirFilePath);
        $json = json_decode($rawJson, true);
        $results = $json['results'];
        $onTheAirArray = array();

        foreach ($results as $show)
        {
            // -------------------- request show --------------------
            $showFilePath = 'squarebinge/shows/show-' . $show['id'] . '.json';
            // if file doesnt exist, request it
            if (!Storage::exists($showFilePath)){
                $this->api->requestShow($show['id']);
            }
            // read show from storage
            $showRaw = Storage::get($showFilePath);
            $currentShowInfo = json_decode($showRaw, true);

            //dd($currentShowInfo);
            // -------------------- request season --------------------
            $seasonFilePath = 'squarebinge/shows/show-' . $show['id'] . '-last-season.json';
            // if season file doesnt exist, request it
            if (!Storage::exists($seasonFilePath)){
                $this->getSeason($show['id'], $currentShowInfo['number_of_seasons']);
            }
            // read season from storage
            $seasonRaw = Storage::get($seasonFilePath);
            $currentSeasonInfo = json_decode($seasonRaw, true);

            //dd($currentSeasonInfo);
            $nextEpisodeDate = $this->getNextEpisode($currentSeasonInfo);
            // -------------------- create new TvShow object --------------------
            $newSHow = new TvShow(
                $show['id'],
                $show['name'],
                $show['first_air_date'],
                $show['original_language'],
                $show['vote_average'],
                $show['overview'],
                'https://image.tmdb.org/t/p/w200'. $show['poster_path'],
                $currentShowInfo['number_of_seasons'],
                $currentShowInfo['last_air_date'],
                $nextEpisodeDate //
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
        $rawJson = Storage::get('squarebinge/top-20-shows.json');
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

    public function getNextEpisode($currentSeasonInfo)
    {
        $episodes = $currentSeasonInfo['episodes'];
        foreach ($episodes as $episode){
            $airData = Carbon::parse($episode['air_date']);
            // if episode hasn't aired yet
            if($airData->gt(Carbon::now())){
                return $airData;
            }
        }
        return null;
    }
}
