<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Sponsor First Level Report</h4>
        </div>
    </div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="card-box table-responsive">
			<h4 class="m-t-0 header-title"><b>Sponsor Level Report</b></h4>
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
                <?php $i=1; foreach ($firstLevel as $row):   ?>
				<tr>
					<td><?= $i++; ?></td>
					<td><?= $row->self_id; ?></td>
					<td><?= $row->first_name." ".$row->last_name; ?></td>
					<td><?= date('M d, Y',strtotime($row->creation_at)); ?></td>
                    <td>1</td>
				</tr>
                <?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>