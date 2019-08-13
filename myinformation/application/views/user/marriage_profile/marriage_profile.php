
<div class="container">
    <!-- Page-Title -->
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 <div class="row">
        <div class="col-sm-12">
		<h4 class="page-title" style="text-align:center;">Marriage Profile-Match</h4>
        </div>
    </div>
   <div class="row">
    <div class="col-sm-12" align="center">
        <form id='form-id' method="get" action="#">
            <div class="radio radio-success radio-inline">
                <!-- <input id='watch-me' name='test' type='radio' />
                <label for="watch-me">  I want to show this biodata - In my caste  </label>
            </div>
            <div class="radio radio-pink radio-inline">
                <input id='see-me' name='test' type='radio' />
                <label for="see-me">   In other caste too </label>
            </div> -->
            <!-- <div class="radio radio-perpul radio-inline">
                <input id='look-me' name='test' type='radio' /> 
                <label for="look-me">  In my caste </label>
            </div> -->
        </form>
        <br><br>
        <div id='show-me' style='; border:2px solid #ccc'>
           <div class="panel panel-default m-t-20">
                <div class="panel-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover" boarder:1px>
                            <thead>
                                <th>Photo</th>
                                <th>Date of birth</th>
                                <th>Full name</th>
                                <th>Father name</th>
                                <th>Gender</th>
                                <th>Religions</th>
                                <th>Sub Religions</th>
                                <th>Dharm</th>
                                <th>Contact Number</th>
                                <th>Address	</th>
                                <th>Country</th>
                                <th>State</th>
                                <th>City</th>
                            </thead>
                            <?php //'<pre>';print_r($alldata);die;
                                if(isset($alldata)){
                                foreach ($alldata as $value)
                                {
                            ?>
                            <tbody>                   
                                <tr class="unread___">
                                    <td class="">
                                        <div class="comment">
                                            <img src="<?= base_url();?>uploads/profile/photo_1_capsule.jpg" alt="" class="comment-avatar">
                                        </div>
                                    </td> 
                                    <td>
                                    <?php if(isset($value->date_of_birth)) {echo $value->date_of_birth;}?>
                                    </td>        
                                    <td>
                                    <?php if(isset($value->fname)) {echo $value->fname;}?>
                                    </td> 
                                    <td>
                                    <?php if(isset($value->father_name)) {echo $value->father_name;}?>
                                    </td> 
                                    <td>
                                    <?php if(isset($value->gender)) {echo $value->gender;}?>
                                    </td> 
                                    <td>
                                    <?php if(isset($getreligion[0]->religions_name)) {echo $getreligion[0]->religions_name;}?>
                                    </td> 
                                    <td>
                                    <?php if(isset($getsubreligion[0]->sub_religions)) {echo $getsubreligion[0]->sub_religions;}?>
                                    </td> 
                                    <td>
                                    <?php if(isset($value->dharm)) {echo $value->dharm;}?>
                                    </td> 
                                    <td>
                                    <?php if(isset($value->contact_no	)) {echo $value->contact_no	;}?>
                                    </td> 
                                    <td>
                                    <?php if(isset($value->address)) {echo $value->address;}?>
                                    </td> 
                                    <td>
                                    <?php if(isset($value->country)) {echo $value->country;}?>
                                    </td>  
                                    <td>
                                    <?php if(isset($value->state)) {echo $value->state;}?>
                                    </td> 
                                    <td>
                                    <?php if(isset($value->city)) {echo $value->city;}?>
                                    </td>                                   
                                </tr>
                                <?php } } ?>
                            </tbody>
                        </table>
                        
                    </div>       
                </div> <!-- panel body -->
            </div> <!-- panel -->  
        </div>
        <div id='show-me-two' style='display:none; border:2px solid #ccc'>
            <div class="panel panel-default m-t-20">
                <div class="panel-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mails m-0">
                            <thead>
                                <th>#</th>
                                <th>Image</th>
                                <th>Full Name</th>
                                <th>Marriege Status</th>
                                <th>State</th>
                                <th>City</th>
                                <th>Profile</th>
                            </thead>
                            <tbody>                   
                                <tr class="unread___">
                                <td>1</td>
                                    <td class="">
                                        <div class="comment">
                                            <img src="<?= base_url();?>assets/images/users/avatar-1.jpg" alt="" class="comment-avatar">
                                        </div>
                                    </td>        
                                    <td>
                                    bvb
                                    </td> 
                                    <td>
                                    b
                                    </td> 
                                    <td>
                                    v
                                    </td>  
                                    <td class="hidden-xs">
                                    f
                                    </td>
                                    <td style="width: 20px;">
                                         <a href="<?= record;?>" class="email-msg"><i class="fa fa-eye"></i></a>                                     </td>                           
                                </tr>
                            </tbody>
                        </table>
                    </div>       
                </div> <!-- panel body -->
            </div> <!-- panel -->  
        </div>
        <!-- <div id='show-me-three' style='display:none; border:2px solid #ccc'>
            
        </div> -->
          
 </div>
</div>
<script>
$(document).ready(function () 
 { 
  $("#watch-me").click(function()
  {
    $("#show-me:hidden").show('slow');
   $("#show-me-two").hide();
   $("#show-me-three").hide();
   });
   $("#watch-me").click(function()
  {
    if($('watch-me').prop('checked')===false)
   {
    $('#show-me').hide();
   }
  });
  
  $("#see-me").click(function()
  {
    $("#show-me-two:hidden").show('slow');
   $("#show-me").hide();
   $("#show-me-three").hide();
   });
   $("#see-me").click(function()
  {
    if($('see-me-two').prop('checked')===false)
   {
    $('#show-me-two').hide();
   }
  });
  $("#look-me").click(function()
  {
    $("#show-me-three:hidden").show('slow');
   $("#show-me").hide();
   $("#show-me-two").hide();
   });
   $("#look-me").click(function()
  {
    if($('see-me-three').prop('checked')===false)
   {
    $('#show-me-three').hide();
   }
  });
  
 });

</script>
   
</div><!-- End row -->
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var max_fields      = 5;
    var wrapper         = $(".container1_kund");
    var add_button_kund      = $(".add_form_field_kund");
  
    var x = 1;
    $(add_button_kund).click(function(e){
        e.preventDefault();
        if(x < max_fields){
            x++;
            $(wrapper).append('<div><input type="file" name="marriage_profile[]" class="form-control" style="padding: 10px; margin: 10px 0px 12px 0px;"><i class="delete fa fa-trash text-danger"></i></div>'); //add input box
        }
  else
  {
  alert('You Reached the limits')
  }
    });
  
    $(wrapper).on("click",".delete", function(e){
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>