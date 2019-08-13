<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Request E-cash</h4>
        </div>
    </div>
</div>
<?php

if($ecashCheck=="" || $ecashCheck->for_verify!='' && $ecashCheck->released_amount>0) { ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>For requesting e-cash</b></h4>
            <?= form_open('user/mycash'); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="p-20">
                        <h5><b>Amount</b></h5>
                        <p class="text-muted m-b-15 font-13">
                          Your actually current e-cash amount shown here.
                        </p>
                        <input type="text" readonly class="form-control" value="<?php if(isset($wallet['user']->wallet) && ($wallet['user']->wallet!='')) { echo $wallet['user']->wallet; } ?>"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-20">
                        <h5><b>Reqesting Amount</b></h5>
                        <p class="text-muted m-b-15 font-13">
                         Please enter reqeusting amount.
                        </p>
                        <input type="text" class="form-control" maxlength="25" name="amount" id="alloptions" />
                    </div>
                </div>
                <div class="col-md-6"></div>
                <div class="col-md-6">
                    <div class="p-20">
                     <button class="btn btn-info pull-right">Submit</button>
                    </div>
                </div>
            </div>
        <?= form_close(); ?>
        </div>
    </div>
</div>
<?php } else { ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="m-t-0 header-title"><b>E-cash Request Details</b></h4>
                <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Requested Amount</th>
                        <th>Pending Amount</th>
                        <th>Requested Date</th>
                        <th>Requested ID</th>
                        <th>For Verify</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>1</td>
                            <td><?= $ecashCheck->amount; ?></td>
                            <td><?= $ecashCheck->pending_amount; ?></td>
                            <td><?= date('M d, Y h:i a',strtotime($ecashCheck->requested_date)); ?></td>
                            <td><?= $ecashCheck->requested_number; ?></td>
                            <td><?php if($ecashCheck->for_verify!="") { ?> <a href="javascript:;" onclick="showImage(<?= $ecashCheck->id; ?>)">Click here</a> <?php } else { echo "<label class='label label-danger'>No File Found</label>"; } ?></td>
                            <td><?php if($ecashCheck->status!=0){ echo "<label class='label label-success'>Active</label>"; } else { echo "<label class='label label-danger'>Pending</label>"; } ?></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>For verify requesting e-cash</b></h4>
            <?= form_open_multipart('user/mycash/verify'); ?>
            <div class="error p-20"><?php if(isset($img_error) && $img_error!= '') { echo $img_error; }?></div>
            <div class="row">
                <div class="col-md-6">
                    <div class="p-20">
                        <h5><b>Upload</b></h5>
                        <p class="text-muted m-b-15 font-13">
                           Please upload image for amount verification
                        </p>
                        <input type="hidden" name="cash_id" value="<?= $ecashCheck->id; ?>">
                        <input type="file" name="image" class="form-control" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="p-20">
                        <h5><b>Please Submit</b></h5>
                        <p class="text-muted m-b-15 font-13">Before submit you sure selected image a real prove of requested amount</p>
                        <button class="btn btn-info">Submit</button>
                    </div>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
</div>
    <?php } ?>
<?php $uri=$this->uri->segment(3);
if(isset($uri))
{
    if($uri=='success')
    {
        echo "<script>window.onload=function() { $.Notification.notify('success','top right','Request send to admin for approval'); } </script>";
    }
    elseif ($uri=='imgsuccess')
    {
        echo "<script>window.onload=function() { $.Notification.notify ('success','top right','For verification image successfully uploaded please wait for approval'); } </script>";
    }
    elseif ($uri=='amterror')
    {
        echo "<script>window.onload=function() { $.Notification.notify ('error','top right','Amount should be greater than 0','Amount should be greater 0 so please enter another amount for requesting'); } </script>";
    }
}

?>

