<?php

namespace App\Http\Controllers\Pemulung;

use DataTables;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PickupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:pemulung');
    }

    //PEMULUNG > MENU REQUEST
    public function index(Request $request)
    {
        $rubbish = DB::select('call client_sp_sales(?,"", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbish',
            ]);

        if ($request->ajax()) {
            // $data = DB::table('collector')->where('id_lapak',Auth::guard('lapak')->user()->id_lapak);

            $id = Auth::guard('pemulung')->user()->id_lapak;
            $order = DB::select('call pemulung_sp_req(?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                'get',
                $id,
                0,
                ]);
            if ($request->cari != '' && $request->date == '') {
                $order = DB::select('call pemulung_sp_req(?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                    'search_address',
                    $id,
                    0,
                    $request->cari,
                ]);
            }elseif($request->cari == '' && $request->date != ''){
                $order = DB::select('call pemulung_sp_req(?, ?, ?, ?,"", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                    'search_date',
                    $id,
                    0,
                    $request->date,
                ]);
            }elseif($request->cari != '' && $request->date != ''){
                $order = DB::select('call pemulung_sp_req(?, ?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                    'search',
                    $id,
                    0,
                    $request->cari,
                    $request->date
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
                            class="edit btn btn-success btn-block" onclick="viewRequest(this)">VIEW</a>';
                    return $btn;
                })
                ->addColumn('price', function($q){
                    return number_format($q->ctotal_harga);
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }
        return view('pemulung.request.index', compact('rubbish'));
    }
    public function show($id)
    {
        $x = collect(DB::select('call pemulung_sp_req(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getOne',
            $id
        ]))->first();
        return view('pemulung.request.view',compact('x'));
    }
    public function book($id)
    {
        //$id = $request->id_so;
        $tgl = date('Y-m-d H:i:s');
        $pemulung =  Auth::guard('pemulung')->user()->id;
        //return $pemulung
        DB::select('call pemulung_sp_req(?, ?, ?, ?, ?, "",  "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
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
            $order = DB::select('call pemulung_sp_req(?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                'get',
                $id,
                1,
                ]);
            if ($request->cari != '' && $request->date == '') {
                $order = DB::select('call pemulung_sp_req(?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                    'search_address',
                    $id,
                    1,
                    $request->cari,
                ]);
            }elseif($request->cari == '' && $request->date != ''){
                $order = DB::select('call pemulung_sp_req(?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                    'search_date',
                    $id,
                    1,
                    $request->date,
                ]);
            }elseif($request->cari != '' && $request->date != ''){
                $order = DB::select('call pemulung_sp_req(?, ?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                    'search',
                    $id,
                    1,
                    $request->cari,
                    $request->date
                ]);
            }
            return Datatables::of($order)
                ->addIndexColumn()
                ->addColumn('price', function($q){
                    return number_format($q->ctotal_harga);
                })
                ->addColumn('aksi', function($x){
                    $btn = '<a href="'.url("/pemulung/mybook/". $x->id) .'" class="edit btn btn-warning btn-block">VIEW</a>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }
        return view('pemulung.book.index');
    }

    public function showbook($id)
    {
        $x = collect(DB::select('call pemulung_sp_req(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getOne',
            $id
        ]))->first();
        $rubbish = DB::select('call client_sp_sales(?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
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

    public function storebook(Request $request, $id)
    {
        // $request->validate([
        //     'address_google' => 'required'
        // ]);

        $data = DB::table('so')
        ->where('id', $id)->first();
            
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
        $missed = $date . '-' . $data->cdate . ', '. $data->ctime;


        $x = DB::select('call pemulung_sp_req(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',[
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
            $request->hasFile('foto') ? $this->uploadImage($request->file('foto')) : null,
            $request->hasFile('foto1') ? $this->uploadImage($request->file('foto1')) : null,
            $request->hasFile('foto2') ? $this->uploadImage($request->file('foto2')) : null,
            $request->hasFile('foto3') ? $this->uploadImage($request->file('foto3')) : null,
            $missed
        ]);

        //return redirect('pemulung/mybook');
        return json_encode([
            'status' => true
        ]);
    }

    //PEMULUNG > MENU > HISTORY (MY PICK)
    public function indexpick(Request $request) {
    // {
        $rubbish = DB::select('call client_sp_sales(?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbish',
            ]);

        if ($request->ajax()) {
            // $data = DB::table('collector')->where('id_lapak',Auth::guard('lapak')->user()->id_lapak);
            $id = Auth::guard('pemulung')->user()->id_lapak;
            $order = DB::select('call pemulung_sp_req(?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                'get',
                $id,
                2,
            ]);

            if ($request->cari != '' && $request->date == '') {
                $order = DB::select('call pemulung_sp_req(?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                    'search_address', 
                    $id,
                    2,
                    $request->cari,
                ]);
            }elseif($request->cari == '' && $request->date != ''){
                $order = DB::select('call pemulung_sp_req(?, ?, ?, ?,"", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                    'search_date',
                    $id,
                    2,
                    $request->date,
                ]);
            }elseif($request->cari != '' && $request->date != ''){
                $order = DB::select('call pemulung_sp_req(?, ?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                    'search',
                    $id,
                    2,
                    $request->cari,
                    $request->date
                ]);
            }

            return Datatables::of($order)
                ->addIndexColumn()
                ->addColumn('date', function($q){
                    return Carbon::parse($q->pdate)->format('Y-m-d');
                })
                ->addColumn('time', function($q){
                    return Carbon::parse($q->pdate)->format('H:i');
                })
                ->addColumn('price', function($q){
                    return number_format($q->ptotal_harga);
                })
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
                            class="edit btn btn-info btn-block" onclick="viewRequest(this)">VIEW</a>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->toJson();
        }
        return view('pemulung.pick.index' , [
            'rubbish' => $rubbish
        ]);
    }
    public function showpick($id)
    {
        $rubbish = DB::select('call client_sp_sales(?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbish',
            ]);
        $x = collect(DB::select('call pemulung_sp_req(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
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

        DB::select('call pemulung_sp_req(?, ?, ?, ?, ?, "",  "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'pick',
            $id,
            $pemulung,
            '1',
            $tgl
        ]);

        // DB::select('call pemulung_sp_req(?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
        //     'book',
        //     $id,
        //     //$pemulung,
        //     '1',
        //     //$tgl
        // ]);

        return json_encode([
            'status' => true,
        ]);

        //return redirect('pemulung/salesreq')->with('berhasil','berhasil di pickup');
    }

    private function uploadImage($image)
    {
        $filename  = rand().time().'.'.$image->getClientOriginalExtension();
        $image->move('assets/img/sales/',$filename);
        return $filename;
    }
}
