<?php

namespace App\Http\Controllers\Pemulung;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use DataTables;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pemulung');
    }

    //PEMULUNG > MENU REQUEST
    public function index(Request $request)
    {
        $rubbish = DB::select('call client_sp_sales(?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbish',
            ]);

        if ($request->ajax()) {
            // $data = DB::table('collector')->where('id_lapak',Auth::guard('lapak')->user()->id_lapak);

            $id = Auth::guard('pemulung')->user()->id_lapak;
            $order = DB::select('call pemulung_sp_req(?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                'get',
                $id,
                0,
                ]);
            if ($request->cari != '') {
                $order = DB::select('call pemulung_sp_req(?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                    'get',
                    $id,
                    0,
                    $request->cari
                ]);
            }
            return Datatables::of($order)
                ->addIndexColumn()
                ->addColumn('aksi', function($x){
                    // $btn = '<a href="'.url("/pemulung/salesreq/". $x->id).'" class="edit btn btn-success btn-sm">View</a><a href="#" class="edit btn btn-success btn-sm">Maps</a>';
                    $ctime = explode(':', $x->ctime);
                    $jam = $ctime[0];
                    $menit = $ctime[1];

                    $btn = '<a href="#requestModal" data-toggle="modal"
                            data-id_so="'.$x->id.'"
							data-hasil="'.$x->hasil.'"
                            data-cdate="'.$x->cdate.'"
							data-jam="'.$jam.'"
                            data-menit="'.$menit.'"
                            data-caddress="'.$x->caddress.'"
                            data-clat="'.$x->clat.'"
                            data-clng="'.$x->clng.'"
                            data-cplastik="'.$x->cplastik.'"
                            data-ctotal_plastik="'.$x->ctotal_plastik.'"
                            data-ckertas="'.$x->ckertas.'"
                            data-ctotal_kertas="'.$x->ctotal_kertas.'"
                            data-cbesi="'.$x->cbesi.'"
                            data-ctotal_besi="'.$x->ctotal_besi.'"
                            data-ctotal_harga="'.$x->ctotal_harga.'"
                            data-cphoto1="'.$x->cphoto1.'"
                            data-cpoto2="'.$x->cpoto2.'"
                            data-cpoto3="'.$x->cpoto3.'"
                            data-cpoto4="'.$x->cpoto4.'"
                            data-cketerangan="'.$x->cketerangan.'"
                            class="edit btn btn-success btn-block" onclick="viewRequest(this)">VIEW</a><a href="#" class="edit btn btn-success btn-block">MAP</a>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }
        return view('pemulung.request.index', compact('rubbish'));
    }
    public function show($id)
    {
        $x = collect(DB::select('call pemulung_sp_req(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getOne',
            $id
        ]))->first();
        return view('pemulung.request.view',compact('x'));
    }
    public function book($id)
    {
        $tgl = date('Y-m-d H:i:s');
        $pemulung =  Auth::guard('pemulung')->user()->id;
        DB::select('call pemulung_sp_req(?, ?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'pick',
            $id,
            $pemulung,
            '1',
            $tgl
        ]);

        return redirect('pemulung/salesreq')->with('berhasil','berhasil di pickup');
    }

    //PEMULUNG > MENU MYBOOK
    public function indexbook(Request $request)
    {
        if ($request->ajax()) {
            // $data = DB::table('collector')->where('id_lapak',Auth::guard('lapak')->user()->id_lapak);
            $id = Auth::guard('pemulung')->user()->id_lapak;
            $order = DB::select('call pemulung_sp_req(?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                'get',
                $id,
                1,
                ]);
            if ($request->cari != '') {
                $order = DB::select('call pemulung_sp_req(?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                    'get',
                    $id,
                    0,
                    $request->cari
                ]);
            }
            return Datatables::of($order)
                ->addIndexColumn()
                ->addColumn('aksi', function($x){
                    $btn = '<a href="'.url("/pemulung/mybook/". $x->id) .'" class="edit btn btn-warning btn-block">VIEW</a><a href="#" class="edit btn btn-warning btn-block">MAP</a>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }
        return view('pemulung.book.index');
    }
    public function showbook($id)
    {
        $x = collect(DB::select('call pemulung_sp_req(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getOne',
            $id
        ]))->first();
        $rubbish = DB::select('call client_sp_sales(?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbish',
            ]);

        return view('pemulung.book.view',compact('x','rubbish'));
    }

    public function sampah()
    {
        $plastik = collect(DB::select('call client_sp_sales(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbishone',
            1
        ]))->first();
        $kertas = collect(DB::select('call client_sp_sales(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbishone',
            2
        ]))->first();
        $besi = collect(DB::select('call client_sp_sales(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbishone',
            3
        ]))->first();

        return response()->json(['plastik' => $plastik->prices,'kertas' => $kertas->prices,'besi' => $besi->prices]);
    }

    public function storebook(Request $request,$id)
    {
        $request->validate([
            'address_google' => 'required'
        ]);

        if ($request->hasFile('foto')) {
            $file   = $request->file('foto');
            $image  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/img/sales/',$image);
        }else {
			$image = null;
		}

        if ($request->hasFile('foto1')) {
            $file   = $request->file('foto1');
            $image1  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/img/sales/',$image1);
        }else {
			$image1 = null;
		}

        if ($request->hasFile('foto2')) {
            $file   = $request->file('foto2');
            $image2  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/img/sales/',$image2);
        }else {
			$image2 = null;
		}

        if ($request->hasFile('foto3')) {
            $file   = $request->file('foto3');
            $image3  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/img/sales/',$image3);
        }else {
			$image3 = null;
		}


        $date = date('Y-m-d H:i:s');
        $address = $request->address_google;
        $lat = $request->latitude;
        $lng = $request->longtitude;
        $status = 2;
        $plastik = $request->qty_plastik;
        $totplas = $request->harga_plastik * $request->qty_plastik;
        $kertas = $request->qty_kertas;
        $totkertas = $request->harga_kertas * $request->qty_kertas;
        $besi = $request->qty_besi;
        $totbesi = $request->harga_besi * $request->qty_besi;;
        $totalberat = $plastik + $kertas + $besi;
        $totalharga = $totplas + $totkertas + $totbesi;


        $x = DB::select('call pemulung_sp_req(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',[
            'pickup',
            $id,
            $date,
            $address,
            $lat,
            $lng,
            $status,
            $plastik,
            $totplas,
            $kertas,
            $totkertas,
            $besi,
            $totbesi,
            $totalberat,
            $totalharga,
            $image,
            $image1,
            $image2,
            $image3
        ]);

        return redirect('pemulung/mybook');
    }

    //PEMULUNG > MENU > HISTORY (MY PICK)
    public function indexpick(Request $request)
    {
        $rubbish = DB::select('call client_sp_sales(?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbish',
            ]);

        if ($request->ajax()) {
            // $data = DB::table('collector')->where('id_lapak',Auth::guard('lapak')->user()->id_lapak);
            $id = Auth::guard('pemulung')->user()->id_lapak;
            $order = DB::select('call pemulung_sp_req(?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                'get',
                $id,
                2,
            ]);

            if ($request->cari != '') {
                $order = DB::select('call pemulung_sp_req(?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                    'get',
                    $id,
                    0,
                    $request->cari
                ]);
            }

            return Datatables::of($order)
                ->addIndexColumn()
                ->addColumn('aksi', function($x){
                    // $btn = '<a href="'.url("/pemulung/salesreq/". $x->id).'" class="edit btn btn-success btn-sm">View</a><a href="#" class="edit btn btn-success btn-sm">Maps</a>';
                    $ctime = explode(':', $x->ctime);
                    $jam = $ctime[0];
                    $menit = $ctime[1];

                    $btn = '<a href="#requestModal" data-toggle="modal"
                            data-id_so="'.$x->id.'"
                            data-hasil="'.$x->hasil.'"
                            data-cdate="'.$x->cdate.'"
                            data-jam="'.$jam.'"
                            data-menit="'.$menit.'"
                            data-caddress="'.$x->caddress.'"
                            data-clat="'.$x->clat.'"
                            data-clng="'.$x->clng.'"
                            data-cplastik="'.$x->cplastik.'"
                            data-ctotal_plastik="'.$x->ctotal_plastik.'"
                            data-ckertas="'.$x->ckertas.'"
                            data-ctotal_kertas="'.$x->ctotal_kertas.'"
                            data-cbesi="'.$x->cbesi.'"
                            data-ctotal_besi="'.$x->ctotal_besi.'"
                            data-ctotal_harga="'.$x->ctotal_harga.'"
                            data-cphoto1="'.$x->cphoto1.'"
                            data-cpoto2="'.$x->cpoto2.'"
                            data-cpoto3="'.$x->cpoto3.'"
                            data-cpoto4="'.$x->cpoto4.'"
                            data-cketerangan="'.$x->cketerangan.'"
                            class="edit btn btn-info btn-block" onclick="viewRequest(this)">VIEW</a><a href="#" class="edit btn btn-info btn-block">MAP</a>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->toJson();

            /*
            return Datatables::of($order)
                ->addIndexColumn()
                ->addColumn('aksi', function($x){
                    $btn = '<a href="'.url("/pemulung/mypick/". $x->id) .'" class="edit btn btn-info btn-block">VIEWQ</a><a href="#" class="edit btn btn-info btn-block">MAP</a>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->toJson();
            */
        }
        //return view('pemulung.pick.index');
        return view('pemulung.pick.index', compact('rubbish'));
    }
    public function showpick($id)
    {
        $rubbish = DB::select('call client_sp_sales(?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbish',
            ]);
        $x = collect(DB::select('call pemulung_sp_req(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getOne',
            $id
        ]))->first();
        return view('pemulung.pick.view',compact('x','rubbish'));
    }

    public function dobook(Request $request)
    {
        

        $id = $request->id_so;
        $tgl = date('Y-m-d H:i:s');
        $pemulung =  Auth::guard('pemulung')->user()->id;

        dump($id);
        dump($tgl);
        dump($pemulung);
        dump($request->all());

        DB::select('call pemulung_sp_req(?, ?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'book',
            $id,
            $pemulung,
            '1',
            $tgl
        ]);

        return redirect('pemulung/salesreq')->with('berhasil','berhasil di pickup');
    }
}
