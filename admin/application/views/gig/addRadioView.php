   <?php $this->load->view('assests/header');
   
   error_reporting(0);
   ?>
 
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
                            <form class="form-horizontal" id="RegisterValidation" action="<?= base_url(); ?>Gig/submit_gig" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                                <!-- <label>GIG ID</label>
                                 <div class="form-group">
                                    <input type="text" name="gigid" value="<?php if(isset($media_detail)){ print_r($media_detail->gigid); } ?>" class="form-control input-default" placeholder="Gig ID">
                                </div>  -->
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
                                    <label>Section</label>
                                    <div class="form-group">
                                        
                                        <select  name="section_category" class="form-control" id="section_category" required>
                                        
                                            <option value="">----Select Section----</option>
                                        <?php foreach ($section_category as $row) {
                                        
                                        if($media_detail->section_category == $row->id){ ?>
                                        <option selected value="<?php echo $row->id; ?>" >
                                        <?php echo $row->name; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->id; ?>" >
                                        <?php echo $row->name; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?> 
                                        </select>
                                        
                                    </div> 
                                    <label>Card Description</label>
                                    <div class="form-group">
                                        <input type="text" name="carddescription" value="<?php if(isset($media_detail)){ print_r($media_detail->carddescription); } ?>" class="form-control input-default" placeholder="Card Description">
                                    </div>
                                    <label>Base(INR)</label>
                                    <div class="form-group">
                                        <input type="number" min="0" name="base" value="<?php if(isset($media_detail)){ print_r($media_detail->base); } ?>" class="form-control input-default" placeholder="Base" id="base_val">
                                    </div>
                                    <label>Sessions</label>
                                    <div class="form-group">
                                        <input type="number"  min="0" name="sessions" value="<?php if(isset($media_detail)){ print_r($media_detail->sessions); } ?>" class="form-control input-default" placeholder="Sessions" id="session_val">
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="maxstudents" value="1">
                                    </div>  
                                   <!--  <label>Coupon</label>
                                    <div class="form-group">
                                        <select  name="couponcode[]" class="form-control" id="couponcode" required multiple="">
                                        
                                            <option value="">----Select Coupon Code----</option>
                                            <?php foreach ($getcoupon as $row) {
                                            $selected='';
                                            if (!empty($media_detail->couponcode)) 
                                            {
                                                $coupons=explode(',',$media_detail->couponcode);
                                                $selected=in_array($row->couponcode, $coupons)?'selected':''; 
                                            }
                                           ?>
                                            <option <?=$selected?> value="<?php echo $row->couponid; ?>" >
                                            <?php echo $row->couponcode; ?>
                                            </option>
                                            
                                            <?php } ?>  
                                        </select>
                                    </div>
                                    <label>Default Coupon </label>
                                    <div class="form-group">
                                        <select  name="default_coupon" class="form-control" required>
                                            <option value="">----Select Coupon Code----</option>
                                            <?php foreach ($getcoupon as $row) {
                                            
                                            $selected=($media_detail->default_coupon == $row->couponcode)?'selected':''; ?>
                                            <option <?=$selected?> value="<?php echo $row->couponid; ?>" >
                                            <?php echo $row->couponcode; ?>
                                            </option>
                                            
                                            <?php } ?>  
                                        </select>
                                    </div>
                                    <label>Teacher Fee / Per Session</label>
                                    <div class="form-group">
                                        <input type="number" name="teacherfee_per_session" value="<?php if(isset($media_detail)){ print_r($media_detail->teacherfee_per_session); } ?>" class="form-control input-default" placeholder="Teacher Fee / Per Session">
                                    </div> -->
                                   <label>Standard Gig Fee(INR)</label>
                                    <div class="form-group">
                                        <input  min="0" type="number" name="standerd_gig_fee" value="<?=(!empty($media_detail))? $media_detail->gigfees:0 ?>" class="form-control input-default" readonly  id="standerd_gig_fee">
                                    </div> 
                                    <label>Final Gig Fee(INR)</label>
                                    <div class="form-group">
                                        <input  min="0" type="number" name="finalgigfees" value="<?php if(isset($media_detail)){ print_r($media_detail->finalgigfees); } ?>" class="form-control input-default" id="finalgigfees" value=0>
                                        <span class="error" id="finalgigfeesErr"></span>
                                    </div> 
                                    <label>Type Of Class</label>
                                    <div class="form-group">
                                        
                                        <select  name="type_of_class" class="form-control" id="type_of_class" required>
                                        
                                            <option value="">----Select Type Of Class----</option>
                                            <?php foreach ($gettypeofclass as $row) {
                                             $selected="";
                                            if($media_detail->type_of_class == $row->type_of_class){ 
                                                $selected="selected";
                                                }?>
                                            <option data-location-req="<?php echo $row->location_required; ?>" value="<?php echo $row->type_of_class; ?>" <?=$selected?>>
                                            <?php echo $row->type_of_class; ?>
                                            </option>
                                            
                                            <?php } ?>  
                                        </select>
                                            
                                    </div>
                                    <div id="location_req_div" style="display: none;">
                                    <label>Country</label>
                                    <div class="form-group">
                                        <select  name="country_id" class="form-control" id="country" >
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
                                   </div>
                                    <label>Session Duration In Hours</label>
                                    <div class="form-group">
                                        <input type="number" name="session_duration_in_hours" value="<?php if(isset($media_detail)){ print_r($media_detail->session_duration_in_hours); } ?>" class="form-control input-default" placeholder="Session Duration In Hours">
                                    </div>
                                        
                                        
                                    <label>Rescheduling Allowed</label>
                                    <div class="form-group">
                                        
                                        <select  name="rescheduling_allowed" class="form-control" id="rescheduling_allowed" required>
                                        
                                        <option value="">----Select Rescheduling Allowed----</option>
                                        <?php foreach ($gettrescheduling as $row) {
                                        
                                        if($media_detail->rescheduling_allowed == $row->rescheduling_allowed){ ?>
                                        <option selected value="<?php echo $row->rescheduling_allowed; ?>" >
                                        <?php echo $row->rescheduling_allowed; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->rescheduling_allowed; ?>" >
                                        <?php echo $row->rescheduling_allowed; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                    </div>
                                        
                                    <label>Picture</label>
                                    <div class="form-group">
                                            
                                        <?php if(isset($media_detail)) { ?>
                                       <input accept="*" type="file" name="banner_img" id="banner_img" >
                                       <?php } else{ ?>
                                        <input accept="*" type="file" name="banner_img" id="banner_img" >
                                       <?php } ?>  
                                      
                                      <?php if(isset($media_detail)) { ?>
                                      <img id="banner_img" src="<?php echo FILE_PATH.$media_detail->banner_img ?>" width="250px", height="200px" />
                                      <?php }  ?>
                                    
                                    </div>
                                   <!--  <label>USD Rate</label>
                                    <div class="form-group">
                                        <input type="text" name="usdrate" value="<?php if(isset($media_detail)){ print_r($media_detail->usdrate); } ?>" class="form-control input-default" placeholder="USD Rate">
                                    </div> -->
                                    <input type="hidden" name="gig_id"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->gig_id; } ?>" /> 
                                    <input type="hidden" name="method"  id="method" value="<?=$method ?>" /> 
                                    <button type="submit"  class="btn btn-dark mb-2">Add Gig</button>
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
   <script src="https://cdn.ckeditor.com/4.13.1/standard-all/ckeditor.js"></script>
   
 <script>
$(document).ready(function(){
    var gig_id="<?=empty($media_detail)?'':$media_detail->gig_id?>";
    if (gig_id && gig_id.length>0) {
        $('#type_of_class').trigger('change');
        setTimeout(function(){ 

           $('#catgry').trigger('change');
            $('#country').trigger('change');

        }, 1000);
        
    }
$('#type_of_class').change(function() {
    var location_required = $('option:selected', this).attr('data-location-req');
    if (location_required==1) 
    {
        $('#location_req_div').show();
        $('#country').attr('required',true);
        $('#state').attr('required',true);
    }
    else
    {
        $('#location_req_div').hide();
        $('#country').attr('required',false);
        $('#state').attr('required',false);
    }

})

$('#base_val,#session_val').keyup(function() {
    var base_val = $('#base_val').val();
    var session_val = $('#session_val').val();
    var standerd_gig_fee=(parseInt(base_val)*parseInt(session_val));
    if (isNaN(standerd_gig_fee) ) {
        standerd_gig_fee=0;
    }
    $('#standerd_gig_fee').val(standerd_gig_fee)

})
$('#finalgigfees').keyup(function() {
    var finalgigfees = $(this).val();
    var standerd_gig_fee= $('#standerd_gig_fee').val();
    if (parseInt(standerd_gig_fee)<parseInt(finalgigfees)) {
        $('#finalgigfeesErr').text('Final gig fee should be less then standerd gig fee');
    }
    else
    {
        $('#finalgigfeesErr').text('');
    }
})
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

 $('#subcategory').change(function(){
  var subcat_id = $('#subcategory').val();
  if(subcat_id != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>Dynamic_dependent/fetch_city",
    method:"POST",
    data:{subcat_id:subcat_id},
    success:function(data)
    {
     $('#city').html(data);
    }
   });
  }
  else
  {
   $('#city').html('<option value="">Select City</option>');
  }
 });
 
});
$(document).ready(function(){
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

<?php $this->load->view('assests/footer'); ?>