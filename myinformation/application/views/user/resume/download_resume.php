<html>
<head>
    <title>RESUME</title>
    <style>
        tr,
        td,
        th {
            padding: 10px;
        }
    </style>
</head>

<body style="background:#fff">
    <table width="595px" style="margin:0 auto; border:1px solid #ccc; padding:10px;">
        <thead>
            <tr>
                <th>
                    <table width="100%">
                        <tr>
                            
                            <td>
                                <h3><?php  if(isset($ByIDRecord)){echo $ByIDRecord->fname;} ?></h3>
                                <h5><?php  if(isset($education)){ echo $education->postgraduation_name; }?></h5>
                                <h5><?php if(isset($ByIDRecord)) {echo  $ByIDRecord->address;}?></h5>
                            </td>
                            <td style="text-align:right">
                                <h5>+91 <?php if(isset($ByIDRecord)) { echo  $ByIDRecord->contact_no;} ?></h5>
                                <h5><?php if(isset($ByIDRecord)) {echo  $ByIDRecord->email_id;} ?></h5>
                                <h5><?php if(isset($ByIDRecord)) { echo  $ByIDRecord->contact_no;} ?></h5>
                            </td>
                        </tr>
                    </table>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td colspan="2" style="background: #ccc">Personal Information</td>
                        </tr>
                        <!-- <tr>
                            <td>Father's Name:</td>
                            <td>Mr. GR Sahu</td>
                        </tr> -->
                        <tr>
                            <td>Age:</td>
                            <td><?php if(isset($birthinfo)) {echo  $birthinfo->age; }?></td>
                        </tr>
                        <tr>
                            <td>Address:</td>
                            <td><?php if(isset($ByIDRecord)) {echo  $ByIDRecord->address;}?></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td style="border-bottom:1px solid #ccc">
                    <table width="100%">
                        <tr>
                            <td colspan="2" style="background: #ccc">qualification</td>
                        </tr>
                        <tr>
                            <td><?php  if(isset($education)){ echo $education->postgraduation_name; }?></td>
                            <td>
                                <p>2005</p>
                                <p>Govt. School Indore</p>
                                <p>49%</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Higher Secondry</td>
                            <td>
                                <p>2005</p>
                                <p>Govt. School Indore</p>
                                <p>49%</p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td>
                    <table width="100%">
                        <tr>
                            <td>Place.................</td>
                            <td style="text-align:right">Sign........................</td>
                        </tr>
                        <tr>
                            <td>Date.................</td>
                            <td style="text-align:right"><?php  if(isset($ByIDRecord)){echo $ByIDRecord->fname;} ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tfoot>
    </table>
</body>
<a class="btn " style="margin-left: 62%;" href="<?=base_url('user/download_pdf');?>">Download Resume </a>
</html>



<!-- <link href="http://myinformation.in/myinformation/assets/front/css/main.css" rel="stylesheet">
<div >
<div>
<a class="btn btn-success" style="margin-left: 85%;" href="<?=base_url('user/download_pdf');?>">Download Resume </a>
    </div>
      <div id="resumeID">
         <div class="profile-page">
            <div class="wrapper">
               <div class="page-header page-header-small" filter-color="green" style="margin:0px;">
                  <div class="page-header-image" data-parallax="true"
                     style="background-image: url('images/cc-bg-1.jpg');"></div>
                  <div class="container">
                     <div class="content-center">
                        <div class="cc-profile-image">
                        <?php 
                              if(!empty($ByIDRecord))
                               {
                                //    print_r($ByIDRecord);die;
                                 $profileImg= unserialize($ByIDRecord->photo_1);
                                 //print_r($profileImg[0]);die;

                              ?>
                            <a href="#">
                                <img src="<?= base_url('uploads/profile/').$profileImg[0]; ?>" alt="Image" />
                            </a>
                               <?php } ?>
                                  
                        </div>
                        <div class="h2 title"><?php  echo $ByIDRecord->fname; ?></div>
                        <p class="category text-white"><?php  echo $education->my_education; ?></p>
                      <a  class="btn btn-primary smooth-scroll mr-2" href="#contact" data-aos="zoom-in"  data-aos-anchor="data-aos-anchor">Print</a>
                        
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="section" id="about">
            <div class="container">
               <div class="card" data-aos="fade-up" data-aos-offset="10">
                  <div class="row">
                     <div class="col-lg-6 col-md-12">
                        <div class="card-body">
                           <div class="h4 mt-0 title">About</div>
                           <p>Hello! I am Anthony Barnett. Web Developer, Graphic Designer and Photographer.
                           </p>
                           <p>Creative CV is a HTML resume template for professionals. Built with Bootstrap 4,
                              Now UI Kit and FontAwesome, this modern and responsive design template is
                              perfect to showcase your portfolio, skills and experience. <a
                                 href="https://templateflip.com/templates/creative-cv/" target="_blank"></a>
                           </p>
                        </div>
                     </div>
                     <div class="col-lg-6 col-md-12">
                        <div class="card-body">
                           <div class="h4 mt-0 title">Basic Information</div>
                           <div class="row">
                              <div class="col-sm-4"><strong class="text-uppercase">Age:</strong></div>
                              <div class="col-sm-8"><?php echo  $birthinfo->age; ?></div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-sm-4"><strong class="text-uppercase">Email:</strong></div>
                              <div class="col-sm-8">
                              <div class="col-sm-8"><?php echo  $ByIDRecord->email_id; ?></div>
                              </div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-sm-4"><strong class="text-uppercase">Phone:</strong></div>
                              <div class="col-sm-8"><?php echo  $ByIDRecord->contact_no; ?></div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-sm-4"><strong class="text-uppercase">Address:</strong></div>
                              <div class="col-sm-8"><?php echo  $ByIDRecord->address; ?></div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-sm-4"><strong class="text-uppercase">Language:</strong></div>
                              <div class="col-sm-8"><?php echo  $ByIDRecord->language; ?></div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="section" id="skill">
            <div class="container">
               <div class="h4 text-center mb-4 title">Professional Skills</div>
               <div class="card" data-aos="fade-up" data-aos-anchor-placement="top-bottom">
                  <div class="card-body">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="progress-container progress-primary">
                              <span class="progress-badge">HTML</span>
                              <div class="progress">
                                 <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                    data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 80%;"></div>
                                 <span class="progress-value">80%</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="progress-container progress-primary">
                              <span
                                 class="progress-badge">CSS</span>
                              <div class="progress">
                                 <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                    data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 75%;"></div>
                                 <span class="progress-value">75%</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="progress-container progress-primary">
                              <span
                                 class="progress-badge">JavaScript</span>
                              <div class="progress">
                                 <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                    data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 60%;"></div>
                                 <span class="progress-value">60%</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="progress-container progress-primary">
                              <span
                                 class="progress-badge">SASS</span>
                              <div class="progress">
                                 <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                    data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 60%;"></div>
                                 <span class="progress-value">60%</span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6">
                           <div class="progress-container progress-primary">
                              <span
                                 class="progress-badge">Bootstrap</span>
                              <div class="progress">
                                 <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                    data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 75%;"></div>
                                 <span class="progress-value">75%</span>
                              </div>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="progress-container progress-primary">
                              <span
                                 class="progress-badge">Photoshop</span>
                              <div class="progress">
                                 <div class="progress-bar progress-bar-primary" data-aos="progress-full"
                                    data-aos-offset="10" data-aos-duration="2000" role="progressbar"
                                    aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 70%;"></div>
                                 <span class="progress-value">70%</span>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="section" id="experience">
            <div class="container cc-experience">
               <div class="h4 text-center mb-4 title">Work Experience</div>
               <div class="card">
                  <div class="row">
                     <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50"
                        data-aos-duration="500">
                        <div class="card-body cc-experience-header">
                           <p>March 2016 - Present</p>
                           <div class="h5">CreativeM</div>
                        </div>
                     </div>
                     <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                        <div class="card-body">
                           <div class="h5"><?php echo  $work->designation; ?></div>
                           <p>Euismod massa scelerisque suspendisse fermentum habitant vitae ullamcorper magna
                              quam iaculis, tristique sapien taciti mollis interdum sagittis libero nunc
                              inceptos tellus, hendrerit vel eleifend primis lectus quisque cubilia sed
                              mauris. Lacinia porta vestibulum diam integer quisque eros pulvinar curae,
                              curabitur feugiat arcu vivamus parturient aliquet laoreet at, eu etiam pretium
                              molestie ultricies sollicitudin dui.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <div class="row">
                     <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50"
                        data-aos-duration="500">
                        <div class="card-body cc-experience-header">
                           <p>April 2014 - March 2016</p>
                           <div class="h5">WebNote</div>
                        </div>
                     </div>
                     <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                        <div class="card-body">
                           <div class="h5">Web Developer</div>
                           <p>Euismod massa scelerisque suspendisse fermentum habitant vitae ullamcorper magna
                              quam iaculis, tristique sapien taciti mollis interdum sagittis libero nunc
                              inceptos tellus, hendrerit vel eleifend primis lectus quisque cubilia sed
                              mauris. Lacinia porta vestibulum diam integer quisque eros pulvinar curae,
                              curabitur feugiat arcu vivamus parturient aliquet laoreet at, eu etiam pretium
                              molestie ultricies sollicitudin dui.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <div class="row">
                     <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50"
                        data-aos-duration="500">
                        <div class="card-body cc-experience-header">
                           <p>April 2013 - February 2014</p>
                           <div class="h5">WEBM</div>
                        </div>
                     </div>
                     <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                        <div class="card-body">
                           <div class="h5">Intern</div>
                           <p>Euismod massa scelerisque suspendisse fermentum habitant vitae ullamcorper magna
                              quam iaculis, tristique sapien taciti mollis interdum sagittis libero nunc
                              inceptos tellus, hendrerit vel eleifend primis lectus quisque cubilia sed
                              mauris. Lacinia porta vestibulum diam integer quisque eros pulvinar curae,
                              curabitur feugiat arcu vivamus parturient aliquet laoreet at, eu etiam pretium
                              molestie ultricies sollicitudin dui.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="section">
            <div class="container cc-education">
               <div class="h4 text-center mb-4 title">Education</div>
               <div class="card">
                  <div class="row">
                     <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50"
                        data-aos-duration="500">
                        <div class="card-body cc-education-header">
                           <p>2013 - 2015</p>
                           <div class="h5">Master's Degree</div>
                        </div>
                     </div>
                     <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                        <div class="card-body">
                           <div class="h5"><?php echo $education->my_education?> </div>
                           <p class="category">University of Computer Science</p>
                           <p>Euismod massa scelerisque suspendisse fermentum habitant vitae ullamcorper magna
                              quam iaculis, tristique sapien taciti mollis interdum sagittis libero nunc
                              inceptos tellus, hendrerit vel eleifend primis lectus quisque cubilia sed
                              mauris. Lacinia porta vestibulum diam integer quisque eros pulvinar curae,
                              curabitur feugiat arcu vivamus parturient aliquet laoreet at, eu etiam pretium
                              molestie ultricies sollicitudin dui.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <div class="row">
                     <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50"
                        data-aos-duration="500">
                        <div class="card-body cc-education-header">
                           <p>2009 - 2013</p>
                           <div class="h5">Bachelor's Degree</div>
                        </div>
                     </div>
                     <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                        <div class="card-body">
                           <div class="h5">Bachelor of Computer Science</div>
                           <p class="category">University of Computer Science</p>
                           <p>Euismod massa scelerisque suspendisse fermentum habitant vitae ullamcorper magna
                              quam iaculis, tristique sapien taciti mollis interdum sagittis libero nunc
                              inceptos tellus, hendrerit vel eleifend primis lectus quisque cubilia sed
                              mauris. Lacinia porta vestibulum diam integer quisque eros pulvinar curae,
                              curabitur feugiat arcu vivamus parturient aliquet laoreet at, eu etiam pretium
                              molestie ultricies sollicitudin dui.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="card">
                  <div class="row">
                     <div class="col-md-3 bg-primary" data-aos="fade-right" data-aos-offset="50"
                        data-aos-duration="500">
                        <div class="card-body cc-education-header">
                           <p>2007 - 2009</p>
                           <div class="h5">High School</div>
                        </div>
                     </div>
                     <div class="col-md-9" data-aos="fade-left" data-aos-offset="50" data-aos-duration="500">
                        <div class="card-body">
                           <div class="h5">Science and Mathematics</div>
                           <p class="category">School of Secondary board</p>
                           <p>Euismod massa scelerisque suspendisse fermentum habitant vitae ullamcorper magna
                              quam iaculis, tristique sapien taciti mollis interdum sagittis libero nunc
                              inceptos tellus, hendrerit vel eleifend primis lectus quisque cubilia sed
                              mauris. Lacinia porta vestibulum diam integer quisque eros pulvinar curae,
                              curabitur feugiat arcu vivamus parturient aliquet laoreet at, eu etiam pretium
                              molestie ultricies sollicitudin dui.
                           </p>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!DOCTYPE> -->
