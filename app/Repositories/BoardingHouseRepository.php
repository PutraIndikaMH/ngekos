<?php


namespace App\Repositories;

use app\Interfaces\BoardingHouseRepositoryInterface;
use App\Models\BoardingHouse;
use App\Models\Room;
use Illuminate\Database\Eloquent\Builder;

class BoardingHouseRepository implements BoardingHouseRepositoryInterface{

    public function getAllBoardingHouses($search = null, $city = null, $category = null)
    {
        $query= BoardingHouse::query();

        /*if($search){
            $query->where('city', 'like', '%' .$search .'%');
        }*/
        if ($search) {
           $query->where(function ($q) use ($search) {
           $q->where('name', 'like', '%' . $search . '%')
          ->orWhereHas('city', function ($q2) use ($search) {
              $q2->where('name', 'like', '%' . $search . '%');
              })
          ->orWhereHas('category', function ($q3) use ($search) {
              $q3->where('name', 'like', '%' . $search . '%');
               });
           });
        }

        if($city){
            $query->whereHas('city', function(Builder $query) use($city){
              $query->where('slug', $city);
            });
        }

        if($category){
            $query->whereHas('category', function(Builder $query) use($category){
              $query->where('slug', $category);
            });
        }

        return $query->get();

    }

    public function getPopularBoardingHouses($limit = 5)
    {
        return BoardingHouse::withCount('transactions')->orderBy('transactions_count', 'desc')->take($limit)->get();
    }

    public function getBoardingHouseByCitySlug($slug)
    {
         return BoardingHouse::whereHas('city', function(Builder $query) use ($slug){
            $query->where('slug', $slug);
         })->get();
    }

    /*public function getBoardingHouseByCategorySlug($slug)
    {
        return BoardingHouse::whereHas('city', function(Builder $query)use ($slug){
            $query->where('slug', $slug);
        })->get();
    }*/
    public function getBoardingHouseByCategorySlug($slug)
        {
           return BoardingHouse::with('city') // biar city->name bisa dipanggil di blade
            ->whereHas('category', function (Builder $query) use ($slug) {
             $query->where('slug', $slug);
        })
        ->get();
        }

    public function getBoardingHouseBySlug($slug)
    {
        return BoardingHouse::where('slug',$slug)->firstOrFail();
    }

    public function getBoardingHouseRoomById($id)
    {
        return Room::find($id);
    }
}
