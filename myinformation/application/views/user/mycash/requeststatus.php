<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Requested E-cash Report </h4> </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box table-responsive">
            <h4 class="m-t-0 header-title"><b>E-cash Request Details</b></h4>
            <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>S.No.</th>
                    <th>User Id</th>
                    <th>Name</th>
                    <th>Requested Amount</th>
                    <th>Requested Date</th>
                    <th>Requested ID</th>
                    <th>For Verify</th>
                    <th>Approved Amount</th>
                    <th>Approved Date</th>
                    <th>Status</th>
                    <th>Remark</th>
                </tr>
                </thead>
                <tbody>
                <?php if(!empty($status)) { $i=1; foreach($status as $row): ?>
                    <tr>
                        <td>
                            <?= $i++; ?>
                        </td>
                        <td>
                            <?= $row->user_id; ?>
                        </td>
                        <td>
                            <?= $row->user_name; ?>
                        </td>
                        <td>
                            <?= $row->amount; ?>
                        </td>
                        <td>
                            <?= date('M d, Y h:i a',strtotime($row->requested_date)); ?>
                        </td>
                        <td>
                            <?= $row->requested_number; ?>
                        </td>
                        <td>
                            <?php if($row->for_verify!="") { ?> <a href="javascript:;" onclick="showImage(<?= $row->id ?>)">Click</a>
                            <?php } else { echo "<label class='label label-danger'>No File Found</label>"; } ?>
                        </td>
                        <td>
                            <?= $row->released_amount; ?>
                        </td>
                        <td>
                            <?php if($row->released_date!='') { echo date('M d, Y h:i a',strtotime($row->released_date)); } else { echo "<label class='label label-danger'>Not Available</label>"; }?>
                        </td>
                        <td>
                            <?php if($row->status!=0){ echo "<label class='label label-success'>Released</label>"; } else { echo "<label class='label label-danger'>Pending</label>"; } ?>
                        </td>
                        <td>
                            <?php if($row->remark==''){?>

                            <?php echo "<label class='label label-danger'>Not Available</label>"; } else { ?> <a href="#remarkModal<?= $row->id; ?>" class="waves-effect waves-light label label-success" data-animation="newspaper" data-plugin="custommodal" data-overlaySpeed="200" data-overlayColor="#36404a">View Remark</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <!--Remark Modal Start-->
                    <div id="remarkModal<?= $row->id ?>" class="modal-demo">
                        <button type="button" class="close" onclick="Custombox.close();"> <span>&times;</span><span class="sr-only">Close</span> </button>
                        <h4 class="custom-modal-title">Remark</h4>
                        <div class="custom-modal-text">
                            <?= $row->remark; ?>
                        </div>
                    </div>
                    <!--Remark Modal End-->
                <?php endforeach; } else { echo "<script>window.onload=function() { $.Notification.notify ('warning','top right','Sorry No record founded'); }</script>"; } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>