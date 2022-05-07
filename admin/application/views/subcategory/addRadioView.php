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
<h3><?=$page?></h3>

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
                <form class="form-horizontal" id="RegisterValidation" id="frmAdd" action="<?= base_url(); ?>Categories/submit_subcategory" method="POST"  enctype="multipart/form-data"> 
                  <?php $disabled=!empty($category_id)?'disabled':'';?>
                  <div class="form-group">
                    <input type="hidden" value="<?=$category_id?>" name="category_id">
                    <input type="hidden" name="method" value="<?=$method?>">
                    <input type="hidden" name="subcat_id" value="<?=@$subcategoryData->subcat_id?>">
                    <select  name="category_id" class="form-control" id="category_name" required <?=$disabled?>>
                      <option value="">----Select Category----</option>
                      <?php if(!empty($categoriesList)): foreach ($categoriesList as $row):
                        $selected=(@$subcategoryData->category_id==$row->category_id || $category_id==$row->category_id)?'selected':'';
                        ?>
                      <option <?=$selected?>  value="<?=$row->category_id;?>" >
                      <?php echo $row->category_name; ?>
                      </option>
                      ?>
                      <?php endforeach;endif; ?>
                   </select>
                 </div>
               <!--  <label>Category</label>
                <div class="form-group">
                    <input type="text" name="category_name" value="<?php if(isset($subcategoryData)){ print_r($subcategoryData->category_name); } ?>" class="form-control input-default" placeholder="Category">
                </div> -->
                <label>Subcategory</label>
                <div class="form-group">
                    <input type="text" name="subcatname" value="<?php if(isset($subcategoryData)){ print_r($subcategoryData->subcatname); } ?>" class="form-control input-default" placeholder="Subcategory">
                </div>
                <label>Description</label>
                <div class="form-group">
                    <textarea name="description" class="form-control input-default" placeholder="Description" ><?=!empty($subcategoryData)?$subcategoryData->description:''?></textarea>
                </div>
                <label>Picture ( max size - 2mb )</label>
               <div class="form-group">
                    
                    <?php if(isset($subcategoryData)) { ?>
                   <input accept="*" type="file" name="banner_img" id="banner_img" >
                   <?php } else{ ?>
                    <input accept="*" type="file" name="banner_img" id="banner_img" >
                   <?php } ?>  
                  
                  <?php if(isset($subcategoryData)) { ?>
                  <img id="banner_img" src="<?php echo base_url().''.$subcategoryData->banner_img ?>" width="230px", height="200px" />
                  <?php }  ?>
                                
                  </div>
                  
                  <input type="hidden" name="subcat_id"  id="subcat_id" value="<?php if(isset($subcategoryData)){ echo $subcategoryData->subcat_id; } ?>" /> 
                  <button type="submit"  class="btn btn-dark mb-2"><?=$page?></button>
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