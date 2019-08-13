<div class="row">
  <div class="col-sm-12">
    <div class="card-box">
        <h4 class="page-title"> Activation/Upgration Self ID</h4>
              <div class="panel-body">
                 <?php foreach($upgrade_notice as $row) {?>  
                 <p><?php if(isset($row->message)){echo $row->message;}?></p>
                 <?php } ?>    
          </div>
    </div>
  </div>
</div>
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <div class="row">

                        <h4 class="m-t-0 header-title"><b>Activation/Upgration Self</b></h4>
                         <span class="text-danger"><?= $this->session->flashdata('amt');?></span>
                        <form method="post"> 
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Enter E-Pin</label>
                                    <input type="text" name="epin" value="" class="form-control">
                                    <span class="text-danger"><?= form_error('epin');?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Select Method</label></br>
                                    Activation <input type="radio" name="method" value="1"> Upgration <input type="radio" name="method" value="2">
                                    <span class="text-danger"><?= form_error('method');?></span>
                                </div>
                            </div>
                        </br>
                            <button type="submit" class="btn btn-purple waves-effect waves-light">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
   