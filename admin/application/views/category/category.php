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
                <form class="form-horizontal" id="RegisterValidation"  action="<?= base_url(); ?>Categories/submit_category" method="POST" onSubmit = "return checkPassword(this)" enctype="multipart/form-data"> 
                  <div class="basic-form">
                      <input type="hidden" name="method" value="<?=$method?>">
                      <input type="hidden" name="category_id" value="<?=@$categoryData->category_id?>">
                      <label>Category</label>
                      <div class="form-group">
                          <input type="text" name="category_name" value="<?=@$categoryData->category_name ?>" class="form-control input-default" placeholder="Category">
                      </div>
                  </div>
                  <button type="submit"  class="btn btn-dark mb-2">Add Category</button>
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
  <script type="text/javascript" src=" https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<?php $this->load->view('assests/footer'); ?>
<script type="text/javascript">
  $(document).ready(function () {

  $('#RegisterValidation').validate({
    rules: {
      category_name: {
        required: true,
      },
     
    },
   
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    submitHandler: function(form) {
      $(form).Submit();
    }
  });
});
</script>