<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use Illuminate\Http\Request;

class LocationsController extends Controller
{
    public function declareAdmin(Request $request){

        $token = $request->bearerToken();
        $user = User::where('api_token', $token)->firstOrFail();
        if($user->userType == 'admin'){
            return true;
        }
        else{
            return false;
        }
    }
    public function getLocations($id = 0,Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        if($id == 0){
            $location = Location::all();
            return $location;
        }
        else{
            $location = Location::where('id', $id)->firstOrFail();
            return $location;
        }
    }

    public function putLocations($id,Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }
if($id!=0) {
    $location = Location::where('id', $id)->first();

    if ($request->longitude) {
        $location->longitude = $request->longitude;
    }
    if ($request->latitude) {
        $location->latitude = $request->latitude;
    }

    $location->updated_at = now()->toDateTimeString();
    $location->save();
    return "Location " . $location->id . " updated successfully";
}
else{
    $location = Location::create([
        'longitude' => $request->longitude,
        'latitude' => $request->latitude,
    ]);

    return $location;
}
    }

    public function addLocations(Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        $location = Location::create([
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,
        ]);

        return $location;
    }


    public function deleteLocations($id,Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        $location = Location::where('id',$id)->first();
        $location->delete();
        return "Deleted location by id of ".$id;
    }
}
