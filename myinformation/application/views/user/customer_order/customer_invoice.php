
						<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">

                <h2 style="color:white;"><b>Order Invoice <b></h2>
            </div>
            <hr>
            <div class="row">
                <div class=" col-md-3 col-lg-3 ">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Billing Address</div>
                        <div class="panel-body">
                            <strong><?php $cust_info=unserialize($order->customer_info); echo $cust_info['first_name']." ".$cust_info['last_name']; ?></strong><br>
                           <?= $cust_info['street']; ?><br>
							 <?= $cust_info['city']; ?><br>
						 <?= $cust_info['state']; ?><br>
							India-<strong> <?= $cust_info['zipcode']; ?><br></strong>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Payment Information</div>
                        <div class="panel-body">
                            <strong>Payment Mode:</strong> Online<br>
							<strong>Order No:</strong><?php echo $order->order_number; ?><br>
                            </div>
                    </div>
                </div>

                <div class=" col-md-3 col-lg-3">
                    <div class="panel panel-default height">
                        <div class="panel-heading">Order Preferences</div>
                        <div class="panel-body">
                            <strong>Sponser Id:<?php $order->sponsor_id; ?></strong> <br>

							<strong>Invoice Date:<?= $order->order_time; ?></strong>
												<br><br>
                           </div>
                    </div>
                </div>
                <div class=" col-md-3 col-lg-3 ">
                    <div class="panel panel-default height">
                        <div class="panel-heading"></div>
                        <div class="panel-body">

                            <br>
                           <img src="<?php echo base_url('/assets/front/images/logo.png'); ?>" alt="Ayushvardhanam" width="100%" ;>
							<br>
                            <!--strong>India-</strong--><br>
                        </div>
                    </div>
                </div>
            </div-->
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
						       <tr>
									<th>S.No</th>
									<th>Product Name</th>
									<th>B.V.</th>
									<th>MRP(₹)</th>
									<th>Quantity</th>
									<th>Unit Price(₹)</th>
									<th>GST(%)</th>
									<th>Selling Price (D.P.)</th>
							   </tr>
						    </thead>
                            <tbody>
							<?php $total=0; $i=1; $product_info=unserialize($order->product_info);
							     foreach($product_info as $row){
							?>
							     <tr>
								 <td><?php echo $i++ ?></td>
                                    <td> <?=  $row['name'].'('. $row['sku'].')'; ?></td>
									 <td class="text-center"><?=  $row['bussiness_volume']; ?></td>
                                    <td class="text-center"><?=  $row['mrp']; ?></td>
									 <td class="text-center"><?=  $row['qty']; ?></td>
									 <td class="text-center"><?=  $row['unit_price']; ?></td>
									 <td class="text-center"><?=  $row['tax']; ?></td>
                                    <td class="text-center"><?=  $row['sp']; ?></td>

                            <?php if(!empty($row['combo'])) {  foreach($row['combo'] as $cm): ?>
															<tr style="font-size:11px;">
																	<td></td>
																	<td><?= $cm['product_name']." (". $cm['sku'].")"; ?></td>
																	<td></td><td></td>
																	<td align="center"><?= $cm['qty']; ?></td>
															</tr>
														<?php endforeach; } ?>

                                </tr>
								<?php } ?>
							    <tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>

                                    <td class="highrow text-center"><strong>Subtotal(₹)</strong></td>
                                    <td class="highrow text-right"><?php echo $order->price; ?></td>
									<td class="highrow"></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
																		

                                    <td class="emptyrow text-center"><strong>Shipping(₹)</strong></td>
                                    <td class="emptyrow text-right">00.00</td>
									<td class="emptyrow"></td>
                                </tr>
                                <tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>

                                    <td class="emptyrow text-center"><strong>Total(₹)</strong></td>
                                    <td class="emptyrow text-right"><?php echo $order->price; ?></td>
									 <td class="emptyrow"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.height {
    min-height: 200px;
}

.icon {
    font-size: 47px;
    color: #5CB85C;
}

.iconbig {
    font-size: 77px;
    color: #5CB85C;
}

.table > tbody > tr > .emptyrow {
    border-top: none;
}

.table > thead > tr > .emptyrow {
    border-bottom: none;
}

.table > tbody > tr > .highrow {
    border-top: 3px solid;
}
</style>
