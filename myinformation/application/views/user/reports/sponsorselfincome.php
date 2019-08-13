<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Self Monthly Information</h4>
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Self Monthly Income</b></h4>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Income</th>
                        <th>On BV</th>
                        <th>Month</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php if(!empty($sponsorincome)) { $i=1; foreach($sponsorincome as $row) { ?>
                    <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->income ?></td>
                            <td><?= $row->on_bv ?></td>
                            <td><?= date('M, Y',strtotime($row->on_month)) ?></td>
                            <td><?php if($row->status==0) { echo "<span class='label label-danger'>Pending</span>"; } else { echo "<span class='label label-success'>Paid</span>"; }?></td>
                    </tr>
                        <?php } } else{  echo "<tr><td colspan='5'><span class='label label-danger'>Opps! No Record Found</span></td></tr>"; } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  