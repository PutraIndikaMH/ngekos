<?php

namespace App\Http\Controllers;
use App\Interfaces\CityRepositoryInterface;
use App\Interfaces\BoardingHouseRepositoryInterface;

use Illuminate\Http\Request;

class CityController extends Controller
{
    private BoardingHouseRepositoryInterface $boardingHouseRepository;
    private CityRepositoryInterface $cityRepository;

     public function __construct(

         CityRepositoryInterface $cityRepository,
         BoardingHouseRepositoryInterface $boardingHouseRepository

     )
     {
        $this->cityRepository = $cityRepository;
        $this->boardingHouseRepository  = $boardingHouseRepository;
     }

      public function show($slug){
        $city = $this->cityRepository->getCityBySlug($slug);
        $boardingHouses = $this->boardingHouseRepository->getBoardingHouseByCitySlug($slug);

        return view('pages.city.show', compact('city','boardingHouses'));
     }
}
