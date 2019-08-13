<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Self Home Fund Income Information</h4>
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Self Home Fund Income (Every 2 Monthly)</b></h4>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Behalf Of</th>
                        <th>Left Income</th>
                        <th>Right Income</th>
                        <th>Income</th>
                        <th>On Month</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php if(!empty($sponsorfund)) { $i=1; foreach($sponsorfund as $row) { ?>
                    <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->fund_name ?></td>
                            <td><?= $row->left_income ?></td>
                            <td><?= $row->right_income ?></td>
                            <td><?= $row->income ?></td>
                            <td><?= date('M,Y',strtotime($row->on_month)) ?></td>
                            <td><?php if($row->status==0){ echo "<span class='label label-danger'>Pending</span>"; } else { echo "<span class='label label-success'>Success</span>";} ?></td>
                    </tr>
                        <?php } } else{  echo "<tr><td colspan='5'><span class='label label-danger'>Opps! No Record Found</span></td></tr>"; } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  