<?php 
$obj = new welcome_model();
$news = $obj->getsinglrowLimit('latest_news', []);
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>MyInformation</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/front/images/logo.png" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/front/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/front/css/custom.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>assets/front/css/animation.css">
        <!-- <link rel="stylesheet" href="<?= base_url(); ?>assets/front/css/owl.carousel.min.css"> -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/front/css/animate.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/front/css/space.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/front/css/theme.css">
    <script type="text/javascript" src="<?= base_url(); ?>assets/front/js/jquery.js"></script>
    <style>
        .navbar-brand>img {
    display: block;
    width: 114px;
    position: absolute;
    left: 10px;
    top: 2px;
}
        select.goog-te-combo {
    padding: 11px 11px;
    position: absolute;
    top: -4px;
    border: 0;
    border-radius: 50px;
    left: 0px;
    color: #820506;
    box-shadow: 0 0 5px #000;
    outline:none;
}
        section.topbar {
    background: #820506;
    padding: 15px 0 10px;
    margin-bottom: 5px;
    color: #fff;
    text-transform: capitalize;
    font-size: 16px;
    line-height: 1.5;
    box-shadow: 0 0 5px #000;
}
.middlebar{
    color: #6c2e16;
    background: #fff;
    margin-bottom: 5px;
    box-shadow: 0 0 5px #000;
}
.middlebar h4{
    line-height: 1.3;
}
section.menubar {
    background: #820506;
    padding: 10px;
    margin-bottom: 5px;
    box-shadow: 0 0 5px #000;
}
.affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
  }
  .dropdown.open .dropdown-toggle {
    border-radius: 50px;
    background:#db7946;
    color:#820506;
}
.dropdown.open .dropdown-toggle:hover .dropdown-menu{
    color:#820506;
}
.dropdown.open .dropdown-menu a:hover, .nav.nav-pills li:hover{
    background: #db7946;
    border-radius: 50px;
    box-shadow: 1px 1px 5px #7d7575;
}
 .nav.nav-pills li {
    background: #fff;
    border-radius: 50px;
    box-shadow: 1px 1px 5px #7d7575;
    margin: 5px;
  }
  .nav.nav-pills li a{
      color: #820506;
  }
  .nav.nav-pills li.active{
    background: #db7946;
    border-radius: 50px;
    box-shadow: 1px 1px 5px #7d7575;
  }
  .nav.nav-pills li.active a{
      color: #fff;
  }
  .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: middle;
    border-top: 1px solid #ddd;
}
a.goog-logo-link {
    display: none;
}
.goog-te-banner-frame {
    left: 0px;
    top: 0px;
    height: 0;
    width: 100%;
    z-index: 10000001;
    position: fixed;
    border: none;
    border-bottom: 1px solid #6b90da;
    margin: 0;
    -moz-box-shadow: 0 0 8px 1px #999999;
    -webkit-box-shadow: 0 0 8px 1px #999999;
    box-shadow: 0 0 8px 1px #999999;
    _position: absolute;
    display: none;
}
.goog-te-gadget {
    font-family: arial;
    font-size: 11px;
    color: #666;
    white-space: nowrap;
    margin: 10px;
}
body{
    position: relative; min-height: 100%; top: 0px !important;
}
.carousel-control.left, .carousel-control.right{
    background-image: none;
}
    </style>
</head>

<body data-spy="scroll" data-target=".menubar" data-offset="50">
    <header>
        <section class="topbar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-3">
                        <span style="margin-left:120px;">Latest News :</span>
                    </div>
                    <div class="col-xs-9">
                        <marquee><?= $news->heading; ?></marquee>
                    </div>
                </div>
            </div>
        </section>
        <!-- <section class="middlebar">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-1">
                        <a href="home.html"><img src="<?= base_url(); ?>assets/front/images/logo.png" width="100%"></a>
                    </div>
                    <div class="col-md-11">

                        <h4>"My Information" विश्व की एक ऐसी Library हैं,जिसमें आपकी सम्पूर्ण आवश्यक "व्यक्तिगत एवं
                            पारिवारिक" जानकारीयों को जीवनभर के लिये "SAVE & SAVE" सुरक्षित रखा जायेगा ।</h4>
                        <h4>शादी के योग्य लोगों को वैवाहिक सूत्र में बाँधने के लिए भी "My Information" एक अनूठा
                            प्रयास करने जा रहा हैं ।
                            इस महान और पावन कार्य अगर आप चाहे तो अपना अमूल्य योगदान भी दे सकते हैं ।</h4>
                        <h4>इस सामाजिक कार्य को करने पर बेरोजगार को रोजगार,वर्तमान कार्य के साथ-साथ अतिरिक्त समय
                            निकालकर इस कार्य को करने पर " Share And Earn " योजना के अंतर्गत आपको एक सम्मानजनक राशि
                            और सम्मानजनक स्थान दिलाने पर "My Information" प्रतिज्ञाबद्ध हैं ।</h4>

                    </div>
                </div>
            </div>
        </section> -->
        <section class="menubar" data-spy="affix" data-offset-top="197">
            <div class="container-fluid">
                <div class="header clearfix">
                <a class="navbar-brand" href="#">
                <img src="<?= base_url(); ?>assets/front/images/logo.png">
                </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#primary-nav"
                        aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="fa fa-bars"></span>
                    </button>
                    <nav class="main-nav navbar-collapse collapse" id="primary-nav" style="margin-left:90px;">
                        <ul class="nav nav-pills">
                            <li class="active"><a href="<?= base_url();?>">Main Page</a></li>
                            <li><a href="<?= about;?>">About Us</a></li>
                            <li><a href="<?= share_earn;?>">Share And Earn</a></li>
                           <li><a href="<?= faq;?>">FAQ</a></li>
                           <?php if(empty($this->session->userdata['user']['id']))
                            {
		                        ?>
                            <li><a href="<?= signup; ?>">Registration</a></li>
                            
                                <li><a href="<?= login;?>">Login</a></li>
                                <?php } ?>
                            <li><a href="download">Download App</a></li>
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">More
                                <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?= packege;?>">Plan</a></li>
                                    <li><a href="<?= legal;?>">Legal</a></li>
                                    <li><a href="<?= our_bank; ?>">Our Bank</a></li>
                                    <li><a href="<?= regional_experts;?>">Regional Experts</a></li>
                                    <li><a href="<?= contact;?>">Contact Us</a></li>
                                </ul>
                            </li>
                            <?php if(!empty($this->session->userdata['user']['id']))
                            {
		                        ?>
                            <li><a href="<?= logout;?>">Logout</a></li>
                            <?php } ?>
                            <li id="google_translate_element">
                                <!-- <div ></div> -->
                            </li>
                           
                        </ul>
                        
                    </nav> 
                </div>
            </div>
        </section>
    </header>