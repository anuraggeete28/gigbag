   <?php $this->load->view('assests/header'); ?>
 
    <?php $this->load->view('assests/sidebar'); ?>

   
<style>
         .input-group-prepend {
    margin-right: -47px;
    z-index: 9999;
}
.content-body{
    padding-top:90px;
}
.form-control {
    display: block;
    width: 50% !important; 
    }
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                       <h4 class="card-title"><?=$page?></h4>
                         <?php if(!empty($this->session->flashdata('message'))):
                            $msg=$this->session->flashdata('message');
                          ?>
                          <div class="alert alert-<?=$msg['status']?> alert-dismissible">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                              <?=$msg['msg']?>
                          </div>
                        <?php endif; ?>
                        <div class="basic-form">
                            <form class="form-horizontal" id="myform" action="<?= base_url(); ?>Student/submit_student" method="POST" enctype="multipart/form-data"> 
                                <input type="hidden" name="method" value="<?=$method?>" />  
                                <input type="hidden" name="usertype" value="student" />
                                <input type="hidden" name="policy" value="yes" />
                                <label>Student Name</label>
                                <div class="form-group">
                                    <input type="text" name="username" id="username"  value="<?php if(isset($media_detail)){ print_r($media_detail->username); } ?>" required="required" class="form-control input-flat" placeholder="Student Name">
                                </div>
                                        
                                <label>Email</label>
                                <div class="form-group">
                                    <span id="error" style="display:none;color:red;">Invalid email</span>
                                    <input type="email" id="email_address" name="email"  value="<?php if(isset($media_detail)){ print_r($media_detail->email); } ?>" class="form-control input-flat" placeholder="Students Email" required>
                                </div>
                                        
                                <label>Address</label>
                                <div class="form-group ">
                                    <input type="text" name="address" value="<?php if(isset($media_detail)){ print_r($media_detail->address); } ?>" required="required" class="form-control input-flat" placeholder="Address">
                                </div>     
                                <label>Country Code</label>
                                <div class="form-group">
                                    <select  name="country_code" class="form-control" id="country_code" required="required">
                                        <option value="">----Select Country Code----</option>
                                        <?php foreach ($getcountry as $row) {
                                        
                                        if($media_detail->country_code == $row->country_code){ ?>
                                        <option selected value="<?php echo $row->country_code; ?>" >
                                        <?php echo $row->country_code; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->country_code; ?>" >
                                        <?php echo $row->country_code; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>  
                                    </select>
                                </div>
                                <label>Country</label>
                                <div class="form-group">
                                    <select  name="country_id" class="form-control" id="country" required>
                                        <option value="">----Select Country----</option>
                                        <?php foreach ($getcountryli as $row) {
                                        
                                        if($media_detail->country_id == $row->country_id){ ?>
                                        <option selected value="<?php echo $row->country_id; ?>" >
                                        <?php echo $row->country; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->country_id; ?>" >
                                        <?php echo $row->country; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>  
                                    </select>
                                        
                                </div>      
                                <label>State</label>
                                <div class="form-group">
                                    <select name="state_id" id="state" class="form-control">
                                        <option value="">----Select State---- </option>
                                    </select>
                                </div>
                                <label>Mobile Number</label>
                                <div class="form-group">
                                    <span id="lblError" style="color: red"></span>
                                    <input type="text" name="mobile" id="txtName" maxlength="10" minlength="10" required="required" value="<?php if(isset($media_detail)){ print_r($media_detail->mobile); } ?>" class="form-control input-default" placeholder="Mobile Number">
                                </div>  
                                <label>Guardian</label>
                                    <div class="form-group">
                                        <input type="text" name="guardian" value="<?php if(isset($media_detail)){ print_r($media_detail->guardian); } ?>" required="required" class="form-control input-default" placeholder="Guardian">
                                    </div>
                                    <label>Student Date Of Birth</label>
                                        <div class="form-group">
                                        <input type="text" name="dob" id="datepicker" value="<?php if(isset($media_detail)){ print_r($media_detail->dob); } ?>" required="required" class="form-control input-default disableFuturedate" placeholder="Date Of Birth">
                                    </div>  
                                    <label>Category</label>
                                    <div class="form-group">
                                        <select  name="category_id" class="form-control" id="catgry" required>
                                            <option value="">----Select Category----</option>
                                            <?php foreach ($getgigcats as $row) {
                                            
                                            if($media_detail->category_id == $row->category_id){ ?>
                                            <option selected value="<?php echo $row->category_id; ?>" >
                                            <?php echo $row->category_name; ?>
                                            </option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $row->category_id; ?>" >
                                            <?php echo $row->category_name; ?>
                                            </option>
                                            <?php }
                                            ?>
                                            <?php } ?>   
                                        </select>
                                    </div>         
                                    <label>Sub Category</label>
                                    <div class="form-group">
                                        <select name="subcat_id" id="subcategory" class="form-control">
                                        <option value="">----Select Sub Category---- </option>
                                       </select>
                                    </div>
                                    <label>Source</label>
                                    <div class="form-group">
                                        
                                        <select  name="source" class="form-control" id="source" required>
                                        
                                            <option value="">----Select Source----</option>
                                        <?php foreach ($getsource as $row) {
                                        
                                        if($media_detail->source == $row->source){ ?>
                                        <option selected value="<?php echo $row->source; ?>" >
                                        <?php echo $row->source; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->source; ?>" >
                                        <?php echo $row->source; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?> 
                                        </select>
                                        
                                    </div>
                         
                                        
                                    <label>Referred By:</label>
                                    <div class="form-group">
                                        <input type="text" name="referal" value="<?php if(isset($media_detail)){ print_r($media_detail->referal); } ?>" required="required" class="form-control input-default" placeholder="Referred By:">
                                    </div>
                                    
                                    <label>Password</label>
                                   <div class="form-group">
                                        <input type="password" name="password" value="<?php if(isset($media_detail)){ print_r($media_detail->password); } ?>" required="required" class="form-control input-default" placeholder="Password">
                                    </div>
                                    
                                    <label>Confirm Password</label>
                                     <div class="form-group">
                                        <input type="password" name="confpassword" value="<?php if(isset($media_detail)){ print_r($media_detail->confpassword); } ?>" required="required" class="form-control input-default" placeholder="Confirm Password">
                                    </div>
                                    <label>T&C & Privacypolicy</label>
                                    <div class="form-group">
                                    
                                    <select  name="policy" class="form-control" id="policy" required>
                                    
                                    <option value="">----Select T&C & Privacypolicy----</option>
                                    <?php foreach ($getpolicyaccept as $row) {
                                    
                                    if($media_detail->policy == $row->policy){ ?>
                                    <option selected value="<?php echo $row->policy; ?>" >
                                    <?php echo $row->policy; ?>
                                    </option>
                                    <?php }else{ ?>
                                    <option value="<?php echo $row->policy; ?>" >
                                    <?php echo $row->policy; ?>
                                    </option>
                                    <?php }
                                    ?>
                                    <?php } ?>                                  
                                    
                                    </select>
                                    
                                    </div>
                                    <label>Picture</label>
                                    <div class="form-group">
                                            
                                            <?php if(isset($media_detail)) { ?>
                                           <input accept="*" type="file" name="profile" id="profile" >
                                           <?php } else{ ?>
                                            <input accept="*" type="file" name="profile" id="profile" >
                                           <?php } ?>  
                                          
                                          <?php if(isset($media_detail)) { ?>
                                          <img id="profile" src="<?php echo FILE_PATH.$media_detail->profile ?>" width="250px", height="200px" />
                                          <?php }  ?>
                                        
                                        </div>
                                    <input type="hidden" name="student_id"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->studentid; } ?>" /> 
                                    <button type="submit"  class="btn btn-dark mb-2">Add Student</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                    
                    
                    </div>
                </div>
            </div>
            <!-- #/ container -->
        </div>
        <script>
$(document).ready(function(){
 $('#catgry').change(function(){
   var category_id = $('#catgry').val();
  if(category_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>Fetchsubcat/Fetch_subcatgry",
    method:"POST",
    data:{category_id:category_id},
    success:function(data)
    {
     $('#subcategory').html(data);
     
     var subcat_id="<?=empty($media_detail)?'':$media_detail->subcat_id?>";
     $('#subcategory').val(subcat_id);
    }
   });
  }
  else
  {
   $('#subcategory').html('<option value="">Select sub category</option>');
  }
 });


 $('#country').change(function(){
  var country_id = $('#country').val();
  if(country_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>Dynamic_dependent/fetch_state",
    method:"POST",
    data:{country_id:country_id},
    success:function(data)
    {
     $('#state').html(data);
      var state_id="<?=empty($media_detail)?'':$media_detail->state_id?>";
     $('#state').val(state_id);
     $('#city').html('<option value="">Select City</option>');
    }
   });
  }
  else
  {
   $('#state').html('<option value="">Select State</option>');
   $('#city').html('<option value="">Select City</option>');
  }
 });

 // $('#state').change(function(){
 //  var state_id = $('#state').val();
 //  if(state_id != '')
 //  {
 //   $.ajax({
 //    url:"<?php echo base_url(); ?>Dynamic_dependent/fetch_city",
 //    method:"POST",
 //    data:{state_id:state_id},
 //    success:function(data)
 //    {
 //     $('#city').html(data);

 //    }
 //   });
 //  }
 //  else
 //  {
 //   $('#city').html('<option value="">Select City</option>');
 //  }
 // });
 
});
</script>
        
        <script>
  $( function() {
      var currentDate = new Date();
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      endDate: "currentDate",
maxDate: currentDate,
dateFormat: 'dd-mm-yy'
    });
  } );
  </script>
        
        <script>
$(document).ready(function () {
var currentDate = new Date();
$('.disableFuturedate').datepicker({
format: 'dd/mm/yyyy',
autoclose:true,
endDate: "currentDate",
maxDate: currentDate
}).on('changeDate', function (ev) {
$(this).datepicker('hide');
});
$('.disableFuturedate').keyup(function () {
if (this.value.match(/[^0-9]/g)) {
this.value = this.value.replace(/[^0-9^-]/g, '');
}
});
});
</script>
        

<script type="text/javascript">
  $(document).ready(function () {
    $('#myform').validate({
      rules: {
      },
      errorElement: 'span',
      errorPlacement: function (error, element) {
        error.addClass('invalid-feedback');
        element.closest('.form-group').append(error);
      },
      highlight: function (element, errorClass, validClass) {
        $(element).addClass('is-invalid');
      },
      unhighlight: function (element, errorClass, validClass) {
        $(element).removeClass('is-invalid');
      },
      submitHandler: function(form) {
        $(form).Submit();
      }
    });
  });
    $(function () {
        $("#txtName").keypress(function (e) {
            var keyCode = e.keyCode || e.which;
 
            $("#lblError").html("");
 
            //Regex for Valid Characters i.e. Numbers.
            var regex = /^[0-9]+$/;
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#lblError").html("Only Numbers allowed.");
            }
 
            return isValid;
        });
    });
</script>    


<script>
    var student_id="<?=empty($media_detail)?'':$media_detail->studentid?>";
        if (student_id && student_id.length>0) {

            setTimeout(function(){ 
               $('#catgry').trigger('change');
             $('#country').trigger('change');

            }, 1000);
            
        }
    $('#email_address').on('keyup', function() {
      var EMAIL_REGEX = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.((in)|(info)|(edu))$/;
    if(EMAIL_REGEX.test($(this).val()) == true) {
        $('#error').hide();
    } else {
        $('#error').show();
    }
})
  
</script>

<script>
    
    $('.Number').keypress(function (event) {
    var keycode = event.which;
    if (!(event.shiftKey == false && (keycode == 46 || keycode == 8 || keycode == 37 || keycode == 39 || (keycode >= 48 && keycode <= 57)))) {
        event.preventDefault();
    }
});
    
</script>

 <script> 
    
      // Function to check Whether both passwords 
      // is same or not. 
      function checkPassword(form) { 
        password = form.password.value; 
        confpassword = form.confpassword.value; 

        // If Password not entered 
        if (password == '') 
          alert ("Please enter Password"); 
          
        // If confirm Password not entered 
        else if (confpassword == '') 
          alert ("Please enter confirm Password"); 
          
        // If Not same return False.   
        else if (password != confpassword) { 
          alert ("\nPassword did not match: Please try again...") 
          return false; 
        } 

        // If same return True. 
        else{ 
          //alert("Password Match") 
          return true; 
        } 
      } 
    </script> 
  
  <?php $this->load->view('assests/footer'); ?>