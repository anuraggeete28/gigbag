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
</style>
<h3>
       <?php if(isset($media_detail)) {?>
           Update In News 
       <?php }else { ?>
          Add In News 
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
                                <h4 class="card-title">Add News</h4>
                                <div class="basic-form">
                                    <form class="form-horizontal" id="RegisterValidation" action="<?= base_url(); ?>Innews/add_radio" method="POST" enctype="multipart/form-data"> 
                                        
                                        <div class="form-group">
                                            <input type="text" name="title" value="<?php if(isset($media_detail)){ print_r($media_detail->title); } ?>" class="form-control input-flat" placeholder="Title">
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="text" name="readmore" value="<?php if(isset($media_detail)){ print_r($media_detail->readmore); } ?>" class="form-control input-flat" placeholder="News Link">
                                        </div>
                                        
                                        <label>Short Description</label>
                                        <div class="form-group">
                                            <textarea cols="150" id="message2" name="short_desc" rows="10" placeholder="Short Description" data-sample-short><?php if(isset($media_detail)){ print_r($media_detail->short_desc); } ?></textarea>
                                        </div>
                                        
                            <label>Cover Image</label>
                                       <div class="form-group">
                                            
                                            <?php if(isset($media_detail)) { ?>
                           <input accept="*" type="file" name="coverimg" id="coverimg" >
                           <?php } else{ ?>
                            <input accept="*" type="file" name="coverimg" id="coverimg" >
                           <?php } ?>  
                          
                          <?php if(isset($media_detail)) { ?>
                          <img id="coverimg" src="<?php echo base_url().''.$media_detail->coverimg ?>" width="250px", height="200px" />
                          <?php }  ?>
                                        
                                        </div>
                                        
                                        
                                        <input type="hidden" name="radioID"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->innews_id; } ?>" /> 
                                        <button type="submit" name="add_radio" value="Update" class="btn btn-dark mb-2">Add In News</button>
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
CKEDITOR.replace('message2', {
height: 320,
width: 984,
});
</script>

<script>
CKEDITOR.replace('message3', {
height: 320,
width: 984,
});
</script>

<script>
CKEDITOR.replace('message', {
height: 320,
width: 984,
});
</script>
  
  <?php $this->load->view('assests/footer'); ?>