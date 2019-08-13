<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Self 90 Days History</h4>
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Self 90 Days History</b></h4>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Left Income</th>
                        <th>Right Income</th>
                        <th>In-Between</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php if(!empty($sponsor90dayshisory)) { $i=1; foreach($sponsor90dayshisory as $row) { ?>
                    <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->left_income ?></td>
                            <td><?= $row->right_income ?></td>
                            <td></td>
                    </tr>
                        <?php } } else{  echo "<tr><td colspan='5'><span class='label label-danger'>Opps! No Record Found</span></td></tr>"; } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  