<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\{DB, Auth, Hash};

use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function guardClient()
    {
        return Auth::guard('client');
    }

    public function broker()
    {
        return Password::broker('users');
    }

    public function showResetForm($email, $token  = null)
    {
        return view('auth.reset-password', [
            'token' => $token, 
            'email' => $email
        ]);
    }

    protected function reset(Request $request)
    {
        DB::table('client')
        ->where('email_client', $request->email)
        ->update([
            'password' => Hash::make($request->pasword),
            'isforgot' => 1
        ]);

        return redirect()->route('login')
        ->with('success', 'berhasil reset password, silahkan login kembali');
    }
}
