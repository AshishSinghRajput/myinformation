<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Weekly Carry Forward Information</h4>
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Weekly Carry Forward Information</b></h4>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>On Left Income</th>
                        <th>On Right Income</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php if(!empty($weeklycarry)) { $i=1; foreach($weeklycarry as $row) { ?>
                    <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->left_income ?></td>
                            <td><?= $row->right_income ?></td>
                    </tr>
                        <?php } } else{  echo "<tr><td><span class='label label-danger'>Opps! No Record Found</span></td></tr>"; } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  