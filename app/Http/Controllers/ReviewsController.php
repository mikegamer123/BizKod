<?php

namespace App\Http\Controllers;

use App\Models\POI;
use App\Models\Review;
use App\Models\User;

use Illuminate\Http\Request;

class ReviewsController extends Controller
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
    public function getReviewsByUser($id){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        if($id == 0){
            $review = Review::all();
            return $review;
        }
        else{
            $event = Review::where('user_id', $id)->get();
            $allEvents = [];
            $i = 0;
            foreach ($event as $even){
                $allEvents[$i]["poi"] = POI::where("id",$even->poi_id)->first();
                $allEvents[$i]["review"] =$even;
                $i++;
            }
            return $allEvents;
        }
    }

    public function getReviews($id = 0){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }

        if($id == 0){
            $review = Review::all();
            return $review;
        }
        else{
            $review = Review::where('id', $id)->firstOrFail();
            return $review;
        }
    }


    public function putReviews($id,Request $request){
//        if(!$this->declareAdmin($request)){
//            return "Unathorized";
//        }
        if ($id!=0) {
            $review = Review::where('id', $id)->first();

            if ($request->rating) {
                $review->rating = $request->rating;
            }
            if ($request->comment) {
                $review->comment = $request->comment;
            }
            if ($request->user_id) {
                $review->user_id = $request->user_id;
            }
            if ($request->poi_id) {
                $review->poi_id = $request->poi_id;
            }

            $review->updated_at = now()->toDateTimeString();
            $review->save();
            return "Review " . $review->id . " updated successfully";
        }
        else{
            $review = Review::create([
                'rating' => $request->rating,
                'comment' => $request->comment,
                'user_id' => $request->user_id,
                'poi_id' => $request->poi_id,
            ]);

            return $review;
        }
    }

    public function addReviews(Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        $review = Review::create([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'user_id' => $request->user_id,
            'poi_id' => $request->poi_id,
        ]);

        return $review;
    }

    public function deleteReviews($id,Request $request){
        if(!$this->declareAdmin($request)){
            return "Unathorized";
        }

        $review = Reviews::where('id',$id)->first();
        $review->delete();
        return "Deleted Review by id of ".$id;
    }
}
