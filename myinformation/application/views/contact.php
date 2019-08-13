<?php $this->load->view('layout/header');?>
    <article>
    <img src="<?= base_url(); ?>assets/front/images/contact.jpg" width="100%">
        <section class="about">
       
            <div class="container-fluid">
                <div class="row">
                <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <section class="">
                            <div style="padding:5% 10%;box-shadow: 0px 0px 5px #ccc;border-radius: 5px;">
                            <h2 style="text-align: center;text-transform: capitalize; color: #ffffff;background: #820506;font-size: 20px;padding: 15px;border-radius: 50px;box-shadow: 2px 2px 5px #000;">Contact with us</h2>
                                <form>
                                    <!-- <label class="text-warning">Full Name</label> -->
                                    <input type="text" class="form-control" placeholder="Full Name"><br>
                                    <!-- <label class="text-warning">Contact Number</label> -->
                                    <input type="tel" class="form-control" placeholder="Contact Number"><br>
                                    <!-- <label class="text-warning">Email Address</label> -->
                                    <input type="email" class="form-control" placeholder="Email Address"><br>
                                    <!-- <label class="text-warning">Your Message</label> -->
                                    <textarea rows="5" class="form-control" placeholder="Write Message" style="resize:none"></textarea>
                                    <button style="display: block;
    margin: 5% auto 0;
    background: #820506;
    border: none;
    border-radius: 50px;
    padding: 15px;
    width: 150px;
    color: #fff;">Submit</button>
                                </form>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-4">
                        <section class="">
                            <div style="padding:5% 10%;box-shadow: 0px 0px 5px #ccc;border-radius: 5px;">
                            <h2 style="text-align: center;text-transform: capitalize; color: #ffffff;background: #820506;font-size: 20px;padding: 15px;border-radius: 50px;box-shadow: 2px 2px 5px #000;">Contact info</h2>
                            <label class="text-info"><i class="fa fa-phone text-warning"></i> +917693098987 (For WhatsApp Only)</label><br>
                            <label class="text-info"><i class="fa fa-phone text-warning"></i> +919826698987 (For Call Only)</label><br>
                            <!-- <label class="text-info"><i class="fa fa-phone text-warning"></i> +91 98 76 543 210</label><br> -->
                            <label class="text-info"><i class="fa fa-envelope text-warning"></i> info@myinformation.in</label><br>
                            <!-- <label class="text-info"><i class="fa fa-envelope text-warning"></i> support@myinformation.in</label><br> -->
                            <label class="text-info"><i class="fa fa-map-marker text-warning"></i> Old Number- 12/9/1022, M.Azad Marg (08-Shikari Gali), Sendhwa (451666), Madhya Pradesh (India)</label>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3679.572572127441!2d75.89183401490708!3d22.74412303238469!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3962fd541cc92fb7%3A0x84fe7fdd973a8f3e!2sC21+Mall!5e0!3m2!1sen!2sin!4v1549282689920" width="100%" height="230" frameborder="0" style="border:0" allowfullscreen></iframe>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
            </div>
        </section>


    <!--Download-Section-->
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

    </article>

    
    <?php $this->load->view('layout/footer');?>