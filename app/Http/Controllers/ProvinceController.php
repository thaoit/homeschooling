<?php

namespace App\Http\Controllers;

use App\Services\ProvinceService;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    //
    public function getAllByCountry(Request $request){

        $input = $request->input();
        $provinces = array();

        if( isset($input['country']) ){
            $provinces = ProvinceService::getAllByCountry( $input['country'] );
        }

        return [
            'provinces' => $provinces
        ];
    }
}
