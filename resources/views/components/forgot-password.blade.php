<!-- Modal login -->
<div id="modal-forgot-password" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Forgot Password</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
               <div id="tec"></div>
                <form id="form-forgot-password">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Email">
                    </div>
                    <div class="modal-footer">
                        <div class="submit-button text-center">
                            <button class="btn btn-success" id="forgot-password" type="submit"
                            data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Loading ..."
                        >Forgot Password</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>