<?php

namespace App\MovieDB;


class ApiRequest
{
    protected $key = '';

    public function __construct($apiKey)
    {
        $this->key = (string)$apiKey;
    }

    //This query looks for any TV show that has an episode with an air date in the next 7 days.
    public function requestOnTheAir()
    {
        $requestString = 'http://api.themoviedb.org/3/tv/on_the_air?page=1&language=en-US&api_key=' .
            $this->key;
        $requestResponse = $this->curlRequest($requestString);

        \Storage::put('squarebinge/on-the-air.json', json_decode(json_encode($requestResponse)));
    }

    public function requestAiringToday()
    {
        $requestString = 'http://api.themoviedb.org/3/tv/airing_today?page=1&language=en-US&api_key=' .
            $this->key;
        $requestResponse = $this->curlRequest($requestString);

        \Storage::put('squarebinge/airing-today.json', json_decode(json_encode($requestResponse)));
    }

    //
    public function requestTopRatedShows()
    {
        $requestString = 'http://api.themoviedb.org/3/tv/top_rated?page=1&language=en-US&api_key=' .
            $this->key;
        $requestResponse = $this->curlRequest($requestString);

        \Storage::put('squarebinge/top-rated-shows.json', json_decode(json_encode($requestResponse)));
    }

    public function requestPopularShows()
    {
        $requestString = 'http://api.themoviedb.org/3/tv/popular?page=1&language=en-US&api_key=' .
            $this->key;
        $requestResponse = $this->curlRequest($requestString);

        \Storage::put('squarebinge/popular-shows.json', json_decode(json_encode($requestResponse)));
    }

    public function requestSeason($showId, $seasonNumber)
    {
        $requestString = 'http://api.themoviedb.org/3/tv/' .
            $showId .
            '/season/' . $seasonNumber .
            '?language=en-US&api_key=' . $this->key;
        $requestResponse = $this->curlRequest($requestString);

        $seasonFilePath = 'squarebinge/shows/show-' . $showId . '-last-season.json';
        \Storage::put($seasonFilePath, json_decode(json_encode($requestResponse)));
    }

    public function requestShow($showId)
    {
        $requestString = 'http://api.themoviedb.org/3/tv/' .
            $showId .
            '?language=en-US&api_key=' . $this->key;
        $requestResponse = $this->curlRequest($requestString);
        //return json_decode($requestResponse); // ALWAYS RETURN DECODE
        $filePath = 'squarebinge/shows/show-' . $showId . '.json';
        \Storage::put($filePath, json_decode(json_encode($requestResponse)));
    }

    public function requestTVSearch($query){
        $encondedQuery = urlencode($query);
        $requestString = 'http://api.themoviedb.org/3/search/tv?query=' .
        $encondedQuery .
        '&api_key=' . $this->key .
        '&language=en-US&page=1';
        $requestResponse = $this->curlRequest($requestString);
        return json_decode(json_encode($requestResponse));
    }

    public function curlRequest($requestString)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $requestString,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "{}",
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}
