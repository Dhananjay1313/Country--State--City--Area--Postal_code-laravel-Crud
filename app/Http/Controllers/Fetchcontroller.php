<?php

namespace App\Http\Controllers;

use App\Models\area;
use App\Models\city;
use App\Models\state;
use Illuminate\Http\Request;

class Fetchcontroller extends Controller
{
    public function fetchStates(Request $request) {
        
        $countryId = $request->input('countryId');
        $states = state::where('country', $countryId)->get(['id', 'state']);
        
        return response()->json(['states' => $states]);
    }

    public function fetchCity(Request $request) {

        $stateId = $request->input('stateId');
        $citys = city::where('state',$stateId)->get(['id', 'city']);
        
        return response()->json(['citys'=> $citys]);
    }

    public function fetchArea(Request $request) {

        $cityId = $request->input('cityId');

        $areas = area::where('city',$cityId)->get(['id', 'area']);
        
        return response()->json(['areas'=> $areas]);
    }
}
