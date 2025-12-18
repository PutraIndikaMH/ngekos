<?php

namespace app\Interfaces;

interface CityRepositoryInterface{
    public function getAllCities();
     public function getCityBySlug($slug);
}