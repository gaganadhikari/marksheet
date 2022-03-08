<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        $email = $request->email;
        $password = $request->password;

        $client = new Client();

        try {
            return $client->post('http://localhost:8000/v1/oauth/token', [
                "form_parms" => [
                    "client_secret" => "IHtyBJGrOh2q8bAXBr2LOSNY2mB8mVIXNppcoOj3",
                    "grant_type" => "password",
                    "client_id" => 2,
                    "username" => $request->email,
                    "password" => $request->password
                ]
            ]);
        }catch(BadResponseException $e){
            return response()->json(['status'=>'error','message'=> $e->getMessage()]);
        }
    }
}
