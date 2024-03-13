<?php

namespace App\Http\Controllers;

use App\Models\area;
use App\Models\city;
use App\Models\country;
use App\Models\state;
use Illuminate\Http\Request;

class Areacontroller extends Controller
{
    public function save(Request $request){

        $hid =$request->all()['hid'];
    
        if ($hid != "") {
            $update =$request->all();
    
            $data = area::where('id',$hid);
    
            $data->update([
                "country" => $update['country'],
                "state" => $update['state'],
                "city" => $update['city'],
                "area" => $update['area'],
                "status" => $update['status']
            ]);
            if ($data) {
                $response['status'] = 1;
                $response['message'] = "Data updated successfully!";
            } else {
                $response['message'] = "Something's Fishy";
            }
            } else {
                $area = new area();
    
                $area->country = $request->country;
                $area->state = $request->state;
                $area->city = $request->city;
                $area->area = $request->area;
                $area->status = $request->status;
                $area->save();
                if ($area->save()) {
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
    
        $list = area::all();
        $aaa = [];
        foreach ($list as $value) {
            // if ($value->status == '0') {
            $row['country'] = isset($countryNames[$value->country]) ? $countryNames[$value->country] : '';
            $row['state'] = isset($stateNames[$value->state]) ? $stateNames[$value->state] : '';
            $row['city'] = isset($cityNames[$value->city]) ? $cityNames[$value->city] : '';
            $row['area'] = $value->area;
            $row['status'] = $value->status;
            $row['action'] = "<button class='btn btn-primary' id='edit' data-id=". $value->id .">Edit</button>
            <button class='btn btn-danger' id='delete' data-id=" . $value->id . ">Delete</button>";
            array_push($aaa, $row);
            // }
        }
        return response()->json(['data' => $aaa]);
     }
    
     public function get(Request $request){
        $id = $request->all();
        $data = $id['id'];
    
        $cc = area::Find($data)->toArray();
        return response()->json($cc);
     }
    
     public function delete(Request $request){
        $hid = $request->all()['id'];
        $del = area::where("id",$hid)->delete();
     }

     public function storeCity(Request $request){
    
        $countryValue = $request->input('country');
        session(['country' => $countryValue]);
    
        $state = $request->input('state');
        session(['state' => $state]);   
    
        $city = $request->input('city');
        session(['city' => $city]);   
    
        return response()->json(['message' => 'country,state,city stored successfully']);
        }
    
        public function getArea(){
    
        // $countries = country::all();
        // $countries = country::where('status', '!=', -1)->get();
        $countries = country::where('status', '!=', 'Inactive')->get();
    
        $states = [];  
    
        $citys = [];
    
        return view('area', ['countries' => $countries, 'states' => $states, 'citys' => $citys]);
        }
}
