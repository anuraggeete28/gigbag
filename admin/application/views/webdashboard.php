<?php $this->load->view('assests/header'); ?>

<?php $this->load->view('assests/websidebar'); ?>


<style>
    .content-body{
        min-height:500px !important;
        background-color:#F1F1F7 !important;
            padding-top:90px;
    }
    
    .gradient-1, .dropdown-mega-menu .ext-link.link-1 a, .morris-hover, .datamaps-hoverover {
    background-image: linear-gradient(#FFFFFF, #FFFFFF, #FFFFFF) !important ;
}

.gradient-2, .dropdown-mega-menu .ext-link.link-3 a {
    background-image: linear-gradient(#FFFFFF, #FFFFFF, #FFFFFF) !important ;
}

.gradient-3, .dropdown-mega-menu .ext-link.link-2 a, .header-right .icons .user-img .activity {
    background-image: linear-gradient(#FFFFFF, #FFFFFF, #FFFFFF) !important ;
}

    
  .gradient-4, .sidebar-right .nav-tabs .nav-item .nav-link.active::after, .sidebar-right .nav-tabs .nav-item .nav-link.active span i::before {
    background-image: linear-gradient(#FFFFFF, #FFFFFF, #FFFFFF) !important ;
}  
    
    .text-white {
    color: black !important;
}

.card .card-body {
    padding: 1rem 1rem !important;
    
}

.input-group-prepend {
    margin-right: -47px;
    z-index: 9999;
}
.card{
    
    border-radius:9px !important;
    height:140px !important;
}
.mt-3, .my-3 {
    margin-top: 0rem !important;
}
 .page-title-icon {
    background-color: #00ADEE !important;
     margin-left:34px;
    display: inline-block;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    text-align: center;

    box-shadow: 0px 3px 8.3px 0.7px rgba(163, 93, 255, 0.35);
}
 .page-title-icon i {
    font-size: .9375rem;
    line-height: 36px;
    color:white;
}
    
</style>


<div class="content-body">
<!--<img src="asset/img/icons8-home-64.png"/ style="height:30px;padding-left:35px;padding-bottom: 6px;">-->
<span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span>
<span style="font-size: 23px;padding-left: 10px;">Dashboard</span>
            <div class="container-fluid mt-3">
                <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <center>
                            <h2 class="font-weight-bold mb-2"><?php 
                           $query = $this->db->query("SELECT * FROM homeslider");

echo $query->num_rows(); 
                            ?></h2>
                            <h6 class="text-uppercase font-size-11 mb-2 text-primary font-weight-bold"><a href="<?php echo base_url(); ?>Homeslider/">Slider Images</a></h6>
                            <p class="m-0 small text-muted"></p>
                            </center>
                        </div>
                        <div>
                            
                            <span class="dashboard-pie-1" style="display: none;">2/5</span><svg class="peity" height="60" width="60"><path d="M 30.000000000000004 0 A 30 30 0 0 1 47.633557568774194 54.270509831248425 L 30 30" data-value="2" fill="rgba(88, 103, 221, 0.3)"></path><path d="M 47.633557568774194 54.270509831248425 A 30 30 0 1 1 29.999999999999993 0 L 30 30" data-value="3" fill="rgb(88, 103, 221)"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <center>
                            <h2 class="font-weight-bold mb-2"><?php 
                           $query = $this->db->query("SELECT * FROM studentsreview");

echo $query->num_rows(); 
                            ?></h2>
                            <h6 class="text-uppercase font-size-11 mb-2 text-success font-weight-bold"><a href="<?php echo base_url(); ?>Studentsreview/">Students Review</a></h6>
                            <p class="m-0 small text-muted"></p>
                            </center>
                        </div>
                        <div>
                            <span class="dashboard-pie-2" style="display: none;">4/5</span><svg class="peity" height="60" width="60"><path d="M 30.000000000000004 0 A 30 30 0 1 1 1.4683045111453907 20.729490168751582 L 30 30" data-value="4" fill="rgba(10, 187, 135, 0.3)"></path><path d="M 1.4683045111453907 20.729490168751582 A 30 30 0 0 1 29.999999999999993 0 L 30 30" data-value="1" fill="rgb(10, 187, 135)"></path></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                   
              
                    
                </div>
            
            </div>
            
        </div>

<?php $this->load->view('assests/footer'); ?>
 
