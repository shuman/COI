<div class="modal-dialog">
  <div class="modal-content">
	  <form action="" method="post" role="form">
	    <div class="modal-header">
	      <button type="button" class="close" data-dismiss="modal">&times;</button>
	      <h4 class="modal-title text-success">User Details</h4>
	    </div>
	    
	    <div class="modal-body">

	        <?php
	        if($success){
		        // var_dump($users_data);
		        ?>

		    	<table class="table table-striped m-b-none">
						<thead>
							<tr>
								<th colspan="2">User Details for:&nbsp; <?php echo $users_data->username; ?></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>User ID</td>
								<td><?php echo $users_data->user_id;?></td>
							</tr>
							<tr>
								<td>User Name</td>
								<td> <?php echo $users_data->username; ?></td>
							</tr>
							<tr>
								<td>User Type</td>
								<td><?php echo ($users_data->role_id == 1 ? "Administrator" : ($users_data->role_id == 2 ? "User" : "Unknown")); ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td><?php echo $users_data->email; ?></td>
							</tr>
							<tr>
								<td>Total Orders</td>
								<td><?php echo $order_details->count_total_orders_by_id; ?></td>
							</tr>
							<tr>
								<td>Pending Orders</td>
								<td><?php echo $order_details->count_pending_orders; ?></td>
							</tr>
							<tr>
								<td>Completed Orders</td>
								<td><?php echo $order_details->count_completed_orders; ?></td>
							</tr>
							<tr>
								<td>Cancelled Orders</td>
								<td><?php echo $order_details->count_cancelled_orders; ?></td>
							</tr>
							<tr>
								<td>Reviewed Quote</td>
								<td><?php echo $order_details->count_reviewed_quote; ?></td>
							</tr>
							<tr>
								<td>Waiting Review</td>
								<td><?php echo $order_details->count_waiting_review; ?></td>
							</tr>
							<tr>
								<td>Accepted Quotes</td>
								<td><?php echo $order_details->count_accepted_quotes; ?></td>
							</tr>
							
							<tr>
								<td>Rejected Quotes</td>
								<td><?php echo $order_details->count_rejected_quotes; ?></td>
							</tr>
							<tr>
								<td>Paid Invoices</td>
								<td><?php echo $order_details->count_paid_invoices; ?></td>
							</tr>
							<tr>
								<td>Unpaid Invoices</td>
								<td><?php echo $order_details->count_unpaid_invoices; ?></td>
							</tr>
							
							<tr>
								<td>Total Due</td>
								<td><?php echo "$".$order_details->total_due; ?></td>
							</tr>

							<tr>
								<td>Activated</td>
								<td><?php echo ($users_data->activated == 1) ? "Activated" : "Inactive"  ?></td>
							</tr>
							<tr>
								<td>Created</td>
								<td><?php echo $users_data->created; ?></td>
							</tr>
							
							<tr>
								<td>Phone</td>
								<td><?php echo $users_data->phone; ?></td>
							</tr>
							<tr>
								<td>Country</td>
								<td><?php echo $users_data->country; ?></td>
							</tr>
							<tr>
								<td>Website</td>
								<td><?php echo $company_data->website; ?></td>
							</tr>
							<tr>
								<td>Last Login</td>
								<td><?php echo $users_data->last_login; ?></td>
							</tr>
							<tr>
								<td>last Ip</td>
								<td><?php echo $users_data->last_ip; ?></td>
							</tr>
							<tr>
								<td>Modified</td>
								<td><?php echo $users_data->modified; ?></td>
							</tr>
							
					</tbody>
				</table>
		        <?php
	        }
	        else{
				echo 'Invalid quote ID';
	        }
	        ?>
	    </div>
	    <div class="modal-footer">
	      <input type="button" class="btn btn-danger" data-dismiss="modal" value="Close" />
	    </div>
    </form>
  </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->