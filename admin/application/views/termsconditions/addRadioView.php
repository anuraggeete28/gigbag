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
           Update Terms & Conditions
       <?php }else { ?>
          Add Terms & Conditions
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
                                <h4 class="card-title">Add / Update Terms & Conditions</h4>
                                <div class="basic-form">
                                    <form class="form-horizontal" id="RegisterValidation" action="<?= base_url(); ?>Termsconditions/add_radio" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                                       <label>Heading</label>
                                        <div class="form-group">
                                            <input type="text" name="heading" value="<?php if(isset($media_detail)){ print_r($media_detail->heading); } ?>" class="form-control input-default" placeholder="Heading">
                                        </div>
                                       
                                        <label>Terms & Conditions</label>
                                         <div class="form-group">
                                            
                                            <textarea cols="80" id="message" name="description" rows="10" data-sample-short><?php if(isset($media_detail)){ print_r($media_detail->description); } ?></textarea>
                                            
                                        </div>
                                        
                                        <label>Banner Image</label>
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
                                        
                                        <input type="hidden" name="radioID"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->termid; } ?>" /> 
                                        <button type="submit" name="add_radio" value="Update" class="btn btn-dark mb-2">Add Terms & Conditions</button>
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