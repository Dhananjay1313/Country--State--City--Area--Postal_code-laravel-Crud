<?php

namespace App\Http\Controllers;

use App\Models\area;
use App\Models\city;
use App\Models\country;
use App\Models\postal;
use App\Models\state;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;

class Countrycontroller extends Controller
{
    public function save(Request $request){

        $hid =$request->all()['hid'];
        
        if ($hid != "") {
        $update =$request->all();

        $data = country::where('id',$hid);

        $data->update([
            "country" => $update['country'],
            "status" => $update['status']
        ]);
        if ($data) {
            $response['status'] = 1;
            $response['message'] = "Data Updateded successfully!";
        } else {
            $response['message'] = "Something's Fishy";
        }
        }else{


        $country = new country();
        $country->country = $request->country;
        $country->status = $request->status;
        $country->save();
        if ($country->save()) {
            $response['status'] = 1;
            $response['message'] = "Data added successfully!";
        } else {
            $response['message'] = "Something's Fishy";
        }
    }
    return response()->json($response);
    }

    public function index(){

        $list = country::all();
        $aaa = [];
        foreach ($list as $value) {
            if ($value->status != '-1') {
            $row['country'] = $value->country ;
            $row['status'] = $value->status;
            $row['action'] = "<button class='btn btn-info' id='edit_id' data-id=". $value->id .">Edit</button>
            <button class='btn btn-secondary' id='delete_id' data-id=" . $value->id . ">Delete</button>";
            array_push($aaa, $row);
        }
        }
        return response()->json(['data' => $aaa]);
    }

    public function get(Request $request){

        $datacountry = $request->all();
        $id = $datacountry['id'];
        
        $edit_id = country::find($id)->toArray();
        return response()->json($edit_id);
    }

    public function delete(Request $request){

    // $hid = $request->all()['id'];
    // $del = country::where("id",$hid)->delete();

    $hid = $request->input('id');

    $state = country::find($hid);

    if ($state) {
        $state->status = -1;
        $state->save();

        return response()->json(['message' => 'Soft delete successful']);
    } else {
        return response()->json(['message' => 'State not found'], 404);
    }
    }
}
