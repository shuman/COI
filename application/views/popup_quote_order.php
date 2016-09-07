<script type="text/javascript">
	function details(quote_id){
		var url = ajax_url + '/popup_quote_details/?quote_id=' + quote_id;
		$("#ajaxModal").load(url);
		return true;
	}
</script>
<div class="modal-dialog">
  	<div class="modal-content">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title"><i class="fa fa-check-circle"></i> <strong>Thank You!</strong> You have accepted the quotation.</h4>
	    </div>
	    <div class="modal-body">
	    	<div class="row">
	    		<div class="col-sm-12">
					<div class="alert alert-warning alert-block">
						<h4 class="text-center" style="margin: 10px 0"><i class="fa fa-exclamation-circle"></i> Do you want to place the quote as order?</h4>
					</div>
					<br>
					<button class="btn btn-sm btn-danger pull-left" data-dismiss="modal">No (Later)</button>
					<a href="<?php echo site_url('/place_order_from_quote/'.$quote_id);?>" class="btn btn-sm btn-success pull-right">Yes (Proceed)</a>
	    		</div>
	    	</div>
		</div>
	</div>
</div>

