
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
				<form id="normal" method="post" action="<?= add_caste; ?>">
                <input type="hidden" name="id" value="<?php if (isset($IdByR->id)) {echo $IdByR->id;}?>">    
                <div class="col-md-6"> 
                        <label style="margin-top: 8px;">Choose Religions</label>
                        <select class="form-control" name="religions_id">
                            <option value="">Choose Religions</option>
                            <?php foreach($religions as $rows) { ?>
                                <option value="<?= $rows->id?>"<?php if (isset($Rselected->religions_id) && ($Rselected->religions_id == $rows->id)) {echo "selected=selected";}?>><?= $rows->religions_name?></option>
                            <?php } ?>
                        </select>
                         <span class="text-danger"><?= form_error('');?></span></span>
                </div>
                <div class="col-md-6"> 
                        <label style="margin-top: 8px;">Caste</label>
                        <input type="text" class="form-control" name="sub_religions" value="<?php if (isset($IdByR->sub_religions)) {echo $IdByR->sub_religions;} else {set_value('sub_religions');}?>"placeholder="Enter Religions">
                         <span class="text-danger"><?= form_error('sub_religions');?></span></span>
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
                <h4 class="m-t-0 header-title"><b>Religions</b></h4>
              
                <table id="datatable-buttons" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Religions</th>
                        <th>Caste</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $j=1;foreach($caste as $row) : 
                        
                        ?>
                    <tr> 
                        <td><?= $j++; ?></td>  
                        <td><?= $row->religions_name;?></td>
                        <td><?= $row->sub_religions;?></td>
                        <td>
                            <a href="<?= site_url('admin/add_caste');?>/<?= $row->id;?>" class="pr-10" title="" data-toggle="tooltip" data-original-title="Update"><i class="fa fa-edit"></i></a>
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
