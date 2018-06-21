<?php


namespace App\MovieDB;


class TvShow
{
    public $id;
    public $name;
    public $firstAirDate;
    public $originalLanguage;
    public $voteAverage;
    public $overview;
    public $posterPath;
    public $numberOfSeasons;
    public $lastAirDate;

    public function __construct($id, $name, $firstAirDate, $originalLanguage, $voteAverage,
                                $overview, $posterPath, $numberOfSeasons, $lastAirDate)
    {
        $this->id = $id;
        $this->name = (string) $name;
        $this->firstAirDate = $firstAirDate;
        $this->originalLanguage = $originalLanguage;
        $this->voteAverage = $voteAverage;
        $this->overview = (string) $overview;
        $this->posterPath = $posterPath;
        $this->numberOfSeasons = $numberOfSeasons;
        $this->lastAirDate = $lastAirDate;
    }
}
