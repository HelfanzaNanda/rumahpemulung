<?php

namespace App\Http\Controllers\Lapak;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class FactoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if ($request->ajax()) {
                $data = DB::table('factory');
                
            }
            $data->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($x){
                       return $this->showButton($x);
                    })
                    ->rawColumns(['action'])
                    ->toJson();
        }
        return view('lapak.factory.index');
    }

    private function showButton($x)
    {
        return '<a class="btn btn-detail btn-primary" data-id="'.$x->id.'" href="#">Detail</a>';
    }

    public function get($id)
    {
        $data = DB::table('factory')->where('id', '=',$id)->first();
        return json_encode($data);
    }

    
}
