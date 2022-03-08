<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function store(Request $request){
        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
            return response()->json(['status'=>'success', 'message'=>'USER_CREATED']);
        }catch (\Exception $e){
            return Response()->json(['status'=>'error','message'=>$e->getMessage()]);
        }
    }
}
