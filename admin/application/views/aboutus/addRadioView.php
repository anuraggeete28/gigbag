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
           Update About Us
       <?php }else { ?>
          Add About Us
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
                                <h4 class="card-title">Add / Update About Us Content</h4>
                                <div class="basic-form">
                                    <form class="form-horizontal" id="RegisterValidation" action="<?= base_url(); ?>Aboutus/add_radio" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                                       
                                        <input type="hidden" name="description" value="about" />
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
                                        
                                        <input type="hidden" name="radioID"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->aboutusid; } ?>" /> 
                                        <button type="submit" name="add_radio" value="Update" class="btn btn-dark mb-2">Add About Us Content</button>
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