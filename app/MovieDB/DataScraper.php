<?php

namespace App\MovieDB;

use App\ItemType;
use App\Release;
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

    // receives a ListItem array and returns an array of poster images
    public function getPosterArray($itemList){

    }

    public function getResultsAsShowArray($results, $howMany = 10){
        $onTheAirCollection = collect();

        foreach ($results as $show) {
            $currentShowInfo = $this->getShow($show['id']);
            //type 1 = tv
            $nextEpisodeDate = $this->getReleaseDate($show['id'], 1, $currentShowInfo);
            // -------------------- create new TvShow object --------------------
            $newSHow = new TvShow(
                $show['id'],
                $show['name'],
                Carbon::parse($show['first_air_date'])->toDateString(),
                $show['original_language'],
                $show['vote_average'],
                $show['overview'],
                'https://image.tmdb.org/t/p/w200'. $show['poster_path'],
                'https://image.tmdb.org/t/p/w300'. $show['backdrop_path'],
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
        $rawJson = Storage::get($onTheAirFilePath);
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
        $rawJson = Storage::get($airingTodayFilePath);
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
        $rawJson = Storage::get($topRatedFilePath);
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
        $rawJson = Storage::get($popularShowsFilePath);
        $json = json_decode($rawJson, true);
        $results = $json['results'];

        return $this->getResultsAsShowArray($results, $howMany);
    }

    public function getSeason($showId, $seasonNumber){
        return $this->api->requestSeason($showId, $seasonNumber); // TODO: uncomment this when in production
    }

    // status: ['Returning Series', 'Planned', 'In Production', 'Ended', 'Canceled', 'Pilot']
    public function getShow($showId){
        $showFilePath = 'squarebinge/shows/show-' . $showId . '.json';
        // if file doesnt exist, request it
        if (!Storage::exists($showFilePath)){
            $this->api->requestShow($showId);
        }
        // read show from storage
        $showRaw = Storage::get($showFilePath);
        $showInfo = json_decode($showRaw, true);
        return $showInfo;
    }

    public function getNextEpisode($currentSeasonInfo)
    {
        if (!array_key_exists('episodes', $currentSeasonInfo)){ return null; }
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

    public function getReleaseDate($id, $type, $itemInfo = null){
        $tvTypeId = ItemType::where('keyword', 'tv')->get()->first()->id;
        $movieTypeId = ItemType::where('keyword', 'movie')->get()->first()->id;
        $title = null;
        $releaseDate = Release::where([
            ['moviedb_id', $id],
            ['item_type_id', $type],
        ])->get()->first();
        if ($releaseDate){
            return $releaseDate->release_date;
        }
        switch ($type) {
            case $tvTypeId:
                if (!$itemInfo){
                    $itemInfo = $this->getShow($id);
                }
                $seasonFilePath = 'squarebinge/shows/show-' . $id . '-last-season.json';
                // if season file doesnt exist, request it
                if (!Storage::exists($seasonFilePath)){
                    $this->getSeason($id, $itemInfo['number_of_seasons']);
                }
                // read season from storage
                $seasonRaw = Storage::get($seasonFilePath);
                $currentSeasonInfo = json_decode($seasonRaw, true);

                $nextEpisodeDate = $this->getNextEpisode($currentSeasonInfo);
                Release::create([
                   'moviedb_id' => $id,
                   'item_type_id' => $type,
                   'release_date' => $nextEpisodeDate
                ]);
                return $nextEpisodeDate;
                break;
            case $movieTypeId:
                $title = $this->getMovie($id);
                break;
        }
    }

    public function getSingleTitleInfo($id, $type){
        $tvTypeId = ItemType::where('keyword', 'tv')->get()->first()->id;
        $movieTypeId = ItemType::where('keyword', 'movie')->get()->first()->id;

        switch ($type) {
            case $tvTypeId:
                // get title info
                $titleInfo = $this->getShow($id);
                // get title release date from db
                $releaseDate = null;
                $release = Release::where([
                    ['moviedb_id', $id],
                    ['item_type_id', $type],
                ])->get()->first();
                // if release exists and is up to date
                if ($release && Carbon::parse($release->release_date)->gte(Carbon::now())){
                        $releaseDate = $release->release_date;
                } else {
                    $seasonFilePath = 'squarebinge/shows/show-' . $id . '-last-season.json';
                    // if season file doesnt exist, request it
                    if (!Storage::exists($seasonFilePath)) {
                        $this->getSeason($id, $titleInfo['number_of_seasons']);
                    }
                    // read season from storage
                    $seasonRaw = Storage::get($seasonFilePath);
                    $currentSeasonInfo = json_decode($seasonRaw, true);
                    $releaseDate = $this->getNextEpisode($currentSeasonInfo);
                    // if release already existed, update it with the new date
                    // otherwise, create a new one
                    if ($release){
                        $release->release_date = $releaseDate;
                        $release->save();
                    } else {
                        Release::create([
                            'moviedb_id' => $id,
                            'item_type_id' => $type,
                            'release_date' => $releaseDate
                        ]);
                    }
                }
                $jsonTitle = new JsonTitle(
                    $titleInfo['id'],
                    $titleInfo['name'],
                    'https://image.tmdb.org/t/p/w200'. $titleInfo['poster_path'],
                    'https://image.tmdb.org/t/p/w300'. $titleInfo['backdrop_path'],
                    $releaseDate,
                    $this->getReadableDate($releaseDate)
                );
                return $jsonTitle;
                break;
            case $movieTypeId:
                $title = $this->getMovie($id);
                break;
        }
    }

    public function getTvSearch($query){
        $results =  json_decode($this->api->requestTvSearch($query), true);
        $resultsArray = $results['results'];
        if ($results['total_results'] > 5){
            return $this->getResultsAsShowArray($resultsArray, 10);
        }
        return $this->getResultsAsShowArray($resultsArray, sizeof($resultsArray));
    }

    public function getReadableDate($date){
        if (!$date){ return 'NA'; }
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

    // --------------------------- MOVIES ---------------------------

    public function getNowPlaying($howMany = 10)
    {
        $nowPlayingFilePath = 'squarebinge/now-playing.json';
        // if file doesnt exist, request it
        if (!Storage::exists($nowPlayingFilePath)){
            $this->api->requestNowPlaying();
        }
        // read from storage
        $rawJson = Storage::get($nowPlayingFilePath);
        $json = json_decode($rawJson, true);
        $results = $json['results'];

        return $this->getResultsAsMovieArray($results, $howMany);
    }

    public function getUpcoming($howMany = 10)
    {
        $upcomingFilePath = 'squarebinge/upcoming.json';
        // if file doesnt exist, request it
        if (!Storage::exists($upcomingFilePath)){
            $this->api->requestUpcoming();
        }
        // read from storage
        $rawJson = Storage::get($upcomingFilePath);
        $json = json_decode($rawJson, true);
        $results = $json['results'];

        return $this->getResultsAsMovieArray($results, $howMany);
    }

    public function getTopRatedMovies($howMany = 10){
        $topRatedFilePath = 'squarebinge/top-rated-movies.json';
        // if file doesnt exist, request it
        if (!Storage::exists($topRatedFilePath)){
            $this->api->requestTopRatedMovies();
        }
        // read from storage
        $rawJson = Storage::get($topRatedFilePath);
        $json = json_decode($rawJson, true);
        $results = $json['results'];

        return $this->getResultsAsMovieArray($results, $howMany);
    }

    public function getPopularMovies($howMany = 10){
        $popularMoviesFilePath = 'squarebinge/popular-movies.json';
        // if file doesnt exist, request it
        if (!Storage::exists($popularMoviesFilePath)){
            $this->api->requestPopularMovies();
        }
        // read from storage
        $rawJson = Storage::get($popularMoviesFilePath);
        $json = json_decode($rawJson, true);
        $results = $json['results'];

        return $this->getResultsAsMovieArray($results, $howMany);
    }

    public function getMovie($movieId){
        $movieFilePath = 'squarebinge/movies/movie-' . $movieId . '.json';
        // if file doesnt exist, request it
        if (!Storage::exists($movieFilePath)){
            $this->api->requestShow($movieId);
        }
        // read show from storage
        $movieRaw = Storage::get($movieFilePath);
        $movieInfo = json_decode($movieRaw, true);
        return $movieInfo;
    }

    public function getMovieSearch($query){
        $results =  json_decode($this->api->requestMovieSearch($query), true);
        $resultsArray = $results['results'];
        if ($results['total_results'] > 5){
            return $this->getResultsAsMovieArray($resultsArray, 10);
        }
        return $this->getResultsAsMovieArray($resultsArray, sizeof($resultsArray));
    }

    public function getResultsAsMovieArray($results, $howMany = 10){
        $movieCollection = collect();

        foreach ($results as $movie) {
            // -------------------- request show --------------------
            $movieFilePath = 'squarebinge/movies/movie-' . $movie['id'] . '.json';
            // if file does not exist, request it
            if (!Storage::exists($movieFilePath)){
                $this->api->requestMovie($movie['id']);
            }
            // read show from storage
            $movieRaw = Storage::get($movieFilePath);
            $currentMovie = json_decode($movieRaw, true);

            // -------------------- create new TvShow object --------------------
            $newMovie = new Movie(
                $currentMovie['id'],
                $currentMovie['title'],
                $currentMovie['original_language'],
                $currentMovie['vote_average'],
                $currentMovie['overview'],
                'https://image.tmdb.org/t/p/w200'. $currentMovie['poster_path'],
                'https://image.tmdb.org/t/p/w300'. $currentMovie['backdrop_path'],
                $currentMovie['release_date'],
                $this->getReadableDate($currentMovie['release_date'])
            );

            $movieCollection->prepend($newMovie);
            if ($movieCollection->count() == $howMany){
                $movieCollection = collect($movieCollection)
                    ->sortByDesc('$releaseDate')
                    ->reverse()
                    ->toArray();
                return $movieCollection;
            }
        }
        return $movieCollection;
    }
}
