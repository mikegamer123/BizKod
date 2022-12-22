<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use App\Models\UserLog;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function register(Request $request)
    {

        global $email; global $nameTo; global $passwordOg;
        $nameTo =  $request->first_name." ".$request->last_name;
        $email= $request->email;
        $passwordOg = $request->password;

        $user = User::create([
            'first_name' => $request->first_name,
            'nickname' => ($request->nickname)?$request->nickname:"",
            'phone_number' => ($request->phone_number)?$request->phone_number:"",
            'position' => $request->position,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'new_employee'=>($request->new_employee)?true:false,
            'gender'=>$request->gender,
        ]);
        //send registration email
        Mail::to($email)->queue(new \App\Mail\RegistrationMail($nameTo,$passwordOg));

        $token = $user->createToken('auth_token')->plainTextToken;

        DB::table('users')
            ->where('id', $user->id)
            ->update(['api_token' => $token]);

        return response()
            ->json(['data' => $user,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    public function login(Request $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            return response()
                ->json(['message' => 'Unauthorized'], 401);
        }

        $user = User::where('email', $request['email'])
            ->firstOrFail();

        $token = $user->createToken('auth_token')->plainTextToken;

        DB::table('users')
            ->where('id', $user->id)
            ->update(['api_token' => $token]);

        return response()
            ->json(['id' => $user->id,'access_token' => $token, 'token_type' => 'Bearer', ]);
    }

    // method for user logout and delete token
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'You have successfully logged out and the token was successfully deleted'
        ];
    }

}
