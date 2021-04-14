@extends('layoutadmin.main')

@section('title','Deliver')
    
@section('contents')
    <!-- Begin Page Content -->
    <div class="container-fluid">

    

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header">
            <h3 class="card-title">Deliver</h3>
        </div>
        <div class="card-body">
        <div class="table-responsive">
           <form action="{{ url('lapak/sales/deliver/'.$x->id) }}" method="post">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <label>Nama Client</label>
                            <input type="text" class="form-control" value="{{ $x->username }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label>Nama Pemulung</label>
                            
                            <input type="text" class="form-control" value="{{ $x->nameof_collector }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label>Alamat Client</label>
                            <textarea class="form-control" rows="2" readonly>{{ $x->caddress }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label>Alamat Pemulung</label>
                            <textarea class="form-control" rows="2" readonly>{{ $x->paddress }}</textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Plastik Client</label>
                            <input type="text" class="form-control" value="{{ $x->cplastik.'Kg' }}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label>Kertas Client</label>
                            
                            <input type="text" class="form-control" value="{{ $x->ckertas.'Kg' }}" readonly>
                        </div><div class="col-md-2">
                            <label>Besi Client</label>
                            <input type="text" class="form-control" value="{{ $x->cbesi.'Kg' }}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label>Plastik Picker</label>
                            
                            <input type="text" class="form-control" value="{{ $x->pplastik.'Kg' }}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label>Kertas Picker</label>
                            <input type="text" class="form-control" value="{{ $x->pkertas.'Kg' }}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label>Besi Picker</label>
                            <input type="text" class="form-control" value="{{ $x->pbesi.'Kg' }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-end">
                            <strong>Total</strong>
                        </div>
                        <div class="col-md-2 d-flex justify-content-end">
                            <strong>{{ $x->ctotal_berat.'Kg' }}</strong>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <strong>Total</strong>
                        </div>
                        <div class="col-md-2 d-flex justify-content-end">
                            <strong>{{ $x->ptotal_berat.'Kg' }}</strong>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label>Total Plastik Client</label>
                            <input type="text" class="form-control" value="{{ 'Rp.'.$x->ctotal_plastik }}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label>Total Kertas Client</label>
                            
                            <input type="text" class="form-control" value="{{ 'Rp.'.$x->ctotal_kertas }}" readonly>
                        </div><div class="col-md-2">
                            <label>Total Besi Client</label>
                            <input type="text" class="form-control" value="{{ 'Rp.'.$x->ctotal_besi }}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label>Total Plastik Picker</label>
                            
                            <input type="text" class="form-control" value="{{ 'Rp.'.$x->ptotal_plastik }}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label>Total Kertas Picker</label>
                            <input type="text" class="form-control" value="{{ 'Rp.'.$x->ptotal_kertas }}" readonly>
                        </div>
                        <div class="col-md-2">
                            <label>Total Besi Picker</label>
                            <input type="text" class="form-control" value="{{ 'Rp.'.$x->ptotal_besi }}" readonly>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 d-flex justify-content-end">
                            <strong>Total</strong>
                        </div>
                        <div class="col-md-2 d-flex justify-content-end">
                            <strong>{{ 'Rp.'.$x->ctotal_harga }}</strong>
                        </div>
                        <div class="col-md-4 d-flex justify-content-end">
                            <strong>Total</strong>
                        </div>
                        <div class="col-md-2 d-flex justify-content-end">
                            <strong>{{ 'Rp.'.$x->ptotal_harga }}</strong>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <h3 class="title">Form Lapak</h3>
                        </div>
                    </div>
                    @php
                        $qty = ['qty_plastik','qty_kertas','qty_besi'];
                        $harga = ['harga_plastik','harga_kertas','harga_besi'];
                    @endphp
                    <div class="row">
                        @foreach ($rubbish as $i => $x)
                        <div class="col-md-4">
                            <table style="width:100%">
                                <tr>
                                    <td><label class="control-label"><b>{{ $x->typeof_rubbish }}</b><br>Rp {{ $x->prices }}/kg</label></td>
                                    <td><input type="number" class="form-control" step="0.1"
                                        name="{{ $qty[$i] }}" value="0" min="0" style="width: 4em">
                                        <input type="hidden" name="{{ $harga[$i] }}" value="{{ $x->prices }}">
                                    </td>
                                </tr>
                            </table>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-success btn-block">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>

    </div>
@endsection