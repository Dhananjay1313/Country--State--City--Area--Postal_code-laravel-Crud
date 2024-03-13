<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\country;
use App\Models\state;
use Illuminate\Http\Request;

class Citycontroller extends Controller
{
    public function save(Request $request){

        $hid =$request->all()['hid'];
    
        if ($hid != "") {
            $update =$request->all();
    
            $data = city::where('id',$hid);
    
            $data->update([
                "country" => $update['country'],
                "state" => $update['state'],
                "city" => $update['city'],
                "status" => $update['status']
            ]);
            if ($data) {
                $response['status'] = 1;
                $response['message'] = "Data Updated successfully!";
            } else {
                $response['message'] = "Something's Fishy";
            }
            } else {
                $city = new city();
    
                $city->country = $request->country;
                $city->state = $request->state;
                $city->city = $request->city;
                $city->status = $request->status;
                $city->save();
                if ($city->save()) {
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
            
        $list = city::all();
        $aaa = [];
        foreach ($list as $value) {
            // if ($value->status == '0') {
            $row['country'] = isset($countryNames[$value->country]) ? $countryNames[$value->country] : '';
            $row['state'] = isset($stateNames[$value->state]) ? $stateNames[$value->state] : '';
            $row['city'] = $value->city;
            $row['status'] = $value->status;
            $row['action'] = "<button class='btn btn-info' id='edit' data-id=". $value->id .">Edit</button>
            <button class='btn btn-dark' id='delete' data-id=" . $value->id . ">Delete</button>";
            array_push($aaa, $row);
        // }
        }
        return response()->json(['data' => $aaa]);
     }
    
     public function get(Request $request){
    
        $edit_id = $request->all();
        $data = $edit_id['id'];
    
        $bb = city::Find($data)->toArray();
        return response()->json($bb);
     }
    
     public function delete(Request $request){
    
        $hid = $request->all()['id'];
        $del = city::where("id",$hid)->delete();
     }

     public function storeState(Request $request){
    
        $countryValue = $request->input('country');
        session(['country' => $countryValue]);
    
        $state = $request->input('state');
        session(['state' => $state]);   
        return response()->json(['message' => 'country,state stored successfully']);
        }
    
        public function getCity(){
    
        $countries = country::all();
        
        // $countries = country::where('status', '!=', -1)->get();
        $countries = country::where('status', '!=', 'Inactive')->get();
    
        $states = [];  
        return view('city', ['countries' => $countries, 'states' => $states]);
        }
}
