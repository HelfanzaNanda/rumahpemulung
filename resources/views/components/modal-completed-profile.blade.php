<!-- set up the modal to start hidden and fade in and out -->
<div id="modal-completed-profile" class="modal fade" data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- dialog body -->
            <div class="modal-body">
                {{-- <button type="button" class="close" data-dismiss="modal">&times;</button> --}}
                <h4>silakhan lengkapi profile anda dahulu !</h4>
            </div>
            <!-- dialog buttons -->
            <div class="modal-footer">
                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button> --}}
                <a href="{{ route('client.profile') }}" type="button" class="btn btn-ya btn-primary">Oke</a>
            </div>
        </div>
    </div>
</div>