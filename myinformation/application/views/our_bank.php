<?php $this->load->view('layout/header');?>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
  
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(odd) {
  background-color: #dddddd;
}
</style>
    <article>
    <img src="<?= base_url(); ?>assets/front/images/orubankimage.jpg" width="100%">


    <div style="padding:30px 0;">
    <div class="container">
        <div class="row" >
            <div class="col-md-2">
            <img src="<?= base_url(); ?>assets/front/images/canara-bank-logo-400x300.jpg" width="100%">
            </div>
            <div class="col-md-10">
            <div class="row bg-info">
                <div class="col-md-3">Bank's Name- </div>
                <div class="col-md-9">Canara Bank</div>
            </div>
            <div class="row ">
                <div class="col-md-3">Branch Name- </div>
                <div class="col-md-9">Sendhwa</div>
            </div>
            <div class="row bg-info">
                <div class="col-md-3">Branch Address-</div>
                <div class="col-md-9">Old A.B.Road, Jawahar Ganj, Sendhwa (451666), Madhya Pradesh (India)</div>
            </div>
            <div class="row  ">
                <div class="col-md-3">Account Holder's Name-  </div>
                <div class="col-md-9">DIB Services (OPC) Pvt. Ltd </div>
            </div>
            <div class="row  bg-info">
                <div class="col-md-3">Account Number- </div>
                <div class="col-md-9">4755201000106</div>
            </div>
            <div class="row ">
                <div class="col-md-6">Other payment options are as follows- </div>
            </div>
            <div class="row bg-info ">
                <div class="col-md-3"><b>Payment option </b>  </div>
                <div class="col-md-3"><b>Mobile  Number</b>  </div>
                <div class="col-md-6"><b>Upi Address</b> </div>
            </div>
            <div class="row ">
                <div class="col-md-3"> <img src="<?= base_url(); ?>assets/front/images/03-PaytmLogo-1800x1137.jpg" height="100%" width="20%">Paytm  </div>
                <div class="col-md-3">7693098987</div>
                <div class="col-md-6">7693098987@paytm</div>
            </div>
            <div class="row bg-info ">
                <div class="col-md-3"> <img src="<?= base_url(); ?>assets/front/images/1_tkgmeTTVBz7hsF8LzcapoA.png" width="20%">Phonepe</div>
                <div class="col-md-3">7693098987      </div>
                <div class="col-md-6">7693098987@paytm </div>
            </div>
            <div class="row ">
                <div class="col-md-3"> <img src="<?= base_url(); ?>assets/front/images/246x0w.jpg" width="20%">Google Pay (Tez)</div>
                <div class="col-md-3">7693098987</div>
                <div class="col-md-6">7693098987@paytm</div>
            </div>

            <div class="row bg-info">
                <div class="col-md-3"> <img src="<?= base_url(); ?>assets/front/images/bhim-69501.png" style="background:white"width="20%">BHIM</div>
                <div class="col-md-3">7693098987      </div>
                <div class="col-md-6">7693098987@paytm </div>
            </div>
           
            <div class="row ">
                <div class="col-md-3"> IFSC Code- </div>
                <div class="col-md-9">CNRB0004755 </div>
            </div>
            </div>
        </div>
    </div>
    </div>
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
<?php $this->load->view('layout/footer');?>