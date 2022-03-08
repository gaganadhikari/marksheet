<?php

namespace App\Http\Controllers;

use App\Models\User;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;

        if(empty($email) or empty($password)){
            return response()->json(['status'=>'error', 'message'=>'you must fill all field']);
        }
        $client = new Client();

        try {
            return $client->request('POST','http://localhost:8001/v1/oauth/token', [
                'form_params' => [
                    "client_secret" => 'IHtyBJGrOh2q8bAXBr2LOSNY2mB8mVIXNppcoOj3',
                    "grant_type" => "password",
                    "client_id" => '2',
                    "username" => $request->email,
                    "password" => $request->password
                    ]
            ]);
        }catch(BadResponseException $e){
            return response()->json(['status'=>'error','message'=> $e->getMessage()]);
        }
    }
    public function register(Request $request){
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;

        if (empty($email) or empty($name) or empty($password)){
            return response()->json(['status'=>'error', 'message'=>'you must fill all field']);
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            return response()->json(['status'=>'error', 'message'=>'you must enter a valid email']);
        }
        if (strlen($password) < 6){
            return response()->json(['status'=>'error', 'message'=>'password must be greater than 6 digit']);
        }
        $user_check = User::where('email','=',$email)->first();
        if ($user_check){
            return response()->json(['status'=>'error', 'message'=>'User already exist']);
        }
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if ($user->save()) {
                return $this->login($request);
            }
            return response()->json(['status'=>'success', 'message'=>'USER_CREATED']);
        }catch (\Exception $e){
            return Response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }

    public function logout(Request $request){
        try{
            auth()->user()->tokens()->each(function ($token){
                $token->delete();
            });
            return response()->json(['status'=>'success', 'message'=>'logged out successfully']);
        } catch (\Exception $e){
            return Response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
}
