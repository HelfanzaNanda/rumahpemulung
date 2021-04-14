<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client');
    }
    public function index()
    {
        return view('client.index');
    }
    public function edit()
    {
        return view('client.editprofile');
    }
}
