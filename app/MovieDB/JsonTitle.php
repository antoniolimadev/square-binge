<?php


namespace App\MovieDB;


class JsonTitle
{
    public $id;
    public $name;
    public $poster;
    public $banner;
    public $releaseDate; // carbon date
    public $readableReleaseDate;

    /**
     * JsonTitle constructor.
     * @param $id
     * @param $name
     * @param $poster
     * @param $banner
     * @param $releaseDate
     * @param $readableReleaseDate
     */
    public function __construct($id, $name, $poster, $banner, $releaseDate, $readableReleaseDate)
    {
        $this->id = $id;
        $this->name = $name;
        $this->poster = $poster;
        $this->banner = $banner;
        $this->releaseDate = $releaseDate;
        $this->readableReleaseDate = $readableReleaseDate;
    } // formatted date '5 July'


}
