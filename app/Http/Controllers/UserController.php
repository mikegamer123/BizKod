<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends Controller
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

    public function getUsers($id = 0,Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        if($id == 0){
            $users = User::all();
            return $users;
        }
        else{
            $user = User::where('id', $id)->firstOrFail();
            return $user;
        }
    }

    public function putUsers($id,Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        $user = User::where('id',$id)->first();

        if($request->first_name){
            $user->first_name = $request->first_name;
        }
        if($request->last_name){
            $user->last_name = $request->last_name;
        }
        if($request->nickname){
            $user->nickname = $request->nickname;
        }
        if($request->date_of_birth){
            $user->date_of_birth = $request->date_of_birth;
        }
        if($request->position){
            $user->position = $request->position;
        }
        if($request->description){
            $user->description = $request->description;
        }
        if($request->email){
            $user->email = $request->email;
        }
        if($request->new_employee){
            $user->new_employee = $request->new_employee;
        }
        if($request->phone_number){
            $user->phone_number = $request->phone_number;
        }
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        if($request->gender){
            $user->gender = Hash::make($request->gender);
        }
        if($request->userType){
            $user->userType = $request->userType;
        }
       // return $user;
       // $user->updated_at = now()->toDateTimeString();
        $user->save();
        return "User ".$user->email. " updated successfully";
    }

    public function deleteUsers($id,Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        $user = User::where('id',$id)->first();
        $user->delete();
        return "Deleted user ".$user->email." by id of ".$id;
    }
}
