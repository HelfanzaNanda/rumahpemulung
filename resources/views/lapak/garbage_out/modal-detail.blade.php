<!-- set up the modal to start hidden and fade in and out -->
<div id="modal-detail" class="modal fade">
    <div class="modal-dialog " style="width:80%;max-width:1250px">
        <div class="modal-content">
            <div class="modal-header row justify-content-between">
                <h4 class="ml-1" id="text-header"></h4>
                <button type="button" class="close mr-1" data-dismiss="modal">&times;</button>
               
            </div>
            <!-- dialog body -->
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Waktu Penjemputan</h5>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Tanggal</label>
                                            <input type="text" id="date" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Jam</label>
                                            <input type="text" id="time" class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5>Alamat Penjemputan</h5>
                                <div class="form-group">
                                    <label for="">Lokasi Penjemputan</label>
                                    <textarea type="text" id="loc-jemput" class="form-control" readonly></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="">Lokasi Berdasarkan Map</label>
                                    <textarea type="text" id="loc-map" class="form-control" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div id="googleMap" style="width:100%;height:380px;"></div>
                        <div class="row mt-2">
                            <div class="col-md-12">
                                <h4>Data Sampah</h4>
                                <hr>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12 mb-5">
                                <label><b>Plastik Rp 3100/kg</b></label>
                                <div class="card h-100">
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td>
                                                    <label class="control-label"><b>Berat</b></label>
                                                    <input type="number" class="form-control"
                                                    id="berat_plastik" readonly style="width: 4em">
                                                </td>
                                                <td><label class="control-label"><b>Rp</b></label>
                                                    <input type="text" readonly  id="harga_plastik"
                                                        class="form-control">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-group foto">
                                            <img src="#" alt="" id="gambar1" width="100%" height="150px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mb-5">
                                <label><b>Kertas Rp 2500/kg</b></label>
                                <div class="card h-100">
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td>
                                                    <label class="control-label"><b>Berat</b></label>
                                                    <input type="number" class="form-control"
                                                    id="berat_kertas" readonly style="width: 4em">
                                                </td>
                                                <td><label class="control-label"><b>Rp</b></label>
                                                    <input type="text" readonly  id="harga_kertas"
                                                        class="form-control">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-group foto">
                                            <img src="#" alt="" id="gambar2" width="100%" height="150px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mb-5">
                                <label><b>Besi Rp 5000/kg</b></label>
                                <div class="card h-100">
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td>
                                                    <label class="control-label"><b>Berat</b></label>
                                                    <input type="number" class="form-control"
                                                    name="" id="berat_besi" readonly style="width: 4em">
                                                </td>
                                                <td><label class="control-label"><b>Rp</b></label>
                                                    <input type="text" readonly  id="harga_besi"
                                                        class="form-control">
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-group foto">
                                            <img src="#" alt="" id="gambar3" width="100%" height="150px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 col-xs-12 mb-5">
                                <label><b>/kg</b></label>
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                       <h3>JUAL</h3>
                                       <h3 id="total"></h3>
                                    </div>
                                    <div class="card-footer">
                                        <div class="form-group foto">
                                            <img src="#" alt="" id="gambar4" width="100%" height="150px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- dialog buttons -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>