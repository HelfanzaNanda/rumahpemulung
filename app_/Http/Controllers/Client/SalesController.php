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
        $rubbish = DB::select('call client_sp_sales(?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbish',
            ]);

        $id = Auth::guard('client')->user()->id;
        $so = DB::select('call client_sp_sales(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'get',
            $id,
            ]);

        return view('client/sales/index',compact('so', 'rubbish'));
    }

    //CLIENT > MENU > REWUEST > TAMPILKAN ALAMAT DROPDOWN HISTORY
	public function getDataAddressHistory(Request $request) {	
		dump("CEEEEEEKKKK <<-----");
		
		$id = Auth::guard('client')->user()->id;
        $so = DB::select('call client_sp_sales(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getaddresshistory',
            $id,
            ]);

		
		
        return Datatables::of($so)
            ->addIndexColumn()
            ->addColumn('aksi', function($x){
                //$ctime = explode(':', $x->ctime);
                //$jam = $ctime[0];
                //$menit = $ctime[1];

			   /*
               $btn = '<a href="#requestModal" data-toggle="modal"
                        data-hasil="'.$x->caddress.'"                        
                        data-cketerangan="'.$x->caddress.'"
                        class="edit btn btn-success btn-sm"onclick="viewRequest(this)">View</a>';
				*/
				
				$btn = "" . $x->caddress . "";
				
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->toJson();
		
		dd("CEK");
    }
	
	//CLIENT > MENU > HISTORY > PROVIDER GRID SAAT FIRST LOAD
    public function getData(Request $request) {
		
        $id = Auth::guard('client')->user()->id;
        $so = DB::select('call client_sp_sales(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'get',
            $id,
            ]);

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
                        class="edit btn btn-success btn-block"onclick="viewRequest(this)">VIEW</a><a href="#" class="edit btn btn-success btn-block">MAP</a>';
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
        $rubbish = DB::select('call client_sp_sales(?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getrubbish',
            ]);
        $brand = DB::select('call client_sp_sales(?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getbrand',
            ]);


        $so = collect(DB::select('call pemulung_sp_req(?, ?, "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "")',[
            'getOne',
            $request->id
        ]))->first();

        return view('client/sales/create',compact('rubbish','brand','so'));
    }

	//CLIENT > REQUEST > ENTRY SAMPAH > SUBMIT
    public function store(Request $request)
    {
		//dd($request->all());
        $request->validate([
            'date'         => 'required',
            'foto'      => 'required|mimes:jpeg,jpg,png',
            'foto1'      => 'required|mimes:jpeg,jpg,png',
            'foto2'      => 'required|mimes:jpeg,jpg,png',
            'foto3'      => 'required|mimes:jpeg,jpg,png',
            'address_google' => 'required'
        ]);
		
		dump("MASUK 1");
		
        if ($request->hasFile('foto')) {
            $file   = $request->file('foto');
            $image  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/img/sales/',$image);
        }
		dump("MASUK 2");
        if ($request->hasFile('foto1')) {
            $file   = $request->file('foto1');
            $image1  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/img/sales/',$image1);
        }
		dump("MASUK 3");
        if ($request->hasFile('foto2')) {
            $file   = $request->file('foto2');
            $image2  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/img/sales/',$image2);
        }
		dump("MASUK 4");
        if ($request->hasFile('foto3')) {
            $file   = $request->file('foto3');
            $image3  = rand().time().'.'.$file->getClientOriginalExtension();
            $file->move('assets/img/sales/',$image3);
        }
		dump("MASUK 5");
        $client = Auth::guard('client')->user()->id;
        $lapak = Auth::guard('client')->user()->id_lapak;
        $date = $request->date;
        $address = $request->address_google;
        $lat = $request->latitude;
        $lng = $request->longtitude;
		
		dump("MASUK 6");
		
        $status = 0;
        $plastik = $request->qty_plastik;
        $totplas = $request->harga_plastik * $request->qty_plastik;
        $bplas = ($request->brand_plastik == '' ? '1' : $request->brand_plastik) ;
        $kertas = $request->qty_kertas;
        $totkertas = $request->harga_kertas * $request->qty_kertas;
        $bkertas = ($request->brand_kertas == '' ? '1' : $request->brand_kertas) ;
        $besi = $request->qty_besi;
		
		dump("MASUK 7");
		
        $totbesi = $request->harga_besi * $request->qty_besi;
        $bbesi = ($request->brand_besi == '' ? '1' : $request->brand_besi) ;
        $totalberat = $plastik + $kertas + $besi;
        $totalharga = $totplas + $totkertas + $totbesi;

        $waktu = $request->jam .':'. $request->menit;
		dump("MASUK 8");
        $keterangan = $request->keterangan;

		dump($request->all());
		
		dump("client = " . $client);
		dump("lapak = " . $lapak);
		dump("date = " . $date);
		dump("address = " . $address);
		dump("at = " . $lat);
		dump("lng = " . $lng);
		dump("status = " . $status);
		dump("plastik = " . $plastik);
		dump("otplas = " . $totplas);
		dump("bplas = " . $bplas);
		dump("plastik = " . $plastik);
		
		dump("totplas = " . $totplas);
		dump("bplas = " . $bplas);
		dump("kertas = " . $kertas);
		dump("totkertas = " . $totkertas);
		dump("bkertas = " . $bkertas);
		dump("besi = " . $besi);
		dump("totbesi = " . $totbesi);
		dump("bbesi = " . $bbesi);
		dump("totalberat = " . $totalberat);
		dump("totalharga = " . $totalharga);
		dump("image = " . $image);
		dump("request->jenis = " . $request->jenis);
		dump("waktu = " . $waktu);
		dump("image1 = " . $image1);
		dump("image2 = " . $image2);
		dump("keterangan = " . $keterangan);
		dump("image3 = " . $image3);
				
		//dd("STOP DI SINI");
         DB::select('call client_sp_sales(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',[
            'simpan',
            $client,
            $lapak,
            $date,
            $address,
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
            $image,
            $request->jenis,
            $waktu,
            $image1,
            $image2,
            $keterangan,
            $image3
        ]);
		
		
        return redirect('client/history');
    }
}
