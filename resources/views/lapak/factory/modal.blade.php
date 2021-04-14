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
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" id="nameof_factory" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">No Hp</label>
                                    <input type="text" id="phone_factory" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Foto</label>
                                    <img id="photo" width="100" height="100">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Owner</label>
                                    <input type="text" id="owner_factory" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Email</label>
                                    <input type="text" id="email_factory" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Alamat</label>
                                    <textarea id="address_factory" class="form-control" readonly></textarea>
                                </div>
                            </div>
                        </div>
                        <div id="googleMap" style="width:100%;height:380px;"></div>
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