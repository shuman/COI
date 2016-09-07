<section id="payment_thankyou" class="hbox stretch">
	<section class="vbox">
		<section class="scrollable padder" style="background:#FFF;">
			<div class="row">
				<div class="col-lg-12">
					<h2>&nbsp;</h2>
					<div>
						<div class="alert alert-success">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<i class="fa fa-ok-sign"></i><strong><?php echo lang('thank_you');?>!</strong> <?php echo lang('payment_thankyou');?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<p><strong><?php echo lang('payment_thankyou3');?>:</strong></p>
					<table width="500" class="table m-b-none" style="max-width:400px;">
						<tr>
							<td>Payment Method:</td>
							<td><?php echo ($payment_method == 'paypal') ? 'PayPal' : $payment_method;?></td>
						</tr>
						<?php if(isset($payment_amount)): ?>
						<tr>
							<td>Amount:</td>
							<td><?php echo $payment_amount;?></td>
						</tr>
						<?php endif; ?>
						<?php if(isset($transaction_id)): ?>
						<tr>
							<td>Transaction ID:</td>
							<td><?php echo $transaction_id;?></td>
						</tr>
						<?php endif; ?>
						<tr>
							<td colspan="2">&nbsp;</td>
						</tr>
					</table>
					<p><?php echo lang('payment_thankyou2');?></p>
					<p><?php echo lang('payment_thankyou4');?></p>
					<p><br />Thanking you,<br />
					<strong>Team Cut Out Image || Team</strong><br />
					<a href="/message">Contact Support</a> | <a href="https://help.cutoutimage.com">Help Center</a>
					</p>
				</div>
			</div>
		</section>
	</section>
</section>