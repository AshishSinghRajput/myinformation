<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
        <?php if($profile['user']->kyc_status==0 || $profile['user']->kyc_status==3){ ?>
           <a href="<?php echo site_url('user/submitKyc/kyc');?>"><button class="btn btn-success">Add KYC</button></a>
          
           <?php } elseif($profile['user']->kyc_status==1){ echo '<button class="btn btn-danger">Pending</button>';}  elseif($profile['user']->kyc_status==2) { echo '<button class="btn btn-primary">Approved</button>'; } if($profile['user']->kyc_status==0){ ?>
           <div class="pull-right"><a href="<?= site_url('user/checkKycstatus'); ?>"><button class="btn btn-success">Click for verification</button></a></div>
           <?php } else { echo "<div class='pull-right' style='margin-top:0px;'><button class='btn btn-success disabled'>Click for verification</button></div> <script> window.onload=function() { $.Notification.notify ('error','top-right','Sorry! you can`t access verify link','Please upload whole document for kyc verification') } </script>";  } ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="text-dark header-title m-t-0 m-b-30">Pan Card <?php if($profile['user']->pancard_status==1){ echo "<div style='color:#ff0000;'>Pan card pending</div>"; } elseif($profile['user']->pancard_status==2){ echo "<div style='color:green;'>Pan card approved</div>"; } elseif($profile['user']->pancard_status==3){ echo "<div style='color:red;'>Pan card rejected please reload image.</div>"; } ?></h4>

            <div class="widget-chart text-center">
                <div id="sparkline3"></div>
                <ul class="list-inline m-t-15">
                    <img src="<?= base_url("document/").$profile['user']->pan_card ;?>" style="max-width:100%;"/>
                </ul>
                <ul>
                    <h3><?= $profile['user']->pan_number; ?></h3>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card-box">
            <h4 class="text-dark  header-title m-t-0 m-b-30"><?= $profile['user']->doc_type; ?> <?php if($profile['user']->doc_type_status==1){ echo  "<div style='color:#ff0000'>".$profile['user']->doc_type." pending </div>";} elseif($profile['user']->doc_type_status==2){ echo "<div style='color:green'>".$profile['user']->doc_type." approved</div>"; } elseif($profile['user']->doc_type_status==3){ echo "<div style='color:red;'>". $profile['user']->doc_type."rejected please reload image.</div>"; } ?></h4>

            <div class="widget-chart text-center">
                <div id="sparkline2"></div>
                <ul class="list-inline m-t-15">
                    <img src="<?= base_url("document/").$profile['user']->doc_img ;?>" style="max-width:100%;"/>
                </ul>
                <ul>
                    <h4 class="text-muted"><?= $profile['user']->doc_type_number; ?></h4>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Cancelled Cheque <?php if($profile['user']->cancel_cheque_status==1){ echo "<div style='color:#ff0000'>Cancel cheque pending</div>"; } elseif($profile['user']->cancel_cheque_status==2) { echo "<div style='color:green'>Cancel cheque approved</div>"; } elseif($profile['user']->cancel_cheque_status==3){ echo "<div style='color:red;'>Cancelled Cheque rejected please reload image.</div>"; } ?></h4>
            <div class="widget-chart text-center">
                <div id="sparkline3"></div>
                <ul class="list-inline m-t-15">
                      <img src="<?= base_url("document/").$profile['user']->cancel_cheque ;?>" style="max-width:100%;"/>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php 
$uri= $this->uri->segment(3);
if(isset($uri))
{
	if($uri=='kycstatus'){
		echo "<script>window.onload=function() { $.Notification.notify('success','top right','Kyc successfully send to admin for approvel'); } </script>";
	}
}

?>