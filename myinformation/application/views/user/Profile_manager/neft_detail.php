<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <div class="row">
                <div class="col-lg-12">
                    <h4 class="m-t-0 header-title"><b>Bank Details</b></h4>
                    <p class="text-muted font-13 add_bank_btn">
                        <a href="<?php echo site_url('user/neftDetail/bank');?>">
					        <button class="btn btn-info"><?php if(!empty($bank['user']->bank)) { echo "Edit Bank Details"; } else { echo "Add Bank Details";}?></button>
                        </a>
                    </p>
                    <div class="p-20">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bank Name</th>
                                        <th>Account Number</th>
                                        <th>IFSC Code</th>
                                        <th>Branch</th>
                                        <th>Branch City</th>
                                        <th>Nominee Name</th>
                                        <th>Relation</th>
                                        <th>Nominee Age</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td scope="row">1</td>
                                        <td scope="row"><?php if(isset($bank['user']->bank)) { echo $bank['user']->bank; } ?></td>
                                        <td scope="row"><?php if(isset($bank['user']->account_number)) { echo $bank['user']->account_number; } ?></td>
                                        <td scope="row"><?php if(isset($bank['user']->ifsc_code)) { echo $bank['user']->ifsc_code;  } ?></td>
                                        <td scope="row"><?php if(isset($bank['user']->branch)) { echo $bank['user']->branch;  } ?></td>
                                        <td scope="row"><?php if(isset($bank['user']->bank_city)) { echo $bank['user']->bank_city; } ?></td>
                                        <td scope="row"><?php  if(isset($bank['user']->nominee)) { echo $bank['user']->nominee; } ?></td>
                                        <td scope="row"><?php if(isset($bank['user']->relation)) { echo $bank['user']->relation; } ?></td>
                                        <td scope="row"><?php  if(isset($bank['user']->nominee_age)) { echo $bank['user']->nominee_age; } ?></td>
                                        
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>