<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Kyc Updation</h4>
        </div>
    </div>
</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="card-box">
						<h4 class="m-t-0 header-title"><b>Kyc Updation</b></h4>
						
						<div class="row">
						<form action="<?php echo site_url('user/submitKyc');?>" enctype="multipart/form-data" method="post">
							<div class="col-md-6">
								<div class="p-20">
								<?php if($profile['user']->cancel_cheque_status==0 || $profile['user']->cancel_cheque_status==3){ ?>
									<h5><b>Upload Cancelled Cheque</b></h5>
									<p class="text-muted m-b-15 font-13">
										Please upload cancel check carefully.
									</p>
									<input type="file" class="form-control" maxlength="25" name="cheque" />
									<?php } if($profile['user']->pancard_status==0 || $profile['user']->pancard_status==3) { ?>
									<div class="m-t-20">
										<h5><b>PAN Card No</b></h5>
										<p class="text-muted m-b-15 font-13">
											Please upload pan card number carefully.
										</p>
										<input type="text" maxlength="25" id="txtPanCard" name="pancard"  class="form-control" id="thresholdconfig" />
									</div>
									<div id="panResult"></div>
									<div class="m-t-20">
										<h5><b>Upload PAN Card</b></h5>
										<p class="text-muted m-b-15 font-13">
											Please upload pan card image
										</p>
										<input type="file" class="form-control" maxlength="25" name="pancardimg" id="moreoptions" />
									</div>
									<?php } ?>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="p-20">
								<?php if($profile['user']->doc_type_status==0 || $profile['user']->doc_type_status==3){ ?>
									<h5><b>Select Document</b></h5>
									<p class="text-muted m-b-15 font-13">
										Please select upload document type
									</p>
									<select onchange="doc(this.value);" name="document"  class="form-control">
										<option value="" >Select Document Type</option>
		                                <option value="PassPort">PassPort</option>
		                                <option value="AadharCard">AadharCard</option>
		                                <option value="DrivingLicence">DrivingLicence</option>
									</select>				
								<?php } ?>	
									<div class="m-t-20 passport" style="display: none;">
										<h5><b>Document Type (Passport)</b></h5>
										<p class="text-muted m-b-15 font-13">
										Please upload passport number
										</p>
										<input type="text" id="PanssPortID" class="form-control" maxlength="25" name="passport"/>
									</div>
									<div class="m-t-20 aadharCard" style="display:none;">
										<h5><b>Document Type (AadharCard)</b></h5>
										<p class="text-muted m-b-15 font-13">
										Please upload aadhar card number
										</p>
										<input type="text" id="aadharCard" name="aadharcard" class="form-control"/>
									</div>
									<div class="m-t-20 drivingLicence" style="display:none;">
										<h5><b>Document Type (Driving Licence)</b></h5>
										<p class="text-muted m-b-15 font-13">
										Please upload driving licence number
										</p>
										<input type="text" id="drivingLicence" name="drivinglicence" class="form-control"/>
									</div>
									<div class="m-t-20 drivingLicence" style="display:none;">
										<h5><b>Document Type (Driving Licence)</b></h5>
										<p class="text-muted m-b-15 font-13">
										Please upload driving licence image...
										</p>
										<input type="file" id="drivingLicence" name="doc_type_driving" class="form-control"/>
									</div>
									<div class="m-t-20 aadharCard" style="display:none;">
										<h5><b>Document Type (AadharCard)</b></h5>
										<p class="text-muted m-b-15 font-13">
										Please upload aadhar card Image
										</p>
										<input type="file" id="aadharCard" name="doc_type_aadharcard" class="form-control"/>
									</div>
									<div class="m-t-20 passport" style="display: none;">
										<h5><b>Document Type (Passport)</b></h5>
										<p class="text-muted m-b-15 font-13">
										Please upload passport image
										</p>
										<input type="file" id="PanssPortID" class="form-control" maxlength="25" name="doc_type_passport"/>
									</div>
									<div class="m-t-20">
									<h5><b>Click button</b></h5>
										<p class="text-muted m-b-15 font-13">
										Please click upload button for upload your kyc
										</p>
										<input type="submit" id="" name="submit" value="upload" class="btn btn-primary"/>
									</div>
								</div>
							</div>
							</form>
						</div>
					</div>
				</div>
		  </div>
		  <?php if(isset($_REQUEST['success']) && ($_REQUEST['success']!=""))		
	{							?>	
<script>				
	window.onload=function(){		
	$.Notification.notify('custom','top right','Profile successfully updated'); } 		
	</script>		
	<?php		
	}?>			
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
	$("#txtPanCard").on('keyup change blur',function(){	
		var check= /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;	
		if(check.test(this.value))	
		{		
		$("#panResult").css('color','green');	
		$("#panResult").html('correct');	
		$("#blah").show();
		}	else	{	
		$("#panResult").css('color','#ff0000');	
		$("#panResult").html('Incorrect Pan number');
	}}); 
	function Valid() {	
		var panVal =  document.getElementById("txtPanCard").value;		
		var regpan = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;		
		if(regpan.test(panVal)){		
		$("#panResult").css('color','green');		
		$("#panResult").html('correct');			
		return true;	
		}else{		
		$("#panResult").html('Invalid pan card number');	
		return false;	
		}  
	}
	function doc(vl)
	{
		
		if(vl=='PassPort')
		{
			$(".passport").show();
			$(".aadharCard").hide();
			$(".drivingLicence").hide();
		}
		else if(vl=='AadharCard')
		{
			$(".aadharCard").show();
			$(".passport").hide();
			$(".drivingLicence").hide();
		}
		else if(vl=='DrivingLicence')
		{
			$(".drivingLicence").show();
			$(".passport").hide();
			$(".aadharCard").hide();
		}
		else
        {
            $(".aadharCard").hide();
            $(".passport").hide();
            $(".drivingLicence").hide();
        }
		
	}
	</script>	