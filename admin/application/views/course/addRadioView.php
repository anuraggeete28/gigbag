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
           Update Profile 
       <?php }else { ?>
          Add Profile 
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
                                <h4 class="card-title">Add / Update Data</h4>
                                <div class="basic-form">
                                    <form class="form-horizontal" id="RegisterValidation" action="<?= base_url(); ?>Course/add_radio" method="POST" enctype="multipart/form-data"> 
                                        
                                        <div class="form-group">
                                        
                                        <select  name="category_id" class="form-control" id="category_id" required>
                                        
                                        <option value="">----Select Category----</option>
                                        <?php foreach ($getCourse as $row) {
                                        
                                        if($media_detail->category_id == $row->category_id){ ?>
                                        <option selected value="<?php echo $row->category_id; ?>" >
                                        <?php echo $row->category_name; ?>
                                        </option>
                                        <?php }else{ ?>
                                        <option value="<?php echo $row->category_id; ?>" >
                                        <?php echo $row->category_name; ?>
                                        </option>
                                        <?php }
                                        ?>
                                        <?php } ?>                                  
                                        
                                        </select>
                                        
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="text" name="title" value="<?php if(isset($media_detail)){ print_r($media_detail->title); } ?>" class="form-control input-flat" placeholder="Title">
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="text" name="pages" value="<?php if(isset($media_detail)){ print_r($media_detail->pages); } ?>" class="form-control input-flat" placeholder="Pages">
                                        </div>
                                        
                                        
                                        <input type="hidden" name="single_license" value="1925" /> 
                                        <input type="hidden" name="enterprise_license" value="2650" /> 
                                        
                                       <!-- <div class="form-group">
                                            <input type="text" name="single_license" value="<?php //if(isset($media_detail)){ print_r($media_detail->single_license); } ?>" class="form-control input-flat" placeholder="Single License Price">
                                        </div>
                                        
                                        <div class="form-group">
                                            <input type="text" name="enterprise_license" value="<?php //if(isset($media_detail)){ print_r($media_detail->enterprise_license); } ?>" class="form-control input-flat" placeholder="Enterprise License Price">
                                        </div>-->
                                       <input type="hidden" name="short_desc" value="Market Report is the latest study published by Gravitas Market Insights. It offers global industry analysis for 2014-2019 and valuates opportunities and forecast data for 2020-2028. This report covers Market Overview along with market background, Market Trends, Demand Analysis, Analysis of COVID-19 Impact, Segment Overview, Regional Profiling, Overall market structure and in-depth Competitive Analysis. Additionally, key activities related to the market strategies which includes mergers and acquisitions, product advancements, etc., are discussed." />
                                       <!--  <label>Short Description</label>
                                        <div class="form-group">
                                            
                                            <textarea cols="80" id="message5" name="short_desc" rows="10" data-sample-short><?php //if(isset($media_detail)){ print_r($media_detail->short_desc); } ?></textarea>
                                            
                                        </div>-->
                                        
                                        <label>Long Description</label>
                                        <div class="form-group">
                                            
                                            <textarea cols="80" id="message" name="description" rows="10" data-sample-short><?php if(isset($media_detail)){ print_r($media_detail->description); } ?></textarea>
                                            
                                        </div>
                                        
                                        <label>Research Methodology</label>
                                        <div class="form-group">
                                            
                                            <textarea cols="80" id="message2" name="methodology" rows="10" data-sample-short><?php if(isset($media_detail)){ print_r($media_detail->methodology); } ?></textarea>
                                            
                                        </div>
                                        
                                        <label>Table Of Content</label>
                                        <div class="form-group">
                                            
                                            <textarea cols="80" id="message3" name="table_of_content" rows="10" data-sample-short><?php if(isset($media_detail)){ print_r($media_detail->table_of_content); } ?></textarea>
                                            
                                        </div>
                                        
                                         <label>keywords</label>
                                        <div class="form-group">
                                            
                                            <textarea cols="80" id="message6" name="keywords" rows="10" data-sample-short><?php if(isset($media_detail)){ print_r($media_detail->keywords); } ?></textarea>
                                            
                                        </div>
                                        <input type="hidden" name="radioID"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->data_id; } ?>" /> 
                                        <button type="submit" name="add_radio" value="Update" class="btn btn-dark mb-2">Add Data</button>
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
width: 985,
});
</script>
<script>
CKEDITOR.replace('message2', {
height: 320,
width: 985,
});
</script>
<script>
CKEDITOR.replace('message3', {
height: 320,
width: 985,
});
</script>
<script>
CKEDITOR.replace('message4', {
height: 320,
width: 985,
});
</script>
<script>
CKEDITOR.replace('message5', {
height: 320,
width: 985,
});
</script>
  <script>
CKEDITOR.replace('message6', {
height: 320,
width: 985,
});
</script>
  <?php $this->load->view('assests/footer'); ?>