<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function showLogin(){
        return response()->view('cms.auth.login');  
    }
    public function login(Request $request){

$validator = Validator($request->all(),[
    'email'=> 'required|email|exists:admins,email',
    'password'=> 'required|string',
    'remember'=> 'required|boolean'
]);
    if (! $validator->fails()){

    }else{
        return response()->json(['message'=>$validator->getMessageBag()->first()],
        Response::HTTP_BAD_REQUEST);
    }
    }
    //
}
