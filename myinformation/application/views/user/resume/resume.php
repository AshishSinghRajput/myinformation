<style>
.modal-dialog{
   width:100%; 
}
.modal {
   top:-30px;
   bottom:-30px;
}
</style>
<link href="http://myinformation.in/myinformation/assets/front/css/main.css" rel="stylesheet">
<div class="wrapper">
   <div class="page-content" style="margin-bottom: 78px;">
      <div id="resumeID">
         <div class="profile-page">
            <div class="wrapper">
               <div class="page-header page-header-small" filter-color="green">
                  <div class="page-header-image" data-parallax="true"
                     style="background-image: url('images/cc-bg-1.jpg');"></div>
                  <div class="container">
                     <div class="content-center">
                        <div class="cc-profile-image">
                        <?php 
                              if(isset($ByIDRecord))
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
                        <div class="h2 title"><?php  if(isset($ByIDRecord)){echo $ByIDRecord->fname;} ?></div>
                        <p class="category text-white"><?php  if(isset($education)){ echo $education->postgraduation_name; }?></p>
                        <!-- <a  class="btn btn-primary smooth-scroll mr-2" href="#contact" data-aos="zoom-in"  data-aos-anchor="data-aos-anchor">Hire Me</a> -->
                        <a class="btn btn-primary" href="http://myinformation.in/myinformation/download_resume"  data-aos="zoom-in" data-aos-anchor="data-aos-anchor" >Preview</a>
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
                              <div class="col-sm-8"><?php if(isset($birthinfo)) {echo  $birthinfo->age; }?></div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-sm-4"><strong class="text-uppercase">Email:</strong></div>
                              <div class="col-sm-8">
                              <div class="col-sm-8"><?php if(isset($ByIDRecord)) {echo  $ByIDRecord->email_id;} ?></div>
                              </div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-sm-4"><strong class="text-uppercase">Phone:</strong></div>
                              <div class="col-sm-8"><?php if(isset($ByIDRecord)) { echo  $ByIDRecord->contact_no;} ?></div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-sm-4"><strong class="text-uppercase">Address:</strong></div>
                              <div class="col-sm-8"><?php if(isset($ByIDRecord)) {echo  $ByIDRecord->address;}?></div>
                           </div>
                           <div class="row mt-3">
                              <div class="col-sm-4"><strong class="text-uppercase">Language:</strong></div>
                              <div class="col-sm-8"><?php if(isset($ByIDRecord)) { echo  $ByIDRecord->language;}?></div>
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
                           <div class="h5"><?php if(isset($work)) { echo  $work->designation; }?></div>
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
               <!-- <div class="card">
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
               </div> -->
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
                           <div class="h5"><?php if(isset($education)){echo $education->postgraduation_name;}?> </div>
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
               <!-- <div class="card">
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
               </div> -->
            </div>
         </div>
      </div>
   </div>
</div>
<!--//main-body-->
</div>






