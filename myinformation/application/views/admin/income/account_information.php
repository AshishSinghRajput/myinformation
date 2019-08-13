
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
                <h4 class="m-t-0 header-title"><b>User's Accounts Information</b></h4>
              
                <table id="datatable-buttons" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>User Id</th>
                        <th>User Name</th>
					    <th>User Mobile No.</th>
                        <th>User Email</th>
                        <th>Bank Name</th>
                        <th>Branch Address</th>
                        <th>Bank Account Holder Name</th>
                        <th>Account Number</th>
                        <th>IFSC Code</th>
                        <th>Paytm No</th>
                        <th>Paytm User Id</th>
                        <th>PhonePe No</th>
                        <th>PhonePe User Id</th>
						<th>BHIM No</th>
						<th>BHIM User Id</th>
                        <th>GooglePay No</th>
                        <th>GooglePay User Id</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
            $count = 1; $match=''; $step=''; $tot_income=''; $bhimNo = ''; $bhimAdd = ''; $bank = ''; $bankAdd = ''; $bankholder=''; $bankAccount=''; $bankifsc=''; $paytmNo = ''; $paytmAdd = ''; $phonepeNo = ''; $phonepeAdd = ''; $gPayNo = ''; $gPayAdd = '';
                if(!empty($user)) {
                 foreach ($user as $row) {
                  $bankInfo = $this->admin_model->getallBankData($row->id);
                  if(!empty($bankInfo->bank_name))
                  {
                    $bank = $bankInfo->bank_name;
                  }else{
                     $bank = 'N/A';
                  }
                   if(!empty($bankInfo->branch))
                  {
                    $bankAdd = $bankInfo->branch;
                  }else{
                     $bankAdd = 'N/A';
                  }
                  if(!empty($bankInfo->ac_holder_name))
                  {
                    $bankholder = $bankInfo->ac_holder_name;
                  }else{
                     $bankholder = 'N/A';
                  }
                   if(!empty($bankInfo->account_no))
                  {
                    $bankAccount = $bankInfo->account_no;
                  }else{
                     $bankAccount = 'N/A';
                  }
                   if(!empty($bankInfo->ifsc))
                  {
                    $bankifsc = $bankInfo->ifsc;
                  }else{
                     $bankifsc = 'N/A';
                  }
                  if(!empty($bankInfo->bhim_no))
                  {
                    $bhimNo = $bankInfo->bhim_no;
                  }else{
                     $bhimNo = 'N/A';
                  }
                   if(!empty($bankInfo->bhim_address))
                  {
                    $bhimAdd = $bankInfo->bhim_address;
                  }else{
                     $bhimAdd = 'N/A';
                  }
                   if(!empty($bankInfo->paytm_no))
                  {
                    $paytmNo = $bankInfo->paytm_no;
                  }else{
                     $paytmNo = 'N/A';
                  }
                   if(!empty($bankInfo->paytm_address))
                  {
                    $paytmAdd = $bankInfo->paytm_address;
                  }else{
                     $paytmAdd = 'N/A';
                  }
                  if(!empty($bankInfo->phonepe_no))
                  {
                    $phonepeNo = $bankInfo->phonepe_no;
                  }else{
                     $phonepeNo = 'N/A';
                  }
                   if(!empty($bankInfo->phonepe_upi))
                  {
                    $phonepeAdd = $bankInfo->phonepe_upi;
                  }else{
                     $phonepeAdd = 'N/A';
                  }
                  if(!empty($bankInfo->google_pay))
                  {
                    $gPayNo = $bankInfo->google_pay;
                  }else{
                     $gPayNo = 'N/A';
                  }
                   if(!empty($bankInfo->google_upi))
                  {
                    $gPayAdd = $bankInfo->google_upi;
                  }else{
                     $gPayAdd = 'N/A';
                  }
                 
                  
                         ?>
                        
                    <tr> 
                        <td><?= $count++;?></td>
                        <td><?= $row->sponsor_id; ?></td>
                        <td><?= ucfirst($row->full_name); ?></td>
                        <td><?= $row->mobile; ?></td>
                        <td><?= $row->email; ?></td>
                        <td><?= $bank;?></td>
                        <td><?= $bankAdd; ?></td>
                        <td><?= $bankholder; ?></td>
                        <td><?= $bankAccount; ?></td>
                        <td><?= $bankifsc; ?></td>
                        <td><?= $paytmNo;?></td>
                        <td><?= $paytmAdd; ?></td>
                        <td><?= $phonepeNo;?></td>
                        <td><?= $phonepeAdd; ?></td>
                        <td><?= $bhimNo;?></td>
                        <td><?= $bhimAdd; ?></td>
                        <td><?= $gPayNo;?></td>
                        <td><?= $gPayAdd; ?></td>
                       
                       
                    </tr>
                <?php } } ?>
                    </tbody>
                </table>
        <?php //} else{ echo "<h3><span class='text-danger'>Not Any Posted Blog</span></h3>";} ?>
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
