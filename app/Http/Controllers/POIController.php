<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Location;
use App\Models\POI;
use App\Models\User;
use Illuminate\Http\Request;

class POIController extends Controller
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

    public function getPOI($id = 0){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        if($id == 0){
            $event = POI::all();
            $allEvents = [];
            $i = 0;
            foreach ($event as $even){
                $allEvents[$i]["category"] = Category::where("id",$even->category_id)->first();
                $allEvents[$i]["location"] = Location::where("id",$even->location_id)->first();
                $allEvents[$i]["POI"] =$even;
                $i++;
            }
            return $allEvents;
        }
        else{
            $event = POI::where('id', $id)->firstOrFail();
            $allEvents = [];
            $i = 0;
            foreach ($event as $even){
                $allEvents[$i]["category"] = Category::where("id",$even->category_id)->first();
                $allEvents[$i]["location"] = Location::where("id",$even->location_id)->first();
                $allEvents[$i]["POI"] =$even;
                $i++;
            }
            return $allEvents;
        }
    }

    public function putPOI($id,Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        $poi = POI::where('id',$id)->first();

        if($request->name){
            $poi->name = $request->name;
        }
        if($request->description){
            $poi->description = $request->description;
        }
        if($request->location_id){
            $poi->location_id = $request->location_id;
        }
        if($request->work_time){
            $poi->work_time = $request->work_time;
        }
        if($request->site_link){
            $poi->site_link = $request->site_link;
        }
        if($request->category_id){
            $poi->category_id = $request->category_id;
        }

        $poi->updated_at = now()->toDateTimeString();
        $poi->save();
        return "POI ".$poi->name. " updated successfully";
    }

    public function deletePOI($id,Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        $poi = POI::where('id',$id)->first();
        $poi->delete();
        return "Deleted POI ".$poi->name." by id of ".$id;
    }

    public function addPOI(Request $request){

        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        $poi = POI::create([
            'name' => $request->name,
            'description' => $request->description,
            'location_id' => $request->location_id,
            'work_time' => $request->work_time,
            'site_link' => $request->site_link,
            'category_id' => $request->host_id,
        ]);

        return $poi;
    }
}
