<?php

namespace App\MovieDB;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Collection;
use App\MovieDB\TvShow;
use Carbon\Carbon;


class DataScraper
{
    protected $api;

    public function __construct() {
        $this->api = resolve('App\MovieDB\ApiRequest');
        //$this->imgUrlPrefix = 'https://image.tmdb.org/t/p/w200';
    }

    public function getResultsAsShowArray($results, $howMany){
        $onTheAirCollection = collect();

        foreach ($results as $show) {
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
                Carbon::parse($show['first_air_date'])->toDateString(),
                $show['original_language'],
                $show['vote_average'],
                $show['overview'],
                'https://image.tmdb.org/t/p/w200'. $show['poster_path'],
                $currentShowInfo['number_of_seasons'],
                Carbon::parse($currentShowInfo['last_air_date'])->toDateString(),
                $nextEpisodeDate,
                $this->getReadableDate($nextEpisodeDate)
            );

            $onTheAirCollection->prepend($newSHow);
            if ($onTheAirCollection->count() == $howMany){
                $onTheAirCollection = collect($onTheAirCollection)
                    ->sortByDesc('nextEpisodeDate')
                    ->reverse()
                    ->toArray();
                return $onTheAirCollection;
            }
        }
        return $onTheAirCollection;
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

        return $this->getResultsAsShowArray($results, $howMany);
    }

    public function getAiringToday($howMany = 10){
        $airingTodayFilePath = 'squarebinge/airing-today.json';
        // if file doesnt exist, request it
        if (!Storage::exists($airingTodayFilePath)){
            $this->api->requestAiringToday();
        }
        // read from storage
        $rawJson = \Storage::get($airingTodayFilePath);
        $json = json_decode($rawJson, true);
        $results = $json['results'];

        return $this->getResultsAsShowArray($results, $howMany);
    }

    public function getTopRatedShows($howMany = 10){
        $topRatedFilePath = 'squarebinge/top-rated-shows.json';
        // if file doesnt exist, request it
        if (!Storage::exists($topRatedFilePath)){
            $this->api->requestTopRatedShows();
        }
        // read from storage
        $rawJson = \Storage::get($topRatedFilePath);
        $json = json_decode($rawJson, true);
        $results = $json['results'];

        return $this->getResultsAsShowArray($results, $howMany);
    }

    public function getPopularShows($howMany = 10){
        $popularShowsFilePath = 'squarebinge/popular-shows.json';
        // if file doesnt exist, request it
        if (!Storage::exists($popularShowsFilePath)){
            $this->api->requestPopularShows();
        }
        // read from storage
        $rawJson = \Storage::get($popularShowsFilePath);
        $json = json_decode($rawJson, true);
        $results = $json['results'];

        return $this->getResultsAsShowArray($results, $howMany);
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
        $today = Carbon::now()->toDateString();
        $episodes = $currentSeasonInfo['episodes'];
        foreach ($episodes as $episode){
            $airData = Carbon::parse($episode['air_date']);
            // if episode hasn't aired yet
            if($airData->gte($today)){
                return $airData;
            }
        }
        return null;
    }

    public function getTvSearch($query){
        return $this->api->requestTvSearch($query);
    }

    public function getReadableDate($date){
        if (!$date){ return 'TBA'; }
        $today = Carbon::now();
        $carbonDate = Carbon::parse($date);
        if ($carbonDate->day == $today->day &&
            $carbonDate->month == $today->month){
            return 'Today';
        }
        $monthNum = $carbonDate->month;
        $dateObj   = \DateTime::createFromFormat('!m', $monthNum);
        $monthName = $dateObj->format('F');
        return $carbonDate->day . ' ' . $monthName;
    }
}
