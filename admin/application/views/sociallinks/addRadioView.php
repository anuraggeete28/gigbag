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
           Update Sociallinks
       <?php }else { ?>
          Add Sociallinks
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
                                <h4 class="card-title">Add / Update Social Links</h4>
                                <div class="basic-form">
                                    <form class="form-horizontal" id="RegisterValidation" action="<?= base_url(); ?>Sociallinks/add_radio" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                                       <label>Facebook</label>
                                        <div class="form-group">
                                            <input type="text" name="facebook" value="<?php if(isset($media_detail)){ print_r($media_detail->facebook); } ?>" class="form-control input-default" placeholder="Facebook Url">
                                        </div>
                                       
                                       <label>Linkedin</label>
                                        <div class="form-group">
                                            <input type="text" name="linkedin" value="<?php if(isset($media_detail)){ print_r($media_detail->linkedin); } ?>" class="form-control input-default" placeholder="Linkedin Url">
                                        </div>
                                        
                                        <label>Google +</label>
                                        <div class="form-group">
                                            <input type="text" name="google" value="<?php if(isset($media_detail)){ print_r($media_detail->google); } ?>" class="form-control input-default" placeholder="Google + Url">
                                        </div>
                                        
                                        <label>Youtube</label>
                                        <div class="form-group">
                                            <input type="text" name="youtube" value="<?php if(isset($media_detail)){ print_r($media_detail->youtube); } ?>" class="form-control input-default" placeholder="Youtube Url">
                                        </div>
                                        
                                        <label>Instagram</label>
                                        <div class="form-group">
                                            <input type="text" name="instagram" value="<?php if(isset($media_detail)){ print_r($media_detail->instagram); } ?>" class="form-control input-default" placeholder="Instagram Url">
                                        </div>
                                       
                                        <input type="hidden" name="radioID"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->socialid; } ?>" /> 
                                        <button type="submit" name="add_radio" value="Update" class="btn btn-dark mb-2">Add Social Links</button>
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