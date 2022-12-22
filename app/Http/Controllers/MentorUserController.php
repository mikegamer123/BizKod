<?php

namespace App\Http\Controllers;

use App\Models\Mentor_User;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MentorUserController extends Controller
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
    public function getMentorUser($id = 0){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        if($id == 0){
            $mu = Mentor_User::all();
            $allMu = [];
            $i = 0;
            foreach ($mu as $mentor){
                $allMu[$i]["mentor"] = User::where("id",$mentor->mentor_id)->first();
                $usersTemp = Mentor_User::where("mentor_id",$mentor->mentor_id)->get();
                $allMu[$i]["users"] = [];
                foreach ($usersTemp as $userTemp){
                    array_push($allMu[$i]["users"],User::where("id",$userTemp->employee_id)->first());
                }
            $i++;
            }
            return $allMu;
        }
        else{
            $mu = Mentor_User::where('mentor_id', $id)->get();
            $allMu = [];
            $i = 0;
            foreach ($mu as $mentor){
                $allMu[$i]["mentor"] = User::where("id",$mentor->mentor_id)->first();
                $usersTemp = Mentor_User::where("mentor_id",$mentor->mentor_id)->get();
                $allMu[$i]["users"] = [];
                foreach ($usersTemp as $userTemp){
                    array_push($allMu[$i]["users"],User::where("id",$userTemp->employee_id)->first());
                }
                $i++;
            }
            return $allMu;
        }
    }

    public function putMentorUser($id,Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        $mu = Mentor_User::where('id',$id)->first();

        if($request->mentor_id){
            $mu->mentor_id = $request->mentor_id;
        }
        if($request->user_id){
            $mu->user_id = $request->user_id;
        }

        $mu->updated_at = now()->toDateTimeString();
        $mu->save();
        return "MentorUser with id ".$mu->id. " updated successfully";
    }

    public function addMentorUser(Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        $mu = Mentor_User::create([
            'id' => $request->id,
        ]);

        return $mu;
    }

    public function deleteMentorUser($id,Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        $mu = Mentor_User::where('id',$id)->first();
        $mu->delete();
        return "Mentor with id ".$mu->mentor_id." and user with id".$mu->user_id." are deleted!";
    }
}
