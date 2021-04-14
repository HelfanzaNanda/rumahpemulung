<?php

namespace App\Http\Controllers\Lapak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:lapak');
    }

    public function index()
    {
        $count_request =  DB::table('so')
        ->leftJoin('client','so.id_client', '=', 'client.id')
        ->leftJoin('collector','so.id_picker', '=', 'collector.id')
        ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
        ->where('so.status', 1)->count();

        $count_booked =  DB::table('so')
        ->leftJoin('client','so.id_client', '=', 'client.id')
        ->leftJoin('collector','so.id_picker', '=', 'collector.id')
        ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
        ->where('so.status', 2)->count();

        $count_pickup =  DB::table('so')
        ->leftJoin('client','so.id_client', '=', 'client.id')
        ->leftJoin('collector','so.id_picker', '=', 'collector.id')
        ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
        ->where('so.status', 3)->count();

        $count_received =  DB::table('so')
        ->leftJoin('client','so.id_client', '=', 'client.id')
        ->leftJoin('collector','so.id_picker', '=', 'collector.id')
        ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
        ->where('so.status', 4)->count();

        
        return view('lapak.index', [
            'count_request' => $count_request,
            'count_booked' => $count_booked,
            'count_pickup' => $count_pickup,
            'count_received' => $count_received
        ]);
    }
}
