<style>
  .sudeep {
    border: 1px solid #ccc;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 0 3px #ccc;
    margin: 8px 0;
}

</style>
<?php
//print_r($this->session->userdata['user']); die;

$id = $this->session->userdata['user']['id'];

$obj = new welcome_model();

$record = $obj->getsinglerow(TBL_USER, ['id' => $id]);
// print_r($My_Sponsor_User_ID);die;
// echo '<pre>';print_r($record);die;
?>

<div class="row " > 


            <div class="col-sm-12">
          <div class="card-box">
            <h4 class="m-t-0  headingStyle"><b>My Membership Information </b></h4>
            <div class="row">
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-success">
                      <i class="fa fa-user"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My User ID :</h4>
                      <h4 class="text-success"><?= $record->sponsor_id;?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-warning">
                      <i class="fa fa-user"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My Name :</h4>
                      <h4 class="text-warning"><?= $record->full_name;?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-danger">
                      <i class="fa fa-pencil"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My Registration Date:</h4>
                      <h4 class="text-danger"><?= $record->create_at;?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-info">
                      <i class="fa fa-dashboard"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My Activation Date:</h4>
                      <h4 class="text-info"> <?= $record->activation_date;?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-info">
                      <i class="fa fa-mobile"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My Mobile No :</h4>
                      <h4 class="text-info"><?= $record->mobile;?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-danger">
                      <i class="fa fa-tag"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My Initial  Plan : </h4>
                      <h4 class="text-danger">₹ <?php if($record->upgrade_plan!=NULL && $record->upgrade_plan!=0) { echo $record->upgrade_plan;}else{ echo '0 '.'N/A';} ?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-warning">
                      <i class="fa fa-ticket"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My Current Plan : </h4>
                      <h4 class="text-warning">₹ <?php if ($record->upgrade_plan != null && $record->upgrade_plan != 0) {echo $record->upgrade_plan;} else {echo '0 ' . 'N/A';}?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-lg-6 col-sm-6">
                <div class="widget-inline-box text-center">
                <h4 class="text-muted">My User ID : <?= $record->sponsor_id;?></h4>
                  <h4 class="text-muted">My Name : <?= $record->full_name;?></h4>
                  <h4 class="text-muted">My Registration Date: <?= $record->create_at;?></h4>
                  <h4 class="text-muted">My Activation Date: <?= $record->activation_date;?></h4>
             </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                   <h4 class="text-muted">My Mobile No : <?= $record->mobile;?></h4>
                    <h4 class="text-muted">My Initial  Plan: ₹ <?php if($record->upgrade_plan!=NULL && $record->upgrade_plan!=0) { echo $record->upgrade_plan;}else{ echo '0 '.'N/A';} ?></h4>
                    <h4 class="text-muted">My Current Plan : ₹ <?php if ($record->upgrade_plan != null && $record->upgrade_plan != 0) {echo $record->upgrade_plan;} else {echo '0 ' . 'N/A';}?></h4>
                    
                
              </div>
            </div> -->
            
          </div>
      </div>
      <div class="col-sm-12">
          <div class="card-box">
            <h4 class="m-t-0  headingStyle"><b> <img src="http://myinformation.in/myinformation/assets/front/images/as_910-512.png" height="auto" style="background:white" width="20px" alt=""> My Sponsor ID's And My Upper ID's Information  <img src="http://myinformation.in/myinformation/assets/front/images/as_910-512.png" height="auto" width="20px" style="background:white" alt=""> </b></h4>
            <div class="row">
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-success">
                      <i class="fa fa-user"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My Sponsor's User ID : </h4>
                      <h4 class="text-success"><?= $My_Sponsor_User_ID->sponsor_id;?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-warning">
                      <i class="fa fa-user"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My Sponsor's Name :</h4>
                      <h4 class="text-warning"><?= $My_Sponsor_User_ID->user_name;?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-danger">
                      <i class="fa fa-mobile"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My Sponsor's Mobile :</h4>
                      <h4 class="text-danger"><?= $My_Sponsor_User_ID->mobile;?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-info">
                      <i class="fa fa-arrow-circle-up"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My Upper's User ID: </h4>
                      <h4 class="text-info"> <?= $My_Sponsor_User_ID->sponsor_id;?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-info">
                      <i class="fa fa-user"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My Upper's Name : </h4>
                      <h4 class="text-info"><?= $My_Sponsor_User_ID->user_name;?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <div class="col-md-3">
                <div class="sudeep">
                <div class="row">
                  <div class="col-md-2">
                    <h4 class="text-danger">
                      <i class="fa fa-mobile"></i>
                    </h4>
                  </div>
                  <div class="col-md-10">
                    <div class="text-right">
                      <h4 class="text-muted">My Upper's Mobile :</h4>
                      <h4 class="text-danger"> <?= $My_Sponsor_User_ID->mobile;?></h4>
                    </div>
                  </div>
                </div>
                </div>
              </div>
            </div>
            <!-- <div class="row">
              <div class="col-lg-6 col-sm-6">
                <div class="widget-inline-box text-center">
                    <h4 class="text-muted">My Sponsor's User ID: <?= $My_Sponsor_User_ID->sponsor_id;?> </h4>
                    <h4 class="text-muted">My Sponsor's Name :<?= $My_Sponsor_User_ID->user_name;?> </h4>
                    <h4 class="text-muted">My Sponsor's Mobile No:<?= $My_Sponsor_User_ID->mobile;?> </h4>
                </div>
              </div>
              <div class="col-lg-6 col-sm-6">
                  <h4 class="text-muted">My Upper's User ID:<?= $My_Sponsor_User_ID->sponsor_id;?> </h4>
                  <h4 class="text-muted">My Upper's Name :<?= $My_Sponsor_User_ID->user_name;?> </h4>
                  <h4 class="text-muted">My Upper's Mobile No:<?= $My_Sponsor_User_ID->mobile;?>  </h4>
                </div>
              </div> -->
            </div>
          </div>
        
     

       <div class="col-sm-12">
          <div class="card-box">
            <h4 class="m-t-0  headingStyle"><b>Upgrade My Plan</b></h4>
            <div class="row">
              <div class="col-lg-12 col-sm-12">
                <div class="widget-inline-box text-center">
                 
                  <h4 class="text-muted">Upgrade My Plan : <img src="http://myinformation.in/myinformation/assets/front/images/download32.png" height="auto" style="background:;margin-left:px;margin-bottom: px;" width="50px" alt=""><a href="activation">Click Here  </a><img src="http://myinformation.in/myinformation/assets/front/images/download2.png" height="auto" style="background:black;margin-left:px;margin-bottom: px;" width="50px" alt=""></h4>                 
                </div>
              </div>
              
              </div>
            </div>
          </div>
          </div>
    <div class="row">
		<div class="col-sm-12">
			<div class="card-box" style="margin-bottom:45px">
				<h4 class="page-title"> Send My Refferal Link</i>: <button style="    margin-left: 150px;margin-bottom: 10px;"class="btn btn-pink btn-custom btn-rounded waves-effect waves-light"onclick="copyToClipboard('#p1')" href="<?=base_url('signup?id=') . $record->sponsor_id;?>" ><p id="p1">http://myinformation.in/myinformation/signup?id=<?=$record->sponsor_id;?></p></button><img src="http://myinformation.in/myinformation/assets/front/images/download.png" height="auto" style="background:black;margin-left:40px;margin-bottom: 15px;" width="50px" alt=""></h4>
				 <?=$this->session->flashdata('upgrade');?>
				<div class="col-md-12">
						<script>
						function copyToClipboard(element) {
						  var $temp = $("<input>");
						  $("body").append($temp);
						  $temp.val($(element).text()).select();
						  document.execCommand("copy");
						  $temp.remove();
						}

						</script>       
				</div>
			</div>
		</div>
	</div>

  </div>
<?PHP
if (isset($_GET['success'])) {
    echo "<script>window.onload=function(){ $.Notification.notify('success','top center','Successfully Login','Welcome to ayushvardhanm user panel please'); }</script>";
}
?>
 <script type="text/javascript">
   window.onload=function() {
       var clock;
        var lastdate = <?php //$lastdate;?>;
      clock = $('.clock').FlipClock({
            clockFace: 'DailyCounter',
            autoStart: false,
            callbacks: {
              stop: function() {
            $('.message').css('color','#7b0505');
                $('.message').html('Your reward timeline has been over so now you are eligible only for 50% reward.');
              }
            }
        });
      if(lastdate){
        clock.setTime(lastdate);
        clock.setCountdown(true);
        clock.start();
      }else{
        clock.stop();
      }
    }
  </script>
<?php

?>