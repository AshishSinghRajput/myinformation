<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Sponsor Second Level Report</h4>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>Sponsor Second Report</b></h4>
            <table id="datatable" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>S.NO.</th>
                    <th>Associate ID</th>
                    <th>Name</th>
                    <th>Joining Date</th>
                    <th>Level</th>
                </tr>
                </thead>
                <tbody>
              <?php $i=1; foreach ($secondLevel as $row):
				    for($j=0;$j<count($row); $j++){
                    if(!empty($row[$j])){
                    ?>
                <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $row[$j]->self_id; ?></td>
                        <td><?= $row[$j]->first_name." ".$row[$j]->last_name; ?></td>
                        <td><?= date('M d, Y',strtotime($row[$j]->creation_at)); ?></td>
                        <td>2</td>
                </tr>
                <?php }  ?>

                    <?php }  endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
