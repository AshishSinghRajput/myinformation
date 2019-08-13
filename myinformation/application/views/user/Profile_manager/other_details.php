<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Fill Personal Deatails </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card-box">
            <h4 class="m-t-0 header-title"><b>Fill Form</b></h4>
            <?= form_open('',array('method'=>'post')); ?>
            <div class="row">
                <div class="col-md-6">
                    <div class="p-20">
                        <h5><b>Married Status</b></h5>
                           <label class="text-pink">Unmarried:</label><input type="radio" name="married_status" value="0" id="alloptions" />
                           <label class="text-pink"> Married:</label><input type="radio" name="married_status" value="1" id="alloptions1" />
                        <span class="text-danger"><?= form_error('married_status'); ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-20">
                        <h5><b>Salary</b></h5>
                           <input type="text" class="form-control" name="brother_nmae" id="alloptions" />
                        <span class="text-danger"><?= form_error('brother_nmae'); ?></span>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="p-20">
                     <button class="btn btn-info pull-left">Submit</button>
                    </div>
                </div>
            </div>
        <?= form_close(); ?>
        </div>
    </div>
</div>


    
<?php 

    if(!empty($this->session->flashdata('message'))){
       
        echo "<script>window.onload=function() { $.Notification.notify ('".$this->session->flashdata('class')."','top right','".$this->session->flashdata('message')."'); } </script>";
    }
   


?>

