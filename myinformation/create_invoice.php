<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4>Invoice</h4>
			</div> 
			<div class="panel-body">
				<div class="clearfix">
					<div class="pull-left">
						<h4 class="text-right"><img src="<?= base_url(); ?>assets/front/images/logo.jpg" alt="logo" width='150px'></h4>
						
					</div>
					
					<div class="pull-right">
						<h4>Invoice # <?= $IdByOrder->order_no; ?> <br>
							<strong><?= $IdByOrder->order_date; ?></strong>
						</h4>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						
						<div class="col-md-4 pull-left m-t-30">
							<address>
								<strong>Address</strong><br>
								102 Riddhi-Siddhi Building,  <br>
								Sector-53, Vijay Nagar,Indore- 452010<br>
								<abbr title="Phone">Phone:</abbr>07415203735
								</address>
						</div>
						<div class="col-md-4 pull-left m-t-30">
							<address>
								<strong>Billing Address</strong><br>
								<?= $IdByOrder->address; ?><br>
								<?= $IdByOrder->city; ?> <?= $IdByOrder->state; ?>,<?= $IdByOrder->zip_code; ?><br>
								<abbr title="Phone">Phone:</abbr> <?= $IdByOrder->official_no; ?>
								</address>
						</div>
						<div class="col-md-4 pull-right m-t-30">
							<p><strong>Order Date/ Time: </strong> <?= $IdByOrder->order_date; ?></p>
							<p class="m-t-10"><strong>Order Status: </strong> <span class="label label-pink">
								<?php 
									if($IdByOrder->order_status ==0){echo 'Pending';}
									elseif($IdByOrder->order_status ==1){echo 'In-Proccess';}
									elseif($IdByOrder->order_status ==2){echo 'Received';}
								?>
							</span></p>
							<!-- <p class="m-t-10"><strong>Order ID: </strong> #123456</p> -->
						</div>
					</div>
				</div>
				<div class="m-h-50"></div>
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table m-t-30">
								<thead>
									<tr><th>#</th>
									<th>Item</th>
									<th>Quantity</th>
									<th>Product Price</th>
									<th>Total</th>
								</tr></thead>
								<tbody>
									<tr>
										<td>1</td>
										<td><?= $IdByOrder->product_name; ?></td>
										<td><?= $IdByOrder->deliver_qnt; ?></td>
										<td><i class="fa fa-inr"></i> <?= $IdByOrder->dealer_product_price; ?></td>
										<td><?= $IdByOrder->deliver_qnt * $IdByOrder->dealer_product_price;?></td>
									</tr>
									
									<!-- <tr>
										<td>4</td>
										<td>LCD</td>
										<td>Lorem ipsum dolor sit amet.</td>
										<td>3</td>
										<td>$300</td>
										<td>$900</td>
									</tr>
									<tr>
										<td>5</td>
										<td>Mobile</td>
										<td>Lorem ipsum dolor sit amet.</td>
										<td>5</td>
										<td>$80</td>
										<td>$400</td>
									</tr> -->
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<div class="row" style="border-radius: 0px;">
					<div class="col-md-3 col-md-offset-9">
						<p class="text-right"><b>Sub-total:</b><i class="fa fa-inr"></i> <?= $IdByOrder->deliver_qnt * $IdByOrder->dealer_product_price;?></p>
						<p class="text-right">Discout: </p>
						<p class="text-right">Shipping Charge: 0</p>
						<hr>
						<h3 class="text-right"><i class="fa fa-inr"></i> <?= $IdByOrder->deliver_qnt * $IdByOrder->dealer_product_price;?> (Including GST)</h3>
					</div>
				</div>
				<hr>
				<div class="hidden-print">
					<div class="pull-right">
						<a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
						<a href="#" class="btn btn-primary waves-effect waves-light">Submit</a>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>

                    