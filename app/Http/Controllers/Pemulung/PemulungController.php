<?php

namespace App\Http\Controllers\Pemulung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class PemulungController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pemulung');
    }
    public function index()
    {
        return view('pemulung.index');
    }
}
