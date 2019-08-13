<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Self Monthly Node (Left & Right) Information</h4>
        </div>
    </div>
</div>


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>Self Monthly Node History</b></h4>
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>left Income</th>
                        <th>Right Income</th>
                        <th>On Month</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php if(!empty($sponsorhistory)) { $i=1; foreach($sponsorhistory as $row) { ?>
                    <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->left_income ?></td>
                            <td><?= $row->right_income ?></td>
                           <td><?= date('M,Y',strtotime($row->on_month)) ?></td>
                            
                    </tr>
                        <?php } } else{  echo "<tr><td colspan='5'><span class='label label-danger'>Opps! No Record Found</span></td></tr>"; } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  