<?php

namespace App\Http\Controllers;

use App\Models\area;
use App\Models\city;
use App\Models\country;
use App\Models\postal;
use App\Models\state;
use Illuminate\Http\Request;

class Postalcontroller extends Controller
{
    public function save(Request $request){

        $hid =$request->all()['hid'];

        if ($hid != "") {
            $update =$request->all();

            $data = postal::where('id',$hid);

            $data->update([
                "country" => $update['country'],
                "state" => $update['state'],
                "city" => $update['city'],
                "area" => $update['area'],
                "postal" => $update['postal'],
                "status" => $update['status']
            ]);
            if ($data) {
                $response['status'] = 1;
                $response['message'] = "Data updated successfully!";
            } else {
                $response['message'] = "Something's Fishy";
            }
            } else {
                $postal = new postal();

                $postal->country = $request->country;
                $postal->state = $request->state;
                $postal->city = $request->city;
                $postal->area = $request->area;
                $postal->postal = $request->postal;
                $postal->status = $request->status;
                $postal->save();
                if ($postal->save()) {
                    $response['status'] = 1;
                    $response['message'] = "Data added successfully!";
                } else {
                    $response['message'] = "Something's Fishy";
                }
            }
            return response()->json($response);
    }

    public function index(){

        $countries = country::all();

        foreach ($countries as $country) {
            $countryNames[$country->id] = $country->country;
        }

        $states = state::all();

        foreach ($states as $state) {
            $stateNames[$state->id] = $state->state;
        }

        $citys = city::all();

        foreach ($citys as $city){
            $cityNames[$city->id] = $city->city;
        }

        $areas = area::all();

        foreach ($areas as $area){
            $areaNames[$area->id] = $area->area;
        }

        $list = postal::all();
        $aaa = [];
        foreach ($list as $value) {
            
            $row['country'] = isset($countryNames[$value->country]) ? $countryNames[$value->country] : '';
            $row['state'] = isset($stateNames[$value->state]) ? $stateNames[$value->state] : '';
            $row['city'] = isset($cityNames[$value->city]) ? $cityNames[$value->city] : '';
            $row['area'] = isset($areaNames[$value->area]) ? $areaNames[$value->area] : '';
            $row['postal'] = $value->postal;
            $row['status'] = $value->status;
            $row['action'] = "<button class='btn btn-info' id='edit_id' data-id=". $value->id .">Edit</button>
            <button class='btn btn-danger' id='delete_id' data-id=" . $value->id . ">Delete</button>";
            array_push($aaa, $row);

        }
        return response()->json(['data' => $aaa]);
    }

    public function get(Request $request){
        $id = $request->all();
        $data = $id['id'];
    
        $dd = postal::Find($data)->toArray();
        return response()->json($dd);
     }
    
     public function delete(Request $request){
        $hid = $request->all()['id'];
        $del = postal::where("id",$hid)->delete();
     }

     public function storeArea(Request $request){
    
        $countryValue = $request->input('country');
        session(['country' => $countryValue]);
    
        $state = $request->input('state');
        session(['state' => $state]);   
    
        $city = $request->input('city');
        session(['city' => $city]);   
    
        $area = $request->input('area');
        session(['area' => $area]);   

        return response()->json(['message' => 'country,state,city,area stored successfully']);
        }

        public function getPostal(){

            $countries = country::where('status', '!=', 'Inactive')->get();
        
            $states = [];  
        
            $citys = [];

            $areas = [];
        
            return view('postal', ['countries' => $countries, 'states' => $states, 'citys' => $citys, 'areas' => $areas]);
    }
}
