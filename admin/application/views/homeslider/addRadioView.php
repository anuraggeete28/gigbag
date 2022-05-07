   <?php $this->load->view('assests/header'); ?>
 
    <?php $this->load->view('assests/websidebar'); ?>

   
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
           Update Slider Image 
       <?php }else { ?>
          Add Gig 
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
                                <h4 class="card-title">Add / Update Slider Details</h4>
                                <div class="basic-form">
                                    <form class="form-horizontal" id="RegisterValidation" action="<?= base_url(); ?>Homeslider/add_radio" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                                        <input type="hidden" name="imgname" value="slider" />
                                        
                                        
                                        <label>Big Text</label>
                                        <div class="form-group">
                                            <input type="text" name="bigtext" value="<?php if(isset($media_detail)){ print_r($media_detail->bigtext); } ?>" class="form-control input-default" placeholder="Big Text">
                                        </div>
                                        
                                        <label>Small Text</label>
                                        <div class="form-group">
                                            <input type="text" name="smalltext" value="<?php if(isset($media_detail)){ print_r($media_detail->smalltext); } ?>" class="form-control input-default" placeholder="Small Text">
                                        </div>
                                        
                                        
                                         <label>Slider Image</label>
                                       <div class="form-group">
                                            
                                            <?php if(isset($media_detail)) { ?>
                           <input accept="*" type="file" name="banner_img" id="banner_img" >
                           <?php } else{ ?>
                            <input accept="*" type="file" name="banner_img" id="banner_img" >
                           <?php } ?>  
                          
                          <?php if(isset($media_detail)) { ?>
                          <img id="banner_img" src="<?php echo base_url().''.$media_detail->banner_img ?>" width="250px", height="200px" />
                          <?php }  ?>
                                        
                                        </div>
                                        
                                        <input type="hidden" name="radioID"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->sliderid; } ?>" /> 
                                        <button type="submit" name="add_radio" value="Update" class="btn btn-dark mb-2">Add Slider Details</button>
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
CKEDITOR.replace('message', {
height: 320,
width: 984,
});
</script>
<script>
CKEDITOR.replace('message2', {
height: 320,
width: 984,
});
</script>
  <?php $this->load->view('assests/footer'); ?>