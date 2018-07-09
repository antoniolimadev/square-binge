<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\MovieDB\DataScraper;

class TvController extends Controller
{
    protected $api;
    protected $dataScraper;

    public function index(){
        return view('tv.home');
    }
}
