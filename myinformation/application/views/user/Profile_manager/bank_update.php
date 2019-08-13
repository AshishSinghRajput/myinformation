<div class="row">
			
								<div class="card-box">
									<h4 class="m-t-0 header-title"><b>Bank Details</b></h4>
									
		                                        
									<?php echo form_open('user/neftDetail'); ?>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="userName">Bank Name</label>
											<input type="text" class="form-control" name="bank_name" value="<?php  if(isset($bank['user']->bank)) { echo $bank['user']->bank; } ?>">
										</div>
										<div class="form-group">
										<label for="pass1">IFSC Code</label>
											<input type="text" class="form-control" name="ifsc_code" value="<?php if(isset($bank['user']->ifsc_code)) {echo $bank['user']->ifsc_code; } ?>">
											
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="emailAddress">Account Number</label>
											<input type="text" id="example-email" value="<?php if(isset($bank['user']->account_number)) {echo $bank['user']->account_number; } ?>" name="account_number" class="form-control" >
										</div>
										<div class="form-group">
											<label for="passWord2">Branch</label>
											<input type="text" name="branch" value="<?php if(isset($bank['user']->branch)) { echo $bank['user']->branch;} ?>" class="form-control" >
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="passWord2">Branch City Name</label>
											<input type="text" name="branch_city" value="<?php  if(isset($bank['user']->bank_city)) { echo $bank['user']->bank_city; } ?>" class="form-control">
										</div>
											
										<div class="form-group">
										<label for="passWord2">Nominee Relation</label>
											<input type="text" name="relation" value="<?php  if(isset($bank['user']->relation)) { echo $bank['user']->relation; }  ?>" class="form-control" >
											
										</div>
									</div>
									<div class="col-lg-6">
										<div class="form-group">
											<label for="passWord2">Nominee</label>
											<input type="text"  name="nominee" value="<?php if(isset($bank['user']->nominee)) { echo $bank['user']->nominee; } ?>" class="form-control">
										</div>
										<div class="form-group">
											<label for="passWord2">Branch Nominee Age</label>
											<input type="text" name="nominee_age" value="<?php if(isset($bank['user']->nominee_age)) { echo $bank['user']->nominee_age; } ?>" class="form-control" >
										</div>
									</div>
										<div class="form-group text-right m-b-0">
											<button class="btn btn-primary waves-effect waves-light" type="submit">
												Submit
											</button>
											
										</div>
										
								<?php echo form_close(); ?>
								</div>
						
	</div>
	<?php 
	$uri=$this->uri->segment(3);
	if($uri=='success')
	{
		?>
		<script>
					window.onload=function(){
					$.Notification.notify('custom','top right','Bank  details successfully updated'); } </script>
		<?php
	}
	else
	{
		//redirect('front/notfound');
	}	
	
	?>