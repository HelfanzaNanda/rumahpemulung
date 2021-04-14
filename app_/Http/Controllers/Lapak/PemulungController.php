<?php

namespace App\Http\Controllers\Lapak;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use DataTables;

class PemulungController extends Controller
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
            $data = DB::table('collector')->where('id_lapak',Auth::guard('lapak')->user()->id_lapak);
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($x){
                    $btn = '<a href="/lapak/pemulung/'. $x->id .'/edit" class="edit btn btn-success btn-sm">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('lapak.pemulung.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('lapak.pemulung.tambah');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "nameof_collector"     => 'required',
            "phone_collector"         => 'required|unique:collector,phone_collector|numeric',
            "email_collector"         => 'required|unique:collector,email_collector|email',
            "address_collector"       => 'required',
            "photo"         => 'mimes:jpeg,jpg,png',
            "address_google"=> 'required',
        ]);

        if ($request->hasFile('photo')) {
            $file   = $request->file('photo');
            $image  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('images/',$image);
        }else{
            $image = 'default.png';
        }


        $id_lapak = Auth::guard('lapak')->user()->id_lapak;
        $q   = DB::select('call lapak_sp_pemulung(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "")',[
            'tambah',
            $request->nameof_collector,
            $request->phone_collector,
            $request->email_collector,
            $request->address_collector,
            $id_lapak,
            $image,
            $request->address_google,
            $request->latitude,
            $request->longitude
        ]);
        if ($q) {
            return redirect('lapak/pemulung')->with('gagal','gagal ditambahkan');
        }else{
            return redirect('lapak/pemulung')->with('berhasil','berhasil ditambahkan');
        }
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
        $pemulung = collect(DB::select('call lapak_sp_pemulung(?, ?, "", "", "", "", "", "", "", "", "")',[
            'getOne',
            $id,
            ]))->first();
        return view('lapak/pemulung/edit',compact('pemulung'));
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
        $request->validate([
            "nameof_collector"     => 'required',
            "phone_collector"         => 'required|numeric|unique:collector,phone_collector,'.$id,
            "email_collector"         => 'required|email|unique:collector,email_collector,'.$id,
            "address_collector"       => 'required',
            "address_google"        => 'required',
        ]);

        if ($request->hasFile('photo')) {
            $file   = $request->file('photo');
            $image  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('images/',$image);
        }else{
            $image = $request->fotolama;
        }

        $q   = DB::select('call lapak_sp_pemulung(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "")',[
            'edit',
            $id,
            $request->nameof_collector,
            $request->phone_collector,
            $request->email_collector,
            $request->address_collector,
            $image,
            $request->address_google,
            $request->latitude,
            $request->longitude
        ]);
        if ($q) {
            return redirect('lapak/pemulung')->with('gagal','gagal diupdate');
        }else{
            return redirect('lapak/pemulung')->with('berhasil','berhasil diupdate');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $q   = DB::select('call lapak_sp_pemulung(?, ?, "", "", "", "", "", "", "", "", "")',[
            'delete',
            $id
        ]);

        if ($q) {
            return redirect('lapak/pemulung')->with('gagal','gagal dihapus');
        }else{
            return redirect('lapak/pemulung')->with('berhasil','berhasil dihapus');
        }
    }
}
