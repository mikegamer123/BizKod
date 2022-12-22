<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\User;
use App\Models\Event;
use Illuminate\Http\Request;

class EventsController extends Controller
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

    public function getEvents($id = 0){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        if($id == 0){
            $event = Event::all();
            $allEvents = [];
            $i = 0;
            foreach ($event as $even){
                $allEvents[$i]["host"] = User::where("id",$even->host_id)->first();
                $allEvents[$i]["location"] = Location::where("id",$even->location_id)->first();
                $allEvents[$i]["event"] =$even;
                $i++;
            }
            return $allEvents;
        }
        else{
            $event = Event::where('id', $id)->firstOrFail();
            $allEvents = [];
            $i = 0;
            foreach ($event as $even){
                $allEvents[$i]["host"] = User::where("id",$even->host_id)->first();
                $allEvents[$i]["location"] = Location::where("id",$even->location_id)->first();
                $allEvents[$i]["event"] =$even;
                $i++;
            }
            return $allEvents;
        }
    }

    public function putEvents($id,Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }
        if($id!=0) {
            $event = Event::where('id', $id)->first();

            if ($request->title) {
                $event->title = $request->title;
            }
            if ($request->description) {
                $event->description = $request->description;
            }
            if ($request->location_id) {
                $event->location_id = $request->location_id;
            }
            if ($request->start) {
                $event->start = $request->start;
            }
            if ($request->finish) {
                $event->finish = $request->finish;
            }
            if ($request->host_id) {
                $event->host_id = $request->host_id;
            }

            $event->updated_at = now()->toDateTimeString();
            $event->save();
            return "Event " . $event->title . " updated successfully";
        }
        else{
            $event = Event::create([
                'title' => $request->title,
                'description' => $request->description,
                'location_id' => $request->location_id,
                'start' => $request->start,
                'finish' => $request->finish,
                'host_id' => $request->host_id,
            ]);

            return $event;
        }
    }

    public function deleteEvents($id,Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        $event = Event::where('id',$id)->first();
        $event->delete();
        return "Deleted event ".$event->title." by id of ".$id;
    }

    public function addEvents(Request $request){

//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        $event = Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'location_id' => $request->location_id,
            'start' => $request->start,
            'finish' => $request->finish,
            'host_id' => $request->host_id,
        ]);

        return $event;
    }
}
