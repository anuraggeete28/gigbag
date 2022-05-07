<!doctype html>
<html class="no-js" lang="">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>GigBag || Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>/asset/img/AppDesign.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/fontawesome-all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/font/flaticon.css">
    <!-- Google Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>asset/css/style.css">
</head>

<style>
    
    .btnclr{
        
        background-color: #00ADEE !important;
    }
</style>

<body>
        
    <section class="fxt-template-animation fxt-template-layout7" data-bg-image="<?php echo base_url(); ?>asset/img/cover4.jpg">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-6 col-lg-7 col-sm-12 col-12 fxt-bg-color">
                    <div class="fxt-content">
                        <div class="fxt-header">
                            <img class="lgdsnss" src="../assets/images/AppDesign.png" alt="logo">                       
                            <p><b>Forgot Password</b></p>
                        </div>                            
                        <div class="fxt-form"> 
                            <form method="post" action="<?php echo base_url(); ?>Forgotpass/resetpass" method="post">
                                <div class="form-group"> 
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">                                              
                                        <input type="email" required="" class="form-control" name="email" placeholder="Enter Registered Email">
                                    </div>
                                </div>
                               
                              
                                <div class="form-group">
                            <button type="submit" name="submit" value="submit" class="btn btn-default btn-block btnclr">Submit</button>
                        </div>
                            </form>                
                        </div> 
                     
                    </div>
                </div>                    
            </div>
        </div>
    </section>    
    <!-- jquery-->
    <script src="<?php echo base_url(); ?>asset/js/jquery-3.5.0.min.js"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url(); ?>asset/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url(); ?>asset/js/bootstrap.min.js"></script>
    <!-- Imagesloaded js -->
    <script src="<?php echo base_url(); ?>asset/js/imagesloaded.pkgd.min.js"></script>
    <!-- Validator js -->
    <script src="<?php echo base_url(); ?>asset/js/validator.min.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url(); ?>asset/js/main.js"></script>

</body>

</html>