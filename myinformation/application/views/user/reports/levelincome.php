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
                        <th>For level</th>
                        <th>On BV</th>
                        <th>Income</th>
                        <th>On Month</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                        <?php if(!empty($levelincome)) { $i=1; foreach($levelincome as $row) { ?>
                    <tr>
                            <td><?= $i++ ?></td>
                            <td><?= $row->level. "<span class='label label-info'>[".$row->percantage."%]</span>" ?></td>
                            <td><?= $row->total_bv_income ?></td>
                            <td><?= $row->level_income ?></td>
                            <td><?= date('M,Y',strtotime($row->on_month)) ?></td>
                            <td>
                                <?php  if($row->is_genrated==1 && $row->is_qualified==1 && $row->status==1) { echo "<span class='label label-success'>Success</span>"; }?>
                                <?php if($row->is_genrated==1 && $row->is_qualified==0) { echo "<span class='label label-warning'>Not Qualified</span>"; }?>
                                <?php  if($row->is_genrated==0 && $row->is_qualified==0) { echo "<span class='label label-danger'>Pending</span>";}?>    
                            <td>
                    </tr>
                        <?php } } else{  echo "<tr><td colspan='5'><span class='label label-danger'>Opps! No Record Found</span></td></tr>"; } ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  