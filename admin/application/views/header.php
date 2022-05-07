<!DOCTYPE html>
<html lang="en"><head>
<!-- Meta -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- SITE TITLE -->
<title>Gigbag</title>
<!-- Favicon Icon -->
 <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>/asset/img/AppDesign.png">
<!-- Animation CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/css/animate.css">
<!-- Latest Bootstrap min CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/bootstrap/css/bootstrap.min.css">
<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&amp;display=swap" rel="stylesheet"> 
<!-- Icon Font CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/css/all.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/css/ionicons.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/css/themify-icons.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/css/linearicons.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/css/flaticon.css">
<!--- owl carousel CSS-->
<!--<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/owlcarousel/css/owl.carousel.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/owlcarousel/css/owl.theme.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/owlcarousel/css/owl.theme.default.min.css">-->
<!-- Magnific Popup CSS -->
<!--<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/css/magnific-popup.css">-->
<!-- Style CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/css/style.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>forgot/css/responsive.css">
<link rel="stylesheet" id="layoutstyle" href="<?php echo base_url(); ?>forgot/color/theme-yellow.css">

<style>
    .logo_light{
        width:200px !important;
    }
    
    .logo_dark{
        width:200px !important;
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
        <a class="navbar-brand" href="../../">
            <img class="logo_light" src="../assets/images/giglogo.webp" alt="logo"> 
        <img class="logo_dark" src="../assets/images/giglogo.webp" alt="logo">
            <!--<h2 class="text-white logo-blue font-weight-bold">LAWFLU</h2>-->
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-expanded="false"> <span class="ion-android-menu"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li><a class="nav-link active" href="../">Home</a></li>
                <li><a class="nav-link" href="../about.php">About</a></li>
                
                 <li class="dropdown"><a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">Account</a>
                    <div class="dropdown-menu">
                        <ul>
                            <li><a class="dropdown-item nav-link nav_item" href="../login.php">Login</a></li>
                            <li><a class="dropdown-item nav-link nav_item" href="../contact.php">Signup</a></li>
                        </ul>
                    </div>
                </li>
               
            </ul>
        </div>
        <ul class="navbar-nav attr-nav align-items-center">
            
              
            <li class="dropdown">
                <a class="nav-link cart_trigger" href="#" data-toggle="dropdown"><i class="linearicons-cart"></i><span class="cart_count">0</span></a>
                <div class="cart_box dropdown-menu dropdown-menu-right">
                    <ul class="cart_list">
                       </ul>
                    <div class="cart_footer">
                        <p class="cart_total"><strong>Subtotal:</strong> <span class="cart_price"> <span class="price_symbole">₹</span></span></p>
                        <p class="cart_buttons"><a href="../viewcart.php" class="btn btn-default view-cart">View Cart</a><a href="../checkout.php" class="btn btn-dark checkout">Checkout</a></p>
                    </div>
                </div>
            </li>
        </ul>
    </nav>
</div>
</header>

