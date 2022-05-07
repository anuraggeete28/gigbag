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
<h3>
    <?php if(isset($media_detail)) {?>
        
    <?php }else { ?>
       
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
                             <h4 class="card-title">Add Order</h4>
                             <div class="basic-form">
                                 <form class="form-horizontal" action="<?= base_url(); ?>orders/add_radio" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                                    
                                 <label>Student ID</label>
                                     <div class="form-group">
                                     
                                     <select  name="student_id" class="form-control" id="student_id" required>
                                     
                                     <option value="">----Select Student ID----</option>
                                     <?php foreach ($getstudentsidss as $row) {
                                     
                                     if($media_detail->student_id == $row->student_id){ ?>
                                     <option selected value="<?php echo $row->student_id; ?>" >
                                     <?php echo $row->student_id; ?>
                                     </option>
                                     <?php }else{ ?>
                                     <option value="<?php echo $row->student_id; ?>" >
                                     <?php echo $row->student_id; ?>
                                     </option>
                                     <?php }
                                     ?>
                                     <?php } ?>                                  
                                     
                                     </select>
                                     
                                     </div>

                                     <label>Coupoun ID</label>
                                     <div class="form-group">
                                     
                                     <select  name="coupon_id" class="form-control" id="coupon_id" required>
                                     
                                     <option value="">----Select Coupom ID----</option>
                                     <?php foreach ($coupon as $row) {
                                     
                                     if($media_detail->couponnumber == $row->couponnumber){ ?>
                                     <option selected value="<?php echo $row->couponnumber; ?>" >
                                     <?php echo $row->couponnumber; ?>
                                     </option>
                                     <?php }else{ ?>
                                     <option value="<?php echo $row->couponnumber; ?>" >
                                     <?php echo $row->couponnumber; ?>
                                     </option>
                                     <?php }
                                     ?>
                                     <?php } ?>                                  
                                     
                                     </select>
                                     
                                     </div>

                                     <label>Class ID</label>
                                     <div class="form-group">
                                     
                                     <select  name="classes_id" class="form-control" id="classes_id" required>
                                     
                                     <option value="">----Select Class ID----</option>
                                     <?php foreach ($classes as $row) {
                                     
                                     if($media_detail->class_id_number == $row->class_id_number){ ?>
                                     <option selected value="<?php echo $row->class_id_number; ?>" >
                                     <?php echo $row->class_id_number; ?>
                                     </option>
                                     <?php }else{ ?>
                                     <option value="<?php echo $row->class_id_number; ?>" >
                                     <?php echo $row->class_id_number; ?>
                                     </option>
                                     <?php }
                                     ?>
                                     <?php } ?>                                  
                                     
                                     </select>
                                     
                                     </div>
                                  
                                     <button type="submit" name="add_radio" value="add" class="btn btn-dark mb-2">Add Order</button>
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
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script>
    $(document).ready(function() {
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
 </script> 

<?php $this->load->view('assests/footer'); ?>