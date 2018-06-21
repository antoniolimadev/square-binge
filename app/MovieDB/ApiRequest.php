<?php

namespace App\MovieDB;


class ApiRequest
{
    protected $key = '';

    public function __construct($apiKey)
    {
        $this->key = (string)$apiKey;
    }

    public function curlRequest(){

        $requestString = 'http://api.themoviedb.org/3/tv/popular?page=1&language=en-US&api_key=' .
                            $this->key;
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
            return json_decode($response);
        }
    }
}
