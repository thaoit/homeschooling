<?php
namespace App\Services;

use App\Models\Country;

class CountryService{

    public static function getAll(){

        return Country::orderBy('name', 'asc')->get();
    }
}
