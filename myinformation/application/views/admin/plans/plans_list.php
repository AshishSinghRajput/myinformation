
    <link href="<?= BASEURL; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
	
		<div class="card-box">
			<div class="row">
				<form id="normal" method="post" action="<?= add_plans; ?>">
                <input type="hidden" name="id" value="<?php if (isset($IdByR->id)) {echo $IdByR->id;}?>">    
                <div class="col-md-4"> 
                        <label style="margin-top: 8px;">Plan</label>
                        <input type="text" class="form-control" name="plan" value="<?php if (isset($IdByR->plan)) {echo $IdByR->plan;} else {set_value('plan');}?>"placeholder="Enter Plan">
                         <span class="text-danger"><?= form_error('plan');?></span></span>
                </div>	
                <div class="col-md-4"> 
                        <label style="margin-top: 8px;">Income</label>
                        <input type="text" class="form-control" name="income" value="<?php if (isset($IdByR->income)) {echo $IdByR->income;} else {set_value('income');}?>"placeholder="Enter Income">
                         <span class="text-danger"><?= form_error('income');?></span></span>
                </div>	
                <div class="col-md-4"> 
                        <label style="margin-top: 8px;">Binary plan</label>
                        <input type="text" class="form-control" name="binary_plan" value="<?php if (isset($IdByR->binary_plan)) {echo $IdByR->binary_plan;} else {set_value('binary_plan');}?>"placeholder="Enter Binary plan">
                         <span class="text-danger"><?= form_error('binary_plan');?></span></span>
                </div>	
                <div class="col-md-4"> 
                        <label style="margin-top: 8px;">Paragraph 1</label>
                        <input type="text" class="form-control" name="p1" value="<?php if (isset($IdByR->p1)) {echo $IdByR->p1;} else {set_value('p1');}?>"placeholder="Enter p1">
                         <span class="text-danger"><?= form_error('p1');?></span></span>
                </div>	
                <div class="col-md-4"> 
                        <label style="margin-top: 8px;">Paragraph 2</label>
                        <input type="text" class="form-control" name="p2" value="<?php if (isset($IdByR->p2)) {echo $IdByR->p2;} else {set_value('p2');}?>"placeholder="Enter p2">
                         <span class="text-danger"><?= form_error('p2');?></span></span>
                </div>
                <div class="col-md-4"> 
                        <label style="margin-top: 8px;">Paragraph 3</label>
                        <input type="text" class="form-control" name="p3" value="<?php if (isset($IdByR->p3)) {echo $IdByR->p3;} else {set_value('p3');}?>"placeholder="Enter p3">
                         <span class="text-danger"><?= form_error('p3');?></span></span>
                </div>
                <div class="col-md-4"> 
                        <label style="margin-top: 8px;">Paragraph 4</label>
                        <input type="text" class="form-control" name="p4" value="<?php if (isset($IdByR->p4)) {echo $IdByR->p4;} else {set_value('p4');}?>"placeholder="Enter p4">
                         <span class="text-danger"><?= form_error('p4');?></span></span>
                </div>	
					<div class="col-lg-12">
						<div class="form-group text-left m-b-0">
							<button type="submit" class="btn btn-pink waves-effect waves-left" style="margin-top: 15px;">
                                <?php if (isset($IdByR->id)) {echo 'Update';}else{echo 'Add';}?>
                            </button>
						</div>
					</div>
				</form>
			</div>
		</div>
	
	</div>
    	 <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Plans</b></h4>
              
                <table id="datatable-buttons" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Plan</th>
                        <th>Income</th>
                        <th>Binary plan</th>
                        <th>Paragraph 1</th>
                        <th>Paragraph 2</th>
                        <th>Paragraph 3</th>
                        <th>Paragraph 4</th>
                        <td>Action</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $j=1;foreach($plans as $row) : 
                        
                        ?>
                    <tr> 
                        <td><?= $j++; ?></td>
                        <td><?= $row->plan; ?></td>  
                        <td><?= $row->income; ?></td>  
                        <td><?= $row->binary_plan; ?></td>  
                        <td><?= $row->p1; ?></td>  
                        <td><?= $row->p2; ?></td>  
                        <td><?= $row->p3; ?></td>
                        <td><?= $row->p4; ?></td>  
                        <td>
                            <a href="<?= site_url('admin/add_plans');?>/<?= $row->id;?>" class="pr-10" title="" data-toggle="tooltip" data-original-title="Update"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    
            <?php endforeach;  ?> 
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

/*====================== *//
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
