<?php

namespace App\Http\Controllers\Lapak;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Auth;
use DataTables;

class ClientController extends Controller
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
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('client')->where('id_lapak',Auth::guard('lapak')->user()->id_lapak);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($x){
                   return $this->btn($x);
                })
                ->addColumn('status',function($x)
                {
                    return $this->status($x);
                })
                ->rawColumns(['action','status'])
                ->toJson();
        }
        return view('lapak.client.index');
    }
    public function btn($x)
    {
        $button = '<a class="btn btn-primary" href="'.route('client.edit',$x->id).'">Edit</a>';
        return $button;
    }
    public function status($x)
    {
        if ($x->isactivated == 1) {
            $button ='<span class="badge badge-success">Aktif</span>';
            //$button ='<button class="btn btn-success">Aktif</button>';
        }else{
            $button ='<span class="badge badge-danger">Non Aktif</span>';
            //$button ='<button class="btn btn-danger">Non Aktif</button>';
        }
        return $button;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $client = collect(DB::select('call lapak_sp_client(?, ?, "", "", "", "", "", "", "", "", "")',[
            'getOne',
            $id,
            ]))->first();
        return view('lapak/client/edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $q   = DB::select('call lapak_sp_client(?, ?, ?, "", "", "", "", "", "", "", "")',[
            'edit',
            $id,
            $request->status
        ]);
        return response()->json('berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
