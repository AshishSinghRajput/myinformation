    <link href="<?= BASEURL; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    
    <link href="<?= BASEURL; ?>assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    
    <link href="<?= BASEURL; ?>assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>
<div class="container">
    <div class="row">
    	 <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>User Plan Summary</b></h4>
                <!-- <h4 class="m-t-0 header-title"><b>All Register User List</b></h4> -->
              
                <table id="datatable-buttons" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User ID </th>
                        <th>User Name </th>
                        <th>User Mobile No. </th>
                        <th>User Email </th>
                        <th>Date of Registration </th>
                        <th>Plan Start Date / Time</th>
					   	<th>Current Plan </th>
                        <th>Start Date Plan 50</th>
                        <th>Start Date Plan 100</th>
                        <th>Start Date Plan 200</th>
                        <th>Start Date Plan 400</th>
                        <th>Start Date Plan 600</th>
                        <th>Start Date Plan 800</th>
                        <th>Start Date Plan 1000</th>
                        <th>Start Date Plan 2000</th>
                        <th>Start Date Plan 4000</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $j=1;
                    $noDate='';
                    foreach($user as $row) { 
                        $otherDate = $this->welcome_model->getAllPlanDate('plan_activation_history',array('sponsor_id'=>$row->sponsor_id));
                        // echo '<pre>';
                        // print_r($otherDate);
                        // die;
                        
                        ?>
                    <tr> 
                        <td><?= $j++; ?></td>  
                        <td><?= $row->sponsor_id; ?></td>
                        <td><?= $row->full_name; ?></td>     
                        <td><?= $row->mobile; ?></td>     
                        <td><?= $row->email; ?></td>     
                        <td><?= !empty($row->create_at) ? date('d-m-Y',strtotime($row->create_at)) : '00-00-0000'; ?></td>   
                         <td>
                             <?php
                                $IndaiDate = new DateTime($row->activation_date);
                                $setDateTime = $IndaiDate->format("d-m-Y h:i:s a");
                                if($row->upgrade_plan ==0)
                                {
                                    echo 'not activated';
                                    
                                }else{
                                     echo $setDateTime;
                                }
                               
                            ?>
                        </td>    
                        <td><?= $row->upgrade_plan; ?></td> 
                        <?php   $noDate = 'No Data Found'; $plandate50=''; $plandate100=''; $plandate200=''; $plandate400=''; $plandate600=''; $plandate800=''; $plandate1000=''; $plandate2000=''; $plandate4000=''; foreach ($otherDate as $data) {
                            if($data->plan_amount==50)
                            {
                              $plandate50 = date('d-m-Y',strtotime($data->created_on));

                            }if($data->plan_amount==100){
                              $plandate100 = date('d-m-Y',strtotime($data->created_on));

                            }elseif($data->plan_amount==200){
                              $plandate200 = date('d-m-Y',strtotime($data->created_on));
                                
                            }elseif($data->plan_amount==400){
                              $plandate400 = date('d-m-Y',strtotime($data->created_on));
                                
                            }elseif($data->plan_amount==600){
                              $plandate600 = date('d-m-Y',strtotime($data->created_on));
                                
                            }elseif($data->plan_amount==800){
                              $plandate800 = date('d-m-Y',strtotime($data->created_on));
                                
                            }elseif($data->plan_amount==1000){
                              $plandate1000 = date('d-m-Y',strtotime($data->created_on));
                                
                            }elseif($data->plan_amount==2000){
                              $plandate2000 = date('d-m-Y',strtotime($data->created_on));
                                
                            }elseif($data->plan_amount==4000){
                              $plandate4000 = date('d-m-Y',strtotime($data->created_on));
                                
                            } } ?>           
                       <td><?= !empty($plandate50) ? $plandate50 : $noDate;?></td>
                       <td><?= !empty($plandate100) ? $plandate100 : $noDate;?></td>
                       <td><?= !empty($plandate200) ? $plandate200 : $noDate;?></td>
                       <td><?= !empty($plandate400) ? $plandate400 : $noDate;?></td>
                       <td><?= !empty($plandate600) ? $plandate600 : $noDate;?></td>
                       <td><?= !empty($plandate800) ? $plandate800 : $noDate;?></td>
                       <td><?= !empty($plandate1000) ? $plandate1000 : $noDate;?></td>
                       <td><?= !empty($plandate2000) ? $plandate2000 : $noDate;?></td>
                       <td><?= !empty($plandate4000) ? $plandate4000 : $noDate;?></td>
                       
                    </tr>
                   
            <?php }  ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end row -->
</div> <!-- container -->

        </div> <!-- content -->

    </div>
    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


   
</div>
<!-- END wrapper -->

<script>
    var resizefunc = [];
</script>
<!-- jQuery  -->
<script src="<?= BASEURL; ?>assets/js/jquery.min.js"></script>
<script src="<?= BASEURL; ?>assets/js/bootstrap.min.js"></script>
<script src="<?= BASEURL; ?>assets/js/detect.js"></script>
<script src="<?= BASEURL; ?>assets/js/fastclick.js"></script>
<script src="<?= BASEURL; ?>assets/js/jquery.slimscroll.js"></script>
<script src="<?= BASEURL; ?>assets/js/jquery.blockUI.js"></script>
<script src="<?= BASEURL; ?>assets/js/waves.js"></script>
<script src="<?= BASEURL; ?>assets/js/wow.min.js"></script>
<script src="<?= BASEURL; ?>assets/js/jquery.nicescroll.js"></script>
<script src="<?= BASEURL; ?>assets/js/jquery.scrollTo.min.js"></script>

<script src="<?= BASEURL; ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.bootstrap.js"></script>

<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/buttons.bootstrap.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/jszip.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/pdfmake.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/vfs_fonts.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/buttons.html5.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/buttons.print.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.fixedHeader.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.keyTable.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.responsive.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/responsive.bootstrap.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.scroller.min.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.colVis.js"></script>
<script src="<?= BASEURL; ?>assets/plugins/datatables/dataTables.fixedColumns.min.js"></script>

<script src="<?= BASEURL; ?>assets/pages/datatables.init.js"></script>



<script type="text/javascript">
    $(document).ready(function () {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });
        $('#datatable-scroller').DataTable({
            ajax: "<?= BASEURL; ?>assets/plugins/datatables/json/scroller-demo.json",
            deferRender: true,
            scrollY: 380,
            scrollCollapse: true,
            scroller: true
        });
        var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
        var table = $('#datatable-fixed-col').DataTable({
            scrollY: "300px",
            scrollX: true,
            scrollCollapse: true,
            paging: false,
            fixedColumns: {
                leftColumns: 1,
                rightColumns: 1
            }
        });
    });
    TableManageButtons.init();

</script>

</body>
</html>
