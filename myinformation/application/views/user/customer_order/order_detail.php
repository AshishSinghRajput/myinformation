<style>
.form-table img{
    margin-top: 0px;
    width: 100%;
    height: 100%;
    margin-left: -15px;
}
.form-control1 {
    background-color: #FFFFFF;
    border: 1px solid #E3E3E3;
    border-radius: 4px;
    color: #565656;
    padding: 7px 12px;
    height: 63px;
    max-width: 100%;
    -webkit-box-shadow: none;
    box-shadow: none;
    -webkit-transition: all 300ms linear;
    -moz-transition: all 300ms linear;
    -o-transition: all 300ms linear;
    -ms-transition: all 300ms linear;
    transition: all 300ms linear;
}

</style>
<div class="page-wrapper">
<div class="container-fluid">
	<!-- Title -->
	<!-- Row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="form-wrap">

								<h3 class="txt-dark capitalize-font"><i class="zmdi zmdi-info-outline mr-10"></i>Order <small>Details</small></h3>
								<hr class="light-grey-hr"/>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- /Row -->

	</div>
	<!-- /Footer -->

</div>

<div class="page-wrapper">
<div class="container-fluid">
	<!-- Title -->
	<!-- Row -->
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default card-view">
				<div class="panel-wrapper collapse in">
					<div class="panel-body">
						<div class="form-wrap">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  form-table back-col ng-pristine ng-valid ng-valid-required" ng-form="EditProfile" novalidate="">
										<form action="<?php echo current_url();?>" method="get">
										  <div class="col-lg-6">
											<div class="input-group">
											  <span class="input-group-btn">
												<button type="submit" class="btn btn-secondary" >Go!</button>
											  </span>
											 		<input type="text" name="search" value="<?php if(isset($_REQUEST['search'])){ echo $_REQUEST['search']; } ?>" class="form-control" placeholder="Search for...">
											  <span class="input-group-btn">
												<a href="<?php echo site_url('user/order_detail'); ?>" type="submit" class="btn btn-secondary btn-success" >Clear</a>
											  </span>
											</div>
										   </div>
									    </form>
								</div>
							</div>
                            <div class="table-responsive">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12  form-table back-col ng-pristine ng-valid ng-valid-required" ng-form="EditProfile" novalidate="">

										<table class="table">
											<thead>
											  <tr>
												<th>S.No</th>
												<th>Order No.</th>
												<th>Amount</th>
												<th>Email Id</th>
												<th>Product info</th>
												<th>Customer info</th>
												<th>Order Date</th>
												<th>Order Status</th>
											  </tr>
											</thead>
											<tbody>

											<?php $i=1;  foreach ($orders as $row):  ?>
											  <tr class="success">
												 <td><?php echo $i++; ?></td>
												<td><?= $row->order_number; ?></td>
												<td><?= $row->price; ?></td>
												<td><?php echo $row->email; ?></td>
												<td> <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal<?= $row->order_id; ?>">Product Info</button></td>
												<td>
											<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#customer<?= $row->order_id; ?>">Customer Info</button>
												</td>
												<td><?php echo $row->order_time; ?></td>
												<td><?php if($row->order_status==0){ echo "<span class='label label-danger'>Pending</span>";} elseif($row->order_status==1) { echo "<span class='label label-warning'>Packed</span>"; } elseif($row->order_status==2) { echo "<span class='label label-info'>Shipped</span>"; } else { echo "<span label label-primary>Delivered</span>";} ?></td>
												<td><a href="<?php echo site_url('user/customer_invoice/').$row->order_id;   ?>" class="btn btn-info btn-xs" >Invoice</a></td>


											  </tr>

						<!--==============Product info modal===================================================================  -->
								<div class="modal fade" id="myModal<?= $row->order_id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true" >
								  <div class="modal-dialog" style="width:70%;">

								  <div class="modal-content">
								   <div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
									<h4 class="modal-title custom_align" id="Heading">Dispatched-</h4>
								   </div>
								   <div class="row" style="background:#d2e6d2;">

									<div class="col-md-2">
									<h4>Product Image</h4>
									</div>
									<div class="col-md-2">
									<h4>Product Name</h4>
									</div>
									<div class="col-md-2">
									<h4>Product Price</h4>
									</div>
									<div class="col-md-2">
									<h4>Product Qty</h4>
									</div>
									<div class="col-md-2">
									<h4>Product code(sku no)</h4>
									</div>
									  <div class="col-md-2">
									<h4>Tax(Inc.)</h4>
									</div>

								   </div>

								   <div class="row">

									<div class="col-md-2">
									  <?php

									  foreach (unserialize($row->product_info) as $pos_data){?>
									  <img src="<?php echo base_url('assets/images/products/thumbnail/').$pos_data['picture']; ?>" width="30px" height="20px" >
									  <?php } ?>
									</div>

									<div class="col-md-2">
									  <?php

									  foreach (unserialize($row->product_info) as $pos_data){ ?>
									   <input type="text" class="form-control1" name="sku[]" value="<?php echo $pos_data['name']; ?>" style="padding:0px;"  readonly required >
									  <?php } ?>
									</div>
									<div class="col-md-2">
									  <?php

									  foreach (unserialize($row->product_info) as $pos_data){
									
										  ?>
									   <input type="text" class="form-control1" name="qty[]"  value="<?php echo $pos_data['unit_price']; ?>" style="padding:0px;"  readonly required>
									  <?php } ?>
									</div>
									 <div class="col-md-2">
									  <?php

									  foreach (unserialize($row->product_info) as $pos_data){?>
									   <input type="text" class="form-control1" name="qty[]"  value="<?php echo $pos_data['qty']; ?>" style="padding:0px;"  readonly required>
									  <?php } ?>
									</div>
									<div class="col-md-2">
									  <?php

									  foreach (unserialize($row->product_info) as $pos_data){?>
									   <input type="text" class="form-control1" name="dispatch_qty[]" value="<?php echo $pos_data['sku']; ?>" style="padding:0px;"    required>
									  <?php } ?>
									</div>
									<div class="col-md-2">
									  <?php

									  foreach (unserialize($row->product_info) as $pos_data){?>
									   <input type="text" class="form-control1" name="pending_qty[]" value="<?php echo $pos_data['tax'];?>" style="padding:0px;"  required readonly>
									  <?php } ?>
									</div>
								</div>



							   <!--div class="modal-footer ">

								<button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
							   </div-->
							  </div>

							 </div>
							</div>
						<!--======================================Product info modal End===================================================================  -->
						<!--==============Customer info modal===================================================================  -->
						   <div class="modal fade" id="customer<?= $row->order_id; ?>" role="dialog">
							<div class="modal-dialog">

							  <!-- Modal content-->
							  <div class="modal-content">
								<div class="modal-header">
								  <button type="button" class="close" data-dismiss="modal">&times;</button>
								  <h4 class="modal-title">Modal Header</h4>
								</div>
								<div class="modal-body">
								  <div class="row" >
									 <div class="col-md-12" >
									 <ul>
										 <li>Name:<?php $cust_info=unserialize($row->customer_info); echo  $cust_info['first_name']." ".$cust_info['last_name'] ; ?></li>
										 <li>Street:<?php echo  $cust_info['street'];  ?></li>
										 <li>City:<?php echo  $cust_info['city'];  ?></li>
										 <li>State:<?php echo  $cust_info['state'];  ?></li>
										 <li>Zipcode:<?php echo  $cust_info['zipcode'];  ?></li>
										 <li>phone:<?php echo  $cust_info['phone'];  ?></li>
										 <ul>
									 </div>

								  </div>
								</div>
								<div class="modal-footer">
								  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								</div>
							  </div>

							</div>
						  </div>
						<!--==============Customer info modal End===================================================================  -->

									<?php endforeach; ?>

								</tbody>
							</table>
						  <?php echo $this->pagination->create_links(); ?>
						</div>

						</div>
							</div>






						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		<!-- /Row -->

	</div>
	<!-- /Footer -->

</div>
