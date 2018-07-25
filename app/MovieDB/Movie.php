<?php

namespace App\MovieDB;


class Movie
{
    public $id;
    public $name;
    public $originalLanguage;
    public $voteAverage;
    public $overview;
    public $posterPath;
    public $bannerPath;
    public $releaseDate;
    public $readableAirDate; // formatted date '5 July'

    public function __construct($id, $name, $originalLanguage, $voteAverage, $overview, $posterPath, $bannerPath, $releaseDate, $readableAirDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->originalLanguage = $originalLanguage;
        $this->voteAverage = $voteAverage;
        $this->overview = $overview;
        $this->posterPath = $posterPath;
        $this->bannerPath = $bannerPath;
        $this->releaseDate = $releaseDate;
        $this->readableAirDate = $readableAirDate;
    }
}
