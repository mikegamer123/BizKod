<?php

namespace App\Http\Controllers;


use App\Models\Language_User;
use Illuminate\Http\Request;

class LanguageUsersController extends Controller
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
    public function getLanguageUser($id = 0,Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        if($id == 0){
            $lu = Language_User::all();
            return $lu;
        }
        else{
            $lu = Language_User::where('id', $id)->firstOrFail();
            return $lu;
        }
    }

    public function putLanguageUser($id,Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        $lu = Language_User::where('id',$id)->first();

        if($request->language_id){
            $lu->language_id = $request->language_id;
        }
        if($request->user_id){
            $lu->user_id = $request->user_id;
        }

        $lu->updated_at = now()->toDateTimeString();
        $lu->save();
        return "LanguageUser with id ".$lu->id. " updated successfully";
    }

    public function addLanguageUser(Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }
        $lu = Language_User::create([
            'id' => $request->id,
        ]);
        return $lu;
    }

    public function deleteLanguageUser($id,Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        $lu = Language_User::where('id',$id)->first();
        $lu->delete();
        return "User with id ".$lu->user_id." don't speak language with id ".$lu->language_id;
    }
}
