<?php $this->load->view('assests/header'); ?>

<?php $this->load->view('assests/sidebar'); ?>
<style>
  .breadcrumb{
      float:left !important;
  }
  .paginate_button{
      border:none !important;
  }
  .content-body{
    padding-top:90px;
    background-color:#F1F1F7 !important;
  }
  .input-group-prepend {
    margin-right: -47px;
    z-index: 9999;
  }
  .dataTables_filter input {
    background-color: #F3F3F9;
    border: 1px solid;
  }
  .csvdownload{
    
    float:right;
  }
 .td{
     font-family: century-gothic;
 }
</style>
<div class="content-body">
  <div class="row page-titles mx-0">
      <div class="col p-md-0">
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
              <li class="breadcrumb-item active"><a href="javascript:void(0)">Sub Admin</a></li>
          </ol>
      </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="<?php echo base_url() ?>admin_settings/add_sub_admin" class="btn btn-primary"><?=$currentPage?></a>   
            <?php if(!empty($this->session->flashdata('message'))):
              $msg=$this->session->flashdata('message');
            ?>
            <div class="alert alert-<?=$msg['status']?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$msg['msg']?>
            </div>
            <?php endif; ?>
            <!-- <div class="row csvdownload">
                <button class="btn btn-primarsy"><a style = "color:white;margin-top:-10px;"href='<?= base_url() ?>Exportsubcat/export_user'>Download Sub Admin Data</a></button>
           </div><br> -->
          </div>       
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="table table table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>edit</th>  
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($sub_admin_list)): 
                  foreach ($sub_admin_list as $key => $value):?>
                    <tr>
                    <td class="systemFilled"><?=$key+1?></td>
                    <td class="userFilled"><?=$value->username?></td>
                    <td class="userFilled"><?=$value->email?></td>
                    <td class="userFilled"><?=$value->mobile?></td>
                    <td><a href="<?=base_url('admin_settings/update_sub_admin/'.base64_encode($value->id))?>"><i class='fa fa-edit fa-lg'></i></a></td>
                    <td><button data-id='<?=$value->id?>'  href='javascript:void(0);' type='button' class='btn btn-primary delete'>Delete</button></td>
                  </tr>
                 <?php  endforeach; endif;?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    var tbl_productList = $('#example').DataTable()

} );

    

 $(document).on('click','.delete',function(){
    var row=$(this).closest('tr');
    var ID=$(this).attr('data-id');
      if(ID != ''){
       var res = confirm("Do you want to delete this Sub Admin ?");
       if (res == true) {

          $.ajax({
            type:'post',
            url : '<?php echo base_url('admin_settings/delete_sub_admin/'); ?>',
            data : {'ID': ID,'isActive': "1"},
            success : function(data){
          if(data.trim() == 1){
              row.animate( {backgroundColor:'#EF5350'}, 1000).fadeIn(1000,function() {
                      row.remove();
                    });
               setTimeout(function(){row.removeClass("highlight").addClass('highlightwhite');;},3000);
          }
            }
        });
      }else{
       return false;
      }
    }else{
        return false;
    }
  })
</script>



<?php $this->load->view('assests/footer'); ?>