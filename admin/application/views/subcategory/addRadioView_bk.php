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
           Update category 
       <?php }else { ?>
          Add category 
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
                                <h4 class="card-title">Add / Update category</h4>
                                <div class="basic-form">
                                    <form class="form-horizontal" id="RegisterValidation" id="frmAdd" action="<?= base_url(); ?>Categories/add_radio" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                                        
                                        
                                      <!--  <div class="form-group">
                                        
                                        <select  name="category_name" class="form-control" id="category_name" required>
                                        
                                        <option value="">----Select Category----</option>
                                        <?php foreach ($getCourse as $row) {
                                        
                                        if($media_detail->category_name == $row->category_name){ ?>
                                        <option selected value="<?php echo $row->category_name; ?>" >
                                        <?php echo $row->category_name; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->category_name; ?>" >
                                        <?php echo $row->category_name; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>-->
                                        
                                        <label>Category</label>
                                        <div class="form-group">
                                            <input type="text" name="category_name" value="<?php if(isset($media_detail)){ print_r($media_detail->category_name); } ?>" class="form-control input-default" placeholder="Category">
                                        </div>
                                        
                                        
                                        <label>Subcategory</label>
                                        <div class="form-group">
                                            <input type="text" name="subcatname" value="<?php if(isset($media_detail)){ print_r($media_detail->subcatname); } ?>" class="form-control input-default" placeholder="Subcategory">
                                        </div>
                                        
                                        <label>Picture ( max size - 2mb )</label>
                                       <div class="form-group">
                                            
                                            <?php if(isset($media_detail)) { ?>
                           <input accept="*" type="file" name="banner_img" id="banner_img" >
                           <?php } else{ ?>
                            <input accept="*" type="file" name="banner_img" id="banner_img" >
                           <?php } ?>  
                          
                          <?php if(isset($media_detail)) { ?>
                          <img id="banner_img" src="<?php echo base_url().''.$media_detail->banner_img ?>" width="230px", height="200px" />
                          <?php }  ?>
                                        
                                        </div>
                                        
                                        <input type="hidden" name="radioID"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->subcat_id; } ?>" /> 
                                        <button type="submit" name="add_radio" value="Update" class="btn btn-dark mb-2">Add Category</button>
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
        
     
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
 <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
 <script>
 $(function() {
 $('#banner_img').change(function(){
 if(Math.round(this.files[0].size/(1024*1024)) > 2) {
 alert('Please select image size less than 2 MB');
 }else{
 alert('success');
 }
 });
 });
 </script>
        
        
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