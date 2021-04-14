<?php

namespace App\Http\Controllers\Lapak;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DataTables;

class GarbageOutController extends Controller
{
    public function salesOrder(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('so')
                ->join('client as c','so.id_client', '=', 'c.id')
                ->join('collector as p','so.id_picker', '=', 'p.id')
                ->select('so.*', 'c.username', 'p.nameof_collector')
                ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
                ->where('so.status',1)   
                //->take(2)
                ->get();

            if ($request->from != '' && $request->to != '') {
                $data = DB::table('so')
                    ->join('client as c','so.id_client', '=', 'c.id')
                    ->join('collector as p','so.id_picker', '=', 'p.id')
                    ->select('so.*', 'c.username', 'p.nameof_collector')
                    ->whereBetween('dateofso',[$request->from,$request->to])
                    ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($x){
                   return $this->btn($x);
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('lapak.garbage_out.sales_order.sales_order');
    }

    public function goodIssue(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('so')
                ->join('client as c','so.id_client', '=', 'c.id')
                ->join('collector as p','so.id_picker', '=', 'p.id')
                ->select('so.*', 'c.username', 'p.nameof_collector')
                ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
                ->where('so.status',1)   
                //->take(2)
                ->get();

            if ($request->from != '' && $request->to != '') {
                $data = DB::table('so')
                    ->join('client as c','so.id_client', '=', 'c.id')
                    ->join('collector as p','so.id_picker', '=', 'p.id')
                    ->select('so.*', 'c.username', 'p.nameof_collector')
                    ->whereBetween('dateofso',[$request->from,$request->to])
                    ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($x){
                   return $this->btn($x);
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('lapak.garbage_out.goods_issue');
    }

    public function invoice(Request $request)
    {
        if ($request->ajax()) {

            $data = DB::table('so')
                ->join('client as c','so.id_client', '=', 'c.id')
                ->join('collector as p','so.id_picker', '=', 'p.id')
                ->select('so.*', 'c.username', 'p.nameof_collector')
                ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
                ->where('so.status',1)   
                //->take(2)
                ->get();

            if ($request->from != '' && $request->to != '') {
                $data = DB::table('so')
                    ->join('client as c','so.id_client', '=', 'c.id')
                    ->join('collector as p','so.id_picker', '=', 'p.id')
                    ->select('so.*', 'c.username', 'p.nameof_collector')
                    ->whereBetween('dateofso',[$request->from,$request->to])
                    ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak);
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($x){
                   return $this->btn($x);
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('lapak.garbage_out.invoice');
    }

    public function btn($x)
    {
        if ($x->status == 0) {
            return '<button data-id="'.$x->id.'" class="btn btn-info btn-wait btn-block">Wait</button>';
        }elseif ($x->status == 1) {
            return '<button data-id="'.$x->id.'" class="btn btn-book btn-warning btn-block">Book</button>';
        }elseif ($x->status == 2) {
            return '<button data-id="'.$x->id.'" class="btn btn-pick btn-primary btn-block">Pick</button>';
            //return '<a href="'.url("lapak/sales/deliver/".$x->id). '" class="btn btn-primary btn-block">Pick</a>';
        }elseif ($x->status == 3) {
            return '<button data-id="'.$x->id.'" class="btn btn-success btn-deliver btn-block">Deliver</button>';
        }else{
            return '<button data-id="'.$x->id.'" class="btn btn-danger btn-cancel btn-block">Cancel</button>';
        }
    }

    public function get($id)
    {
        $so = DB::table('so')->where('id', '=', $id)->first();
        return json_encode($so);
    }
}
