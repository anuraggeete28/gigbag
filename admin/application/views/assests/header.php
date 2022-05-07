<?php 
$userdata=$this->session->userdata('user');
$user_id=$userdata['id'];
$username=$userdata['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Admin || GigBag</title>
    <!-- Favicon icon -->
    <!--<link rel="icon" type="image/png" sizes="16x16" href="<?php //echo base_url(); ?>design/images/favicon.png">-->
    <!-- Pignose Calender -->
    <link href="<?php echo base_url(); ?>design/plugins/pg-calendar/css/pignose.calendar.min.css" rel="stylesheet">
    <!-- Chartist -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/plugins/chartist/css/chartist.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>design/plugins/chartist-plugin-tooltips/css/chartist-plugin-tooltip.css">
    <!-- Custom Stylesheet -->
    <link href="<?php echo base_url(); ?>design/css/style.css" rel="stylesheet">
    <!--  datatable -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="<?php echo base_url(); ?>design/js/jquery.min.js"></script>
    
</head>

<style>
    
    h3{
        color:white;
    }
    
   .nav-header {
    background-color: #7571F9 !important;
    
}

 .bg-transparent {
    
    height: 40px !important;
}

.schh{
    
    margin-left:0px;
    text-align:right;
}

.footer {
    padding-left: 15.1875rem;
    background-color: #131432 !important;
}

/*.hvvr:hover{*/
    
/*    background-color: white !important;*/
/*    color:black !important;*/
/*}*/
.nav-header{
    
    position:fixed !important;
}

.header .header-content{
    
    background-color: white !important;
    
}

.content-body{
    
    background-color: #E7EBEE !important;
}

/*.icon-menu{
    
    color:white;
}

.header-right .icons > a{
    
    color:white;
}*/
    
</style>


<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
            </svg>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    
    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <div class="brand-logo">
                <a href="<?php echo base_url(); ?>Dashboard" style="text-decoration:none;">
                    <b class="logo-abbr" ><h3>G</h3> </b>
                   <!-- <span class="logo-compact"><img src="<?php //echo base_url(); ?>design/images/logo-compact.png" alt=""></span>-->
                    <span class="brand-title">
                        <h3>GigBag Admin</h3>
                    </span>
                </a>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header" style="position:fixed;">    
            <div class="header-content clearfix">
                
                <div class="nav-control">
                    <div class="hamburger">
                        <span class="mdi mdi-equal"><i class=""></i></span>
                    </div>
                </div>
                <!--<div class="header-left">
                    <div class="input-group icons">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-transparent border-0 pr-2 pr-sm-3" id="basic-addon1"><i class="mdi mdi-magnify"></i></span>
                        </div>
                        <input type="search" class="schh form-control" placeholder="Search Dashboard" aria-label="Search Dashboard">
                        <div class="drop-down animated flipInX d-md-none">
                            <form action="#">
                                <input type="text" class="form-control" placeholder="Search">
                            </form>
                        </div>
                    </div>
                </div>-->
                <div class="header-right">
                    <ul class="clearfix">
                        <!--<li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-email-outline"></i>
                                <span class="badge badge-pill gradient-1">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">3 New Messages</span>  
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-1">3</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="<?php echo base_url(); ?>design/images/avatar/1.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Saiful Islam</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li class="notification-unread">
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="<?php echo base_url(); ?>design/images/avatar/2.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Adam Smith</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Can you do me a favour?</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="<?php echo base_url(); ?>design/images/avatar/3.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Barak Obama</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hi Teddy, Just wanted to let you ...</div>
                                                </div>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void()">
                                                <img class="float-left mr-3 avatar-img" src="<?php echo base_url(); ?>design/images/avatar/4.jpg" alt="">
                                                <div class="notification-content">
                                                    <div class="notification-heading">Hilari Clinton</div>
                                                    <div class="notification-timestamp">08 Hours ago</div>
                                                    <div class="notification-text">Hello</div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>-->
                        
                        
                        <!--<li class="icons dropdown"><a href="javascript:void(0)" data-toggle="dropdown">
                                <i class="mdi mdi-bell-outline" style="color:black;"></i>
                                <span class="badge badge-pill gradient-2">3</span>
                            </a>
                            <div class="drop-down animated fadeIn dropdown-menu dropdown-notfication">
                                <div class="dropdown-content-heading d-flex justify-content-between">
                                    <span class="">2 New Notifications</span>  
                                    <a href="javascript:void()" class="d-inline-block">
                                        <span class="badge badge-pill gradient-2">5</span>
                                    </a>
                                </div>
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li>
                                            <a href="javascript:void()">
                                                <span class="mr-3 avatar-icon bg-success-lighten-2"><i class="icon-present"></i></span>
                                                <div class="notification-content">
                                                    <h6 class="notification-heading">Events near you</h6>
                                                    <span class="notification-text">Within next 5 days</span> 
                                                </div>
                                            </a>
                                        </li>
                                       
                                    </ul>
                                    
                                </div>
                            </div>
                        </li>-->
                    
                        
                        <!--<li class="icons dropdown d-none d-md-flex">
                            <a class="hvvr" href="javascript:void(0)" class="log-user"  data-toggle="dropdown">
                                <span>English</span>  <i class="fa fa-angle-down f-s-14" aria-hidden="true"></i>
                            </a>
                            <div class="drop-down dropdown-language animated fadeIn  dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        <li><a class="hvvr" href="javascript:void()">English</a></li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </li>-->
                        <li class="icons dropdown hvr">
                            <div class="user-img c-pointer position-relative"   data-toggle="dropdown">
                                <span class="activity active"></span>
                                <img src="<?php echo base_url(); ?>design/images/user/1.png" height="60px" width="60px" alt="">
                            </div>
                            <div class="drop-down dropdown-profile animated fadeIn dropdown-menu">
                                <div class="dropdown-content-body">
                                    <ul>
                                        
                                        
                                        <li>
                                            <a class="hvvr" href="<?php echo base_url(); ?>profile/edit/<?php echo $user_id ?>"><i class=""></i> <span>Profile</span></a>
                                        </li>
                                      
                                        <li><a class="hvvr" href="<?php echo base_url(); ?>Login/logout"><i class=""></i> <span>Logout</span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>