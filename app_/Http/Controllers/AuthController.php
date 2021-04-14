<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:client,superadmin,lapak,pemulung')->except('logout');
    }
    
    // login
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()->first()]);
        }
        if (Auth::guard('client')->attempt(['email_client' => $request->email,'password' => $request->password,'isactivated' => 1])) {
            // return redirect()->intended('/client');
            return response()->json(['berhasil' => 'login']);
        }
        return response()->json(['error' => 'email atau password salah,atau akun tersuspend']);
        
    }
    public function loginpemulung(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::guard('pemulung')->attempt(['email_collector' => $request->email,'password' => $request->password])) {
            return redirect()->intended('pemulung');
        }
        return redirect('pemulung/login')->with('gagal','email/password salah');
    }
    public function loginadmin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::guard('superadmin')->attempt(['username' => $request->username,'password' => $request->password])) {
            return redirect()->intended('superadmin');
        }
        return redirect()->intended('superadmin/login');
    }

    public function loginlapak(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        
        if (Auth::guard('lapak')->attempt(['email' => $request->email,'password' => $request->password])) {
            return redirect()->intended('lapak');
        }
        return redirect()->intended('lapak/login');
    }

    // registrasi client
    public function registerstore(RegisterRequest $request)
    {
        $fullname   = $request->fullname;    
        $username   = $request->username;     
        $phone      = $request->phone;
        $address    = $request->address;    
        $email      = $request->email;
        $password   = Hash::make($request->password);
        $remember   = \Str::random(60);
        $status = 0;
        if ($request->hasFile('photo')) {
            $file   = $request->file('photo');
            $image  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('images/',$image);
        }else{
            $image = 'default.png';
        }

        $register   = DB::select('call sp_register(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',[
            'client',
            $fullname,
            $username,
            $phone,
            $address,
            $email,
            $password,
            $remember,
            $image,
            $request->address_google,
            $request->latitude,
            $request->longitude,
            $status
        ]);

       $details = [
           'title' => 'Aktivasi Pengguna',
           'body'   => 'silahkan klik link berikut untuk verifikasi akun 
           http://localhost:8000/verifikasi/'.$remember
       ];
        \Mail::to($email)
        ->send(new \App\Mail\Mailer($details));

        if (Mail::failures()) {
            return redirect('/register')->with('gagal','anda gagal daftar');
         }
        return redirect('/register')->with('berhasil','anda berhasil daftar silahkan cek email untuk verifikasi');
    }
    public function verifikasi($id)
    {
        $baru = \Str::random(60);
        $register   = DB::select('call sp_register(?, ?, ?, ?, "", "", "", "", "", "", "", "", "")',[
            'verifikasi',
            $id,
            1,
            $baru
        ]);
        if ($register) {
            return redirect('register')->with('gagal','gagal aktifkan akun');
        }else{
            return redirect('register')->with('berhasil','akun diaktifkan');
        }
    }

    public function logout()
    {
        if (Auth::guard('client')->check()) {
            Auth::guard('client')->logout();
            return redirect('/');
        }
        if (Auth::guard('superadmin')->check()) {
            Auth::guard('superadmin')->logout();
            return redirect('superadmin/login');
        }
        if (Auth::guard('lapak')->check()) {
            Auth::guard('lapak')->logout();
            return redirect('lapak/login');
        }
        if (Auth::guard('pemulung')->check()) {
            Auth::guard('pemulung')->logout();
            return redirect('pemulung/login');
        }
        return redirect('/');
    }
}
