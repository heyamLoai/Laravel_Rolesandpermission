<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\EventListener\ResponseListener;

class EmailVerificationController extends Controller
{
    //

    public  function notice(Request $request)
    {
        return response()->view('cms.auth.email-verify-notice');
    }
// to send email 
    public function send(Request $request){
        $request->user()->sendEmailVerificationNotification(); // void 
        return response()->json(['message'=> 'Verification Link Send']
        ,Response::HTTP_OK);
    }
    public function verify(EmailVerificationRequest $EmailVerificationRequest) // containes id and has (Request $request, $id ,$hash)
    {        
        if($EmailVerificationRequest->authorize()){ // authorize it means that they have id and hash
            $EmailVerificationRequest->fulfill(); 
            return redirect()->route('cms.dashboard');
         // return response()->json( ['message'=> 'Email Verifiyed successfully'],Response::HTTP_OK);
        }else{
            return response()->json( ['message'=> 'Email Verification is not authorized!'],Response::HTTP_BAD_REQUEST);
        }
    }
}
