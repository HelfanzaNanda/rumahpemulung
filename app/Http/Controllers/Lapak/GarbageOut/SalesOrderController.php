<?php

namespace App\Http\Controllers\Lapak\GarbageOut;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class SalesOrderController extends Controller
{
    public function index(Request $request)
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

    public function create()
    {
        $rubbishs = DB::table('rubbish')->get();
        //$products = ['Plastik', 'Kertas', 'Besi'];
        return view('lapak.garbage_out.sales_order.create', [
            //'listProduct' => $products,
            'rubbishs' =>  $rubbishs
        ]);
    }

    public function getFactory(Request $request)
    {
        return DB::table('factory')
        ->where('nameof_factory', 'like', '%'. $request->name . '%')->get();
    }

    public function store(Request $request)
    {
        //return json_encode($request->all());
        // $item = [];
        // foreach($request->qty as $key => $qty){
        //     if ($qty != null) {
        //         array_push($item, $request->qty[$key]);    
        //     }
        // }
        // return json_encode($item);
        DB::beginTransaction();
        try {
            $sales_order_id = DB::table('sales_order')->insertGetId([
                'factory_id' => $request->factory_name,
                'date' => Carbon::parse($request->date)->format('Y-m-d'),
                'address' => $request->address,
                'total' => $request->total,
            ]);

            foreach($request->qty as $key => $qty){
                if ($qty != null) {
                    DB::table('sales_order_item')->insert([
                        'rubbish_id' => $request->rubbish_id[$key],
                        'price' => str_replace(',', '', $request->price[$key]),
                        'qty' => $qty,
                        'sub_total' => str_replace('.', '', $request->sub_total[$key]),
                        'note' => $request->note[$key] ?? null,
                        'sales_order_id' => $sales_order_id
                     ]);
                }
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'berhasil menambahkan data !'
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
