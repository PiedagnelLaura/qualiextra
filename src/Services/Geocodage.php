<?php

namespace App\Services;

class Geocodage 
{
    //private $apiKey = '01534106af904849972628c720331642';
    public $adress;

    // public function __construct()
    // {
    //     $this->apiKey = $apiKey;
    // }

    public function geocoding ($adress){
        $geocoder = new \OpenCage\Geocoder\Geocoder('01534106af904849972628c720331642');
        $result = $geocoder->geocode($adress);
         return $result['results'][0]['geometry'];
    }

}