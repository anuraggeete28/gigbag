<!DOCTYPE html>
<html lang="en"><head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- SITE TITLE -->
<title>GigBag</title>
<!-- Favicon Icon -->
<link rel="shortcut icon" type="image/x-icon" href="assets/images/AppDesign.png">
<!-- Animation CSS -->
<link rel="stylesheet" href="assets/css/animate.css">
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet"> 
<!-- Icon Font CSS -->
<link rel="stylesheet" href="assets/css/all.min.css">
<link rel="stylesheet" href="assets/css/ionicons.min.css">
<link rel="stylesheet" href="assets/css/themify-icons.css">
<link rel="stylesheet" href="assets/css/linearicons.css">
<link rel="stylesheet" href="assets/css/flaticon.css">
<!--- owl carousel CSS-->
<link rel="stylesheet" href="assets/owlcarousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.css">
<link rel="stylesheet" href="assets/owlcarousel/css/owl.theme.default.min.css">
<!-- Magnific Popup CSS -->
<link rel="stylesheet" href="assets/css/magnific-popup.css">
<!-- Style CSS -->
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="assets/css/responsive.css">
<link rel="stylesheet" id="layoutstyle" href="assets/color/theme-yellow.css">

<style>
    .logo_light{
        width:200px !important;
    }
    
    .logo_dark{
        width:200px !important;
    }
    body{
        overflow-x: hidden !important;
    }
    
    .bg_blue {
    background-color: #00ADEE !important;
}
.bg_default {
    background-color: #00ADEE !important;
}

.btn-default{
    
   background-color: #00ADEE !important; 
}

.light_skin .navbar-nav a, .light_skin .navbar-toggler {
    color: black !important;
   
}

.header_wrap:not([class*="bg_"]):not([class*="bg-"]).transparent_header {
    background-color: #ffff !important;
}

</style>
</head>

<body>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- START HEADER -->
<header
class="header_wrap fixed-top light_skin sticky_dark_skin main_menu_uppercase transparent_header header_with_topbar dd_dark_skin">
<div class="container">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="<?=base_url()?>">
            <img class="logo_light" src="assets/images/giglogo.webp" alt="logo"> 
        <img class="logo_dark" src="assets/images/giglogo.webp" alt="logo">
            
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-expanded="false"> <span class="ion-android-menu"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li><a class="nav-link active" href="<?=base_url()?>">Home</a></li>
                <li><a class="nav-link" href="<?=base_url('about')?>">About</a></li>
            </ul>
        </div>
        
    </nav>
</div>
</header>

<!-- END HEADER -->
