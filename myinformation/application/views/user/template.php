<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="mlm">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/logo.png">
        <title>My Information|UserPanel</title>
        <!--Morris Chart CSS -->
		<script>
			var base_url="<?php echo site_url(); ?>";
		</script>
    <!-- Vendor styles -->
	<?php  $obj= new jscss_model();
			$css=$obj->get_css($page);
			$js=$obj->get_js($page);
			foreach($css as $csrow){
		?> 
			<link href="<?php echo base_url($csrow); ?>" rel="stylesheet"><?php
		}
	?>
        <script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
    </head>
    <body class="fixed-left">
        <div id="wrapper">
             <!-- Top Bar Start -->
            <div class="topbar">
                <!-- LOGO -->
               
                <div class="topbar-left">
                
                    <div class="text-center">
                        <a href="<?php echo site_url('user');?>" class="logo"><i class="icon-bold icon-c-logo"></i><span><?php echo $this->session->userdata['user']['sponsor_id']; ?></span></a>
                        
                    </div>
                    
                </div>
                <!-- Button mobile view to collapse sidebar menu -->
                <?php $this->load->view('user/layout/header'); ?>
            </div>
            <!-- Top Bar End -->
            <!-- ========== Left Sidebar Start ========== -->

            <div class="left side-menu">
                <div class="sidebar-inner slimscrollleft">
                    <!--- Divider -->
                     <?php $this->load->view('user/layout/sidebar'); ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
        <!-- END wrapper -->
		<div class="content-page">
                <div class="content">
                    <div class="wraper container">
						<?php $this->load->view("user/".$content); ?>
					</div>
				</div>
		<footer class="footer">
                  <?php $this->load->view('user/layout/footer');?>
        </footer>
		</div>
        <script>
            var resizefunc = [];
        </script>
	<?php
    foreach($js as $csrow){
		?> 
		 <script src="<?php echo  base_url($csrow); ?>"></script>
		<?php
	}
   ?>
   
   
   <script src="<?php echo base_url() ?>assets/js/waves.js"></script>
   <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/r/dt/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.9,af-2.0.0,b-1.0.3,b-colvis-1.0.3,b-html5-1.0.3,b-print-1.0.3,se-1.0.1/datatables.min.js"></script>
     <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <script type="text/javascript" language="javascript">
     $(document).ready(function(){
         
/********************* STEP INCOME DATEWISE ******************************/         
        var dataTable = $('#step-income').DataTable({
            "processing":true,
            "serverSide":true,
             "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/User/fetch_step_income'; ?>",
                type:"POST",

              dataType:"json"

            },
            dom:"lBfrtrip",
            buttons:['excel','csv','pdf','copy'],
            "lengthMenu":[ [10,25,50,-1],[10,25,50,"All"] ],
            
            "columnDefs":[
               {
                "targets":-1,
                "orderable":false,
               }
             ]
         }); 
/********************* STEP INCOME DATEWISE ******************************/

/********************* MY MATCHING INCOME ******************************/         
        var dataTable = $('#user-datamIn').DataTable({
            "processing":true,
            "serverSide":true,
             "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/User/fetch_user'; ?>",
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
/********************* MY MATCHING INCOME ******************************/


/********************* STEP PLAN WISE DOWNLINES LISTS ******************************/         
        var dataTable = $('#user-data6').DataTable({
            "processing":true,
            "serverSide":true,
             "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/User/fetch_step_planwise_downlines'; ?>",
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
/********************* STEP PLAN WISE DOWNLINES LISTS ******************************/

/********************* MATCHING PLAN WISE DOWNLINES LISTS ******************************/         
        var dataTable = $('#user-data5').DataTable({
            "processing":true,
            "serverSide":true,
             "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/User/fetch_matching_planwise_downlines'; ?>",
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
/********************* MATCHING PLAN WISE DOWNLINES LISTS ******************************/

/********************* MY DIRECT DOWNLINES EARNING REPORT ******************************/         
        var dataTable = $('#user-data4').DataTable({
            "processing":true,
            "serverSide":true,
             "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/User/fetch_direct_downlines'; ?>",
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
/********************* MY DIRECT DOWNLINES EARNING REPORT ******************************/

/********************* TOTAL DOWNLINES EARNING REPORT ******************************/         
        var dataTable = $('#user-data3').DataTable({
            "processing":true,
            "serverSide":true,
             "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/User/fetch_downlines'; ?>",
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
/********************* MY DIRECT DOWNLINES EARNING REPORT ******************************/

/********************* TOTAL INCOME DATEWISE ******************************/         
        var dataTable = $('#user-data2').DataTable({
            "processing":true,
            "serverSide":true,
             "stateSave": true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() .'/User/fetch_income'; ?>",
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
/********************* TOTAL INCOME DATEWISE ******************************/

/********************* TOTAL INCOME WEEKLY ******************************/ 
    
        // var dataTable = $('#user-data1').DataTable({
        //     "processing":true,
        //     "serverSide":true,
        //      "stateSave": true,
        //     "order":[],
        //     "searching":false,
        //     "ajax":{
        //         url:"<?php echo base_url() .'/User/fetch_income_weekly'; ?>",
        //         type:"POST",
        //          "data": function ( data ) {
        //         data.country = $('#country').val();
        //         data.FirstName = $('#FirstName').val();
        //         data.LastName = $('#LastName').val();
        //         data.address = $('#address').val();
        //     }
        //     },
        //     dom:"lBfrtrip",
        //     buttons:['excel','csv','pdf','copy'],
        //     "lengthMenu":[ [10,25,50,-1],[10,25,50,"All"] ],
            
        //     "columnDefs":[
        //       {
        //         "targets":[0,2,4,5],
        //         "orderable":false,
        //       }
        //      ]
        //  });
        
         table = $('#table').DataTable({ 
 
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        "order": [], //Initial no order.
        "searching":false,
 
        // Load data for the table's content from an Ajax source
        "ajax": {
             url:"<?php echo base_url() .'/User/fetch_income_weekly'; ?>",
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
 
/********************* TOTAL INCOME WEEKLY ******************************/
     }); 
</script>
    <?php if(!empty($this->session->flashdata('success'))) { ?> 
    <script>
        window.onload=function(){
            $.Notification.notify('success','top-right','<?= $this->session->flashdata("success") ?>','<?= $this->session->flashdata("message") ?>');
        }
    </script>
    <?php } if(!empty($this->session->flashdata('error'))) { ?> 
        <script>
            window.onload=function(){
                $.Notification.notify('error','top-right','<?= $this->session->flashdata("error") ?>','<?= $this->session->flashdata("message") ?>');
            }
        </script>
    <?php }?>
</body>
</html>