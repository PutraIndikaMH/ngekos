<?php


namespace App\Repositories;

use app\Interfaces\CityRepositoryInterface;
use App\Models\City;


class CityRepository implements CityRepositoryInterface{

    public function getAllCities()
    {
        return City::all();
    }

     public function getCityBySlug($slug)
    {
        return City::where('slug', $slug)->firstOrFail();
    }
}