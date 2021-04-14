<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client');
    }

    public function index()
    {
       $user =  Auth::guard('client')->user();
        return view('client.profile.index', [
            'user' => $user
        ]);
    }

    public function edit()
    {
        $user =  Auth::guard('client')->user();
        return view('client.profile.edit-profile', [
            'user' => $user
        ]);
    }

    public function editPassword()
    {
        return view('client.profile.edit-password');
    }

    public function update(Request $request)
    {
        $userId =  Auth::guard('client')->user()->id;
        $client = DB::table('client')->where('id', $userId)->limit(1);
        $this->validateProfile($request);
        DB::beginTransaction();
        try {
            $client->update([
                'fullname_client' => $request->fullname ?? $client->fullname_client,
                'username' => $request->username ?? $client->username,
                'phone_client' => $request->phone ?? $client->phone_client,
                'address_client' => $request->address ?? $client->address_client,
                'address_google' => $request->address_google ?? $client->address_google,
                'photo' => $request->hasFile('photo') ? $this->uploadImage($request->file('photo')) : $client->photo,
                'latitude' => $request->lat ?? $client->latitude,
                'longitude' => $request->lng ?? $client->longitude,
            ]);
            DB::commit();
            return redirect()->route('client.profile')
            ->with('success', 'berhasil update profile');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('client.profile')
            ->with('error', $th->getMessage());
        }
    }

    private function validateProfile($request)
    {
        $rules = [
            'fullname' => ['required'],
            'username' => ['required'],
            'phone' => ['required'],
            'address' => ['required'],
            'photo' => ['required'],
            'address_google' => ['required'],
        ];

        $messages = [
            'required' => ":attribute tidak boleh kosong",
        ];
       return $this->validate($request, $rules, $messages);
    }

    public function updatePassword(Request $request)
    {
        $userId =  Auth::guard('client')->user()->id;
        $client = DB::table('client')->where('id', $userId)->limit(1);
        $this->validatePassword($request);
        DB::beginTransaction();
        try {
            $client->update([
                'password' => Hash::make($request->password) ?? $client->password
            ]);
            DB::commit();
            return redirect()->route('client.profile')
            ->with('success', 'berhasil update password');
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->route('client.profile')
            ->with('error', $th->getMessage());
        }
    }

    private function validatePassword($request)
    {
        $rules = [
            'password' => ['required', 'min:6', 'confirmed'],
            'password_confirmation' => ['required', 'min:6'],
        ];

        $messages = [
            'required' => ":attribute tidak boleh kosong",
            'min' => ":attribute minimal :min karakter",
            'confirmed' => ':attribute konfirmasi tidak cocok.',
        ];
       return $this->validate($request, $rules, $messages);
    }

    private function uploadImage($image)
    {
        $filename = rand().time().'.'.$image->getClientOriginalExtension();
        $image->move('images/',$filename);
        return $filename;
    }
}
