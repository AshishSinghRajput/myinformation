<?php $this->load->view('layout/header'); ?>
    <article>
        <section>
            <div class="about">
                <div class="container">
                    <h2>Login</h2>
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6" style="    box-shadow: 0 0 5px #ccc;padding: 30px;">
                            <form method="post">
                            <p class="contact_success_box"><?php if(isset($msg)){echo $msg; } ?>
                            <?php if(!empty($this->session->flashdata('error'))) { ?>
                                <div class="alert alert-danger">
                                    <?= $this->session->flashdata('error'); ?>
                                </div>
                                <?php } ?>
                            
                            </p>
                                <div class="form-group">
                                    <label for="" class="form-label">Your User ID<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="MOBILE11"  name="sponsor_id" placeholder="Your User ID">
                                    <span class="text-danger"><?= form_error('sponsor_id'); ?></span>
                                    <label for="" class="col-form-label">Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" placeholder="password">
                                    <span class="text-danger"><?= form_error('password'); ?></span>
                                    <label for="check" class="col-form-label">
                                        <input type="checkbox" id="check">
                                        Remember</label>
                                    <input type="submit" class="form-control btn btn-outline-info" value="Login">
                                </div>
                            </form>
                            <!-- <label for="" class="col-form-label" style="border-bottom: 1px solid #222;width: 100%;text-align: end;">
                                <a href="#" class="text-info">Forgot Password?</a>
                            </label> -->
                            <p class="reg-p"><a href="<?= signup; ?>" class="text-info">Please Create a new Account</a></p>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                </div>
            </div>
            
        </section>
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
    <?php $this->load->view('layout/footer'); ?>