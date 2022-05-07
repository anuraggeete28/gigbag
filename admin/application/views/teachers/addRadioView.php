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
                            <form autocomplete="off" class="form-horizontal" id="RegisterValidation" action="<?= base_url(); ?>teachers/submit_teacher" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data" novalidate> 
                                <input type="hidden" name="method" value="<?=$method?>" />  
                                <input type="hidden" name="usertype" value="teacher" /> 
                            
                            <?php
                            if(isset($stiudentCategory) && count($stiudentCategory) > 0) {        
                            foreach($stiudentCategory as $key=>$value) { ?>
                            <?php if($key == 0) { ?>
                            <div class="after-add-more">
                                <div class="row col-lg-12">
                                    <div class="col-lg-6">
                                        <label>Category</label>
                                        <div class="form-group">
                                            <select style="width: 100%!important;" name="category_id[]" class="form-control category_id" id="catgry" onchange="getSubcategory(this)" required>
                                                <option value="">----Select Category----</option>
                                                <?php foreach ($getgigcats as $row) {
                                                    if($value->category_id == $row->category_id){ ?>
                                                        <option selected value="<?php echo $row->category_id; ?>" ><?php echo $row->category_name; ?></option>
                                                    <?php }else{ ?>
                                                        <option value="<?php echo $row->category_id; ?>" ><?php echo $row->category_name; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>    
                                    </div> 
                                    <div class="col-lg-6">
                                        <label>Sub Category</label>
                                        <div class="form-group">
                                            <select style="width: 80%!important; float:left;" name="subcat_id[]" id="subcategory" class="form-control subcat_id" required>
                                                <option value="">----Select Sub Category---- </option>
                                                <?php
                                                    $this->db->select('*');
                                                    $this->db->from('subcategory');
                                                    $this->db->where(array('category_id' => $value->category_id));
                                                    $query    = $this->db->get();
                                                    $subCategory = $query->result();
                                                foreach ($subCategory as $row1) {
                                                    if($value->subcategory_id == $row1->subcat_id){ ?>
                                                        <option selected value="<?php echo $row1->subcat_id; ?>" ><?php echo $row1->subcatname; ?></option>
                                                    <?php }else{ ?>
                                                        <option value="<?php echo $row1->category_id; ?>" ><?php echo $row1->subcatname; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                            <div style="float:right;" class="input-group-btn"> 
                                                <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <?php } else { ?>
                            <div class="row col-lg-12 cat-div">
                                <div class="col-lg-6">
                                    <label>Category</label>
                                    <div class="form-group">
                                        <select style="width: 100%!important;" name="category_id[]" class="form-control category_id" onchange="getSubcategory(this)"   required>
                                            <option value="">----Select Category----</option>
                                            <?php foreach ($getgigcats as $row) {
                                                if($value->category_id == $row->category_id){ ?>
                                                    <option selected value="<?php echo $row->category_id; ?>" ><?php echo $row->category_name; ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $row->category_id; ?>" ><?php echo $row->category_name; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                    </div>    
                                </div> 
                                <div class="col-lg-6">
                                    <label>Sub Category</label>
                                    <div class="form-group">
                                        <select style="width: 80%!important; float:left;" name="subcat_id[]" class="form-control subcat_id" required>
                                            <option value="">----Select Sub Category---- </option>
                                            <?php
                                                $this->db->select('*');
                                                $this->db->from('subcategory');
                                                $this->db->where(array('category_id' => $value->category_id));
                                                $query    = $this->db->get();
                                                $subCategory = $query->result();
                                            foreach ($subCategory as $row1) {
                                                if($value->subcategory_id == $row1->subcat_id){ ?>
                                                    <option selected value="<?php echo $row1->subcat_id; ?>" ><?php echo $row1->subcatname; ?></option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $row1->category_id; ?>" ><?php echo $row1->subcatname; ?></option>
                                                <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <div style="float:right;" class="input-group-btn"> 
                                            <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove <i class="fa fa-add"></i> </button>
                                        </div>
                                    </div>
                                </div>  
                            </div>
                            <?php } ?>
                            <?php } ?>
                            <?php } else { ?>
                            <div class="after-add-more">
                                <div class="row col-lg-12">
                                    <div class="col-lg-6">
                                        <label>Category</label>
                                        <div class="form-group">
                                            <select style="width: 100%!important;" name="category_id[]" class="form-control category_id" id="catgry" onchange="getSubcategory(this)" required>
                                                <option value="">----Select Category----</option>
                                                <?php foreach ($getgigcats as $row) {
                                                    if($media_detail->category_id == $row->category_id){ ?>
                                                        <option selected value="<?php echo $row->category_id; ?>" ><?php echo $row->category_name; ?></option>
                                                    <?php }else{ ?>
                                                        <option value="<?php echo $row->category_id; ?>" ><?php echo $row->category_name; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>    
                                    </div> 
                                    <div class="col-lg-6">
                                        <label>Sub Category</label>
                                        <div class="form-group">
                                            <select style="width: 80%!important; float:left;" name="subcat_id[]" id="subcategory" class="form-control subcat_id" required>
                                                <option value="">----Select Sub Category---- </option>
                                            </select>
                                            <div style="float:right;" class="input-group-btn"> 
                                                <button class="btn btn-success add-more" type="button"><i class="glyphicon glyphicon-plus"></i> Add</button>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>
                            <?php } ?>

                            <div class="copy hide" style="display: none;">
                                <div class="row col-lg-12 cat-div">
                                    <div class="col-lg-6">
                                        <label>Category</label>
                                        <div class="form-group">
                                            <select style="width: 100%!important;" name="category_id[]" class="form-control category_id" onchange="getSubcategory(this)"   required>
                                                <option value="">----Select Category----</option>
                                                <?php foreach ($getgigcats as $row) {
                                                    if($media_detail->category_id == $row->category_id){ ?>
                                                        <option selected value="<?php echo $row->category_id; ?>" ><?php echo $row->category_name; ?></option>
                                                    <?php }else{ ?>
                                                        <option value="<?php echo $row->category_id; ?>" ><?php echo $row->category_name; ?></option>
                                                    <?php } ?>
                                                <?php } ?>
                                            </select>
                                        </div>    
                                    </div> 
                                    <div class="col-lg-6">
                                        <label>Sub Category</label>
                                        <div class="form-group">
                                            <select style="width: 80%!important; float:left;" name="subcat_id[]" class="form-control subcat_id" required>
                                                <option value="">----Select Sub Category---- </option>
                                            </select>
                                            <div style="float:right;" class="input-group-btn"> 
                                                <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i> Remove <i class="fa fa-add"></i> </button>
                                            </div>
                                        </div>
                                    </div>  
                                </div>
                            </div>

                            <label>Coach Name</label>
                            <div class="form-group">
                                <input type="text" name="username" value="<?php if(isset($media_detail)){ print_r($media_detail->username); } ?>" class="form-control input-default" placeholder="Coach Name" required  autocomplete="false">
                            </div>   
                            <label>Coach Email</label>
                            <div class="form-group">
                                <span id="error" style="display:none;color:red;">Invalid email</span>
                                <input type="email" id="email_address" name="email"  value="<?php if(isset($media_detail)){ print_r($media_detail->email); } ?>" class="form-control input-flat" placeholder="Coach Email" required autocomplete="false">
                            </div>      
                            <label>Address</label>
                            <div class="form-group">
                                <input type="text" name="address" value="<?php if(isset($media_detail)){ print_r($media_detail->address); } ?>" class="form-control input-flat" placeholder="Address" required autocomplete="false">
                            </div>  
                            <label>Country Code</label>
                                <div class="form-group">
                                    <select  name="country_code" class="form-control" id="country_code" required >
                                        
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
                                <label>Coach Mobile Number</label>
                                    <div class="form-group">
                                        <span id="lblError" style="color: red"></span>
                                        <input type="text" name="mobile" id="txtName" maxlength="10" minlength="10" required="required" value="<?php if(isset($media_detail)){ print_r($media_detail->mobile); } ?>" class="form-control input-default" placeholder="Coach Mobile Number" autocomplete='false'>
                                    </div> 
                                    <label>Date Of Birth</label>
                                        <div class="form-group">
                                            <input type="text" name="dob" id="datepicker" value="<?php if(isset($media_detail)){ print_r($media_detail->dob); } ?>" class="form-control input-flat disableFuturedate" placeholder="Date Of Birth" required autocomplete="false">
                                        </div>
                                       <!-- <label>Select Source</label>
                                        <div class="form-control">
                                            <select id="selectBox" onchange="changeFunc();" class="" name="source" tabindex="100">
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
                                        
                                        <label>Name In Bank Account</label>
                                        <div class="form-group">
                                            
                                            <input type="text" name="name_in_bank_account" value="<?php if(isset($media_detail)){ print_r($media_detail->name_in_bank_account); } ?>" class="form-control input-flat" placeholder="Name In Bank Account"required autocomplete="false" >
                                        </div>
                                        
                                        <label>Bank Name</label>
                                        <div class="form-group">
                                            <input type="text" name="bankname" value="<?php if(isset($media_detail)){ print_r($media_detail->bankname); } ?>" class="form-control input-flat" placeholder="Bank Name" required autocomplete="false">
                                        </div>
                                        
                                        <label>Branch Location</label>
                                        <div class="form-group">
                                            <input type="text" name="branch_name" value="<?php if(isset($media_detail)){ print_r($media_detail->branch_name); } ?>" class="form-control input-flat" placeholder="Branch Location" required autocomplete="false">
                                        </div>
                                        
                                        <label>Account Number</label>
                                        <div class="form-group">
                                            <span id="lblError2" style="color: red"></span>
                                            <input type="text" name="account_number" id="txtName2" value="<?php if(isset($media_detail)){ print_r($media_detail->account_number); } ?>" class="form-control input-flat" placeholder="Account Number" required autocomplete="false">
                                        </div>
                                        
                                        <label>IFSC Code</label>
                                        <div class="form-group">
                                            <input type="text" name="ifsc_code" value="<?php if(isset($media_detail)){ print_r($media_detail->ifsc_code); } ?>" class="form-control input-flat" placeholder="IFSC Code" required autocomplete="false">
                                        </div>
                                        
                                       
                                        <label>Induction Date </label>
                                        <div class="form-group">
                                            <input type="date" name="induction_date" value="<?php if(isset($media_detail)){ print_r($media_detail->induction_date); } ?>" class="form-control input-flat" placeholder="Induction Date" required autocomplete="false">
                                        </div>
                                        
                                        
                                        <label>Password</label>
                                        <div class="form-group">
                                            <input type="password" name="password" value="<?php if(isset($media_detail)){ print_r($media_detail->password); } ?>" class="form-control input-default" placeholder="Password" required autocomplete="false">
                                        </div>
                                        
                                        
                                        <label>Confirm Password</label>
                                        <div class="form-group">
                                            <input type="password" name="confpassword" value="<?php if(isset($media_detail)){ print_r($media_detail->confpassword); } ?>" class="form-control input-default" placeholder="Confirm Password" required autocomplete="false">
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
                                        
                                        <input type="hidden" name="teacher_id"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->studentid; } ?>" /> 
                                        <button type="submit"   class="btn btn-dark mb-2"><?=$page?></button>
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

        $(document).ready(function () {
            getSubcategory = function(subCat1) {
                var category_id = $(subCat1).val();
                var subCat = subCat1;
                if (category_id != '') {
                    $.ajax({
                        url: "<?php echo base_url(); ?>Fetchsubcat/Fetch_subcatgry",
                        method: "POST",
                        data: {
                            category_id: category_id
                        },
                        success: function (data) {
                            $($(subCat).parent().parent().parent().find('.subcat_id')).html(data);
                        }
                    });
                } else {
                    $('#subcategory').html('<option value="">Select sub category</option>');
                    $('#city').html('<option value="">Select City</option>');
                }
            }
        });

    $( function() {
        var currentDate = new Date();
        $( "#datepicker" ).datepicker({
            changeMonth: true,
            changeYear: true,
            endDate: "currentDate",
            maxDate: currentDate,
            dateFormat: 'dd-mm-yy'
        });
    });
 
    
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
        
        
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script type="text/javascript">
    $(function () {
        var teacher_id="<?=empty($media_detail)?'':$media_detail->studentid?>";
        if (teacher_id && teacher_id.length>0) {

            setTimeout(function(){ 
               $('#catgry').trigger('change');

            }, 1000);
            
        }
        
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
    $('#email_address').on('keypress', function() {
    var re = /([A-Z0-9a-z_-][^@])+?@[^$#<>?]+?\.[\w]{2,4}/.test(this.value);
    if(!re) {
        $('#error').show();
    } else {
        $('#error').hide();
    }
})
    
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

    $(document).ready(function() {
        $(".add-more").click(function(){ 
            var html = $(".copy").html();
            $(".after-add-more").after(html);
        });
        $("body").on("click",".remove",function(){ 
            $(this).parent().parent().parent().parent('.cat-div').remove();
        });
    });

    </script> 
  
  <?php $this->load->view('assests/footer'); ?>