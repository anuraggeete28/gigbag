<?php $this->load->view('assests/header'); ?>

<?php $this->load->view('assests/websidebar'); ?>

    

<div class="content-body">
    
    
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
    </style>

            <div class="row page-titles mx-0">
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="javascript:void(0)">About Us</a></li>
                    </ol>
                </div>
            </div>
            <!-- row -->

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        
                        <div class="card">
                            
                            <div class="card-header">

                 <a href="<?php echo base_url() ?>Aboutus/add" class="btn btn-primary">Add About Us Content</a>
                
                      
                     

                     <?php 

                if ($this->session->flashdata('success_msg') != NULL) { ?>
                    <div id="failure_msg" class="alert alert-success">
                        <?= $this->session->flashdata('success_msg'); ?>
                    </div>
                <?php } if ($this->session->flashdata('err_message') != NULL) { ?>
                    <div id="failure_msg" class="alert alert-danger">
                        <?php echo $this->session->flashdata('err_message'); ?>
                         </label> 
                    </div>
                <?php } ?>
  <style>
                   .td{
                       font-family: century-gothic;
                   }
               </style>
               
              </div>
                            
                              <div class="card-body">
                <div class="table-responsive">
                  <table id="example" class="table table table-bordered" style="width:100%">
                    
                    <thead>
                              <tr>

                                <th>Id</th>
                                <th>Banner Image</th>
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
            <!-- #/ container -->
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
                  url: "<?php echo base_url() ?>Aboutus/radioListwebAPI", // The service URL
                  type: "get",       // The type of request (post or get)
                  allInOne: false,            // Set to true to load all your data in one AJAX call
                  refresh: false  ,
                  dataSrc: function (json)
                  {
            
                      var cars = [];

                      for (var i = 0; i < json.data.length; i++) 
                      {
                        var object =  json.data[i];
                        object.banner_img= "<img src="+object.banner_img+ " alt='Image Not Available' height='55' width='100'>";
                        object.examlink = "<a href="+object.examlink+" target='_blank'> View </a>";
                        object.qr_image= "<img src="+object.qr_image+ " alt='Image Not Available' height='55' width='100'>";
                         if(object.isActive == 0){
                              object.action = "<button  onclick='deactiveRadio("+object.aboutusid+");' href='javascript:void(0);' type='button' class='btn btn-primary'>Delete</button>";
                        }else{
                            object.action = "<button  onclick='activeRadio("+object.aboutusid+");' href='javascript:void(0);' type='button' class='btn btn-primary'>Delete</button>";
                        }
                        object.edit = "<a href='<?php echo base_url() ?>Aboutus/edit/"+object.aboutusid+"'><i class='fa fa-edit fa-lg'></i></a>";
                        
                        if(object.isStatus == 0){
                              object.action2 = "<button  onclick='deactiveLanguage("+object.aboutusid+");' href='javascript:void(0);' type='button' class='btn btn-primary'>Un-Approve</button>";
                        }else{
                            object.action2 = "<button  onclick='activeLanguage("+object.aboutusid+");' href='javascript:void(0);' type='button' class='btn btn-primary'>Approve</button>";
                        }
                      }
                      return json.data;
                  },
                                      // every X milliseconds
          },

           
         "columns": [
             { "data": "aboutusid"},
             { "data": "banner_img"},
            { "data": "edit"},
             { "data": "action","class":"isActive"}
        
        ],
        "columnDefs":[
            
            
            {
            "targets":2,
            "orderable":false
        },
        
        {
            "targets":3,
            "orderable":false
        }
        
        
        ]

    } );

} );

     function activeRadio(ID){
              if(ID != ''){
               var res = confirm("Do you want to delete this content ?");
               if (res == true) {

                  $.ajax({
                            type:'post',
                            url : '<?php echo base_url('Aboutus/radioActivation/'); ?>',
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
             var res = confirm("Do you want to delete this content ?");
             if (res == true) {

                $.ajax({
                          type:'post',
                          url : '<?php echo base_url('Aboutus/radioActivation/'); ?>',
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
           var res = confirm("Do you want to Un-Approve this content ?");
           if (res == true) {

              $.ajax({
                        type:'post',
                        url : '<?php echo base_url('Aboutus/languageActivation/'); ?>',
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
           var res = confirm("Do you want to Approve this content ?");
           if (res == true) {

              $.ajax({
                        type:'post',
                        url : '<?php echo base_url('Aboutus/languageActivation/'); ?>',
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



<?php $this->load->view('assests/footer'); ?>