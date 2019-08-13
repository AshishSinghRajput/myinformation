
<link rel="stylesheet" href="<?= BASEURL;?>assets/plugins/magnific-popup/css/magnific-popup.css"/>

   <div class="container">
        <!-- Page-Title -->
        <?php if(!empty($allcertificatedata)) { ?>
        <div class="row">
                <h4 class="page-title">All Document</h4>
            </div>
        </div>
        
        <h4>All Marksheet</h4>
    <div class="row port">
        <div class="portfolioContainer">
            <div class="col-sm-4 col-md-3 col-lg-4 webdesign illustrator">
                <div class="gal-detail thumb">
                <?php 
                        if(isset($allcertificatedata)){

                            $img10 = unserialize($allcertificatedata->tenth_class_certificate_img);
                        
                ?>
                    <a href="<?php echo base_url('uploads/education/school/').$img10[0]; ?>" class="image-popup" title="Screenshot-1">
                        <img src="<?php echo base_url('uploads/education/school/').$img10[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>10th</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 graphicdesign illustrator photography">
                <div class="gal-detail thumb">
                <?php 
                     $img12 = unserialize($allcertificatedata->twelfth_class_certificate_img);
                ?>
                    <a href="<?php echo base_url('uploads/education/school/').$img12[0]; ?>" class="image-popup" title="Screenshot-2">
                        <img src="<?php echo base_url('uploads/education/school/').$img12[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>12th</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 webdesign graphicdesign">
                <div class="gal-detail thumb">
                <?php 
                     $grad = unserialize($allcertificatedata->graduation_certificate_img);
                ?>
                    <a href="<?php echo base_url('uploads/education/school/').$grad[0]; ?>" class="image-popup" title="Screenshot-3">
                        <img src="<?php echo base_url('uploads/education/school/').$grad[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Graduation</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 illustrator photography">
                <div class="gal-detail thumb">
                <?php 
                     $postgrad = unserialize($allcertificatedata->postgraduation_certificate_img);
                ?>
                    <a href="<?php echo base_url('uploads/education/school/').$postgrad[0]; ?>" class="image-popup" title="Screenshot-4">
                        <img src="<?php echo base_url('uploads/education/school/').$postgrad[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Post Graduation</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 graphicdesign photography">
                <div class="gal-detail thumb">
                <?php 
                     $otheredu = unserialize($allcertificatedata->other_education_certificate_img);
                ?>
                    <a href="<?php echo base_url('uploads/education/school/').$otheredu[0]; ?>" class="image-popup" title="Screenshot-5">
                        <img src="<?php echo base_url('uploads/education/school/').$otheredu[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Other Education</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 webdesign photography">
                <div class="gal-detail thumb">
                <?php 
                     $voterimg = unserialize($allcertificatedata->votar_img);
                ?>
                    <a href="<?php echo base_url('uploads/special/voter/').$voterimg[0]; ?>" class="image-popup" title="Screenshot-6">
                        <img src="<?php echo base_url('uploads/special/voter/').$voterimg[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Voter Id</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 illustrator photography graphicdesign">
                <div class="gal-detail thumb">
                <?php 
                     $adharimg = unserialize($allcertificatedata->aadhar_img);
                ?>
                    <a href="<?php echo base_url('uploads/special/addhar/').$adharimg[0]; ?>" class="image-popup" title="Screenshot-7">
                        <img src="<?php echo base_url('uploads/special/addhar/').$adharimg[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Adhar card</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 graphicdesign photography webdesign">
                <div class="gal-detail thumb">
                <?php 
                     $panimg = unserialize($allcertificatedata->pan_img);
                ?>
                    <a href="<?php echo base_url('uploads/special/pan/').$panimg[0]; ?>" class="image-popup" title="Screenshot-8">
                        <img src="<?php echo base_url('uploads/special/pan/').$panimg[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Pan card</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 webdesign illustrator">
                <div class="gal-detail thumb">
                <?php 
                     $birthimg = unserialize($allcertificatedata->birth_img);
                ?>
                    <a href="<?php echo base_url('uploads/special/birth/').$birthimg[0]; ?>" class="image-popup" title="Screenshot-9">
                        <img src="<?php echo base_url('uploads/special/birth/').$birthimg[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Birth certificate</h4>
                </div>
            </div>
            <h4></h4>
            <div class="col-sm-4 col-md-3 col-lg-4 photography graphicdesign">
                <div class="gal-detail thumb">
                <?php 
                     $castimg = unserialize($allcertificatedata->cast_img);
                ?>
                    <a href="<?php echo base_url('uploads/special/cast/').$castimg[0]; ?>" class="image-popup" title="Screenshot-10">
                        <img src="<?php echo base_url('uploads/special/cast/').$castimg[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Caste certificate</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 graphicdesign photography">
                <div class="gal-detail thumb">
                <?php 
                     $disabilitimg = unserialize($allcertificatedata->disability_img);
                ?>
                    <a href="<?php echo base_url('uploads/special/desable/').$disabilitimg[0]; ?>" class="image-popup" title="Screenshot-11">
                        <img src="<?php echo base_url('uploads/special/desable/').$disabilitimg[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Disability certificate</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 webdesign graphicdesign illustrator">
                <div class="gal-detail thumb">
                <?php 
                     $incomimg = unserialize($allcertificatedata->income_img);
                ?>
                    <a href="<?php echo base_url('uploads/special/income/').$incomimg[0]; ?>" class="image-popup" title="Screenshot-12">
                        <img src="<?php echo base_url('uploads/special/income/').$incomimg[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Income certificate</h4>
                </div>
            </div>
            <h4></h4>
            <div class="col-sm-4 col-md-3 col-lg-4 graphicdesign illustrator photography">
                <div class="gal-detail thumb">
                <?php 
                     $specialcerimg = unserialize($allcertificatedata->speciality_img);
                ?>
                    <a href="<?php echo base_url('uploads/special/speciality_img/').$specialcerimg[0]; ?>" class="image-popup" title="Screenshot-2">
                        <img src="<?php echo base_url('uploads/special/speciality_img/').$specialcerimg[0]; ?>" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Special certificate</h4>
                </div>
            </div>

            <!-- <div class="col-sm-4 col-md-3 col-lg-4 webdesign graphicdesign">
                <div class="gal-detail thumb">
                    <a href="<?= base_url();?>assets/images/gallery/3.jpg" class="image-popup" title="Screenshot-3">
                        <img src="<?= base_url();?>assets/images/gallery/3.jpg" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>1<sup>St</sup> Class</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 illustrator photography">
                <div class="gal-detail thumb">
                    <a href="<?= base_url();?>assets/images/gallery/4.jpg" class="image-popup" title="Screenshot-4">
                        <img src="<?= base_url();?>assets/images/gallery/4.jpg" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>2<sup>nd</sup> Class</h4>
                </div>
            </div>
            <h4>Personal Id</h4>
            <div class="col-sm-4 col-md-3 col-lg-4 photography graphicdesign">
                <div class="gal-detail thumb">
                    <a href="<?= base_url();?>assets/images/gallery/10.jpg" class="image-popup" title="Screenshot-10">
                        <img src="<?= base_url();?>assets/images/gallery/10.jpg" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Aadhar Card</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 graphicdesign photography">
                <div class="gal-detail thumb">
                    <a href="<?= base_url();?>assets/images/gallery/11.jpg" class="image-popup" title="Screenshot-11">
                        <img src="<?= base_url();?>assets/images/gallery/11.jpg" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Pan Card</h4>
                </div>
            </div>

            <div class="col-sm-4 col-md-3 col-lg-4 webdesign graphicdesign illustrator">
                <div class="gal-detail thumb">
                    <a href="<?= base_url();?>assets/images/gallery/12.jpg" class="image-popup" title="Screenshot-12">
                        <img src="<?= base_url();?>assets/images/gallery/12.jpg" class="thumb-img" alt="work-thumbnail">
                    </a>
                    <h4>Voter Id</h4>
                </div>
            </div>
             -->
            

        </div>
<?php }  ?>
<?php }else{ ?>
    <h3 class="text-center text-danger" style="margin-top: 15%;">!!No Data Found!!</h3>
    <?php } ?>
    </div> <!-- End row -->


</div> <!-- container -->

<script type="text/javascript" src="<?= BASEURL;?>assets/plugins/isotope/js/isotope.pkgd.min.js"></script>
        <script type="text/javascript" src="<?= BASEURL;?>assets/plugins/magnific-popup/js/jquery.magnific-popup.min.js"></script>
          
        <script type="text/javascript">
            $(window).load(function(){
                var $container = $('.portfolioContainer');
                $container.isotope({
                    filter: '*',
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });

                $('.portfolioFilter a').click(function(){
                    $('.portfolioFilter .current').removeClass('current');
                    $(this).addClass('current');

                    var selector = $(this).attr('data-filter');
                    $container.isotope({
                        filter: selector,
                        animationOptions: {
                            duration: 750,
                            easing: 'linear',
                            queue: false
                        }
                    });
                    return false;
                }); 
            });
            $(document).ready(function() {
                $('.image-popup').magnificPopup({
                    type: 'image',
                    closeOnContentClick: true,
                    mainClass: 'mfp-fade',
                    gallery: {
                        enabled: true,
                        navigateByImgClick: true,
                        preload: [0,1] // Will preload 0 - before current, and 1 after the current image
                    }
                });
            });
        </script>
