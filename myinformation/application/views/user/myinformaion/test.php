<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    

</head>

<body>
     <div class="col-md-4">
         <div class="form-group">
        <label>Religions</label>
        <select name="relegions" id="country" class="form-control">
            <option value="">Select relegions</option>
            <?php foreach ($dharm as $row) {?>
                <option value="<?=$row->id;?>" ><?=$row->religions_name;?></option>
            <?php }?>
        </select>
        </div>
    </div>
    <div class="col-md-4">
         <div class="form-group">
        <label>Caste</label>
        <select name="state" id="state" class="form-control">
             <option value="">Select Caste</option>
        </select>
        </div>
    </div>
    <div class="col-md-4">
         <div class="form-group">
        <label>Sub Caste</label>
        <select name="relegions" class="form-control">
            <select name="city" id="city" class="form-control input-lg">
            <option value="">Select Sub Caste</option>
   </select>
        </select>
        </div>
    </div>
    <script>
$(document).ready(function(){
 $('#country').change(function(){
  var id = $('#country').val();
  if(id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>user/fetch_caste",
    method:"POST",
    data:{id:id},
    success:function(data)
    {
     $('#state').html(data);
     $('#city').html('<option value="">Select Sub Caste</option>');
    }
   });
  }
  else
  {
   $('#state').html('<option value="">Select Caste</option>');
   $('#city').html('<option value="">Select Sub Caste</option>');
  }
 });

 $('#state').change(function(){
  var state_id = $('#state').val();
  if(state_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>user/fetch_sub_caste",
    method:"POST",
    data:{state_id:state_id},
    success:function(data)
    {
     $('#city').html(data);
    }
   });
  }
  else
  {
   $('#city').html('<option value="">Select Sub Caste</option>');
  }
 });
 
});
</script>
    <div class="row">
        
        <br />
        <h2 align="center">title</h2>
        <div class="form-group">

            <div class="table-responsive">
                <table class="table table-bordered" id="articles">
                    <tr>

                        <td> Name of Bank:<input type="text" name="bank_name[]" placeholder="Name of Bank" class="form-control name_list" /></td>
                        <td> Branch Address:<input type="text" name="branch[]" placeholder="Branch Address" class="form-control name_list" /></td>
                        <td> Account Holder's Name:<input type="text" name="ac_holder_name[]" placeholder="Account Holder's Name" class="form-control name_list" /></td>
                        <td> Account Number:<input type="number" name="account_no[]" placeholder="Account Number" class="form-control name_list" /></td>
                        <td> IFSC Code:<input type="text" name="ifsc[]" placeholder="IFSC Code" class="form-control name_list" /></td>
                        <td><button type="button" name="add" id="add" class="btn btn-success">Add new</button></td>
                    </tr>
                </table>
                <input type="button" name="submit" id="submit" class="btn btn-info" value="Submit" />
            </div>
            </form>
        </div>
        Add another director <input type="checkbox" id="checkbox1" />
        <div id="autoUpdate" class="autoUpdate">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="name"> My Favourite Game </label>
                    <input type="text" name='game' class="form-control" value="<?php  ?>">
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="form-group">
                <label for="name">I keep playing my favorite game<span class="text-danger">*</span></label><br>
                <label class="radio-inline">
                    <input type="radio" name="ask_game" onchange="yess(1);" value="yes" id="yesId" <?php  ?> >Yes
                </label>
                <label class="radio-inline">
                    <input type="radio" name="ask_game" onchange="yess(0);" value="no" id="noId" <?php  ?> >No

                </label>
                <span class="text-danger"><span id="normal-where_live"></span></span>
            </div>
        </div>
        <span id="yessID" style="display:none;">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="Tehsil">My Favourite Game </label>
                    <input type="text" name="game" class="form-control" value="<?php if (isset($special->game)) {echo $special->game;} else {set_value('game');}?>">
                </div>
            </div>
        </span>
    </div>
    </span>
    <span id="NoID" style="display:none;">
        <div class="col-lg-6">
        </div>
    </span>
    </div>
    </div>
    </span>
   
    </div>
    <div class="row">
        
</div>
</body>
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>

</html>
<script>
    $(document).ready(function() {
        var i = 1;
        $('#add').click(function() {
            i++;
            $('#articles').append('<tr id="row' + i + '"><td>Name of Bank:<input type="text" id="quantity" name="bank_name[]" placeholder="Name of Bank" class="form-control name_list" /></td> <td>Branch Address:<input type="text" id="price" name="branch[]" placeholder="Branch Address" class="form-control name_list" /></td> <td>Account Holders Name<input type="text" id="" name="ac_holder_name[]" placeholder="Account Holders Name" class="form-control name_list" /></td> <td> Account Number:<input type="number" name="account_no[]" placeholder="Account Number" class="form-control name_list" /></td> <td> IFSC Code:<input type="text" name="ifsc[]" placeholder="IFSC Code" class="form-control name_list" /></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        // $('#submit').click(function() {
        //     //alert($('#add_name').serialize()); //alerts all values and works fine          
        //     $.ajax({
        //         url: "wwwdb.php",
        //         method: "POST",
        //         data: $('#add_name').serialize(),
        //         success: function(data) {
        //             $('#add_name')[0].reset();
        //         }
        //     });
        // });

        // function upd_art() {
        //     var qty = $('#quantity').val();
        //     var price = $('#price').val();
        //     var total = (qty * price).toFixed(2);
        //     $('#total').val(total);
        // }
        // setInterval(upd_art, 1000);
    });
    $(document).ready(function() {
        $('#checkbox1').change(function() {
            if (this.checked)
                $('#autoUpdate').fadeIn('fast');
            else
                $('#autoUpdate').fadeOut('fast');

        });
    });
    //

    function yess(str) {
        $("#yessID").css('display', 'none');
        $("#NoID").css('display', 'none');
        if (str == 1) {
            $("#yessID").css('display', 'block');
        } else if (str == 0) {
            $("#NoID").css('display', 'block');
        }
    }

   
</script> 