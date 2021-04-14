<!-- Modal -->

<div class="modal fade" id="mapsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="exampleModalLabel">Geser Marker ke Lokasi Anda</h6>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
          <input type="text" class="form-control search-address mb-2" id="search-address"  name="search-address" placeholder="Cari Alamat">
          <div id="map" style=" height: 70vh; width: 100%"></div>
          <div class="row mt-3">
            <div class="col-md-5">
                <div class="form-group">
                  <label for="">Latitude</label>
                  <input type="text" name="lat" id="input-lat" class="form-control" readonly>
                </div>
                <div class="form-group">
                  <label for="">longitude</label>
                  <input type="text" name="lng" id="input-lng" class="form-control" readonly>
                </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="address" id="input-address" class="form-control" readonly style="height: 125px; width: 100%"></textarea>
              </div>
            </div>
          </div>
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" id="btn-ok" class="btn btn-primary">Pilih</button>
        </div>
      </div>
    </div>
  </div>