                        <div class="row">

                            <div class="col-md-4 col-lg-4">

                                <div class="profile-detail card-box">

                                    <div>

                                        <img src="<?php echo base_url('profile/').$profile->image; ?>" class="img-circle" alt="profile-image">



                                        <ul class="list-inline status-list m-t-20">

                                        </ul>

			

                                        <hr>

                                        <h4 class="text-uppercase font-600">About Me</h4>

                                        <p class="text-muted font-13 m-b-30">

                                        </p>



                                        <div class="text-left">

                                            <p class="text-muted font-13"><strong>Full Name:</strong> <span class="m-l-15"><?= $profile->full_name ?></span></p>
											 <p class="text-muted font-13"><strong>User Code :</strong><span class="m-l-15"><?= $profile->user_name; ?></span></p>
                                            <p class="text-muted font-13"><strong>Sponsor ID :</strong><span class="m-l-15"><?= $profile->sponsor_id; ?></span></p>

											<p class="text-muted font-13"><strong>Placement:</strong> <span class="m-l-15"><?= ucfirst($profile->position); ?></span></p>

											<p class="text-muted font-13"><strong>Contact:</strong> <span class="m-l-15"><?= $profile->mobile; ?></span></p>

											

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="col-lg-8 col-md-8">

                                

                                <div class="row"> 

                            <div class="col-md-12"> 

                                <div class="panel-group" id="accordion-test-2"> 

                                    <div class="panel panel-default"> 

                                        <div class="panel-heading"> 

                                            <h4 class="panel-title"> 

                                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="javascript:;" aria-expanded="false" class="collapsed">

                                                   Update Profile

                                                </a> 

                                            </h4> 
											
                                        </div> 
										<span style="color:green;font-size:16px;fond-famity:bold;text-align:right"><?= $this->session->flashdata('success');?></span>
                                        <div id="collapseOne-2" class="panel-collapse collapse in"> 

                                            <div class="panel-body">

                                                <div class="col-md-10">

														<form class="form-horizontal" role="form" method="post"  enctype="multipart/form-data">                                    

															<div class="form-group">

																<label class="col-md-4 control-label">Full Name</label>

																<div class="col-md-8">

																	<input type="text" name="full_name" class="form-control" value="<?php echo $profile->full_name; ?>">

																	<span class="text-danger"><?= form_error('full_name'); ?></span>

																</div>

															</div>

															

															<div class="form-group">

																<label class="col-md-4 control-label" for="example-email">Email</label>

																<div class="col-md-8">

																	<input type="text" id="example-email" name="email" class="form-control" placeholder="Email" value="<?php echo $profile->email; ?>">

																	<span class="text-danger"><?= form_error('email'); ?></span>

																</div>

															</div>

															<div class="form-group">

																<label class="col-md-4 control-label" for="example-email">Contact Number</label>

																<div class="col-md-8">

																	<input type="text" id="example-email" name="mobile" class="form-control" placeholder="Contact Number" value="<?php echo $profile->mobile; ?>">

																	<span class="text-danger"><?= form_error('mobile'); ?></span>

																</div>

															</div>

															<div class="form-group">

																<label class="col-md-4 control-label" for="example-email">Gender</label>

																<div class="col-md-8">

																	<select name="gender" class="form-control">

																		<option value="">-Select Gender-</option>

																		<option value="male" <?php if($profile->gender=='male') { echo "selected= selected "; } ?>>Male</option>

																		<option value="female" <?php if($profile->gender=='female') { echo "selected= selected "; } ?>>Female</option>

																	</select>

																	<span class="text-danger"><?= form_error('gender'); ?></span>

																</div>

															</div>

															<div class="form-group">

																<label class="col-md-4 control-label" for="example-email">Image</label>

																<div class="col-md-8">

																	<input type="file" id="example-email" name="image" class="form-control">

																																	</div>

															</div>

															<button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>                                                                      

													  

														</form>

												</div>

                                            </div> 

                                        </div> 

                                    </div>

                                    <!-- <div class="panel panel-default"> 

                                        <div class="panel-heading"> 

                                            <h4 class="panel-title"> 

                                                <a data-toggle="collapse" data-parent="#accordion-test-2" href="#collapseTwo-2" class="collapsed" aria-expanded="false">

                                                    Change Password

                                                </a> 

                                            </h4> 

                                        </div> 

                                        <div id="collapseTwo-2" class="panel-collapse collapse"> 

                                            <div class="panel-body">

                                                <div class="col-md-10">

														<form class="form-horizontal" role="form" method="post" action="<?php echo site_url('user/showProfile/password');?>">                                    

															<div class="form-group">

																<label class="col-md-4 control-label">Old Password</label>

																<div class="col-md-8">

																	<input type="password" name="old_password" class="form-control" value="<?php  ?>">

																</div>

															</div>

															<div class="form-group">

																<label class="col-md-4 control-label">New Password</label>

																<div class="col-md-8">

																	<input type="password" name="new_password" class="form-control" value="<?php  ?>">

																</div>

															</div>

															<div class="form-group">

																<label class="col-md-4 control-label" for="example-email">Confirm Password</label>

																<div class="col-md-8">

																	<input type="password" id="example-email" name="con_password" class="form-control"  value="<?php ?>">

																</div>

															</div>

															<button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>                                                                      

													  

														</form>

												</div>

                                            </div> 

                                        </div> 

                                    </div>  -->

									

									

                                </div> 

                            </div>

                        </div>

                            </div>



                        </div>

		

				<?php 

			

			if(!empty($this->session->flashdata('success'))){?>

				<script>

					

				$.Notification.notify($this->session->flashdata('class'),'top right',$this->session->flashdata('success'));  

				</script>

			<?php } ?>

			



			

			