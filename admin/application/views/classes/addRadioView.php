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
                                <h4 class="card-title">Add / Update Class</h4>
                                <div class="basic-form">
                                    <form class="form-horizontal" id="RegisterValidation" action="<?= base_url(); ?>Classess/add_radio" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                                        
                                        <input type="hidden" name="usertype" value="teacher" /> 
                                        
                                        
                                        <label>Teacher ID</label>
                                        <div class="form-group">
                                        
                                        <select  name="teacher_id" class="form-control" id="teacher_id" required>
                                        
                                        <option value="">----Select Teacher ID----</option>
                                        <?php foreach ($getteacherid as $row) {
                                        
                                        if($media_detail->teacher_id == $row->studentid){ ?>
                                        <option selected value="<?php echo $row->studentid; ?>" >
                                        <?php echo $row->teacher_id.'-'.$row->teacher_name; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->studentid; ?>" >
                                        <?php echo $row->teacher_id.'-'.$row->teacher_name; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>
                                        
                                        
                                        
                                        <label>GIG ID</label>
                                        <div class="form-group">
                                        
                                        <select  name="gigid" class="form-control" id="gigid" required>
                                        
                                        <option value="">----Select GIG ID----</option>
                                        <?php foreach ($getgig as $row) {
                                        
                                        if($media_detail->gigid == $row->gig_id){ ?>
                                        <option selected value="<?php echo $row->gig_id; ?>" >
                                        <?php echo $row->gigid.'-'.$row->gig_title; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->gig_id; ?>" >
                                        <?php echo $row->gigid.'-'.$row->gig_title; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>
                                        
                                         <label>Coupon Code</label>
                                        <div class="form-group">
                                        
                                        <select  name="couponcode" class="form-control" id="couponcode" required>
                                        
                                        <option value="">----Select Coupon Code----</option>
                                        <?php foreach ($getcoupon as $row) {
                                        
                                        if($media_detail->couponcode == $row->couponcode){ ?>
                                        <option selected value="<?php echo $row->couponcode; ?>" >
                                        <?php echo $row->couponnumber.'-'.$row->couponcode; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->couponcode; ?>" >
                                        <?php echo $row->couponnumber.'-'.$row->couponcode; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>
                                        
                                        <label>Start Date</label>
                                        <div class="form-group">
                                            <input type="date" name="startdate" value="<?php if(isset($media_detail)){ print_r($media_detail->startdate); } ?>" class="form-control input-flat" placeholder="Start Date">
                                        </div>
                                        
                                        
                                        
                                        <label>Class Start Time</label>
                                        <div class="form-group">
                                            <input type="time" name="class_start_time" value="<?php if(isset($media_detail)){ print_r($media_detail->class_start_time); } ?>" class="form-control input-flat" placeholder="Class Start Time">
                                        </div>
                                        
                                        
                                        <label>End Date </label>
                                        <div class="form-group">
                                            <input type="date" name="end_date" value="<?php if(isset($media_detail)){ print_r($media_detail->end_date); } ?>" class="form-control input-flat" placeholder="End Date ">
                                        </div>
                                        
                                        
                                        
                                       <!--  <label>Status</label>
                                        <div class="form-group">
                                        
                                        <select  name="status" class="form-control" id="status" required>
                                        
                                        <option value="">----Select Status----</option>
                                        <?php foreach ($getstatus as $row) {
                                        
                                        if($media_detail->status == $row->status){ ?>
                                        <option selected value="<?php echo $row->status_id; ?>" >
                                        <?php echo $row->status; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->status_id; ?>" >
                                        <?php echo $row->status; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>
                                        
                                        
                                        <label>Paid</label>
                                        <div class="form-group">
                                        
                                        <select  name="paid" class="form-control" id="paid" required>
                                        
                                        <option value="">----Select Paid----</option>
                                        <?php foreach ($getpaid as $row) {
                                        
                                        if($media_detail->paid == $row->paid){ ?>
                                        <option selected value="<?php echo $row->paid; ?>" >
                                        <?php echo $row->paid; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->paid; ?>" >
                                        <?php echo $row->paid; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div> -->
                                        
                                        <input type="hidden" name="radioID"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->class_id; } ?>" /> 
                                        <button type="submit" name="add_radio" value="Update" class="btn btn-dark mb-2">Add Class</button>
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