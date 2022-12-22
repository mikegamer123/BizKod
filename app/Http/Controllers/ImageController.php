<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\User;
use App\Models\POI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function imageUser($id,Request $request){
        if ($request->hasFile('image_upload')) {
            $token = $request->bearerToken();
            $user = User::where('api_token', $token)->firstOrFail();
//        $path = Storage::disk('local')->put($request->file('photo')->getClientOriginalName(),$request->file('photo')->get());
                $path = Storage::disk('local')->put('/public', $request->file("image_upload"));
                $split_path = explode("/",$path);
                $image = Image::create([
                    'path' => "storage/".$split_path[1],
                    'user_id'=>$user->id,
               ]);
                $userImg = User::where('id',$id)->first();
                $userImg->image_id = $image->id;
                $userImg->save();
                return $image;
        }
        return "no file";
    }

    public function imagePOI($id,Request $request){
        if ($request->hasFile('image_upload')) {
            $token = $request->bearerToken();
            $user = User::where('api_token', $token)->firstOrFail();
//        $path = Storage::disk('local')->put($request->file('photo')->getClientOriginalName(),$request->file('photo')->get());
            $path = Storage::disk('local')->put('/public', $request->file("image_upload"));
            $split_path = explode("/",$path);
            $image = Image::create([
                'path' => "storage/".$split_path[1],
                'user_id'=>$user->id,
            ]);
            $poiImg = POI::where('id',$id)->first();
            $poiImg->image_id = $image->id;
            $poiImg->save();
            return $image;
        }
        return "no file";
    }
    public function getImage($id,Request $request){
        $image = Image::where('id', $id)->firstOrFail();
        return $image;
    }
}
