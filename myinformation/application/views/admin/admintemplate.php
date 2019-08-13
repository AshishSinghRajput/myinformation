<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Coderthemes">
		 <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/logo.png">
        <link rel="stylesheet" href="<?php echo base_url("assets/css/sweetalert.css"); ?>" >
       <!--- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>---!>
		<script  src="<?= base_url('assets/css/sweetalert-dev.js'); ?>" ></script>
		
		<title><?php echo $page; ?></title>
		<script>
			var base_url="<?php echo site_url(); ?>";
			</script>
			<!-- Vendor styles -->
			<?php  
				$obj= new jscss_model();
				$css=$obj->get_css($page);
				$js=$obj->get_js($page);
				foreach($css as $csrow)
				{
				?> 
				<link href="<?php echo base_url($csrow); ?>" rel="stylesheet" type="text/css" >
				<?php
				}
			?>
        <script src="<?= base_url();  ?>assets/js/modernizr.min.js"></script>
	</head>
	<body class="fixed-left">
		<!-- Begin page -->
		<div id="wrapper">
            <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
                <div class="topbar-left">
                    <div class="text-center">
                        <!-- Image Logo here -->
                        <a href="index.html" class="logo">
                        <i class="icon-c-logo"> <img src="<?= base_url(); ?>assets/images/logo.png" height="42"/> </i>
                            <span><img src="<?= base_url(); ?>assets/images/logo.png" height="50"/></span>
                        </a>
                    </div>
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="">
                            <div class="pull-left">
                                <button class="button-menu-mobile open-left waves-effect waves-light">
                                    <i class="md md-menu"></i>
                                </button>
                                <span class="clearfix"></span>
                            </div>
                            <ul class="nav navbar-nav navbar-right pull-right">
                                <li class="hidden-xs">
                                    <a href="#" id="btn-fullscreen" class="waves-effect waves-light"><i class="icon-size-fullscreen"></i></a>
                                </li>
                                <!--li class="hidden-xs">
                                    <a href="#" class="right-bar-toggle waves-effect waves-light"><i class="icon-settings"></i></a>
                                </li-->
                                <li class="dropdown top-menu-item-xs">
                                    <a href="" class="dropdown-toggle profile waves-effect waves-light" data-toggle="dropdown" aria-expanded="true">
									<!--img src="<?php echo base_url('uploads/profile/').$this->session->userdata['admin']['profile_image']; ?>" alt="user-img" class="img-circle"-->
									 <?= $this->session->userdata['admin']['email'];?> <i class="fa fa-arrow-down"></i>
									</a>
                                    <ul class="dropdown-menu">
                                        <li><a href="<?= adminprofile; ?>"><i class="ti-user m-r-10 text-custom"></i> Profile</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?= change;?>"><i class="fa fa-key m-r-10 text-danger"></i> Change Password</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?= admin_logout;?>"><i class="ti-power-off m-r-10 text-danger"></i> Logout</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Top Bar End -->
            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft" style="overflow: scroll;">
                    <!--- Divider -->
                    <div id="sidebar-menu">
                        <ul>
                        <li class="has_sub">
                            <a href="<?= site_url('admin');?>" class="waves-effect"><i class="ti-home"></i> <span> Dashboard </span> </a>  
                        </li>
                          <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span>User Information</span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="<?= userlist;?>">Registered User Information</a></li>
                                    <li><a href="active_user_info">Active User Information</a></li>
                                    <li><a href="pending_user_info">Pending User Information</a></li>
                                    <li><a href="block_user_info">Block User Information</a></li>
                                    <li class="hide"><a href="<?= member_profile;?>">User detail</a></li>
                                    <li class="hide"><a href="free_user">Free user Information</a></li>
                                    <li class="hide"><a href="user_income">User Income Information</a></li>
                                    <li class="hide"><a href="payment_history">User Payment's Information</a></li>
                                    <li><a href="user_plan">User Plan Information</a></li>
                                    <li><a href="multiple_id_user">User Multiple ID' Information</a></li>
                                </ul> 
                            </li>
                             <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-info-circle"></i> <span>User Income Information</span> <span class="menu-arrow"></span> </a>
                                    <ul class="list-unstyled">
                                        <li><a href="<?= new_step_income; ?>" title="Step Income(Date)">Step Income(Date)</a></li>
                                         <li><a href="<?= matching_income; ?>" title="Binary Income">User Matching Income</a></li>
                                        <li><a href="<?= income_datewise; ?>" title="Total Income(Date)">User Total Income(Date)</a></li>
                                        <li><a href="<?= user_total_income_weekly; ?>" title="Weekly Total Income">Total Income(Weekly)</a></li>
                                        <li><a href="<?= account_information; ?>" title="Account Information">User Account Information</a></li>
                                        <li><a href="<?= bank_information; ?>" title="Bank Information">User Bank Information</a></li>
                                        <li><a href="<?= paytm_information; ?>" title="Paytm Informations)">User Paytm Information</a></li>
                                        <li><a href="<?= phonepe_information; ?>" title="Phonepe Informations)">User PhonePe Information</a></li>
                                        <li><a href="<?= bhim_information; ?>" title="BHIM Informations)">User BHIM Information</a></li>
                                         <li><a href="<?= googlepay_information; ?>" title="GooglePay Informations)">User GooglePay Information</a></li>

                                        <li class="hide"><a href="<?= step_income; ?>" title="Level Income">User Step Income</a></li>
                                        
                                        <li class="hide"><a href="<?= downlines_earning; ?>" title="Total Downlines Earning">Total Downlines Earning</a></li>
                                        <li class="hide"><a href="<?= direct_downlines_earning; ?>" title="Direct Downlines Earning">Direct Downlines Earning</a></li>
                                        <li class="hide"><a href="<?= matching_planwise_downlines; ?>" title="Matching Plan Wise Downlines">Matching Plan Wise Downlines</a></li>
                                        <li class="hide"><a href="<?= step_planwise_downline; ?>" title="Step Plan Wise Downlines">Step Plan Wise Downlines</a></li>
                                        <li class="hide"><a href="<?= new_step_income; ?>" title="Step Income(Date)">Step Income(Date)</a></li>
                                        <li class="hide"><a href="<?= matching_income; ?>" title="Create Transfer Epin">Create Transfer Epin</a></li>
                                    </ul> 
                                </li> 
                                 <li class="has_sub">
                                    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-history"></i> <span>ePin History</span> <span class="menu-arrow"></span> </a>
                                    <ul class="list-unstyled">
                                        <li><a href="" title="Binary Income">All ePin</a></li>
                                        <li><a href="all_epin" title="Binary Income">All ePin</a></li>
                                        <li><a href="<?= epin_history; ?>" title="Level Income">Transfer ePin</a></li>
                                    </ul> 
                                </li>
                                 <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span>Religions</span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="religions">Add Religions</a></li>
                                    <li><a href="caste">Add Caste</a></li>
                                    <li><a href="sub_caste">Add Sub Caste</a></li>
                                </ul> 
                            </li> 
                        <li class="">
							<a href="<?= latest_news;?>" class="waves-effect"><i class="fa fa-newspaper-o"></i> <span>Latest News Section</span>  </a>								   
						</li>
                          <li class="">
                                    <a href="<?= regional; ?>" class="waves-effect"><i class="fa fa-code"></i> <span> Regional Experts</span>  </a>                                
                                </li>
                            <li class="">
                                    <a href="<?= view_slider;?>" class="waves-effect"><i class="fa fa-file-image-o"></i> <span>Slider</span>  </a>                                 
                                </li>
                        <li class="">
							<a href="<?= testmonial;?>" class="waves-effect"><i class="fa fa-quote-left"></i> <span>Testmonial</span>  </a>								   
						</li>
                        <li class="">
							<a href="<?= importent;?>" class="waves-effect"><i class="fa fa-photo"></i> <span>Important Notice</span>  </a>								   
						</li>
                         <li class="">
                            <a href="<?= user_history;?>" class="waves-effect"><i class="fa fa-photo"></i> <span>User History</span>  </a>                                
                        </li>
                            <li class="has_sub hide">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span>subscription Plans </span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="plans">Add Plans</a></li>
                                </ul> 
                            </li> 
                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i> <span>Upgrade Plans Notice</span> <span class="menu-arrow"></span> </a>
                                <ul class="list-unstyled">
                                    <li><a href="upgrade_notice">Add upgrade Plans Notice</a></li>
                                </ul> 
                            </li> 
                                <!-- <li class="">
								    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-life-ring"></i> <span> Marriage Folder </span>  </a>
							    </li>
                                <li class="">
								    <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-paragraph"></i> <span> Personality Folder </span>  </a>
							    </li> -->
                                <li class="has_sub">
                                        <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-cog"></i> <span>Setting</span> <span class="menu-arrow"></span> </a>
                                        <ul class="list-unstyled">
                                            <li><a href="<?= adminprofile; ?>">Update Profile</a></li>
                                            <li><a href="change">Change Password</a></li>
                                            <li><a href="admin_logout">Logout</a></li>
                                        </ul> 
                                    </li> 
                                </li>
                            </ul>
                         <div class="clearfix"></div>
                      </div>
                    <div class="clearfix"></div>
                </div>
            </div>
			<!-- Left Sidebar End -->
			<!-- ============================================================== -->

			<!-- Start right Content here -->

			<!-- ============================================================== -->
			<div class="content-page">
				<!-- Start content -->
				<div class="content">
					<?php $this->load->view('admin/'.$content)?>         
                </div> <!-- content -->
                <footer class="footer" style="margin-left: 240px;">
                    © 2017. All rights reserved. Develop By <a href="http://slashtechnologies.com/" target="_black"> Slash Technologies</a>
                </footer>
            </div>
            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->
            <!-- Right Sidebar -->
        </div>
        <!-- END wrapper -->
        <script>
            var resizefunc = [];
        </script>
    <?php
     foreach($js as $csrow){
		?> 
		 <script src="<?php echo  base_url($csrow);?>"></script>
		<?php
	   }
   ?>

<?php if (!empty($this->session->flashdata('success'))) {?>
    <script>
        window.onload=function(){
            $.Notification.notify('success','top-right','<?=$this->session->flashdata("success")?>','<?=$this->session->flashdata("message")?>');
        }
    </script>
    <?php }if (!empty($this->session->flashdata('error'))) {?>
        <script>
            window.onload=function(){
                $.Notification.notify('error','top-right','<?=$this->session->flashdata("error")?>','<?=$this->session->flashdata("message")?>');
            }
        </script>
    <?php }?>
    
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
    <script type="text/javascript" language="javascript">
     $(document).ready(function(){
        var dataTable = $('#user-datamIn').DataTable({
            "processing":true,
            "serverSide":true,
             "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/Admin/fetch_user'; ?>",
                type:"POST",
                dataType:"json"

            },
            dom:"lBfrtrip",
            buttons:['excel','csv','pdf','copy'],
            "lengthMenu":[ [10,25,50,-1],[10,25,50,"All"] ],
            
            "columnDefs":[
               {
                "targets":[0,2,4,5],
                "orderable":false,
               }
               ]
               }); 
               }); 
</script>
<script type="text/javascript" language="javascript">
     $(document).ready(function(){
        var dataTable = $('#user-data2').DataTable({
            "processing":true,
            "serverSide":true,
             "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/Admin/fetch_income'; ?>",
                type:"POST",
                dataType:"json"

            },
            dom:"lBfrtrip",
            buttons:['excel','csv','pdf','copy'],
            "lengthMenu":[ [10,25,50,-1],[10,25,50,"All"] ],
            
            "columnDefs":[
               {
                "targets":[0,2,4,5],
                "orderable":false,
               }
               ]
               }); 
               }); 
</script>
<script type="text/javascript" language="javascript">
     $(document).ready(function(){
        var dataTable = $('#user-data3').DataTable({
            "processing":true,
            "serverSide":true,
             "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/Admin/fetch_downlines'; ?>",
                type:"POST",
                dataType:"json"

            },
            dom:"lBfrtrip",
            buttons:['excel','csv','pdf','copy'],
            "lengthMenu":[ [10,25,50,-1],[10,25,50,"All"] ],
            
            "columnDefs":[
               {
                "targets":[0,2,4,5],
                "orderable":false,
               }
               ]
               }); 
               }); 
</script>
<script type="text/javascript" language="javascript">
     $(document).ready(function(){
        var dataTable = $('#user-data4').DataTable({
            "processing":true,
            "serverSide":true,
            "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/Admin/fetch_direct_downlines'; ?>",
                type:"POST",
                dataType:"json"

            },
            dom:"lBfrtrip",
            buttons:['excel','csv','pdf','copy'],
            "lengthMenu":[ [10,25,50,-1],[10,25,50,"All"] ],
            
            "columnDefs":[
               {
                "targets":[0,2,4,5],
                "orderable":false,
               }
               ]
               }); 
               }); 
</script>
<script type="text/javascript" language="javascript">
     $(document).ready(function(){
        var dataTable = $('#user-data5').DataTable({
            "processing":true,
            "serverSide":true,
            "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/Admin/fetch_planwise_downlines'; ?>",
                type:"POST",
                dataType:"json"

            },
            dom:"lBfrtrip",
            buttons:['excel','csv','pdf','copy'],
            "lengthMenu":[ [10,25,50,-1],[10,25,50,"All"] ],
            "columnDefs":[
               {
                "targets":[0,2,4,5],
                "orderable":false,
               }
               ]
               });
               });
</script>
<script type="text/javascript" language="javascript">
     $(document).ready(function(){
        var dataTable = $('#user-data6').DataTable({
            "processing":true,
            "serverSide":true,
            "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/Admin/fetch_step_planwise_downlines'; ?>",
                type:"POST",
                dataType:"json"

            },
            dom:"lBfrtrip",
            buttons:['excel','csv','pdf','copy'],
            "lengthMenu":[ [10,25,50,-1],[10,25,50,"All"] ],
            
            "columnDefs":[
               {
                "targets":[0,2,4,5],
                "orderable":false,
               }
               ]
               }); 
               }); 
</script>
<script type="text/javascript" language="javascript">
     $(document).ready(function(){

        var dataTable = $('#user-data7').DataTable({
            "processing":true,
            "serverSide":true,
             "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/Admin/fetch_step_income'; ?>",
                type:"POST",
                dataType:"json"

            },
            dom:"lBfrtrip",
            buttons:['excel','csv','pdf','copy'],
            "lengthMenu":[ [10,25,50,-1],[10,25,50,"All"] ],
            
            "columnDefs":[
               {
                "targets":[0,2,4,5],
                "orderable":false,
               }
               ]
               }); 
               }); 
        </script>
        <script type="text/javascript" language="javascript">
     $(document).ready(function(){
       
         table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "searching":false,
 
        // Load data for the table's content from an Ajax source
        "ajax": {
             url:"<?php echo base_url() .'/Admin/fetch_income_weekly'; ?>",
            "type": "POST",
            "data": function ( data ) {
                data.FirstName = $('#from_date').val();
                data.LastName = $('#to_date').val();
            }
        },
        
         dom:"lBfrtrip",
             buttons:['excel','csv','pdf','copy'],
             "lengthMenu":[ [10,25,50,-1],[10,25,50,"All"] ],
 
        //Set column definition initialisation properties.
        "columnDefs": [
        { 
            "targets": [ 0 ], //first column / numbering column
            "orderable": false, //set not orderable
        },
        ],
 
    });
 
    $('#btn-filter').click(function(){ //button filter event click
        table.ajax.reload();  //just reload table
    });
    $('#btn-reset').click(function(){ //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload();  //just reload table
    });
               }); 
        </script>
	</body>
</html>