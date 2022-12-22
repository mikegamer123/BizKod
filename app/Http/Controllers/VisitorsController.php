<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Visitor;
use App\Models\User;
use Illuminate\Http\Request;

class VisitorsController extends Controller
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
    public function getVisitor($id = 0,Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        if($id == 0){
            $visitors = Visitor::all();
            $allVisitors = [];
            $i = 0;
            foreach ($visitors as $visitor){
                $allVisitors[$i]["event"] = Event::where("id",$visitor->event_id)->first();
                $usersTemp = Visitor::where("event_id",$visitor->event_id)->get();
                $allVisitors[$i]["visitors"] = [];
                foreach ($usersTemp as $userTemp){
                    array_push($allMu[$i]["visitors"],User::where("id",$userTemp->user_id)->first());
                }
                $i++;
            }
            return $allVisitors;

        }
        else{
            $visitors = Visitor::where('event_id', $id)->get();
            $allVisitors = [];
            $i = 0;
            foreach ($visitors as $visitor){
                $allVisitors[$i]["event"] = Event::where("id",$visitor->event_id)->first();
                $usersTemp = Visitor::where("event_id",$visitor->event_id)->get();
                $allVisitors[$i]["visitors"] = [];
                foreach ($usersTemp as $userTemp){
                    array_push($allVisitors[$i]["visitors"],User::where("id",$userTemp->user_id)->first());
                }
                $i++;
            }
            return $allVisitors;
        }
    }

    public function putVisitor($id,Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }
        if($id!=0) {

            $visitors = Visitor::where('id', $id)->first();

            if ($request->event_id) {
                $visitors->event_id = $request->event_id;
            }
            if ($request->user_id) {
                $visitors->user_id = $request->user_id;
            }

            $visitors->updated_at = now()->toDateTimeString();
            $visitors->save();
            return "New visitor with id " . $visitors->user_id . " is checked on event with id " . $visitors->event_id;
        }
        else{
            $visitor = Visitor::create([
                'event_id' => $request->event_id,
                'user_id' => $request->user_id,
            ]);
            return $visitor;
        }
    }

    public function addVisitor(Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }
        $visitor = Visitor::create([
            'id' => $request->id,
        ]);
        return $visitor;
    }

    public function deleteVisitor($id,Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        $visitor = Visitor::where('id',$id)->first();
        $visitor->delete();
        return "User with id ".$visitor->user_id." doesn't coming on the event with id ".$visitor->event_id;
    }
}
