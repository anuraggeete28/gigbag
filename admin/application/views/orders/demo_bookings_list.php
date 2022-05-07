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
              <li class="breadcrumb-item active"><a href="javascript:void(0)">Demo Bookings</a></li>
          </ol>
      </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <?php if(!empty($this->session->flashdata('message'))):
              $msg=$this->session->flashdata('message');
            ?>
            <div class="alert alert-<?=$msg['status']?> alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?=$msg['msg']?>
            </div>
            <?php endif; ?>
            <div class="row csvdownload">

           </div><br>
          </div>       
          <div class="card-body">
            <div class="table-responsive">
              <table id="example" class="table table table-bordered" style="width:100%">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Booking Id</th>
                    <th>Student</th>
                    <th>Category Name</th>
                    <th>Gig Type</th>
                    <th>Booking date</th>
                    <th>Booking Status</th>
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

<!-- Modal -->
<div class="modal fade" id="studentDetailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Student Info</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="well well-sm">
                      <div class="row">
                          <div class="col-sm-6 col-md-4">
                              <img src="" id="studentProfile" alt="" class="img-rounded img-responsive" />
                          </div>
                          <div class="col-sm-6 col-md-8">
                              <h4 id="studentName"></h4>
                                  <i class="glyphicon glyphicon-envelope"></i><span id="studentEmail"></span>
                                  <br />
                                  Student ID: <span id="studentId"></span><br />
                                  Addresss: <span id="studentAddress"></span><br />
                                  Mobile: <span id="studentMobile"></span><br />
                                  Student DOB: <span id="studentDOB"></span><br />
                                  Student Category: <span id="studentCategory"></span><br />
                                  <!-- Student Sub-Category: <span id="studentSubCategory"></span><br /> -->
                                  Student Referred By: <span id="studentReferredBy"></span><br />
                                  Student Guardian: <span id="studentGuardian"></span><br />
                                  Student Source: <span id="studentSource"></span><br />
                                  Student Status: <span id="studentStatus"></span><br />
                                  Student T&C & Privacypolicy: <span id="studentPolicy"></span><br />
                                  <!-- <i class="glyphicon glyphicon-globe"></i><a href="http://www.jquery2dotnet.com">www.jquery2dotnet.com</a>
                                  <br />
                                  <i class="glyphicon glyphicon-gift"></i>June 02, 1988</p> -->
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>


<div class="modal fade" id="updateStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Update Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12">
                <form action="" method="post" id="bookingStatusUpdateForm">
                  <input type="hidden" name="id" value="" id="bookingId" />
                  <input type="hidden" name="rowId" value="" id="rowId" />
                  
                  <div class="form-group">
                    <label>Booking Status</label>
                    <select name="booking_status" id="bookingStatusDropdown" class="form-control" aria-label="Default select example">
                      <option value="New Request" selected>New Request</option>
                      <option value="Scheduled">Scheduled</option>
                      <option value="Completed">Completed</option>
                      <option value="Cancelled">Cancelled</option>
                    </select>
                  </div>
                  <button type="submit" class="btn btn-primary">Update</button>
                </form>            
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
                  url: "<?php echo base_url() ?>orders/demoBookingListwebAPI",// The service URL
                  type: "post",// The type of request (post or get)
                  allInOne: false,// Set to true to load all your data in one AJAX call
                  refresh: false  ,
                  dataSrc: function (json)
                  {
                      return json.data;
                  },
                                      // every X milliseconds
          },

           
         "columns": [
            { "data": "id"},
            { "data": "booking_id"},
            { "data": "student_name"},
            { "data":  "category_name"},
             { "data":  "type_of_class"},
            { "data": "booking_date"},
            {"data": "status"},
            {"data": "action"},
        
        ],
        
      

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

  $(document).on('click', '.studentInfo', function() {
    $.ajax({
      type:'post',
      url : '<?php echo base_url('Student/getProfile'); ?>',
      data : {'student_id': $(this).attr("student-id")},
      success : function(response){
        response = JSON.parse(response);
        if(response.status) {
          $('#studentEmail').text(response.data.email);
          $('#studentName').text(response.data.username);
          $('#studentProfile').attr("src", response.data.profile);
          $('#studentProfile').attr("alt", response.data.username);
          $('#studentId').text(response.data.unique_id);
          $('#studentAddress').text(response.data.address);
          $('#studentMobile').text(response.data.country_code+""+response.data.mobile);
          $('#studentDOB').text(response.data.dob);
          $('#studentCategory').text(response.data.category_name);
          // $('#studentSubCategory').text(response.data.studentid);
          $('#studentGuardian').text(response.data.guardian);
          $('#studentSource').text(response.data.source);
          $('#studentStatus').text(response.data.status);
          $('#studentPolicy').text(response.data.policy);
        }
      }
    });
    $('#studentDetailModal').modal('show')
  })

  $("#bookingStatusUpdateForm").submit(function(e) {
      e.preventDefault();
      var form = $(this);
      var actionUrl = form.attr('action');
      $.ajax({
      type:'post',
      url : '<?php echo base_url('Orders/bookingStatusUpdate'); ?>',
      data: form.serialize(),
      success : function(response){
        response = JSON.parse(response);
        if(response.status) {
          $('#'+response.data.rowId).children('td').eq(6).text(response.data.booking_status);
        }
        $('#updateStatusModal').modal('hide')
      }
    })
  });

  $(document).on('click', '.updateStatus', function() {
    let selectValue = $(this).parent().parent().children('td').eq(6).text();
    $('#bookingStatusDropdown option[value="'+selectValue+'"]').attr("selected", "selected");
    $('#bookingId').val($(this).attr('booking-id'));
    $('#rowId').val($(this).attr('row-id'));
    $('#updateStatusModal').modal('show');
  })

</script>



<?php $this->load->view('assests/footer'); ?>