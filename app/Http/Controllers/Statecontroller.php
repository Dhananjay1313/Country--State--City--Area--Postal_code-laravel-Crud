<?php

namespace App\Http\Controllers;

use App\Models\country;
use App\Models\state;
use Illuminate\Http\Request;

class Statecontroller extends Controller
{
    public function save(Request $request){

        $hid =$request->all()['hid'];
        if ($hid != "") {
            $update =$request->all();
    
            $data = state::where('id',$hid);
    
            $data->update([
                "country" => $update['country'],
                "state" => $update['state'],
                "status" => $update['status']
            ]);

            if ($data) {
                $response['status'] = 1;
                $response['message'] = "Data Updateded successfully!";
            } else {
                $response['message'] = "Something's Fishy";
            }

            }else{
                $state = new state();

                $state->country = $request->country;

                $state->state = $request->state;
                $state->status = $request->status;
                $state->save();
                if ($state->save()) {
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

        $list = state::all();
        $aaa = [];

        foreach ($list as $value) {
            // if ($value->status == '0') {
            $row['country'] = isset($countryNames[$value->country]) ? $countryNames[$value->country] : '';
            $row['state'] = $value->state;
            $row['status'] = $value->status;
            $row['action'] = "<button class='btn btn-primary' id='edit_id' data-id=". $value->id .">Edit</button>
            <button class='btn btn-danger' id='delete_id' data-id=" . $value->id . ">Delete</button>";
            array_push($aaa, $row);
        // }
        }
        return response()->json(['data' => $aaa]);
    }

 public function get(Request $request){

    $edit = $request->all();
    $data = $edit['id'];

    $aa = state::Find($data)->toArray();
    return  response()->json($aa);
 }

 public function delete(Request $request){

    $hid = $request->all()['id'];
    $del = state::where("id",$hid)->delete();
 }

 public function storeCountry(Request $request){

    $countryValue = $request->input('country');
    session(['country' => $countryValue]);
    return response()->json(['message' => 'Country stored successfully']);
    }

    public function getState(){

        $countries = country::where('status', '!=', 'Inactive')->get();
        return view('state', ['countries' => $countries]);

    }
    
}
