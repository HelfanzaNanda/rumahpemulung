<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuestController extends Controller
{
    public function index()
    {
        
    }
    public function maps(Request $request)
    {
        return view('maps/popup', [
            'title' => 'Ambil Lokasi Lapak',
            'judul' => 'Ambil Lokasi',
            'lat' => $request->get('lat'),
            'long' =>$request->get('long')
        ]);
    }
}
