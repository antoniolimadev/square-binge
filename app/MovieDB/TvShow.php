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
    public $nextEpisodeDate; // carbon date
    public $readableAirDate; // formatted date '5 July'

    public function __construct($id, $name, $firstAirDate, $originalLanguage, $voteAverage, $overview,
                                $posterPath, $numberOfSeasons, $lastAirDate, $nextEpisodeDate, $readableAirDate)
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
        $this->nextEpisodeDate = $nextEpisodeDate;
        $this->readableAirDate = $readableAirDate;
    }
}
