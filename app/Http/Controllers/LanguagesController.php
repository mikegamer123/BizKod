<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Illuminate\Http\Request;

class LanguagesController extends Controller
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
    public function getLanguage($id = 0,Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        if($id == 0){
            $lang = Language::all();
            return $lang;
        }
        else{
            $lang = Language::where('id', $id)->firstOrFail();
            return $lang;
        }
    }

    public function putLanguage($id,Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        $lang = Language::where('id',$id)->first();

        if($request->language_id){
            $lang->language_id = $request->language_id;
        }

        $lang->updated_at = now()->toDateTimeString();
        $lang->save();
        return "Language with id ".$lang->id. " is now updated successfully";
    }

    public function addLanguage(Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }
        $lang = Language::create([
            'id' => $request->id,
        ]);
        return $lang;
    }

    public function deleteLanguage($id,Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        $lang = Language::where('id',$id)->first();
        $lang->delete();
        return "Language with id ".$lang->language_id." does not exist anymore";
    }
}
