<?php $this->load->view('layout/header'); ?>
    <article>
        <section>
            <div class="about">
                <div class="container">
                    <h2>Registration</h2>
                    <div class="row">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-6" style="box-shadow: 0 0 5px #ccc;padding: 30px;">
                            <form action="<?= signup;?>"  method="post">
                            <div class="text-danger">
                                <?php if (!empty($this->session->flashdata('msg'))) {?>
                                <div class="alert alert-<?=$this->session->flashdata('class')?> alert-dismissible">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?=$this->session->flashdata('msg')?>
                                </div>
                                <?php }?>
                            </div>
                                <div class="form-group">
                                    <label for="" class="form-label">Your Sponsor ID Code<span class="text-danger">*</span></label>
                                    <br><b><span id="msgs"></span></b>
                                    <input type="text" class="form-control" name="sponsor_id" <?php if(!empty($_GET['id'])) { echo "readonly"; } ?> onkeyup="checkdata(this.value,'1');" value="<?php if(!empty($_GET['id'])) { echo $_GET['id']; } else { echo set_value('sponsor_id'); } ?>" id="spo" placeholder="Enter sponsor id">
									<span class="text-danger"><?= form_error('sponsor_id')?></span>
                                    
                                    
									<label for="sab" class="col-form-label" style="width:49%"> <input type="radio" name="placement" value="left" checked id="sab"> Left</label>
									<label for="saba" class="col-form-label" style="width:49%"><input type="radio" name="placement" value="right" id="saba" > Right</label>
									<span class="text-danger"><?= form_error('placement')?></span>

									<!-- <label for="" class="col-form-label">Your User ID Code <span class="text-danger">*</span></label>
                                     <input type="text" value="<?= set_value('user_name'); ?>" name="user_name" class="form-control" id="NAME" placeholder="Enter User name"> -->
									<span class="text-danger"><?= form_error('user_name')?></span>
                                    <label for="" class="col-form-label">Your Name (With Surname) <span class="text-danger">*</span></label>
                                     <input type="text" value="<?= set_value('full_name'); ?>" name="full_name" class="form-control" id="NAME1" placeholder="Enter Name">
									<span class="text-danger"><?= form_error('full_name')?></span>
                                   
                                    <label for="" class="col-form-label">Your Country<span class="text-danger">*</span></label>
                                    
                                     <select  name="country" class="form-control" >
                                        <option value="">Choose Country</option>
                                        <?php foreach($country as $row) { ?>
                                        <option value="<?= $row->countries_name;?>"><?= $row->countries_name;?></option>
                                        <?php } ?>
                                     </select>
                                     <span class="text-danger"><?= form_error('country')?></span>
                                     
									<span class="text-danger"><?= form_error('Country')?></span>
                                    <label for="" class="col-form-label"> Your Contact No.<span class="text-danger">*</span></label>
                                     <select  name="countries_isd_code" class="" style="position: absolute;padding: 6px;border-radius: 3px;z-index: 99;margin: 41px 0px 0 -120px;">
                                        <option value="">Country ISD Code</option>
                                        <?php foreach($country as $row) { ?>
                                        <option value="<?= $row->countries_isd_code;?>">+<?= $row->countries_isd_code;?></option>
                                        <?php } ?>
                                     </select>
                                     <input type="text" value="<?= set_value('mobile'); ?>" name="mobile" class="form-control" id="MOBILE" placeholder="Enter Mobile Number" style="position: relative;padding-left: 30%;">
									<span class="text-danger"><?= form_error('mobile')?></span>
                                    
                                    <label for="" class="col-form-label">Your E-mail ID</span></label>
                                     <input type="text" value="<?= set_value('email'); ?>" name="email" class="form-control" id="EMAIL" placeholder="Enter Email Id">
                                     <span class="text-danger"><?= form_error('email')?></span>

									<label for="" class="col-form-label">Your Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="password" id="PASS" value="<?= set_value(''); ?>" placeholder="Password">
									<span class="text-danger"><?= form_error('password')?></span>
									<label for="" class="col-form-label">Your Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" class="form-control" name="confirm" id="txtconfirmpass"  placeholder="Confirm Password">
                                        <span class="text-danger"><?= form_error('confirm')?></span>
                                    <label for="check" class="col-form-label">
                                        <input type="checkbox" name="checkbx" id="chk11">
                                        I agree to terms and conditions <span class="text-danger">*</span></label>
                                        <span class="text-danger"><?= form_error('checkbx')?></span>
                                    <input type="submit" class="form-control btn btn-outline-info" id="" value="Register">
                                    <img src="/Content/loader.gif" class="loader" style="display:none;width:25px">
                                </div>
                                
                            </form>
                            <p class="reg-p" style="border-top: 1px solid #222; padding-top: 10px"><a href="<?= login; ?>"
                                class="text-info">I have already an Account Please Login</a></p>
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
    <!--Download-Section/-->

    <!--Question-section-->
 
    </article>
    <?php $this->load->view('layout/footer'); ?>
<script>
   function checkdata(id,value){
       var msg= '';
            if(value==1){
                 msg =  $("#msgs").html('loading...');
                }else{
                    msg =  $("#msgu").html('loading...');
                }
        $.ajax({
            url: '<?= site_url("welcome/getname") ?>',
            dataType:'json',
            type:'POST',
            data:{id:id},
            beforeSend: function(result){
               msg;
            },error: function(result){
                msg;
            },success: function(result){
                if(value==1){
                    if(result.success==1){
                        $("#msgs").css('color','rgb(243, 86, 5)');
                        $("#msgs").html(result.msg);
                    }else{
                        $("#msgs").css('color','red');
                        $("#msgs").html(result.msg);
                    }
                }else{
                    if(result.success==1){
                        $("#msgu").css('color','green');
                        $("#msgu").html(result.msg);
                    }else{
                        $("#msgu").css('color','red');
                        $("#msgu").html(result.msg);
                    }
                }
            }
        });
    }
</script>
<script>
   
$("#UpLoginFormName").on('keyup change blur', function(){
    var selfid = $("#self_idd").val();
    console.log(selfid+'='+this.value);
		$.ajax({
      url: '<?php echo site_url('welcome/getupsponsornmae/')?>'+this.value,
      method : 'GET',
      data : {sponsor_id : selfid ,upline_id : this.value},
			success: function(result){
        console.log(result);
				if(result!=false)
				{
					$("#up_result").css('color','green');
					$("#up_result").css('font-size','12px');
					$("#up_result").html(result);
				}
				else
				{
					$("#up_result").css('color','#ff0000');
					$("#up_result").css('font-size','12px');
					$("#up_result").html('Invalid Upline Sponsor id');
				}
			}
		});
	});
	</script> 
    <script>
        $('#chk11').click(function()
        {
            if ($(this).is(":checked")) {
                $('#myModal111').modal('show');
            }else {
                $('#myModal111').modal('hide');
            }
        });
    </script>
    



    <div id="myModal111" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
      <h2>Terms and Conditions</h2>
   <p class="text-danger">
       <b>Welcome to myinformation!</b>
   </p>
    <p class="text-info">
    These terms and conditions outline the rules and regulations for the use of DIB SERVICES OPC PRIVATE LIMITED's Website, located at http://myinformation.in/myinformation/.
    </p>
    <p class="text-info">
        By accessing this website we assume you accept these terms and conditions. Do not continue to use myinformation if you do not agree to take all of the terms and conditions stated on this page. Our Terms and Conditions were created with the help of the Terms And Conditions Generator and the Privacy Policy Template.
    </p>
    <p class="text-info">
        The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and compliant to the Company’s terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company. "Party", "Parties", or "Us", refers to both the Client and ourselves. All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client’s needs in respect of provision of the Company’s stated services, in accordance with and subject to, prevailing law of Netherlands. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.
    </p>
    <p class="text-danger">
       <b> Cookies</b>
   </p>
    <p class="text-info">
    We employ the use of cookies. By accessing myinformation, you agreed to use cookies in agreement with the DIB SERVICES OPC PRIVATE LIMITED's Privacy Policy.
    </p>
    <p class="text-info">
        Most interactive websites use cookies to let us retrieve the user’s details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.
    </p>
    <p class="text-danger">
       <b>License</b>
   </p>
    <p class="text-info">
        Unless otherwise stated, DIB SERVICES OPC PRIVATE LIMITED and/or its licensors own the intellectual property rights for all material on myinformation. All intellectual property rights are reserved. You may access this from myinformation for your own personal use subjected to restrictions set in these terms and conditions.
    </p>

    <p class="text-danger">
       <b>You must not:</b>
   </p>
    <p class="text-info">
    •	Republish material from myinformation<br>
    •	Sell, rent or sub-license material from myinformation<br>
    •	Reproduce, duplicate or copy material from myinformation<br>
    •	Redistribute content from myinformation<br>

    </p>

    <p class="text-danger">
       <b> This Agreement shall begin on the date hereof.</b>
   </p>
    <p class="text-info">
    Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. DIB SERVICES OPC PRIVATE LIMITED does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of DIB SERVICES OPC PRIVATE LIMITED,its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions. To the extent permitted by applicable laws, DIB SERVICES OPC PRIVATE LIMITED shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/or appearance of the Comments on this website.
    </p>
    <p class="text-info">
        DIB SERVICES OPC PRIVATE LIMITED reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions.
    </p>   
    <p class="text-danger">
       <b> You warrant and represent that:</b>
   </p>
    <p class="text-info">
        •	You are entitled to post the Comments on our website and have all necessary licenses and consents to do so;<br>
        •	The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party;<br>
        •	The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy<br>
        •	The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity.<br>

    </p>
    <p class="text-info">
         You hereby grant DIB SERVICES OPC PRIVATE LIMITED a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.
    </p>
    <p class="text-danger">
        <b>Hyperlinking to our Content </b>
    </p>
    <p class="text-info">
        The following organizations may link to our Website without prior written approval:
    </p>
    <p class="text-info">
    •	Government agencies;<br>
    •	Search engines;<br>
    •	News organizations;<br>
    •	Online directory distributors may link to our Website in the same manner as they hyperlink to the Websites of other listed businesses; and<br>
    •	System wide Accredited Businesses except soliciting non-profit organizations, charity shopping malls, and charity fundraising groups which may not hyperlink to our Web site.<br>

    </p>
    <p class="text-info">
        These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party’s site.
    </p>
    <p class="text-info">
        We may consider and approve other link requests from the following types of organizations:
    </p>
    <p class="text-info">
    •	commonly-known consumer and/or business information sources;<br>
    •	dot.com community sites;<br>
    •	associations or other groups representing charities;<br>
    •	online directory distributors;<br>
    •	internet portals;<br>
    •	accounting, law and consulting firms; and<br>
    •	educational institutions and trade associations.<br>

    </p>
    <p class="text-info">
        We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of DIB SERVICES OPC PRIVATE LIMITED; and (d) the link is in the context of general resource information.
    </p>
    <p class="text-info">
       These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party’s site.
    </p>
    <p class="text-info">
       If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to DIB SERVICES OPC PRIVATE LIMITED. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.
    </p>
    
    <p class="text-danger">
        <b> Approved organizations may hyperlink to our Website as follows</b>
    </p>
    <p class="text-info">
        •	By use of our corporate name; or<br>
        •	By use of the uniform resource locator being linked to; or<br>
        •	By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party’s site.<br>

    </p>
    <p class="text-danger">
        No use of DIB SERVICES OPC PRIVATE LIMITED's logo or other artwork will be allowed for linking absent a trademark license agreement.
    </p>
    <p class="text-danger">
        <b> iFrames</b>
    </p>
    <p class="text-info">
        Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.
    </p>
    <p class="text-danger">
        <b> Content Liability</b>
    </p>
    <p class="text-info">
        We shall not be hold responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of, any third party rights.
    </p>
    <p class="text-danger">
        <b>Your Privacy </b>
    </p>
    <p class="text-info">
Please read Privacy Policy
    </p>
    <p class="text-info">
    Reservation of Rights
    </p>
    <p class="text-info">
    We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amen these terms and conditions and it’s linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.
    </p>
    <p class="text-danger">
        <b> Removal of links from our website</b>
    </p>
    <p class="text-info">
        If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.
    </p>
    <p class="text-info">
        We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.
    </p>
    <p class="text-danger">
        <b>Disclaimer</b>
    </p>
    <p class="text-info">
To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website. Nothing in this disclaimer will
    </p>
    <p class="text-info">
•	limit or exclude our or your liability for death or personal injury;<br>
•	limit or exclude our or your liability for fraud or fraudulent misrepresentation;<br>
•	limit any of our or your liabilities in any way that is not permitted under applicable law; or<br>
•	exclude any of our or your liabilities that may not be excluded under applicable law.<br>

    </p>
    <p class="text-info">
        The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty.
    </p>
    <p class="text-info">
As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.
    </p>
   


    <h2>Privacy Policy for my information</h2>
   <p class="text-info">
       <b> At myinformation.in, accessible from http://myinformation.in/myinformation/, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by myinformation.in and how we use it.</b>
   </p>
    <p class="text-info">
        If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us through email at info@myinformation.in
    </p>

    <p class="text-danger">
       <b> Log Files</b>
   </p>
    <p class="text-info">
        myinformation.in follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.
    </p>

    <p class="text-danger"> 
       <b>Privacy Policies</b>
   </p>
    <p class="text-info">
        You may consult this list to find the Privacy Policy for each of the advertising partners of myinformation.in. Our Privacy Policy was created with the help of the GDPR Privacy Policy Generator and the Privacy Policy Generator from Terms Feed plus the Terms and Conditions Template.
    </p>
    <p class="text-info">
        Third-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on myinformation.in, which are sent directly to users' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.
    </p>
    <p class="text-info">
        Note that myinformation.in has no access to or control over these cookies that are used by third-party advertisers.
    </p>
    <p class="text-danger">
       <b> Third Pary Privacy Policies</b>
   </p>
    <p class="text-info">
        myinformation.in's Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. You may find a complete list of these Privacy Policies and their links here: Privacy Policy Links.
    </p>
    <p class="text-info">
        You can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers' respective websites. What Are Cookies?
    </p>

    <p class="text-danger">
       <b> Children's Information</b>
   </p>
    <p class="text-info">
        Another part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.
    </p>
    <p class="text-info">
        myinformation.in does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.
    </p>
    <p class="text-danger">
       <b> Online Privacy Policy Only</b>
   </p>
    <p class="text-info">
        This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in myinformation.in. This policy is not applicable to any information collected offline or via channels other than this website.
    </p>
    
    <p class="text-danger">
        <b>Consent</b>
    </p> 
    <p class="text-info">
        By using our website, you hereby consent to our Privacy Policy and agree to its Terms and Conditions.
    </p>   
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Accept</button>
      </div>
    </div>

  </div>
</div>