<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\SendResetPassword;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function broker()
    {
        return Password::broker('users');
    }

    public function validateEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);
    }

    public function messageSuccess()
    {
        return "Kami telah mengirimkan email untuk pengaturan ulang kata sandi Anda!";
    }

    public function messageFail()
    {
        return "masukkan email anda yang benar";
    }

    protected function credentials(Request $request)
    {
        return $request->only('email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validateEmail($request);
        $user = DB::table('client')
        ->where('email_client',$request->email)
        ->first();
        if ($user) {
            Mail::to($user->email_client)->send(new SendResetPassword($user));
            return response()->json($this->sendResetLinkResponse());
        }else{
            return response()->json($this->sendResetLinkFailedResponse($request));
        }
    }

    public function sendResetLinkResponse()
    {
        return [
            'status' => true,
            'message' => $this->messageSuccess()
        ];
        //return back()->with('success', );
    }

    public function sendResetLinkFailedResponse(Request $request)
    {
        return [
            'status' => false,
            'message' => trans($this->messageFail())
        ];
        //return back()->withInput($request->only('email'))->withErrors(['email' => trans($this->messageFail())]);
    }

}
