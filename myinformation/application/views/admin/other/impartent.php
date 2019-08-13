
    <link href="<?= BASEURL; ?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
    
    <link href="<?= BASEURL; ?>assets/plugins/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    
    <link href="<?= BASEURL; ?>assets/plugins/datatables/dataTables.colVis.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="<?= BASEURL; ?>assets/plugins/datatables/fixedColumns.dataTables.min.css" rel="stylesheet" type="text/css"/>
    <!-----===============Autocomplite Search==================--->
    
<style>

</style>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">
                    
                        <form role="form" action="<?= site_url("admin/addimportent_note");?>"  method="post"> 
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <!-- <label for="exampleInputPassword1">Impartent Note</label> -->
                                    <label for="exampleInputPassword1">Important Note</label>
                                    <textarea type="text" name="description"class="form-control" id="exampleInputPassword1"  placeholder="Enter description"><?= set_value('description');?></textarea>
                                    <span class="text-danger"><?= form_error('description');?></span>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-purple waves-effect waves-light">Add</button>
                        </form>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    
        <div class="col-sm-12">
            <div class="card-box table-responsive">
               <h4 class="m-t-0 header-title"><b>Important Note List</b></h4>
                <table id="datatable-buttons" class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                     <?php $i=1; foreach($imp as $row): ?>
                    <tr> 
                        <td><?= $i++; ?></td>
                        <td><?= $row->description; ?></td>
                        <td><?= $row->date; ?></td>
                        <td>
                            <a href="<?= site_url('admin/delete_importent?id='.base64_encode($row->id)); ?>" class="pr-10" onclick="return confirm('Are you sure to delete')" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                  <?php endforeach; ?>
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
<!-- AjaxSearch -->
<script type="text/javascript">
$('#transfer').prop('disabled',true);
function ajaxSearch(id)
{
    $('#transfer').prop('disabled',true);
    if(id.length==8){
        $.ajax({
            url: "<?= site_url('user/search/'); ?>"+id,
            dataType: 'json',
            success: function (data) {
                console.log(data);
              if(data.success){
                  $("#autoSuggestionsList").html(data.success.name).css('color','green');
                  $('#transfer').prop('disabled',false);
              }else {
                $("#autoSuggestionsList").html(data.error.name).css('color','red');
              }
            }
         });
    }else{
        $("#autoSuggestionsList").text('Sponsor id length should be 8 digit').css('color','red');
    }
  
 }

 
    function showHide(ele) {
        var srcElement = document.getElementById(ele);
        if (srcElement != true) {
            if (srcElement.style.display == "block") {
                srcElement.style.display = 'none';
            }
            else {
                srcElement.style.display = 'block';
            }
            return false;
        }
    }

</script>
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

    window.onload= function(){
    $('#transfer').prop('disabled',true);
    $("#ckbCheckAllBox").click(function () {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
                
            });
    }

  function ckbCheckAll(){
	    getValueUsingClass();
        var confir = confirm('Are you sure for transfer this epin to selected user');
        if(confir==true){
        var ids = $("#pro_ids").val();
        var toid = $("#search_data").val();
        $.ajax({
            url : '<?= site_url("user/transferpin")?>',
            type: 'POST',
            data: {ids: ids, toid: toid},
            dataType: 'json',
            success: function(result){
                    if(result.success.success==1){
                        alert('Epin transfer successfully');
                        location.reload();
                    }else{
                        alert('Something went wrong');
                    }
                // $("#appair").html(result.list);
            }
        });
        }else{
            alert('Ohh! you not sure to transfer these epin for this user');
        }
	}

 function getValueUsingClass(){

	var chkArray = [];
	$(".checkBoxClass:checked").each(function() {
		chkArray.push($(this).val());
	});
	var selected;
	selected = chkArray.join(',') ;
	
    if(selected.length > 0){
        $("#pro_ids").val(selected);
	}else{
        alert('Please select atleast one checkbox');
	}
}

</script>
</body>
</html>
