<script type="text/javascript">
    function accept_tos() {
        $("input[name=check]").prop('checked', true);
        $('form').submit();
    }
</script>
<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Terms of Service</h4>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-warning alert-block m-b-lg">
                        <p>You must agree to our "TOS". Click <strong>Agree</strong> to accept and continue or <strong>Cancel</strong> otherwise.</p>
                    </div>

                    <div class="tos_wrapper m-b-lg bg-light padder">
                        <?php $this->load->view('raw_tos'); ?>
                    </div>
                    <button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-sm btn-success pull-right" data-dismiss="modal" onclick="accept_tos()">Agree</button>
                </div>
            </div>
        </div>
    </div>
</div>