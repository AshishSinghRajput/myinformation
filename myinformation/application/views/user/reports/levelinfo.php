<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Level Information</h4>
        </div>
    </div>
</div>

<?php if(!empty($levelinfo)) { foreach($levelinfo as $row) { ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>First Level Information</b></h4>
                <p>Total Member <span class="label label-info"><?= $row->total_member ?></span></p>
                <table id="datatable<?= $row->id ?>" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Sponsor Id</th>
                        <th>Name</th>
                        <th>Status</th>
                    </tr>
                    </thead>


                    <tbody>
                        <?php $temp = unserialize($row->member_info);  $k=1; for($i=0; $i<count($temp); $i++) {  ?>
                    <tr>
                            <td><?= $k++ ?></td>
                            <td><?= $temp[$i]['sponsor_id'] ?></td>
                            <td><?= $temp[$i]['member_name'] ?></td>
                            <td><?= $temp[$i]['is_active'] ?></td>
                    </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php } } else { ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="m-t-0 header-title"><span class="label label-danger">Opps! No Record Found</span></h4>
            </div>
        </div>
    </div>

    <?php } ?>
<script type="text/javascript">
    window.onload=function() {
        $('#datatable1').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });

        $('#datatable2').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });

        $('#datatable3').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });


        $('#datatable4').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });

        $('#datatable5').dataTable();
        $('#datatable-keytable').DataTable({keys: true});
        $('#datatable-responsive').DataTable();
        $('#datatable-colvid').DataTable({
            "dom": 'C<"clear">lfrtip',
            "colVis": {
                "buttonText": "Change columns"
            }
        });

        $('#datatable-scroller').DataTable({
            ajax: "assets/plugins/datatables/json/scroller-demo.json",
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
    }
</script>
