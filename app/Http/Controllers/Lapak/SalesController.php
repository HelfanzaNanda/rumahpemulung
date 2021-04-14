<?php

namespace App\Http\Controllers\Lapak;

use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:lapak');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    //LAPAK > SIDE MENU GARBAGE IN > REQUEST > GAK DIPAKAI LAGI ??
    public function index(Request $request)
    {
        //dd("COk");
        if ($request->ajax()) {

            $data = DB::table('so')
                ->join('client as c','so.id_client', '=', 'c.id')
                ->join('collector as p','so.id_picker', '=', 'p.id')
                ->select('so.*', 'c.username', 'p.nameof_collector')
                ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
                ->take(5)
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
        return view('lapak.sales.index');
    }

    //LAPAK > SIDE MENU GARBAGE IN > REQUEST
    public function porequest(Request $request)
    {
        //dd("COk");
        if ($request->ajax()) {

            $data = DB::table('so')
                ->leftJoin('client as c','so.id_client', '=', 'c.id')
                ->leftJoin('collector as p','so.id_picker', '=', 'p.id')
                ->select('so.*', 'c.username', 'p.nameof_collector')
                ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)  
                ->where('so.status',0)              
                //->take(2)
                ->get();

            if ($request->from != '' && $request->to != '') {
                $data = DB::table('so')
                    ->leftJoin('client as c','so.id_client', '=', 'c.id')
                    ->leftJoin('collector as p','so.id_picker', '=', 'p.id')
                    ->select('so.*', 'c.username', 'p.nameof_collector')
                    ->whereBetween('cdate',[$request->from,$request->to])
                    ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
                    ->where('so.status',0)
                    ->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('lapse', function($x){
                    return Carbon::parse($x->cdate)->diffForHumans();
                 })
                ->addColumn('action', function($x){
                   return $this->btn($x);
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('lapak.sales.porequest');
    }

    //LAPAK > SIDE MENU GARBAGE IN > BOOK
    public function pobook(Request $request)
    {
        //dd("COk");
        if ($request->ajax()) {

            $data = DB::table('so')
                ->leftJoin('client as c','so.id_client', '=', 'c.id')
                ->leftJoin('collector as p','so.id_picker', '=', 'p.id')
                ->select('so.*', 'c.username', 'p.nameof_collector')
                ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
                ->where('so.status',1)   
                //->take(1)
                ->get();

            if ($request->from != '' && $request->to != '') {
                $data = DB::table('so')
                    ->leftJoin('client as c','so.id_client', '=', 'c.id')
                    ->leftJoin('collector as p','so.id_picker', '=', 'p.id')
                    ->select('so.*', 'c.username', 'p.nameof_collector')
                    ->whereBetween('cdate',[$request->from,$request->to])
                    ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
                    ->where('so.status',1)->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($x){
                   return $this->btn($x);
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('lapak.sales.pobook');
    }

    //LAPAK > SIDE MENU GARBAGE IN > PICK
    public function popick(Request $request)
    {
        //dd("COk");
        if ($request->ajax()) {

            $data = DB::table('so')
                ->leftJoin('client as c','so.id_client', '=', 'c.id')
                ->leftJoin('collector as p','so.id_picker', '=', 'p.id')
                ->select('so.*', 'c.username', 'p.nameof_collector')
                ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
                ->where('so.status',2)   
                //->take(2)
                ->get();

            if ($request->from != '' && $request->to != '') {
                $data = DB::table('so')
                    ->leftJoin('client as c','so.id_client', '=', 'c.id')
                    ->leftJoin('collector as p','so.id_picker', '=', 'p.id')
                    ->select('so.*', 'c.username', 'p.nameof_collector')
                    ->whereBetween('cdate',[$request->from,$request->to])
                    ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
                    ->where('so.status',2)->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('price', function($x){
                    return number_format($x->ctotal_harga);
                })
                ->addColumn('action', function($x){
                    return $this->btn($x);
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('lapak.sales.popick');
    }  

    //LAPAK > SIDE MENU GARBAGE IN > RECEIVING
    public function poreceiving(Request $request)
    {
        //dd("COk");
        if ($request->ajax()) {

            $data = DB::table('so')
                ->leftJoin('client as c','so.id_client', '=', 'c.id')
                ->leftJoin('collector as p','so.id_picker', '=', 'p.id')
                ->select('so.*', 'c.username', 'p.nameof_collector')
                ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
                ->where('so.status', 3)->get();

            if ($request->from != '' && $request->to != '') {
                $data = DB::table('so')
                    ->leftJoin('client as c','so.id_client', '=', 'c.id')
                    ->leftJoin('collector as p','so.id_picker', '=', 'p.id')
                    ->select('so.*', 'c.username', 'p.nameof_collector')
                    ->whereBetween('cdate',[$request->from,$request->to])
                    ->where('so.id_lapak',Auth::guard('lapak')->user()->id_lapak)
                    ->where('so.status', 3)->get();
            }

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($x){
                return $this->btn($x);
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('lapak.sales.index');
    }  

    public function btn($x)
    {
        if ($x->status == 0) {
            return '<button data-id="'.$x->id.'" class="btn btn-info btn-sm btn-view btn-block">View</button>';
        }elseif ($x->status == 1) {
            return '<button data-id="'.$x->id.'" class="btn btn-view btn-sm btn-warning btn-block">View</button>';
        }elseif ($x->status == 2) {
            return '<button data-id="'.$x->id.'" class="btn btn-view btn-sm btn-primary btn-block">View</button>';
            //return '<a href="'.url("lapak/sales/deliver/".$x->id). '" class="btn btn-primary btn-block">Pick</a>';
        }elseif ($x->status == 3) {
            return '<button data-id="'.$x->id.'" class="btn btn-success btn-sm btn-view btn-block">View</button>';
        }else{
            return '<button data-id="'.$x->id.'" class="btn btn-danger btn-sm btn-view btn-block">View</button>';
        }
    }

    public function updatestatus($id, $status)
    {
        DB::beginTransaction();
        try {
            DB::table('so')->where('id', $id)
            ->update([
                'status' => $status
            ]);
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'berhasil update status'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
       

    }

    public function deliver($id)
    {
        $x = collect(DB::select('call pemulung_sp_req(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getOne',
            $id
        ]))->first();
        $rubbish = DB::select('call client_sp_sales(?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbish',
            ]);

        return view('lapak.sales.deliver',compact('x','rubbish'));
    }

    public function storedeliver(Request $request,$id)
    {
        $tg = date('Y-m-d H:i:s');
        $status = 3;
        $plastik = $request->qty_plastik;
        $totplas = $request->harga_plastik * $request->qty_plastik;
        $kertas = $request->qty_kertas;
        $totkertas = $request->harga_kertas * $request->qty_kertas;
        $besi = $request->qty_besi;
        $totbesi = $request->harga_besi * $request->qty_besi;;
        $totalberat = $plastik + $kertas + $besi;
        $totalharga = $totplas + $totkertas + $totbesi;

        DB::select('call lapak_sp_sales(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "")',[
            'delivery',
            $id,
            $status,
            $tg,
            $plastik,
            $totplas,
            $kertas,
            $totkertas,
            $besi,
            $totbesi,
            $totalberat,
            $totalharga,
        ]);
        return redirect('lapak/sales');
    }

    public function get($id)
    {
        $so = DB::table('so')->where('id', '=', $id)->first();
        return json_encode($so);
    }
}
