<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use DataTables;

class LapakController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:superadmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('lapak');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($x){
                    $btn = '<a href="/superadmin/lapak/'. $x->id .'/edit" class="edit btn btn-success btn-sm">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.lapak.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.lapak.tambah');
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
            "namaUsaha"     => 'required',
            "namaPemilik"   => 'required',
            "phone"         => 'required|unique:lapak,phone|numeric',
            "email"         => 'required|unique:lapak,email|email',
            "address"       => 'required',
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

        $q   = DB::select('call admin_sp_lapak(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "")',[
            'tambah',
            $request->namaUsaha,
            $request->namaPemilik,
            $request->phone,
            $request->email,
            $request->address,
            $image,
            $request->address_google,
            $request->latitude,
            $request->longitude
        ]);
        if ($q) {
            return redirect('superadmin/lapak')->with('gagal','gagal ditambahkan');
        }else{
            return redirect('superadmin/lapak')->with('berhasil','berhasil ditambahkan');
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
        $lapak = collect(DB::select('call admin_sp_lapak(?, ?, "", "", "", "", "", "", "", "", "")',[
            'getOne',
            $id,
            ]))->first();
        return view('admin/lapak/edit',compact('lapak'));
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
            "namaUsaha"     => 'required',
            "namaPemilik"   => 'required',
            "phone"         => 'required|numeric|unique:lapak,phone,'.$id,
            "email"         => 'required||email|unique:lapak,email,'.$id,
            "address"       => 'required', 
            "address_google"=> 'required',
        ]);

        if ($request->hasFile('photo')) {
            $file   = $request->file('photo');
            $image  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('images/',$image);
        }else{
            $image = $request->fotolama;
        }

        $q   = DB::select('call admin_sp_lapak(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',[
            'edit',
            $id,
            $request->namaUsaha,
            $request->namaPemilik,
            $request->phone,
            $request->email,
            $request->address,
            $image,
            $request->address_google,
            $request->latitude,
            $request->longitude
        ]);

        if ($q) {
            return redirect('superadmin/lapak')->with('gagal','gagal diupdate');
        }else{
            return redirect('superadmin/lapak')->with('berhasil','berhasil diupdate');
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
        $q   = DB::select('call admin_sp_lapak(?, ?, "", "", "", "", "", "", "", "", "")',[
            'delete',
            $id
        ]);

        if ($q) {
            return redirect('superadmin/lapak')->with('gagal','gagal dihapus');
        }else{
            return redirect('superadmin/lapak')->with('berhasil','berhasil dihapus');
        }
    }
}
