<?php

namespace App\Http\Controllers;

use Auth;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\SendResetPassword;
use function PHPSTORM_META\map;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Laravel\Socialite\Facades\Socialite;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')
        ->except('logout');
        $this->middleware('guest:client,superadmin,lapak,pemulung')
        ->except('logout');
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
            $user = Auth::guard('client')->user();
            $params['id_user'] = $user->id;
            $params['username'] = $user->email_client;
            $params['category'] = 'client';
            $params['status'] = 'sukses';
            SysLog::insertLog($params);
            return response()->json(['berhasil' => 'login']);
        }
        $params['id_user'] = null;
        $params['username'] = $request->email;
        $params['category'] = 'client';
        $params['status'] = 'gagal';
        SysLog::insertLog($params);
        return response()->json(['error' => 'email atau password salah,atau akun tersuspend']);
        
    }
    public function loginpemulung(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if (Auth::guard('pemulung')->attempt(['email_collector' => $request->email,'password' => $request->password])) {
            $user = Auth::guard('pemulung')->user();
            $params['id_user'] = $user->id;
            $params['username'] = $user->email_collector;
            $params['category'] = 'pemulung';
            $params['status'] = 'sukses';
            SysLog::insertLog($params);
            return redirect()->intended('pemulung/salesreq');
        }
        $params['id_user'] = null;
        $params['username'] = $request->email;
        $params['category'] = 'pemulung';
        $params['status'] = 'gagal';
        SysLog::insertLog($params);
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
            $user = Auth::guard('lapak')->user();
            $params['id_user'] = $user->id;
            $params['username'] = $user->email;
            $params['category'] = 'lapak';
            $params['status'] = 'sukses';
            SysLog::insertLog($params);
            return redirect()->intended('lapak');
        }
        $params['id_user'] = null;
        $params['username'] = $request->email;
        $params['category'] = 'lapak';
        $params['status'] = 'gagal';
        SysLog::insertLog($params);
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

       $user = [
           'name' => $fullname,
           'email' => $email,
       ];
        \Mail::to($email)->send(new \App\Mail\Mailer($user));
        if (Mail::failures()) {
            return response()->json([
                'status' => false,
                'message' => 'anda gagal daftar'
            ]);
            ///return redirect('/register')->with('gagal','anda gagal daftar');
         }
         return response()->json([
            'status' => true,
            'message' => 'anda berhasil daftar silahkan cek email untuk verifikasi'
        ]);
        //return redirect('/register')->with('berhasil','anda berhasil daftar silahkan cek email untuk verifikasi');
    }
    public function verifikasi($email, $token)
    {
        DB::beginTransaction();
        try {
            DB::table('client')->where('email_client', $email)
            ->update([
                'isactivated' => 1,
                'isverified' => 1
            ]);
            DB::commit();
            return redirect('register')->with('berhasil','akun diaktifkan');
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
        
        // $baru = \Str::random(60);
        
        // $register   = DB::select('call sp_register(?, ?, ?, ?, "", "", "", "", "", "", "", "", "")',[
        //     'verifikasi',
        //     $id,
        //     1,
        //     $baru
        // ]);
        // if ($register) {
        //     return redirect('register')->with('gagal','gagal aktifkan akun');
        // }else{
        //     return redirect('register')->with('berhasil','akun diaktifkan');
        // }
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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $findUser = DB::table('client')
            ->where('google_id', $user->id)->first();
            if(!$findUser){
                $newUser = DB::table('client')->insertGetId([
                    'id_lapak' => 1,
                    'google_id' => $user->id,
                    'fullname_client' => $user->name,
                    'email_client' => $user->email,
                    'isactivated' => 1,
                    'isverified' => 1,
                    'password' => Hash::make('123456dummy')
                ]);
                $params['id_user'] = $newUser;
                $params['username'] = $user->email;
                $params['category'] = 'client';
                $params['status'] = 'sukses';
                SysLog::insertLog($params);
                Auth::guard('client')->loginUsingId($newUser);
                session()->flash('nothing', 'silahkan lenkapi profil dahulu');
            }else{
                $params['id_user'] = $findUser->id;
                $params['username'] = $findUser->email_client;
                $params['category'] = 'client';
                $params['status'] = 'sukses';
                SysLog::insertLog($params);
                Auth::guard('client')->loginUsingId($findUser->id);
                if (!$findUser->address_client) {
                    session()->flash('nothing', 'silahkan lenkapi profil dahulu');
                }
            }
            return redirect()->intended('client/history')->with('successfully_login_google', 'anda telah login menggunakaan akun gmail');
            
        } catch (\Throwable $th) {
            return response()->json( [
                'status' => false,
                'message' =>$th->getMessage()
            ]);
        }
    }
}
