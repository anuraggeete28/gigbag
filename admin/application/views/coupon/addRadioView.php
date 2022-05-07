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
    .error {
        color:red;
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
                            <form class="form-horizontal" id="RegisterValidation" action="<?= base_url(); ?>Coupon/submit_coupon" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                                <label>Coupon Code</label>
                                <div class="form-group">
                                    <input type="text" name="couponcode" id="input1" value="<?php if(isset($media_detail)){ print_r($media_detail->couponcode); } ?>" required="required" class="form-control input-default" placeholder="Coupon Code">
                                </div>
                                <label>Discount Rate</label>
                                <div class="form-group">
                                    <input type="number" id="discountrate" name="discountrate" min="0" value="<?php if(isset($media_detail)){ print_r($media_detail->discountrate); } ?>" required="required" class="form-control input-default" placeholder="Discount Rate">
                                    <span class="error" id="discountRateErr"></span>
                                </div>
                                <label>Available Coupon </label>
                                <div class="form-group">
                                    <input type="number" name="availablecoupon" min="0" value="<?php if(isset($media_detail)){ print_r($media_detail->availablecoupon); } ?>" required="required" class="form-control input-default" placeholder="Available Coupon">
                                </div>
                                <label>Start Date </label>
                                <div class="form-group">
                                    <input type="text" id="txtFrom" name="startdate" value="<?php if(isset($media_detail)){ print_r($media_detail->startdate); } ?>" required="required" class="form-control input-default" placeholder="Start Date">
                                </div>
                                <label>End Date </label>
                                <div class="form-group">
                                    <input type="text" name="enddate" id="txtTo" value="<?php if(isset($media_detail)){ print_r($media_detail->enddate); } ?>" required="required" class="form-control input-default" placeholder="End Date">
                                </div>
                                <input type="hidden" name="coupon_id"  id="radioID" value="<?php if(isset($media_detail)){ echo $media_detail->couponid; } ?>" /> 
                                <input type="hidden" name="method"  id="method" value="<?=$method ?>" /> 
                                <button type="submit"  class="btn btn-dark mb-2"><?=$page?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"
type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css"
rel="Stylesheet"type="text/css"/>
<script type="text/javascript">
$(function () {
    $("#txtFrom").datepicker({
        numberOfMonths: 2,
        minDate: 0,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() + 1);
            $("#txtTo").datepicker("option", "minDate", dt);
        }
    });
    $("#txtTo").datepicker({
        numberOfMonths: 2,
        onSelect: function (selected) {
            var dt = new Date(selected);
            dt.setDate(dt.getDate() - 1);
            $("#txtFrom").datepicker("option", "maxDate", dt);
        }
    });
});
</script>
        
        
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script language="javascript">
        $(document).ready(function () {
            $("#txtdate").datepicker({
                minDate: 0
            });
        });
    </script>
        <script language="javascript">
        $(document).ready(function () {
            $("#txtdate2").datepicker({
                minDate: 0
            });
        });
    </script>
    
    
    <script>
        
        
    </script>
    
        
        <script>
            $(function() {
        $('#input1').on('keypress', function(e) {
            if (e.which == 32){
                console.log('Space Detected');
                return false;
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
var input = document.querySelector('#discountrate');
input.addEventListener('keyup', function (event) {
    if(this.value.includes('-')) {
        this.value = this.value.replace('-','')
    } else {
        if (/\D/g.test(this.value)) {
            this.value = this.value.replace(/\D/g,'')
        } else {
            if(this.value > 1 || this.value < 0) {
                $('#discountRateErr').text('discount rate should be between 0 and 1');
            } else {
                $('#discountRateErr').text('');
            }
        }
    }
});
</script>
  <?php $this->load->view('assests/footer'); ?>