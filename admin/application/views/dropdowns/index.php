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




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    /* Populate data to state dropdown */
    $('#country').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url('dropdowns/getStates'); ?>',
                data:'country_id='+countryID,
                success:function(data){
                    $('#state').html('<option value="">Select State</option>'); 
                    var dataObj = jQuery.parseJSON(data);
                    if(dataObj){
                        $(dataObj).each(function(){
                            var option = $('<option />');
                            option.attr('value', this.id).text(this.name);           
                            $('#state').append(option);
                        });
                    }else{
                        $('#state').html('<option value="">State not available</option>');
                    }
                }
            }); 
        }else{
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
    
    /* Populate data to city dropdown */
    $('#state').on('change',function(){
        var stateID = $(this).val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'<?php echo base_url('dropdowns/getCities'); ?>',
                data:'state_id='+stateID,
                success:function(data){
                    $('#city').html('<option value="">Select City</option>'); 
                    var dataObj = jQuery.parseJSON(data);
                    if(dataObj){
                        $(dataObj).each(function(){
                            var option = $('<option />');
                            option.attr('value', this.id).text(this.name);           
                            $('#city').append(option);
                        });
                    }else{
                        $('#city').html('<option value="">City not available</option>');
                    }
                }
            }); 
        }else{
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });
});
</script>

<!-- Country dropdown -->




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
<h3>
       <?php if(isset($media_detail)) {?>
           Update Student 
       <?php }else { ?>
          Add Student 
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
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Add / Update Student</h4>
                                <div class="basic-form">
                                    <form class="form-horizontal" id="myform" action="<?= base_url(); ?>Mailtouser/Apply" method="POST" enctype="multipart/form-data"> 
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
                                        
                                         <label>Country</label>
                                        <div class="form-group">
                                        <select class="form-control" id="country" name="country" required="required">
    <option value="">Select Country</option>
    <?php
    if(!empty($countries)){
        foreach($countries as $row){ 
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
    }else{
        echo '<option value="">Country not available</option>';
    }
    ?>
</select>
</div> 


<!-- State dropdown -->
 <label>State</label>
 <div class="form-group">
<select class="form-control" name="state" id="state" required="required">
    <option value="">Select country first</option>
</select>

   </div>                                      
                                        <label>Country Code</label>
                                        <div class="form-group">
                                        
                                        <select  name="country_code" class="form-control" id="country_code" required="required">
                                        
                                        <option value="">----Select Country----</option>
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
                                        
                                        
                                        <label>Mobile Number</label>
                                        <div class="form-group">
                                            <span id="lblError" style="color: red"></span>
                                            <input type="text" name="mobile" id="txtName" maxlength="10" minlength="10" required="required" value="<?php if(isset($media_detail)){ print_r($media_detail->mobile); } ?>" class="form-control input-default" placeholder="Mobile Number">
                                        </div>
                                        
                                        
                                        <label>Guardian</label>
                                         <div class="form-group">
                                            <input type="text" name="guardian" value="<?php if(isset($media_detail)){ print_r($media_detail->guardian); } ?>" required="required" class="form-control input-default" placeholder="Guardian">
                                        </div>
                                        
                                       
                                        <label>Date Of Birth</label>
                                         <div class="form-group">
                                            <input type="text" name="dob" id="datepicker" value="<?php if(isset($media_detail)){ print_r($media_detail->dob); } ?>" required="required" class="form-control input-default disableFuturedate" placeholder="Date Of Birth">
                                        </div>
                                        
                                        <label>Looking To Learn</label>
                                        <div class="form-group">
                                            <input type="text" name="looking_to_learn" value="<?php if(isset($media_detail)){ print_r($media_detail->looking_to_learn); } ?>" required="required" class="form-control input-default" placeholder="Looking To Learn">
                                        </div>
                                        
                                        
                                        <!--
                                        <label>Select Source</label>
                                        <div class="form-control">
                                            <select id="selectBox" onchange="changeFunc();" class="" name="source" tabindex="100" required="required">
                                        <option data-countryCode="#" value="#">----Select Source----</option>
                                        <option data-countryCode="facebook" value="Facebook">Facebook</option>
                                        <option data-countryCode="linkedin" value="Linkedin">Linkedin</option>
                                        <option data-countryCode="youtube" value="Youtube">Youtube</option>
                                        <option data-countryCode="instagram" value="Instagram">Instagram</option>
                                        <option data-countryCode="google" value="Google">Google</option>
                                        <option data-countryCode="Referal" value="Referal">Referal</option>
                                        <option value="Other">Other</option>
												</select>
												                   </div>
                                            
                                            <input name="source" placeholder="Add New Source" class="form-control" type="text" style="display: none" id="textboxes">
<script type="text/javascript">
function changeFunc() {
var selectBox = document.getElementById("selectBox");
var selectedValue = selectBox.options[selectBox.selectedIndex].value;
if (selectedValue=="Other"){
$('#textboxes').show();
}

}
</script>-->


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
                                        
                                        <input type="hidden" name="radioID"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->studentid; } ?>" /> 
                                        <button type="submit" name="add_radio" value="Validate!" class="btn btn-dark mb-2">Add Student</button>
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

<?php $this->load->view('assests/footer'); ?>