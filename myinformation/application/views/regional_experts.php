<?php $this->load->view('layout/header');?>
<!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css"> -->
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css">
<img src="<?= base_url(); ?>assets/front/images/meeting.jpg" width="100%">
    <article>
        <div class="container-fluid">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
        <?php if(!empty($regional)) { ?>
        <thead>
            <tr>
            <th>#</th>
                <th>Name</th>
                <th>Mobile Number</th>
                <th>Languege</th>
                <th>Region</th>
                
            </tr>
        </thead>
        <tbody>
            <?php $a=1;foreach($regional as $row): ?>
            <tr>
                <td><?= $a++;?></td>
                <td><?= $row->first_name;?> <?= $row->last_name;?></td>
                <td><?= $row->mobile;?></td>
                <td><?= $row->languege;?></td>
                <td><?= $row->region;?></td>
            </tr>
        <?php endforeach;?>
        </tbody>
        <?php } else{ ?>
            <h3 style="color:red;text-align:center;">Regional Experts Record Not Found..</h3>
        <?php } ?>
    </table>
        </div>
         <!-- <section class="relative fix" id="App">
        <div class="space-80"></div> 
        <div class="section-bg overlay-bg">
            <img src="<?= base_url(); ?>assets/front/images/a_bg.jpg" alt="">
        </div>
        <div class="container">
            <div class="row wow fadeInUp">
            <div class="col-xs-12 col-sm-3   wow fadeInRight ">
                    <img src="<?= base_url(); ?>assets/front/images/mobile.png" alt="" width="100%">
                </div>
                <div class="col-xs-12 col-sm-9 text-center text-white">
                <div class="space-60"></div>
                    <h3 class="text-capitalize">Download MyInformation Today</h3>
                    <p>Lorem ipsum madolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor coli
                        incididunt ut labore Lorem ipsum madolor sit amet.</p>
                        <div class="space-60"></div>
                        <a href="#" class="big-button aligncenter">
                        <span class="big-button-icon">
                            <span class="fa fa-android"></span>
                        </span>
                        <span>Available On</span>
                        <br>
                        <strong>Play Store</strong>
                    </a>
                </div>
                
            </div>
             <div class="space-60"></div> 
        </div>
        <div class="space-80"></div> 
    </section> -->
    <section class="relative fix" id="App">
        <!-- <div class="space-80"></div> -->
        <div class="section-bg overlay-bg">
            <img src="<?= base_url(); ?>assets/front/images/a_bg.jpg" alt="">
        </div>
        <div class="container">
            <div class="row wow fadeInUp">
            <div class="col-xs-12 col-sm-3   wow fadeInRight ">
                    <img src="<?= base_url(); ?>assets/front/images/mobile.png" alt="" width="100%">
                </div>
                <div class="col-xs-12 col-sm-9 text-center text-white">
                <div class="space-60"></div>
                    <h3 class="text-capitalize">So download the "My Information" App today</h3>
                    <p>You can also download this "App" by typing My Information on Google Play Store or clicking on the link given here -</p>
                        <!-- <div class="space-40"></div> -->
                        <a href="#" class="big-button aligncenter">
                        <span class="big-button-icon">
                            <span class="fa fa-android"></span>
                        </span>
                        <span>Available on</span>
                        <br>
                        <strong>Play Store</strong>
                    </a>
                    <p style="margin-top:20px">आप Google Play Store पर My Information लिखकर या यहाँ दिए गए लिंक पर क्लिक करके भी इस "App" को डाउनलोड कर सकते हैं।</p>
                </div>
                
            </div>
            <!-- <div class="space-60"></div> -->
           
        </div>
        <!-- <div class="space-80"></div> -->
    </section>
    <!--Download-Section/-->

    <!--Question-section-->
    
    
    </article>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
<?php $this->load->view('layout/footer');?>