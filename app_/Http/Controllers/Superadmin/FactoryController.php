<?php

namespace App\Http\Controllers\Superadmin;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use DataTables;

class FactoryController extends Controller
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
            $data = DB::table('factory');
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="/superadmin/factory/'.$row->id.'/edit" class="edit btn btn-success btn-sm">Edit</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('admin.factory.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.factory.tambah');
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
            "nameof_factory"        => 'required',
            "owner_factory"         => 'required',
            "phone_factory"         => 'required|unique:factory,phone_factory|numeric',
            "email_factory"         => 'required|unique:factory,email_factory|email',
            "address_factory"       => 'required',
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

        $q   = DB::select('call admin_sp_factory(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, "")',[
            'tambah',
            $request->nameof_factory,
            $request->owner_factory,
            $request->phone_factory,
            $request->email_factory,
            $request->address_factory,
            $image,
            $request->address_google,
            $request->latitude,
            $request->longitude
        ]);
        if ($q) {
            return redirect('superadmin/factory')->with('gagal','gagal ditambahkan');
        }else{
            return redirect('superadmin/factory')->with('berhasil','berhasil ditambahkan');
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
        $factory = collect(DB::select('call admin_sp_factory(?, ?, "", "", "", "", "", "", "", "", "")',[
            'getOne',
            $id
            ]))->first();
        return view('admin/factory/edit',compact('factory'));
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
            "nameof_factory"        => 'required',
            "owner_factory"         => 'required',
            "phone_factory"         => 'required|numeric|unique:factory,phone_factory,'.$id,
            "email_factory"         => 'required|email|unique:factory,email_factory,'.$id,
            "address_factory"       => 'required',
            "address_google"        => 'required',
        ]);
        

        if ($request->hasFile('photo')) {
            $file   = $request->file('photo');
            $image  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('images/',$image);
        }else{
            $image = $request->fotolama;
        }

        $q   = DB::select('call admin_sp_factory(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',[
            'edit',
            $id,
            $request->nameof_factory,
            $request->owner_factory,
            $request->phone_factory,
            $request->email_factory,
            $request->address_factory,
            $image,
            $request->address_google,
            $request->latitude,
            $request->longitude
        ]);
        if ($q) {
            return redirect('superadmin/factory')->with('gagal','gagal diupdate');
        }else{
            return redirect('superadmin/factory')->with('berhasil','berhasil diupdate');
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
        $q   = DB::select('call admin_sp_factory(?, ?, "", "", "", "", "", "", "", "", "")',[
            'delete',
            $id
        ]);

        if ($q) {
            return redirect('superadmin/factory')->with('gagal','gagal dihapus');
        }else{
            return redirect('superadmin/factory')->with('berhasil','berhasil dihapus');
        }
    }
}
