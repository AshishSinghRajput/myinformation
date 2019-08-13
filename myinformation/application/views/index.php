<?php $this->load->view('layout/header');?>
<style>
#owl-demo .item img{
    display: block;
    width: 100%;
    height: auto;
}
.owl-carousel .owl-item img {
    width: auto;
    max-width: 100%;
}
.panel-default {
    border: medium none;
    box-shadow: 2px 2px 7px -2px #dddddd;
    margin-bottom: 20px !important;
    padding: 5px;
}

.panel-default > .panel-heading {
    background-color: transparent;
    border-color: transparent;
}

.panel-default > .panel-heading + .panel-collapse > .panel-body {
    border-top-color: transparent;
}

.panel {
    border: medium none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}
.panel-title a {
    display: block;
}
.overlay-bg {
    background: rgba(0, 0, 0, 0) linear-gradient(to right, #251414 0%, #6d2f17 0%, #820506 100%) repeat scroll 0 0 !important;
}

#accordion .panel-title a {
    position: relative;
}

#accordion .panel-title a:after {
    content: "\f078" !important;
    font-family: FontAwesome !important;
    font-size: 12px;
    position: absolute;
    right: 0;
    top: 50%;
    -webkit-transform: translateY(-50%);
    transform: translateY(-50%);
    -webkit-transition: 0.3s;
    transition: 0.3s;
}

#accordion .panel-title a.collapsed:after {
    content: "\f077" !important;
}
#scrollUp {
    background-color: #820506 !important;
    border: 1px solid #820506 !important;
    border-radius: 2px;
    bottom: 30px;
    color: #ffffff;
    /* height: 40px; */
    line-height: 3;
    right: 30px;
    text-align: center;
    width: 40px;
}

.big-button:after {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    opacity: 1;
    -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";
    background: #820506;
    background: rgba(0, 0, 0, 0) linear-gradient(to right, #251414 0%, #6d2f17 0%, #820506 100%) repeat scroll 0 0 !important;
    background: linear-gradient(to right, #0a4488 0%, #3ca5cd 0%, #1743e2 100%);
    filter: progid: DXImageTransform.Microsoft.gradient( startColorstr='#00c9fd', endColorstr='#81ee8e', GradientType=1);
    -webkit-transition: 0.3s;
    transition: 0.3s;
}
.carousel-inner{
    border-radius:20px;
}
hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #820506;
}
.plan .plan-box{
    border: 2px solid #820506;
    border-radius: 10px;
    padding: 15px;
}
.plan .plan-box h1{
    color:#820506;
}
.plan .plan-box p{
    text-align:center;
}
.plan .plan-box button{
    background: #820506;
    color: #fff;
    padding: 15px 30px;
    border-radius: 50px;
    border: none;
    margin: 15px 0 0;
}
</style>


    <section class="slider">

        <div class="slider">

        <div id="myCarousel" class="carousel carousel-fade" data-ride="carousel">
    <!-- Indicators -->
    <!-- <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol> -->

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <!-- <img src="<?= base_url(); ?>assets/front/images/logo.png" style="position: absolute;z-index: 999;top: 10px;right: 10px;width: 150px;"> -->
        <?php  $i=1;foreach($slider as $rows):
               $active = "";
              $img = unserialize($rows->slider_img);
              for ($j = 0; $j < count($img); $j++) {
               
        ?>
        <div class="item <?= $i==1 ? 'active' : "" ?>">
            <img src="<?php echo base_url('uploads/slider/').$img[$j];?>" alt="Slider Image Not found" style="width:100%;">
            <div class="carousel-caption">
                <h3><?= $rows->slider_tagline;?></h3>
                <p><?= $rows->description;?></p>
            </div>
        </div>
        <?php $i++; } ?>
            <?php   endforeach; ?>
      <!-- <div class="item">
        <img src="<?= base_url(); ?>assets/front/images/slide3.png" alt="Chicago" style="width:100%;">
        <div class="carousel-caption">
        <h3>Los Angeles</h3>
        <p>LA is always so much fun!</p>
      </div>
      </div>
    
      <div class="item">
        <img src="<?= base_url(); ?>assets/front/images/slide4.png" alt="New york" style="width:100%;">
        <div class="carousel-caption">
        <h3>Los Angeles</h3>
        <p>LA is always so much fun!</p>
      </div>
      </div>-->
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

        <!-- <div id="owl-demo" class="owl-carousel owl-theme">
            <div class="item"><img src="<?= base_url(); ?>assets/front/images/slide2.png" alt="GTA V"></div>
            <div class="item"><img src="<?= base_url(); ?>assets/front/images/slide3.png" alt="Mirror Edge"></div>
            <div class="item"><img src="<?= base_url(); ?>assets/front/images/slide4.png" alt="The Last of us"></div>
        </div> -->

            <!-- <div class="container-flmuslimd">

                <div id="wowslider-container1" style="border-radius: 20px;">

                    <div class="ws_images" style="overflow:hidden;">

                        <ul>

                            <li><img src="<?= base_url(); ?>assets/front/images/slide5.png" alt="" title=""></li>

                            <li><img src="<?= base_url(); ?>assets/front/images/slide1.png" alt="" title=""></li>

                            <li><img src="<?= base_url(); ?>assets/front/images/slide2.png" alt="" title=""></li>

                            <li><img src="<?= base_url(); ?>assets/front/images/slide3.png" alt="" title=""></li>

                            <li><img src="<?= base_url(); ?>assets/front/images/slide4.png" alt="" title=""></li>

                        </ul>

                    </div>

                </div>

            </div> -->

        </div>

    </section>

    <article>
        <section class="marrige">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <!-- <section class="success"> -->
                            <h2>Marriage should be like this</h2>
                            <!-- <div class="container-flmuslimd">
                                <div id="wowslider-container1" style="border-radius: 20px;">
                                    <div class="ws_images" style="overflow:hidden;">
                                        <ul>
                                        <li><img src="<?= base_url(); ?>assets/front/images/f15.png" alt="slide" title="slide" width="100%"></li>
                                            <li><img src="<?= base_url(); ?>assets/front/images/f16.png" alt="slide1" title="slide1" width="100%"></li>
                                            <li><img src="<?= base_url(); ?>assets/front/images/f17.png" alt="slide2" title="slide2" width="100%"></li>
                                            <li><img src="<?= base_url(); ?>assets/front/images/f18.png" alt="slide3" title="slide3" width="100%"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        <!-- </section> -->

                        <div id="myCarousel1" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel1" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel1" data-slide-to="1"></li>
    <li data-target="#myCarousel1" data-slide-to="2"></li>
    <li data-target="#myCarousel1" data-slide-to="3"></li>
    <li data-target="#myCarousel1" data-slide-to="4"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="<?= base_url(); ?>assets/front/images/m1.png" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="<?= base_url(); ?>assets/front/images/m2.png" alt="Chicago">
    </div>

    <div class="item">
      <img src="<?= base_url(); ?>assets/front/images/m3.png" alt="New York">
    </div>

    <div class="item">
      <img src="<?= base_url(); ?>assets/front/images/m4.png" alt="New York">
    </div>
    <div class="item">
      <img src="<?= base_url(); ?>assets/front/images/m5.png" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
</div>
</div>
                    <div class="col-md-4">
                        <!-- <section class="success"> -->
                            <h2>Now towards a fantastic personality</h2>
                            <!-- <div class="container-flmuslimd">
                                <div id="wowslider-container1" style="border-radius: 20px;">
                                    <div class="ws_images" style="overflow:hidden;">
                                        <ul>
                                            <li><img src="<?= base_url(); ?>assets/front/images/f11.png" alt="slide" title="slide" width="100%"></li>
                                            <li><img src="<?= base_url(); ?>assets/front/images/f12.png" alt="slide1" title="slide1" width="100%"></li>
                                            <li><img src="<?= base_url(); ?>assets/front/images/f13.png" alt="slide2" title="slide2" width="100%"></li>
                                            <li><img src="<?= base_url(); ?>assets/front/images/f14.png" alt="slide3" title="slide3" width="100%"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> -->
                        <!-- </section> -->

                        <div id="myCarousel2" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel2" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel2" data-slide-to="1"></li>
    <li data-target="#myCarousel2" data-slide-to="2"></li>
    <li data-target="#myCarousel2" data-slide-to="3"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="<?= base_url(); ?>assets/front/images/f11.png" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="<?= base_url(); ?>assets/front/images/f12.png" alt="Chicago">
    </div>

    <div class="item">
      <img src="<?= base_url(); ?>assets/front/images/f13.png" alt="New York">
    </div>

    <div class="item">
      <img src="<?= base_url(); ?>assets/front/images/f14.png" alt="New York">
    </div>
  </div>

  <!-- Left and right controls -->
</div>
                    </div>
                    <div class="col-md-4">
                        <!-- <section class="success"> -->
                            <h2>Our companions</h2>
                            <marquee scrollamount="3" direction="up" width="100%" height="280" style="border: 1px solid #ccc;  border-radius: 20px;">
                                <?php if(!empty($mtchincm)) { ?>
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>User ID</th>
                                            <th>Name</th>
                                            <th>City</th>
                                            <th>State</th>
                                            <th>Country</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php  foreach($mtchincm as $match) :
                                        
                                        ?> 
                                        <tr>
                                             <td><?= $match->sponsor_id;?></td>
                                            <td><?= $match->full_name;?></td>
                                            <td>Indore</td>
                                            <td>Madhya Pradesh</td>
                                            <td>India</td>
                                            
                                        </tr>
                                        <?php  endforeach; ?>
                                    </tbody>
                                </table>
                                    <?php } else{ echo '<h3 style="color:red;">Record Not Found</h3>';} ?>
                            </marquee>
                        <!-- </section> -->
                    </div>
                </div>
            </div>
            </div>
        </section>




        <!-- <section class="about">
            <h2>About My Information</h2>
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                    <h4>"MyInformation" विश्व की एक ऐसी Library हैं,जिसमें आपकी सम्पूर्ण आवश्यक "व्यक्तिगत एवं
                            पारिवारिक" जानकारीयों को जीवनभर के लिये "SAVE & SAVE" सुरक्षित रखा जायेगा ।</h4>
                            <br>
                        <h4>शादी के योग्य लोगों को वैवाहिक सूत्र में बाँधने के लिए भी "MyInformation" एक अनूठा
                            प्रयास करने जा रहा हैं ।
                            इस महान और पावन कार्य अगर आप चाहे तो अपना अमूल्य योगदान भी दे सकते हैं ।</h4>
                            <br>
                        <h4>इस सामाजिक कार्य को करने पर बेरोजगार को रोजगार,वर्तमान कार्य के साथ-साथ अतिरिक्त समय
                            निकालकर इस कार्य को करने पर " Share And Earn " योजना के अंतर्गत आपको एक सम्मानजनक राशि
                            और सम्मानजनक स्थान दिलाने पर "My Information" प्रतिज्ञाबद्ध हैं ।</h4>
                            <br>
                        <a href="#" class="btn">Read More</a>
                        <br>
                    </div>
                    <div class="col-md-3">
                        <img src="<?= base_url(); ?>assets/front/images/logo.png" class="d-block w-100">
                    </div>
                </div>
            </div>
        </section> -->



        <section class="vission">
            <div class="container">
                <div class="row">
                    <!-- <div  class="col-md-2"></div> -->
                    <div class="col-md-6 animated fadeInDown">
                        <h2>
                            <i class="fa fa-bullseye"></i>
                        </h2>
                        <h2>Our Mission</h2>
                        <p>हमारा मुख्य लक्ष्य "My Information" से जुड़े सभी सदस्यों की जीवन शैली, व्यक्तिगत और पारिवारिक विवरणों को व्यवस्थित करना है।</p>
                        <p>अविवाहित सदस्यों को उनकी इच्छा के अनुसार जीवन साथी चुनने में मदद करना भी हमारी प्राथमिकता है।</p>
                        <p>हमारा लक्ष्य सभी सदस्यों के आर्थिक आधार को मजबूत करके वित्तीय स्वतंत्रता प्रदान करना है। पूरी दुनिया में आज बेरोजगारी बढ़ रही है। रोजगार या व्यवसाय होने के बावजूद लोग अपना जीवन ठीक से नहीं जी पा रहे हैं।"My Information" ने सभी को पूंजीपति बनाने का फैसला किया है, ताकि वे समाज में एक सम्मानजनक स्थान और प्रतिष्ठा प्राप्त कर सकें।</p>
                        <p>सभी को वित्तीय रूप से मजबूत करके उन्हें वित्तीय स्वतंत्रता प्रदान करना भी "MyInformation" का एक मिशन है।</p><hr>
                        <p> Our main goal is to organize the lifestyle, personal and family details of all the members connected with "my information".</p>
                        <p> It is also our priority to help unmarried members to choose a life partner according to their wishes.</p>
                        <p> Our goal is to provide financial independence by strengthening the economic base of all the members.</p>
                        <p> Unemployment is increasing today in the whole world.Despite having employment or business, people have not been able to live their lives properly."My Information" has decided to make everyone a bourgeoisie, so that they can get a respectable position and reputation in the society.</p>
                        <p>Providing financial independence to all by financially strengthening them is also a mission of "MyInformation".</p>
                    </div> 
                    <div class="col-md-6 animated fadeInDown">
                        <h2>
                            <i class="fa fa-bullseye"></i>
                        </h2>
                        <h2>Our Vision</h2>
                        <p>"My Information" के सदस्यों की जीवन शैली को बदलना हमारा विशेष दृष्टिकोण है।</p>
                        <p>"My Information" के माध्यम से, प्रत्येक व्यक्ति जन्म से लेकर वर्तमान तक की जीवनी को व्यवस्थित कर सकता है और अपने परिवार से जानकारी इकट्ठा करके अपनी वंशावली को व्यवस्थित कर सकता है।</p>
                        <p>"My Information" के माध्यम से, अविवाहित व्यक्ति अपनी योग्यता / नौकरी / व्यवसाय के आधार पर अपने जीवनसाथी को सही समय पर पा सकते हैं।</p>
                        <p style="margin-top: 32px;">आज के समय में, कई धर्मों / समाजों / जातियों में, सही समय पर, अविवाहित युवक-युवतियों का विवाह नहीं हो रहा है, इस वजह से कई गलत धारणाएँ जन्म लेती हैं, जो सामाजिक दृष्टिकोण से सही नहीं हैं। इन बातों को ध्यान में रखते हुए, "My Information" ने ध्यान में रखा है कि, ऐसी पहल की जानी चाहिए, ताकि किसी को भी लाभ हो सके।</p><hr>
                        <p> Changing the lifestyle of members of "My Information" is our special approach.</p>
                        <p> Through "My Information", each person can organize the biography from birth to the present and can organize its genealogy by gathering information from his family.</p>
                        <p> Through "My Information", unmarried persons can find their spouse at the right time, on the basis of their qualifications / jobs / business.</p>
                        <p style="margin-top:18px"> In today's time, in many religions / societies / castes, at the right time, unmarried young men and women are not getting married, due to this many misconceptions are born, which are not right from the social perspective. Keeping these things in mind, "My Information" has taken into consideration that, such an initiative should be made, so that anyone can benefit.</p>
                  <br><br>
                        </div>
                    <!-- <div  class="col-md-2"></div> -->

                    <!-- <div class="col-md-4 animated fadeInDown">
                        <h2>
                            <i class="fa fa-cubes"></i>
                        </h2>
                        <h2>Integrity</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has
                            been the industry's standard dummy text ever since the 1500s, when an unknown printer took
                            a galley of type and scrambled it to make a type specimen book. It has survived not only
                            five centuries, but also the leap into electronic typesetting, remaining essentially
                            unchanged. It was popularised in the 1960s with the release of Letraset sheets containing
                            Lorem Ipsum passages, and more recently with desktop publishing software like Aldus
                            PageMaker including versions of Lorem Ipsum.</p>
                    </div> -->
                </div>

            </div>

        </section>

        <section class="relative fix">
        <!-- <div class="space-10"></div> -->
        <div class="section-bg overlay-bg">
            <img src="<?= base_url(); ?>assets/front/images/t_bg.jpg" alt="">
        </div>
        <div class="container" style="color:#fff">
            <div class="row wow fadeInUp">
                <div class="col-xs-12 col-md-6 col-md-offset-3 text-center text-white">
                    <h3 class="text-capitalize">"testimonial"</h3>
                </div>
            </div>
            
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                <?php $i=10;foreach($test as $row):
                    $active = "";
                    if ($i == 1) 
                    {
                        $active = 'active';
                    }
                    $i++;
                    ?>
                    <div class="item  <?= $active;?>">
                        <div class="slide-box">
                            <h1>
                                <i class="fa fa-quote-left"></i>
                            </h1>
                            <p>
                               <?= $row->description; ?>
                            </p>
                            <?php 
                                $imge = unserialize($row->img); 
                                    for($i=0; $i<count($imge);$i++)
                                    {
                            ?>
                            <img src="<?= base_url('uploads/testmonial/').$imge[$i]; ?>">
                         <?php } ?>
                            <h6 style="text-align:right"><i> <?= $row->client_name; ?></i> <br> <?= $row->city; ?>, <?= $row->state; ?></h6>
                        </div>
                    </div>
                <?php endforeach;  ?> 
                    <!-- <div class="item">
                        <div class="slide-box">
                            <h1>
                                <i class="fa fa-quote-left"></i>
                            </h1>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has
                                been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took
                                a galley of type and scrambled.
                            </p>
                            <h6 style="text-align:right"><i>Sudeep Sahu</i> <br> Indore, Madhya Pradesh</h6>
                            <img src="<?= base_url(); ?>assets/front/images/m13.png">
                        </div>
                    </div>
                    <div class="item">
                        <div class="slide-box">
                            <h1>
                                <i class="fa fa-quote-left"></i>
                            </h1>
                            <p>
                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                Ipsum has
                                been the industry's standard dummy text ever since the 1500s, when an unknown
                                printer took
                                a galley of type and scrambled.
                            </p>

                            <h6 style="text-align:right"><i>Sudeep Sahu</i> <br> Indore, Madhya Pradesh</h6>

                            <img src="<?= base_url(); ?>assets/front/images/m15.png">

                        </div>

                    </div> -->

                </div>

                </div>
        </div>
        <!-- <div class="space-10"></div> -->
    </section>
    
   



    <!-- <link rel="stylesheet" href="https://www.needyy.com/recobike/website/css/bootstrap.min.css"> -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/front/css/owl.carousel.min.css">
    <!-- <link rel="stylesheet" href="https://www.needyy.com/recobike/website/css/themify-icons.css"> -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/front/css/animate.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/front/css/space.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/front/css/theme.css">
    <!-- <link rel="stylesheet" href="https://www.needyy.com/recobike/website/css/overright.css"> -->


    
        <!--Screenshot-Section-->
    <section id="app">
        <!-- <div class="space-80"></div> -->
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
                    <h3 class="text-capitalize">"App Screenshots"</h3>
                    <p>My Information "App" के कुछ "Screeshots" इस प्रकार हैं -</p>
                </div>
            </div>
            <!-- <div class="space-60"></div> -->
            <div class="row wow fadeIn">
                <div class="col-xs-12">
                    <div class="space-40"></div>
                    <div class="list_screen_slide">
                        <div class="item">
                            <a href="<?= base_url(); ?>assets/front/images/screen1.jpg" class="work-popup">
                                <img src="<?= base_url(); ?>assets/front/images/screen1.jpg" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="<?= base_url(); ?>assets/front/images/screen2.jpg" class="work-popup">
                                <img src="<?= base_url(); ?>assets/front/images/screen2.jpg" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="<?= base_url(); ?>assets/front/images/screen3.jpg" class="work-popup">
                                <img src="<?= base_url(); ?>assets/front/images/screen3.jpg" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="<?= base_url(); ?>assets/front/images/screen4.jpg" class="work-popup">
                                <img src="<?= base_url(); ?>assets/front/images/screen4.jpg" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="<?= base_url(); ?>assets/front/images/screen5.jpg" class="work-popup">
                                <img src="<?= base_url(); ?>assets/front/images/screen5.jpg" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="<?= base_url(); ?>assets/front/images/screen6.jpg" class="work-popup">
                                <img src="<?= base_url(); ?>assets/front/images/screen6.jpg" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="<?= base_url(); ?>assets/front/images/screen7.jpg" class="work-popup">
                                <img src="<?= base_url(); ?>assets/front/images/screen7.jpg" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="<?= base_url(); ?>assets/front/images/screen8.jpg" class="work-popup">
                                <img src="<?= base_url(); ?>assets/front/images/screen8.jpg" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="<?= base_url(); ?>assets/front/images/screen9.jpg" class="work-popup">
                                <img src="<?= base_url(); ?>assets/front/images/screen9.jpg" alt="">
                            </a>
                        </div>
                        <div class="item">
                            <a href="<?= base_url(); ?>assets/front/images/screen10.jpg" class="work-popup">
                                <img src="<?= base_url(); ?>assets/front/images/screen10.jpg" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="space-40"></div>
                </div>
            </div>
            <div class="row wow fadeInUp">
                <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
                    <p  style="margin-top:30px;">Some "Screenshots" of My Information "App" are as follows -</p>
                </div>
            </div>
        </div>
        <!-- <div class="space-80"></div> -->
    </section>
    <!--Screenshot-Section/-->
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
    <!--Download-Section/-->

    <!--Question-section-->
    <section class="fix" id="faq">
        <!-- <div class="space-80"></div> -->
        <div class="container">
            <div class="row wow fadeInUp">
                <div class="col-xs-12 col-md-6 col-md-offset-3 text-center">
                    <h3 class="text-capitalize">Frequently asked questions</h3>
                    <p>Here are some special questions and their answers that are important to you, knowing who your thoughts will be better than before -</p>
                </div>
            </div>
            <div class="space-40"></div>
            <div class="row">
                <div class="col-xs-12 col-md-6 wow fadeInUp">
                    <div class="space-60"></div>
                    <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                ये “My Information” क्या हैं ? कृपया इसे स्पष्ट करें ?</a></h4>
                            </div>
                            <div id="collapse1" class="panel-collapse collapse in">
                                <div class="panel-body">
                                <p>"My Information" विश्व की एक ऐसी Library हैं,जिसमें आपकी सम्पूर्ण आवश्यक "व्यक्तिगत एवं पारिवारिक" जानकारीयों को जीवनभर के लिये सुरक्षित रखा जायेगा।<br>
                                "My information" विवाह योग्य लोगों को शादी में बाँधने के लिए एक अनूठा प्रयास करने जा रही है।<br>
                                इस महान और पवित्र कार्य में, यदि आप चाहें, तो आप अपना अमूल्य योगदान भी दे सकते हैं।</p>

                                <p>यदि आप इस महान कार्य को जन-जन तक पहुंचाने में अपना अमूल्य योगदान देते हैं, तो यह किसी पुण्य कार्य से कम नहीं होगा।</p>

                                <p>अपने बहुमूल्य योगदान को जनता तक पहुँचाने के लिए, आपको एक सहायता राशि भी दी जाएगी जो आपके लिए पर्याप्त होगी।<br>
                                वह सहकारी राशि इतनी हो सकती है कि आपकी अगली सात पीढ़ियों को जीवन में कभी भी आर्थिक तंगी का सामना न करना पड़े।</p>

                                <p>यह सामाजिक कार्य बेरोजगारों के लिए एक रोजगार होगा जो किसी वरदान से कम नहीं होगा ...<br>
                                मौजूदा काम के साथ, अतिरिक्त काम करने वालों के लिए एक आर्थिक वरदान भी है ...</p>

                                <p>हमारा मतलब...सहयोग के साथ कमाई,वो भी असीमित<br>
                                हमारा मतलब..."आम के आम और गुठलियों के दाम"</p>

                                <p>इस काम को करने पर, आप "साझा करें और कमाएँ" योजना के तहत एक सम्मानजनक राशि और सम्मानजनक स्थान पाने के लिए "My Information" के लिए प्रतिबद्ध हैं।</p>

                                <p>यह आवश्यक नहीं है कि आप "My Information" में Income कमाने वाले के रूप में काम करें।<br>
                                हमारा उद्देश्य आपको बिल्कुल भी लुभाना नहीं है।<br>
                                लेकिन अगर आपकी भावना आहत हुई है, तो हमें क्षमा करें।<br>
                                लेकिन अगर आप एक सामाजिक कार्यकर्ता हैं तो इस काम में भाग लेकर आप कई लोगों और कई समाजों को वित्तीय मदद भी कर सकते हैं।</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse3">
                                        आपके द्वारा दी गई जानकारीयों को आपकी आने वाली पीढ़ी निम्नानुसार देख पायेगी</a></h4>
                            </div>
                            <div id="collapse3" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <p>🔸आप किसके पुत्र थे ?</p>
                                    <p>🔹आप कब और कहाँ पैदा हुए थे ?</p>
                                    <p>🔸आपकी पारिवारिक स्थिति कैसी थी ?</p>
                                   <p> 🔹आपके कितने भाई-बहन थे ?</p>
                                    <p>🔸आपकी शिक्षा कितनी हुई थी ?</p>
                                    <p>🔹आपने अपने जीवन मे कितना और कैसे संघर्ष किया ?</p>
                                    <p>🔸आप अपने जीवन में कितना विफल और सफल हुए ?</p>
                                    <p>🔸आपने कितनी सम्पत्ति अर्जित की थी ?</p>
                                    <p>🔹आपके पिता से आपको कितनी सम्पत्ति प्राप्त हुई थी ?</p>
                                    <p>🔸आपका स्वास्थ कैसा रहता था ?</p>
                                    <p>🔹आपके पिता,के पिता,के पिता,के पिता. कौन थे ?</p>
                                    <p>🔸आप किस पीढ़ी की,कौनसी सन्तान हैं ?</p>
                                    <p>🔹वर्तमान में आपका कुटुम्ब/परिवार/खानदान/पीढ़ी कहाँ पर निवासरत हैं ?</p>
                                    <p>🔸आप कहाँ के निवासी कहलाते हो ?</p>
                                    <p>🔹 यदि आप बातें "My Information" के माध्यम से आपकी सम्पूर्ण जानकारियों को SAVE करेंगे तो आपकी पीढ़ी को कभी भी आपके बारें में जानने में परेशानी नहीं होगी,जिससे आपका कोई संदेश इस वेबसाईट के माध्यम से आपकी पीढ़ी तक जाता रहेगा ।</p>
                                    <p>🔸आपकी तबीयत कब,कैसे,क्यों खराब हुई ?,</p>
                                    <p>🔹आपने किस डॉक्टर को दिखाया ?,</p>
                                    <p>🔸आपको उस डॉक्टर ने कौनसी दवाई लिखकर दी ?</p>
                                   <p> इन सभी जानकारियों को अगर आप इस वेबसाईट पर SAVE करेंगे तो कभी भी आपकी जानकारियों (History) को कभी भी,किसे भी,आपकी सारी रिपोर्ट्स को,दिखाकर अपना ईलाज व्यवस्थित ढंग से करवा सकोगे तो आपके लिए यह अच्छा ही होगा
                                    आप इस वेबसाईट पर जो भी जानकारी लिखकर रखेंगे,वो लिखित मार्गदर्शन आपकी आने वाली पीढ़ी को हमेशा के लिए काम में आने वाला हैं,इसलिये आपको किसी भी हालत में आपकी सम्पूर्ण जानकारी को किसी भी प्रकार से जानकारियाँ प्राप्त करके भरना ही हैं ।</p>

                                <p>भारत सहित विश्व का प्रत्येक व्यक्ति,प्रत्येक धर्म के लोग,प्रत्येक जाति और समाज के लोग अब एक साथ इस वेबसाईट के माध्यम से जुड़कर अपना बॉयोडाटा जीवन भर के लिए Save कर पायेंगे ।</p>

                                आप जब भी चाहे तो इस website के माध्यम से अपने और अपने परिवार के लिये लड़का (वर) या लड़की (वधू) को भी खोजकर वैवाहिक सम्बन्ध स्थापित कर सकते हैं</p>

                               <p> यह जरुरी नहीं हैं कि इस वेबसाईट के माध्यम से आपकी या किसी अन्य की शादी हो ही जायें,
                                किन्तु "MyInformation" के माध्यम से,यदि आपकी या किसी अन्य की शादी हो जाती हैं तो "MyInformation" को बहुत खुशी होगी </p>
                                <p>ऐसे समय में "My Information" की भूमिका,आपके जीवन में सबसे श्रेष्ठ होगी,क्योंकि आज के समय में किसी भी व्यक्ति के पास अब इतना समय नहीं रहा कि वो आपके लिये समय निकाल सकें ।
                                अब तो आपके पास सबकुछ हैं लेकिन समय नहीं होने के कारण आपको आपके रिश्तेदारों पर निर्भर रहना पड़ता हैं। कभी-कभी तो आपकी जल्द शादी कराने के चक्कर में आप गलत जगह रिश्ता कर बैठते हैं,जिसका परिणाम आपको जीवनभर भुगतने को मिलता हैं ।
                                आजकल तो शादी कराने के लिये कई मैरेज ब्यूरो खुल चुके हैं,जो आपसे लाखों रुपये लेकर भी आपको संतुष्ट नही करा पाते हैं.</p>
                                <p>लेकिन "MyInformation" आपसे इस सम्बन्ध में किसी भी प्रकार से कोई धनराशि नहीं लेता हैं । आप घर बैठे ही अपना कार्य बिना किसी रोकटोक के पूरा कर सकते हो,बशर्ते "MyInformation" में मौजूद "Information" आपके लायक हो,
                                यदि आप सभी इस महान कार्य में अपना अमूल्य सहयोग देकर "MyInformation" का "DATA" इकट्ठा करने में मदद करोगे तो "My Information" आपका जीवनभर ऋणी रहेगा,क्योंकि आपके कारण ही इकट्ठे "DATA" को सभी लोग देखकर अपना कार्य सफल कर पायेंगे ।</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse4">
                                इस प्लॉन से जुड़ने के हमें क्या करना होगा ? हमारी जॉइनिंग कैसे होगी ?</a></h4>
                            </div>
                            <div id="collapse4" class="panel-collapse collapse">
                                <div class="panel-body">
                                <p>इसमें सम्मिलित होने के कई आसान तरीके हैं -</p>

<p>पहला तरीका- प्राप्त जानकारी में दिए गए लिंक पर क्लिक करने पर Registration पृष्ठ खुल जाएगा, जिसमें आप अपनी जानकारी भरकर अपना Registration कर सकते हैं।</p>

<p>दुसरा तरीका- आपको www.myinformation.in पर Registration करने का विकल्प दिखाई देगा, इसमें Sponsor का Sponsor ID Code दर्ज करके, और अपनी जानकारी भरकर खुद को पंजीकृत कर सकते हैं।</p>

<p>तीसरा तरीका- "My Information" में आपको पहले से ही जुड़े सदस्य से इस योजना के बारे में जानकारी मिल चुकी है, आप उस सदस्य को भी जानकारी भेजकर इसमें शामिल हो सकते हैं।</p>

<p>इसके बाद, अपने Sponsor से संपर्क करें और अपनी User ID को सक्रिय करें।</p>

<p>चौथा तरीका- यदि सदस्य ने आपको इस योजना के बारे में बताया है, तो उसी व्यक्ति से संपर्क करें और अपनी ID सक्रिय करें।</p>

<p>यदि "My Information" का कोई सदस्य आपके शहर या गाँव से है, तो आप उससे बहुत मदद ले सकते हैं।</p>

<p>आप इन चार तरीकों में से किसी में भी फ्री में शामिल हो सकते हैं।</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse2">
                                "My Information" में जानकारीयाँ रखने से हमें क्या फायदा होगा ? </a></h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
                                <p>"My Information" का मुख्य उद्देश्य आपके जीवन की पूरी सच्चाई को संजोना और आपकी जीवन शैली को उज्जवल बनाना है।<br>
                                    "My Information" में आप एक ही स्थान पर सभी व्यक्तिगत और पारिवारिक जानकारीयों को एकत्र कर सकते हैं और इसे समय-समय पर अपडेट कर सकते हैं, ताकि आप हमेशा खुद से पुनः परिचित हो सकें और अपनी अगली पीढ़ी को भी परिचय करा सकें।<br>
                                    इसलिए, आप जीवन भर के लिए "My Information" में अपने और अपने परिवार के सदस्यों की पूरी जानकारी सुरक्षित कर सकते हैं।<br>
                                    आपकी सभी जानकारी पूरी तरह से व्यक्तिगत रहेगी, जो समय-समय पर, आपकी कई पीढ़ियों को जानने के लिए हमेशा आसान होगी।<br>
                                    यदि आपके कारण,आपके बच्चों को आपकी सात पीढ़ियों के बारे में तुरंत जानकारी मिल जाएगी, तो यह कितना अच्छा होगा?</p>

                                    <p>हम सभी जानते हैं कि- "परिवर्तन ही दुनिया का नियम है"<br>
                                    प्रकृति के नियमों के अनुसार, प्रत्येक व्यक्ति इस दुनिया को छोड़ने के लिए बाध्य है। इस विचार के साथ, प्रत्येक व्यक्ति अपने कार्यों को निर्धारित करता है, वह इन उद्देश्यों के साथ काम करता है, अपने बच्चों और परिवार को खुश देखने के लिए कड़ी मेहनत करता है, धन और संपत्ति इकट्ठा करता है, और एक दिन, वह दुनिया छोड़ देता है। ऐसी स्थिति में उस व्यक्ति के बच्चे भी अपना उद्देश्य पूरा करके दुनिया छोड़ देंगे। इसी तरह यह सिलसिला पीढ़ियों तक चलता रहेगा।</p>

                                    <p>अब कुछ देर अपने बारे में सोचें?<br>
                                    आपने अपने बच्चों / पीढ़ियों के लिए क्या, कब, क्यों, कैसे और कितना किया? जब आपके बारे में बताने वाला कोई नहीं होगा तो आपका जीवन कैसे सार्थक होगा? क्योंकि आज आप अपनी सात पीढ़ियों के बारे में भी नहीं जानते हैं, तो आप अपनी अगली पीढ़ी से कैसे उम्मीद कर सकते हैं?</p>

                                    <p>जिस तरह से आप अपनी सात पीढ़ियों के बारे में नहीं जानते हैं, शायद आपकी अगली पीढ़ी भी आपको याद नहीं रख पायेगी कि-</p>

                                    <p>- आप कौन थे ?<br>
                                    - आप किसके पुत्र थे ?<br>
                                    - आप कब और कहाँ पैदा हुए थे ?<br>
                                    - आपके कितने भाई-बहन थे ?<br>
                                    - आपने कितनी शिक्षा प्राप्त की थी ?<br>
                                    - आपने कितनी सम्पत्ति अर्जित की थी ?<br>
                                    - आपके पिता से आपको कितनी सम्पत्ति प्राप्त हुई थी ?<br>
                                    - किस उम्र में आपका स्वास्थ्य कैसा था ?<br>
                                    - आपके पिता के पिता ... उनके पिता के पिता ... उनके पिता के पिता कौन थे ?<br>
                                    - आप किस पीढ़ी की संतान हैं ?<br>
                                    - वर्तमान में आपकी पीढ़ी कहाँ निवास कर रही है ?<br>
                                    - अपने मूल स्थान का नाम बताइए,जहाँ आपके वंशज रहते थे ?</p>

                                    <p>यदि आप अपनी पूरी जानकारी "My Information" में सहेजते हैं तो आपकी पीढ़ी को आपके बारे में जानने में कभी परेशानी नहीं होगी, जिससे आपका कोई भी संदेश इसके माध्यम से आपकी पीढ़ी तक पहुंच जायेगा।</p>

                                    <p>- आप कब, कैसे, कहाँ और क्यों बीमार हुए?<br>
                                    - आपने किस डॉक्टर को दिखाया ?<br>
                                    - डॉक्टर ने कौन सी दवा लिखी ?<br>
                                    यदि आप इन सभी सूचनाओं को "My Information" पर सहेजते हैं, तो आप अपने स्वास्थ्य इतिहास को कभी भी, कहीं भी, किसी भी तरह से, अपनी सभी रिपोर्टों में दिखा कर अपना उपचार व्यवस्थित कर सकेंगे, यह आपके लिए अच्छा रहेगा।</p>

                                    <p>"My Information" पर आप जो भी जानकारी लिखते हैं, यह लिखित मार्गदर्शिका आपकी अगली पीढ़ी के लिए हमेशा उपयोगी होगी। इसलिए, किसी भी परिस्थिति में, आपको अपनी पूरी जानकारी (किसी भी तरीके से जानकारी प्रदान करके) भरनी होगी।</p>

                                    <p>हर देश के लोग, हर धर्म के लोग, हर जाति और समाज के लोग अब "My Information" के माध्यम से एक साथ जुड़ पाएंगे और जीवन भर के लिए अपना पूरा बायोडाटा "SAFE" कर पाएंगे।</p>

                                    <p>जब भी आप चाहें, आप "My Information" के माध्यम से अपने और अपने परिवार के लिए एक लड़का या लड़की की खोज करके वैवाहिक संबंध स्थापित कर सकते हैं।<br>
                                    यह आवश्यक नहीं है कि "My Information" की मदद से आपकी या किसी और की शादी हो जाए, इस संबंध में, "My Information" सिर्फ एक सलाहकार है जो आपके रिश्ते को किसी भी तरह से जोड़ने के लिए बाध्य नहीं है। "My Information" के माध्यम से, यदि आप स्वेच्छा से अपना काम करते हैं, तो हमें बहुत खुशी होगी।</p>

                                    <p>इस महान कार्य "My Information" अभियान में शामिल होकर, आपको निश्चित रूप से अपने और परिचितों की मदद करनी चाहिए, ताकि आपका मानव जीवन सफल हो सके।</p>

                                    <p>यदि आप चाहें, तो आप "My Information" के माध्यम से भी बहुत पैसा कमा सकते हैं ?<br>
                                    यदि आप इस महान कार्य में अपना सहयोग देते हैं, तो आपको "My Information" से पर्याप्त सहयोग दिया जायेगा।<br>
                                    आप समाज सेवा के साथ-साथ लाखों / करोड़ों / अरबों / खरबों रुपये या उससे अधिक कमा सकते हैं और अपनी अगली पीढ़ियों को जीवन के लिए खुश कर सकते हैं।</p>

                                    <p><b>विशेष -</b> आपको अपनी सात पीढ़ियों की वंशावली लिखने वाले संरक्षकों से जानकारी प्राप्त करनी होगी।<br>
                                    आपको अपने वरिष्ठों से भी जानकारी प्राप्त करनी होगी।<br>
                                    और आपको "My Information" में उस जानकारी को भरना होगा।<br>
                                    क्योंकि, जिन लोगों ने आपको यह जानकारी दी है, हो सकता है कि वे आपको जीवन में दोबारा न मिलें।</p>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse6">
                                हम "My Information" में पैसा कमाने के लिए कैसे समय निकाल सकते हैं ?</a></h4>
                            </div>
                            <div id="collapse6" class="panel-collapse collapse">
                                <div class="panel-body">
                                <p>यदि आप बेरोजगार हैं, तो इस कार्य को पूरा समय दें। यदि आप पूरा समय देकर ऐसा करते हैं, तो आपको जीवन भर किसी भी रोजगार की आवश्यकता नहीं होगी। इसके माध्यम से, आप असीमित आय अर्जित करके अपनी अगली सात पीढ़ियों को खुश करेंगे।</p>

<p>यदि आप कोई कार्य-जैसे सरकारी/प्राईवेट नौकरी या व्यापार करते हो ,तो भी इस कार्य को आसानी से कर सकोगे । कैसे ?...तो आईये इसे समझते हैं-</p>

<p>आपको 1 दिवस में 24 घंटे मिलते हैं, तो इन 24 घंटो में ये निम्नलिखित तरीकों से अपना समय बिताते जाते हैं-</p>

<p>आपकी नौकरी / व्यापार  = 12 घंटे<br>
आपकी नींद ---- ------------= 8 घंटे<br>
शौचालय,नहाना ----------- = 1 घंटा<br>
भोजन(2 टाईम)------------= 1घंटा<br>
-------------------------------------------------<br>
कुल समय खर्च हुआ-------= 22 घंटे<br>
कुल समय बचा-----------= 2 घंटे (अब तक आपके ये 2 घंटे बेकार जाते थे)</p>

<p>बस,इन्हीं 2 घंटो में,आप इसे मोबाईल के द्वारा...फोन करके,ईमेल,व्हाट्सएप,SMS,यूट्यूब  के माध्यम से प्लॉन दिखाकर,विडिओ,ऑडियो,pdf फाईल,PPT फाईल भेजकर या इसकी लिंक भेजकर,समक्ष बैठकर या मीटिंग के द्वारा अपना यह कार्य बहुत ही आसानी से कर सकते हो।</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#collapse9">
कृपया किसी अन्य उदाहरण के माध्यम से "My Information" को समझाने की कृपा करें ? </a></h4>
</div>
<div id="collapse9" class="panel-collapse collapse">
<div class="panel-body">
<p>कृपया आप इस उदाहरण के माध्यम से "My Information" को समझने का प्रयास करें.... </p>

<p>मानाकि आप "My Information" में 1000 रुपये से सम्मिलित होते हो</p>

<p>तो "My Information" आपके 1000 रुपये को उन लोगों में विभाजित करेगी जो इस "सिस्टम" में आपसे पहले जुड़े हुए हैं।</p>

<p>स्टेप इन्कम के तहत, आपके कुछ रुपये पहले आपसे जुड़े 20 ऊपरी लोगों को वितरित किए जाएंगे।</p>

<p>"My Information" आपके द्वारा दिए गए 1000 रुपये में से 20-20 रुपये को उन 20 लोगों को तुरंत बांट देगी।</p>

<p>और 20 रुपये Admin को भी बांटे जाएंगे।</p>
<p>और आपके बचे हुए रुपयों को मैचिंग इन्कम में बाँट दिया जायेगा </p>
<p >id ऐक्टिवेट होने के बाद आपको एक लिंक प्राप्त होती है। परिचितों में इस लिंक को साझा करके, आप उन्हें अपने साथ जोड़ सकते हैं। </p>
<p >आपके द्वारा चुने प्लॉन अनुसार ही आपको इन्कम प्राप्त होगी।</p>
<p>अब जो लोग सीधे आपसे जुड़ेंगे, यह आपका पहला स्टेप होगा।</p>
<p>जो लोग आपके साथ जुड़े लोगों से जुड़ते हैं, यह आपका दूसरा स्टेप होगा।</p>
<p>आपके तीसरे स्टेप वाले लोग,दूसरे स्टेप के नीचे आयेंगे।</p>
<p>आप इस प्रकार के 20 स्टेप के लोगों से सीधे इन्कम प्राप्त करेंगे।</p>
<p>साथ ही, आपकी जॉइनिंग के अनुसार, आपको 20 पेयर्स तक मैचिंग इन्कम भी मिलती रहेगी।</p>
<p>पेयर का अर्थ- Left Side के लोगों की संख्या को Right Side के लोगों की संख्या से मिलान करना हैं।</p>
<p>मैचिंग इन्कम का अर्थ- मैचिंग पेयर्स की संख्या के आधार पर,आपकी जॉइनिंग के अनुसार इन्कम देना ही मैचिंग इन्कम कहलाता हैं।</p>
<p>मैचिंग इनकम के तहत, यदि आपको 1000 वे स्टेप नीचे एक जोड़ी मिलती है, तो आपको लाभ मिलेगा, बशर्ते कि पेयर की संख्या प्रतिदिन 20 पेयर्स की सीमा से बाहर न हो।</p>
<strong>Note- </strong><p> "My Information" स्वचालित रूप से प्रतिदिन 20 पैयर्स इन्कम का भुगतान करेगी।</p>
<p>अक्सर यह देखा गया है कि स्टेप इन्कम प्लॉन अच्छा तो होता हैं, लेकिन शुरुआत में, किसी व्यक्ति को कम राशि मिलने के कारण, वे इसका आनंद नहीं लेते हैं, जो किसी अन्य या मैचिंग इन्कम प्लॉन में आता है।</p>
<p>इस कारण से, स्टेप इन्कम में मैचिंग इन्कम को भी जोड़ा गया है ताकि किसी भी सदस्य को इस महान कार्य को करते समय वित्तीय समस्या न हो ताकि वह इस काम को दिल से कर सके ...</p>
</div>
</div>
</div>
                    </div>
                </div>
                <div class="hidden-xs hidden-sm col-md-5 col-md-offset-1 wow fadeInRight ">
                    <img src="<?= base_url(); ?>assets/front/images/mobile.png" alt="">
                </div>
            </div>

            <div class="row wow fadeInUp">
                <div class="col-xs-12 text-center">
                    <p style="margin-top:30px">यहाँ पर कुछ विशेष प्रश्न और उनके उत्तर दिए गए हैं जो आपके आपके लिये महत्वपूर्ण हैं, जिन्हें जानकर आपके विचार पहले से बेहतर हो जायेंगे।</p>

<!-- <p>अब सारे प्रश्न पहले हिंदी और उसीके नीचे अंग्रेजी में Show होने चाहिये।</p> -->
                </div>
            </div>
        </div>
        <!-- <div class="space-80"></div> -->
    </section>
    <!--Question-section/-->
    </article>

    <!--Plugin JS-->
    <script src="<?= base_url(); ?>assets/front/js/owl.carousel.min.js"></script>
    <script src="<?= base_url(); ?>assets/front/js/scrollUp.min.js"></script>
    <script src="<?= base_url(); ?>assets/front//js/wow.min.js"></script>

<script>
$(document).ready(function() {
 
 $("#owl-demo").owlCarousel({
     navigation : true, // Show next and prev buttons

     slideSpeed : 300,
     paginationSpeed : 400,
     autoplay:true,
    autoplayTimeout:2000,
    autoplayHoverPause:true,
    loop:true,
     items : 1, 
     itemsDesktop : false,
     itemsDesktopSmall : false,
     itemsTablet: false,
     itemsMobile : false,
     animateIn: 'fadeIn',
     animateOut: 'fadeOut',
     dots: true,

 });

});



jQuery(document).ready(function ($) {
    "use strict";
   
    /* Scroll to top
    ===================*/
    $.scrollUp({
        scrollText: '<span class="fa fa-chevron-up"></span>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

    /*WoW js Active
     =================*/
    new WOW().init({
        mobile: true,
    });
    /* list_screen_slide Active
    =============================*/
  
    /* list_screen_slide Active
    =============================*/
    $('.list_screen_slide').owlCarousel({
        loop: true,
        responsiveClass: true,
        nav: true,
        margin: 5,
        autoplay: true,
        autoplayTimeout: 4000,
        smartSpeed: 500,
        center: true,
        navText: ['<span class="fa fa-chevron-left"></span>', '<span class="fa fa-chevron-right"></span>'],
        responsive: {
            0: {
                items: 1,
            },
            600: {
                items: 3
            },
            1200: {
                items: 5
            }
        }
    });
    
    
    
   

   
    // Book List Slider
    var client_photo = $('.client_photo');
    client_photo.owlCarousel({
        loop: true,
        margin: 30,
        dots: true,
        autoplayTimeout: 4000,
        smartSpeed: 600,
        mouseDrag: true,
        touchDrag: false,
        center: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            992: {
                items: 3
            }
        }
    });
    $('.client_nav .testi_next').on('click', function () {
        client_photo.trigger('next.owl.carousel');
    });
    $('.client_nav .testi_prev').on('click', function () {
        client_photo.trigger('prev.owl.carousel');
    });

    client_photo.on('translate.owl.carousel', function (property) {
        $('.client-details-content .owl-dot:eq(' + property.page.index + ')').click();
    });
    client_photo2.on('translate.owl.carousel', function (property) {
        $('.client-photo-list .owl-dot:eq(' + property.page.index + ')').click();
    });
    /*---------------------------
    
    /*--------------------
    MAGNIFIC POPUP JS
    ----------------------*/
    $('.work-popup').magnificPopup({
        type: 'image',
        removalDelay: 300,
        mainClass: 'mfp-with-zoom',
        gallery: {
            enabled: true
        },
        zoom: {
            enabled: true, // By default it's false, so don't forget to enable it

            duration: 300, // duration of the effect, in milliseconds
            easing: 'ease-in-out', // CSS transition easing function

            // The "opener" function should return the element from which popup will be zoomed in
            // and to which popup will be scaled down
            // By defailt it looks for an image tag:
            opener: function (openerElement) {
                // openerElement is the element on which popup was initialized, in this case its <a> tag
                // you don't need to add "opener" option if this code matches your needs, it's defailt one.
                return openerElement.is('img') ? openerElement : openerElement.find('img');
            }
        }
    });
    // jQuery Ripples
    if (typeof $.fn.ripples == 'function') {
        try {
            $('.ripple').ripples({
                resolution: 500,
                perturbance: 0.04
            });
        } catch (e) {
            $('.error').show().text(e);
        }
    }
    /* Instagram-jQuery */
    jQuery.fn.spectragram.accessData = {
        accessToken: '2136707.4dd19c1.d077b227b0474d80a5665236d2e90fcf',
        clientID: '4dd19c1f5c7745a2bca7b4b3524124d0'
    };

    $('.instagram').spectragram('getUserFeed', {
        query: 'adrianengine', //this gets adrianengine's photo feed
        size: 'small',
        max: 9,
    });
     $('.feature-area a').on('mouseenter', function () {
        $(this).tab('show');
    });
}(jQuery));



</script>
    <?php $this->load->view('layout/footer');?>