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
              <li class="breadcrumb-item active"><a href="javascript:void(0)">Category</a></li>
          </ol>
      </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <a href="<?php echo base_url() ?>Categories/add_category" class="btn btn-primary">Add category</a>   
            <?php if(!empty($this->session->flashdata('message'))):
              $msg=$this->session->flashdata('message');
            ?>
            <div class="alert alert-<?=$msg['status']?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$msg['msg']?>
            </div>
            <?php endif; ?>
            <div class="row csvdownload">
                <button class="btn btn-primary"><a style = "color:white;margin-top:-10px;"href='<?= base_url() ?>Exportsubcat/export_category'>Download Category Data</a></button>
           </div><br>
          </div>       
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="table table table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Categories</th>
                    <th>Subcategories</th>
                    <th>edit</th>  
                    <th>Action</th>
                  </tr>
                </thead>
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
    var tbl_productList = $('#example').DataTable(
      {
       
      "processing": false,
               "serverSide": true,
               paging:true,
               pageLength:10,
              "processing": true,
              "pagingType": "full_numbers",
              "scrollX": true,
              "order": [],
               ajax: {
                  url: "<?php echo base_url() ?>Categories/load_category_table_data", // The service URL
                  type: "post",       // The type of request (post or get)
                  allInOne: false,            // Set to true to load all your data in one AJAX call
                  refresh: false  ,
          },
          
        "columnDefs":[
            
            
            {
            "targets":2,
            "orderable":false
        },
        
        {
            "targets":3,
            "orderable":false
        },

        {
            "targets":0,
            "className":"systemFilled"
        },
        {
            "targets":1,
            "class":"userFilled"
        }

        
        
        ]

    } );

} );

    

 $(document).on('click','.delete',function(){
    var row=$(this).closest('tr');
    var ID=$(this).attr('data-id');
      if(ID != ''){
       var res = confirm("Do you want to delete this Category ?");
       if (res == true) {

          $.ajax({
            type:'post',
            url : '<?php echo base_url('Categories/delete_category/'); ?>',
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