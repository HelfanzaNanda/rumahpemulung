<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use DataTables;

class SalesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:client');
    }
    public function index(Request $request)
    {
		//dd("CEK");
        $rubbish = DB::select('call client_sp_sales(?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbish',
            ]);

        $id = Auth::guard('client')->user()->id;
        $so = DB::select('call client_sp_sales(?, ?,"",  "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'get',
            $id,
            ]);

        return view('client/sales/index',compact('so', 'rubbish'));
    }

   
	
	//CLIENT > MENU > HISTORY > PROVIDER GRID SAAT FIRST LOAD
    public function getData(Request $request) {
		
        $id = Auth::guard('client')->user()->id;
        $so = DB::select('call client_sp_sales(?, ?, "",  "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'get',
            $id,
        ]);
        if ($request->cari != '' && $request->date == '') {
            $so = DB::select('call client_sp_sales(?, ?, ?,  "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                'search_address',
                $id,
                $request->cari
            ]);
        }elseif($request->cari == '' && $request->date != ''){
            $so = DB::select('call client_sp_sales(?, ?, ?,  "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                'search_date',
                $id,
                $request->date
            ]);
        }elseif($request->cari != '' && $request->date != ''){
            $so = DB::select('call client_sp_sales(?, ?, ?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
                'search',
                $id,
                $request->cari,
                $request->date
            ]);
        }
        return Datatables::of($so)
            ->addIndexColumn()
            ->addColumn('aksi', function($x){
                $ctime = explode(':', $x->ctime);
                $jam = $ctime[0];
                $menit = $ctime[1];

				//KOLOM ASI > BUTTON VIEW
                $btn = '<a href="#requestModal" data-toggle="modal"
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
                        class="edit btn btn-sm btn-success btn-block"onclick="viewRequest(this)">VIEW</a>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    //CLIENT > REQUEST > FIRST LOAD
    //PROVIDE DATA PRICE FOR PLASTIC/PAPER/METAL
    public function create(Request $request)
    {
        //dd("CREATE");
        //DATA MASTER HARGA SAMPAH
        $rubbish = DB::select('call client_sp_sales(?, "",  "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbish',
            ]);

        //DATA MASTER BRAND
        $brand = DB::select('call client_sp_sales(?, "",  "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getbrand',
            ]);

        //TAMPILKAN ALAMAT REGISTRASI
        $id = Auth::guard('client')->user()->id;  
        $ar = collect(DB::select('call client_sp_sales(?, ?, "",  "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getaddressreg',
            $id,
            ]))->first();

        //TAMPILKAN ALAMAT DROPDOWN HISTORY
        $id = Auth::guard('client')->user()->id;  
        $ah = DB::select('call client_sp_sales(?, ?, "",  "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getaddresshistory',
            $id,
            ]);

        //
        $so = collect(DB::select('call pemulung_sp_req(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getOne',
            $request->id
            ]))->first();

        return view('client/sales/create',compact('rubbish','brand','so','ar','ah'));
    }

	//CLIENT > REQUEST > ENTRY SAMPAH > SUBMIT
    public function store(Request $request)
    {
        $request->validate([
            'date'       => 'required',
            'address_google' => 'required'
        ]);
        
        $client = Auth::guard('client')->user()->id;
        $lapak = Auth::guard('client')->user()->id_lapak;
        $date = $request->date;
        $address = $request->address_pickup ?? $request->address_google;
        $google_address = $request->address_google;
        $lat = $request->latitude;
        $lng = $request->longtitude;
		
		
        $status = 0;
        $plastik = $request->qty_plastik;
        $totplas = $request->harga_plastik * $request->qty_plastik;
        $bplas = ($request->brand_plastik == '' ? '1' : $request->brand_plastik) ;
        $kertas = $request->qty_kertas;
        $totkertas = $request->harga_kertas * $request->qty_kertas;
        $bkertas = ($request->brand_kertas == '' ? '1' : $request->brand_kertas) ;
        $besi = $request->qty_besi;
		
        $totbesi = $request->harga_besi * $request->qty_besi;
        $bbesi = ($request->brand_besi == '' ? '1' : $request->brand_besi) ;
        $totalberat = $plastik + $kertas + $besi;
        $totalharga = $totplas + $totkertas + $totbesi;

        $waktu = $request->jam .':'. $request->menit;
        $keterangan = $request->keterangan ?? 'ket';
         DB::select('call client_sp_sales(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',[
            'simpan',
            $client,
            $lapak,
            $date,
            $address,
            $google_address,
            $lat,
            $lng,
            $status,
            $plastik,
            $totplas,
            $bplas,
            $kertas,
            $totkertas,
            $bkertas,
            $besi,
            $totbesi,
            $bbesi,
            $totalberat,
            $totalharga,
            $request->hasFile('foto') ? $this->uploadImage($request->file('foto')) : '',
            $request->jenis,
            $waktu,
            $request->hasFile('foto1') ? $this->uploadImage($request->file('foto1')) : '',
            $request->hasFile('foto2') ? $this->uploadImage($request->file('foto2')) : '',
            $keterangan,
            $request->hasFile('foto3') ? $this->uploadImage($request->file('foto3')) : '',
            ''
        ]);

		return json_encode([
            'status' => true,
        ]);
        //return redirect('client/history');
    }

    private function uploadImage($image)
    {
        $filename  = rand().time().'.'.$image->getClientOriginalExtension();
        $image->move('assets/img/sales/',$filename);
        return $filename;
    }
}
