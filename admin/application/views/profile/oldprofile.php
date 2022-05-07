   <?php $this->load->view('assests/header'); ?>
 
    <?php $this->load->view('assests/sidebar'); ?>
<style>
    .pdtpp{
        
        margin-top:75px;
    }
    
    .form-control {
    display: block;
    width: 50%;
    }
    
</style>

 <h3>
       <?php if(isset($media_detail)) {?>
           
       <?php }else { ?>
          Add Profile 
        <?php } ?>
        
    </h3>
<?php

        if($this->session->flashdata('item')) {
           $message = $this->session->flashdata('item');
        ?>
           <div class="<?php echo $message['class'] ?>"><?php echo $message['message']; ?>

           </div>
           <?php
         }

          ?>

    <div class="content-body">

          
            <!-- row -->

            <div class="container-fluid">
                <div class="row pdtpp">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Update Profile</h4>
                                <div class="basic-form">
                                    <form class="form-horizontal" id="RegisterValidation" action="<?= base_url(); ?>Profile/add_radio" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                                        
                                        
                                        <label>Username</label>
                                        <div class="form-group">
                                            <input type="text" name="username" value="<?php if(isset($media_detail)){ print_r($media_detail->username); } ?>" class="form-control input-default" placeholder="Username">
                                        </div>
                                        <!--<label>Email</label>
                                        <div class="form-group">
                                            <input type="email" name="email" value="<?php if(isset($media_detail)){ print_r($media_detail->email); } ?>" class="form-control input-flat" placeholder="Email">
                                        </div>-->
                                        
                                        <label> Email</label>
                                        <div class="form-group">
                                            <span id="error" style="display:none;color:red;">Invalid email</span>
                                            <input type="email" id="email_address" name="email"  value="<?php if(isset($media_detail)){ print_r($media_detail->email); } ?>" class="form-control input-flat" placeholder="Coach Email" required>
                                        </div>
                                        
                                        <label>Password</label>
                                        <div class="form-group">
                                            <input type="password" name="password" value="<?php if(isset($media_detail)){ print_r($media_detail->password); } ?>" class="form-control input-flat" placeholder="Password">
                                        </div>
                                        <label>Confirm password</label>
                                        <div class="form-group">
                                            <input type="password" name="confirm_Password" value="<?php if(isset($media_detail)){ print_r($media_detail->confirm_Password); } ?>" class="form-control input-flat" placeholder="Confirm Password">
                                        </div>
                                        
                                        <!--<label>USD rate</label>
                                        <div class="form-group">
                                            <input type="text" name="usdrate" value="<?php if(isset($media_detail)){ print_r($media_detail->usdrate); } ?>" class="form-control input-flat" placeholder="USD rate">
                                        </div>-->
                                        
                                        <label>USD rate</label>
                                        <div class="form-group">
                                            <span id="lblError2" style="color: red"></span>
                                            <input type="text" name="usdrate" id="txtName2" value="<?php if(isset($media_detail)){ print_r($media_detail->usdrate); } ?>" class="form-control input-flat" placeholder="USD rate" required>
                                        </div>
                                        
                                        <input type="hidden" name="radioID"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->id; } ?>" /> 
                                        <button type="submit" name="add_radio" value="Update" class="btn btn-dark mb-2">Update</button>
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
    $('#email_address').on('keypress', function() {
    var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(this.value);
    if(!re) {
        $('#error').show();
    } else {
        $('#error').hide();
    }
})
    
</script>
        
        <script type="text/javascript">
    $(function () {
        $("#txtName2").keypress(function (e) {
            var keyCode = e.keyCode || e.which;
 
            $("#lblError2").html("");
 
            //Regex for Valid Characters i.e. Numbers.
            var regex = /^[0-9]+$/;
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#lblError2").html("Only Numbers allowed.");
            }
 
            return isValid;
        });
    });
</script> 
        <script> 
    
      // Function to check Whether both passwords 
      // is same or not. 
      function checkPassword(form) { 
        password = form.password.value; 
        confirm_Password = form.confirm_Password.value; 

        // If Password not entered 
        if (password == '') 
          alert ("Please enter Password"); 
          
        // If confirm Password not entered 
        else if (confirm_Password == '') 
          alert ("Please enter confirm Password"); 
          
        // If Not same return False.   
        else if (password != confirm_Password) { 
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