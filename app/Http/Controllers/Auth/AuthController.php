<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{ 
    public function showLogin(Request $request){
        // dd($request->guard);
        // $validator= Validator($request->all(),[]);

        $request->merge(['guard' => $request->guard]);  //ارسال البيانات مع الريكوست
        //dd($request->all());

        $validator= Validator($request->all(),[
            'guard' => 'required|string|in:admin,user'
        ]);
        session()->put('guard',$request->input('guard')); // to know the guard 
        if(! $validator->fails()){
        return response()->view('cms.auth.login');
        }else{
        abort(404);
        } 
    }
    public function login(Request $request){

        $validator = Validator($request->all(),[
        'email'=> 'required|email',
        'password'=> 'required|string',
        'remember'=> 'required|boolean'
    ]);

    $guard = session('guard');
        if (! $validator->fails()){
        //     $credentials=[
        //     'email'=>$request->input('email'),
        //     'password'=>$request->input('password')
        // ]; 

        if(Auth::guard($guard)->attempt($request->only(['email','password']),$request->input('remember'))) {
            return response()->json(['message'=>'Logged in successfully'],Response::HTTP_OK);
        }else{
            return response()->json(['message'=>'Credential error, checked and try again!'],Response::HTTP_BAD_REQUEST);
        }
        }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()],
            Response::HTTP_BAD_REQUEST);
        }
        }

        public function logout(Request $request){
            $guard = session('guard');
            Auth::guard('admin')->logout();   // 1- make log out for user
            // auth('admin')->logout();
            // $request->user('admin')->logout();  
            $request->session()->invalidate(); // 2- then delet Session 
            return redirect()->route('cms.login', $guard);
        }
        //
        
        public function editPassword() {
             return response()->view('cms.auth.edit-password');
        } 
        public function updatePassword(Request $request) {

           // dd($request->all()); 
           $guard = session('guard');
           $validator = Validator ($request->all(),[
            'current_password' => 'required|string|current_password:' .$guard,
            'new_password' => 'required|string|confirmed'
           ]);

           if(! $validator->fails()){
            $user =$request->user();
            $user->password = Hash::make($request->input('new_password'));
            $isSave = $user->save(); 
            return response()->json(['message'=>$isSave? 'password change successfully' : 'failef to change password'], 
            $isSave ?  Response::HTTP_OK :  Response::HTTP_BAD_REQUEST);    
           }else{
            return response()->json(['message'=>$validator->getMessageBag()->first()], 
            Response::HTTP_BAD_REQUEST); 
           }
        }
    }
    