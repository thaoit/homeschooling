<?php
namespace App\Services;

use App\Models\Province;
use App\Models\Country;

class ProvinceService{

    public static function getAllByCountry($country_name){

        $country_id = Country::where('name', $country_name)->pluck('id')->first();
        $provinces = Province::where('country_id', $country_id)->get();

        return $provinces;
    }
}
