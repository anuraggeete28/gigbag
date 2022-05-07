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
                                <h4 class="card-title">Add / Update Attendance</h4>
                                <div class="basic-form">
                                    <form class="form-horizontal" action="<?= base_url(); ?>Attendance/add_radio" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                                        
                                        <input type="hidden" name="usertype" value="teacher" /> 
                                        
                                         <!--<label>Timestamp ( Last Updated ) </label>
                                        <div class="form-group">
                                            <input type="date" name="last_update" value="<?php if(isset($media_detail)){ print_r($media_detail->last_update); } ?>" class="form-control input-flat" placeholder="Timestamp ( Last Updated ) ">
                                        </div>-->
                                        
                                        <label>Dates</label>
                                        <div class="form-group">
                                            <input type="date" name="dates" value="<?php if(isset($media_detail)){ print_r($media_detail->dates); } ?>" class="form-control input-default" placeholder="Date">
                                        </div>
                                        
                                        <label>Time</label>
                                        <div class="form-group">
                                            <input type="time" name="time" value="<?php if(isset($media_detail)){ print_r($media_detail->time); } ?>" class="form-control input-flat" placeholder="Time">
                                        </div>
                                        
                                        <label>Duration</label>
                                        <div class="form-group">
                                            <input type="number" name="duration" value="<?php if(isset($media_detail)){ print_r($media_detail->duration); } ?>" class="form-control input-flat" placeholder="Duration">
                                        </div>
                                        
                                       <label>Status</label>
                                        <div class="form-group">
                                        
                                        <select  name="status" class="form-control" id="status" required>
                                        
                                        <option value="">----Select Status----</option>
                                        <?php foreach ($getattenstatus as $row) {
                                        
                                        if($media_detail->status == $row->status){ ?>
                                        <option selected value="<?php echo $row->status; ?>" >
                                        <?php echo $row->status; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->status; ?>" >
                                        <?php echo $row->status; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>
                                        
                                     <label>Remark</label>
                                        <div class="form-group">
                                            <input type="text" name="remark" value="<?php if(isset($media_detail)){ print_r($media_detail->remark); } ?>" class="form-control input-flat" placeholder="Remark">
                                        </div>
                                        
                                        
                                         <label>Teacher ID</label>
                                        <div class="form-group">
                                        
                                        <select  name="teacher_id" class="form-control" id="teacher_id" required>
                                        
                                        <option value="">----Select Teacher ID----</option>
                                        <?php foreach ($getteacheridss as $row) {
                                        
                                        if($media_detail->teacher_id == $row->teacher_id){ ?>
                                        <option selected value="<?php echo $row->teacher_id; ?>" >
                                        <?php echo $row->teacher_id; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->teacher_id; ?>" >
                                        <?php echo $row->teacher_id; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>
                                    
                                     <label>Start Time </label>
                                        <div class="form-group">
                                            <input type="time" name="start_time" value="<?php if(isset($media_detail)){ print_r($media_detail->start_time); } ?>" class="form-control input-flat" placeholder="Start Time">
                                        </div>
                                        
                                        <label>End Time </label>
                                        <div class="form-group">
                                            <input type="time" name="endtime" value="<?php if(isset($media_detail)){ print_r($media_detail->endtime); } ?>" class="form-control input-flat" placeholder="End Time">
                                        </div>
                                    
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
                                    
                                    
                                        <label>Virtual Link</label>
                                        <div class="form-group">
                                            <input type="text" name="virtuallink" value="<?php if(isset($media_detail)){ print_r($media_detail->virtuallink); } ?>" class="form-control input-flat" placeholder="Virtual Link">
                                        </div>
                                        
                                        
                                        <label>Classroom Link</label>
                                        <div class="form-group">
                                            <input type="text" name="classroomlink" value="<?php if(isset($media_detail)){ print_r($media_detail->classroomlink); } ?>" class="form-control input-flat" placeholder="Classroom Link">
                                        </div>
                                        
                                       
                                         <label>Gig ID</label>
                                     
                                        <div class="form-group">
                                        
                                        <select  name="gigid" class="form-control" id="gigid" required>
                                        
                                        <option value="">----Select Gig ID----</option>
                                        <?php foreach ($getgigids as $row) {
                                        
                                        if(trim($media_detail->gigid) == trim($row->gigid)){ ?>
                                        <option selected value="<?php echo $row->gigid; ?>" >
                                        <?php echo $row->gigid; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->gigid; ?>" >
                                        <?php echo $row->gigid; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>
                                       
                                        
                                        <input type="hidden" name="radioID"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->attendance_id; } ?>" /> 
                                        <button type="submit" name="add_radio" value="Update" class="btn btn-dark mb-2">Add Attendance</button>
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