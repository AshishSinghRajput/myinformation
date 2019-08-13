<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Weekly Information</h4>
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Weekly Level Information</b></h4>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Income</th>
                        <th>On Left Income</th>
                        <th>On Right Income</th>
                        <th>On Closing Date</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php if(!empty($weeklyinfo)) { $i=1; foreach($weeklyinfo as $row) { ?>
                    <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->income ?></td>
                            <td><?= $row->left_income ?></td>
                            <td><?= $row->right_income ?></td>
                            <td><?= $row->on_closing ?></td>
                    </tr>
                        <?php } } else{  echo "<tr><td><span class='label label-danger'>Opps! No Record Found</span></td></tr>"; } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  