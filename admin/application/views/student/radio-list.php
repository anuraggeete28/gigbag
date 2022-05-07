<?php $this->load->view('assests/header'); ?>

<?php $this->load->view('assests/sidebar'); ?>

    <style>
         /*.table{
            
                width: 1146px !important;
        }*/
        
            .content-body{
    padding-top:90px;
        background-color:#F1F1F7 !important;
    }
         .input-group-prepend {
    margin-right: -47px;
    z-index: 9999;
}
    </style>

<div class="content-body">
    
    
      <style>
        .breadcrumb{
            float:left !important;
        }
          .paginate_button{
            border:none !important;
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

<div class="row page-titles mx-0">
    <div class="col p-md-0">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Student</a></li>
        </ol>
    </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <a href="<?php echo base_url() ?>Student/add" class="btn btn-primary">Add Student</a>
          <?php if(!empty($this->session->flashdata('message'))):
                $msg=$this->session->flashdata('message');
              ?>
              <div class="alert alert-<?=$msg['status']?> alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <?=$msg['msg']?>
              </div>
            <?php endif; ?>
            <div class="row csvdownload">
              <button class="btn btn-primary"><a style = "color:white;margin-top:-10px;"href='<?= base_url() ?>Exportstudentsdata/export'>Download Students Data</a></button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#studentModal"> Upload Students Data</button>
            </div><br>
        </div>         
        <div class="card-body">
          <div class="table-responsive">
            <table id="example" class="table table table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Modified Date</th>
                  <th>Student Id</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Address</th>
                  <th>State</th>
                  <th>Country</th>
                  <th>Country Code</th>
                  <th>Mobile</th>
                  <th>Student Date of Birth</th> 
                  <th>Category</th> 
                  <th>Sub Category</th> 
                   <th>Referred By:</th> 
                  <th>Guardian</th> 
                  <th>Status</th> 
                  <th>Source</th> 
                  <th>T&C & Privacypolicy</th> 
                  <th>Student Profile pic </th>
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


<!-- Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
       <form class="form-horizontal" id="myform" action="<?= base_url(); ?>Student/uploadStudentCsv" method="POST" enctype="multipart/form-data">   
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Upload Student Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <div class="row">
           <div class="form-group">
             <input type="file" class="form-control" name="csv_file" required=""> 
           </div>
         </div>
              
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?= base_url() ?>Export_csv/download_student_sample"><button type="button" class="btn btn-primary">Download Sample</button></a>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
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
                  url: "<?php echo base_url() ?>Student/radioListwebAPI", // The service URL
                  type: "get",       // The type of request (post or get)
                  allInOne: false,            // Set to true to load all your data in one AJAX call
                  refresh: false  ,
                  dataSrc: function (json)
                  {
            
                      var cars = [];

                      for (var i = 0; i < json.data.length; i++) 
                      {
                        var object =  json.data[i];
                        object.profile= "<img src="+object.profile+ " alt='Image Not Available' height='55' width='100'>";
                        object.solution = "<a href="+object.solution+" target='_blank'> View </a>";
                        object.youtubelink = "<a href="+object.youtubelink+" target='_blank'> View On Youtube </a>";
                        object.qr_image= "<img src="+object.qr_image+ " alt='Image Not Available' height='55' width='100'>";
                         if(object.isActive == 0){
                              object.action = "<button  onclick='deactiveRadio("+object.studentid+");' href='javascript:void(0);' type='button' class='btn btn-primary'>Delete</button>";
                        }else{
                            object.action = "<button  onclick='activeRadio("+object.studentid+");' href='javascript:void(0);' type='button' class='btn btn-primary'>Delete</button>";
                        }
                        object.edit = "<a href='<?php echo base_url() ?>Student/edit/"+object.studentid+"'><i class='fa fa-edit fa-lg'></i></a>";
                        
                        if(object.isStatus == 0){
                              object.action2 = "<button  onclick='deactiveLanguage("+object.studentid+");' href='javascript:void(0);' type='button' class='btn btn-primary'>Un-Approve</button>";
                        }else{
                            object.action2 = "<button  onclick='activeLanguage("+object.studentid+");' href='javascript:void(0);' type='button' class='btn btn-primary'>Approve</button>";
                        }
                      }
                      return json.data;
                  },
                                      // every X milliseconds
          },

           
         "columns": [
             
             { "data": "studentid"},
              { "data": "signup_date"},
             { "data": "unique_id"},
             { "data": "username"},
             { "data": "email"},
             { "data": "address"},
             { "data": "state"},
             { "data": "country"},
              { "data": "country_code"},
             { "data": "mobile"},
              { "data": "dob"},
              { "data": "category_name"},
               { "data": "subcatname"},
               { "data": "referal"},
             { "data": "guardian"},
             { "data": "status"},
             { "data": "source"},
              { "data": "policy"},
              { "data": "profile"},
            { "data": "edit"},
             { "data": "action","class":"isActive"}
        
        ],
        "columnDefs":[
            
            
            {
            "targets":19,
            "orderable":false
        },
        
        {
            "targets":20,
            "orderable":false
        }
        , {
            "targets":[0, 1, 2,  15],
            "className":"systemFilled"
        },
        {
            "targets":[3,4,5,6,7,8,9,10,11,12,13,14,16,17,18],
            "class":"userFilled"
        }
        
        ]

    } );

} );

     function activeRadio(ID){
              if(ID != ''){
               var res = confirm("Do you want to delete this Student ?");
               if (res == true) {

                  $.ajax({
                            type:'post',
                            url : '<?php echo base_url('Student/radioActivation/'); ?>',
                            data : {'ID': ID,'isActive': "0"},
                            success : function(data){
                          if(data.trim() == 1){
                               $('#DT_RowId_'+ID).animate( {backgroundColor:'#EF5350'}, 1000).fadeIn(1000,function() {
                                    $('#DT_RowId_'+ID).remove();
                                  });

                               setTimeout(function(){$('#DT_RowId_'+ID).removeClass("highlightred").addClass('highlightwhite');;},3000);
                          }
                            }
                        });
              }else{
               return false;
              }
              }else{
                  return false;
              }
          }



        function deactiveRadio(ID){
            if(ID != ''){
             var res = confirm("Do you want to delete this Student ?");
             if (res == true) {

                $.ajax({
                          type:'post',
                          url : '<?php echo base_url('Student/radioActivation/'); ?>',
                          data : {'ID': ID,'isActive': "1"},
                          success : function(data){
                        if(data.trim() == 1){
                            $('#DT_RowId_'+ID).animate( {backgroundColor:'#EF5350'}, 1000).fadeIn(1000,function() {
                                    $('#DT_RowId_'+ID).remove();
                                  });
                             setTimeout(function(){$('#DT_RowId_'+ID).removeClass("highlight").addClass('highlightwhite');;},3000);
                        }
                          }
                      });
            }else{
             return false;
            }
            }else{
                return false;
            }
        }
        
        
        
        function activeLanguage(ID){
          if(ID != ''){
           var res = confirm("Do you want to Un-Approve this Student ?");
           if (res == true) {

              $.ajax({
                        type:'post',
                        url : '<?php echo base_url('Student/languageActivation/'); ?>',
                        data : {'ID': ID,'isStatus': "0"},
                        success : function(data){
                      if(data.trim() == 1){
                           $('#DT_RowId_'+ID).animate( {backgroundColor:'#EF5350'}, 1000).fadeIn(1000,function() {
                                $('#DT_RowId_'+ID).removeClass("highlightwhite").addClass("highlightred");
                                $('#DT_RowId_'+ID+ " td.isStatus" ).html(
                                '<button  onclick="deactiveLanguage('+ID+');" href="javascript:void(0);" type="button" class="btn btn-primary">Un-Approve</button>');
                               });

                           setTimeout(function(){$('#DT_RowId_'+ID).removeClass("highlightred").addClass('highlightwhite');;},3000);
                      }
                        }
                    });
          }else{
           return false;
          }
          }else{
              return false;
          }
      }



      function deactiveLanguage(ID){
          if(ID != ''){
           var res = confirm("Do you want to Approve this Student ?");
           if (res == true) {

              $.ajax({
                        type:'post',
                        url : '<?php echo base_url('Student/languageActivation/'); ?>',
                        data : {'ID': ID,'isStatus': "1"},
                        success : function(data){
                      if(data.trim() == 1){
                           $('#DT_RowId_'+ID).animate( {backgroundColor:'#B2FF59'}, 1000).fadeIn(1000,function() {
                               $('#DT_RowId_'+ID).removeClass("highlightwhite").addClass("highlight");
                               $('#DT_RowId_'+ID + " td.isStatus").html(
                                '<button  onclick="activeLanguage('+ID+');" href="javascript:void(0);" type="button" class="btn btn-primary">Approve</button>');
                               });
                           setTimeout(function(){$('#DT_RowId_'+ID).removeClass("highlight").addClass('highlightwhite');;},3000);
                      }
                        }
                    });
          }else{
           return false;
          }
          }else{
              return false;
          }
      }
        
        


  
</script>


<script>
      
    function getLanguage2(ID){
        $("#lang_id").val(ID);
          if(ID != ''){
              $.ajax({
                        type:'post',
                        url : '<?php echo base_url('Student/ordersdetail/'); ?>',
                        data : {'ID': ID},
                        success : function(data){

                           $("#buttonSave").html("Update");
                           $("#name").val(data);
                           $('#showdata').html(data);

                        }
                    });
          
          }else{
              return false;
          }
      }
    
 $(document).ready(function() {



    // var tbl_productList = $('#tbl_advertisement1').DataTable(
    //   {
       
    //   "processing": false,
    //           "serverSide": true,
    //           paging:true,
    //           pageLength:10,
    //           "processing": true,
    //           "pagingType": "full_numbers",
    //           "scrollX": true,
    //           ajax: {
    //               url: "<?php echo base_url() ?>LiveTV/ordersdetail", // The service URL
    //               type: "get",       // The type of request (post or get)
    //               allInOne: false,            // Set to true to load all your data in one AJAX call
    //               refresh: false  ,
    //               dataSrc: function (json)
                  
    //               {
                     

    //                   for (var i = 0; i < json.data.length; i++) 
    //                   {
    //                     var object =  json.data[i];
                        
    //                   } 

                                         
    //                   return json.data;
    //               },
                                      
    //       },

    //         "columns": [
            
    //         { "data": "name"},
    //         { "data": "name"},
    //         { "data": "order_number"},
    //          { "data": "delivery_address"},
    //         { "data": "order_status"},
            
    //     ]
    //   });
    //  
    
    
    
  
 });   
    
    
</script>


<?php $this->load->view('assests/footer'); ?>