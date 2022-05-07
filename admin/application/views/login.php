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
    
    .fxt-template-layout7 .fxt-btn-fill{
        
        background-color: #00ADEE !important;
    }
</style>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->     
    <section class="fxt-template-animation fxt-template-layout7" data-bg-image="<?php echo base_url(); ?>asset/img/cover4.jpg">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-xl-6 col-lg-7 col-sm-12 col-12 fxt-bg-color">
                    <div class="fxt-content">
                        <div class="fxt-header">
                            <img class="lgdsnss" src="<?=base_url('assets/images/AppDesign.png')?>" alt="logo">                       
                            <p><b>Admin Login</b></p>
                        </div>     
                        <div class="fxt-form"> 
                             <?php if(!empty($this->session->flashdata('message'))):
                                $msg=$this->session->flashdata('message');
                              ?>
                              <div class="alert alert-<?=$msg['status']?> alert-dismissible">
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <?=$msg['msg']?>
                              </div>
                            <?php endif; ?>
                            <form method="post" action="<?php echo base_url(); ?>Login/do_login">
                                <div class="form-group"> 
                                    <div class="fxt-transformY-50 fxt-transition-delay-1">                                              
                                        <input type="email" id="email" class="form-control" name="username" placeholder="Email" required="required">
                                    </div>
                                </div>
                                <div class="form-group">  
                                    <div class="fxt-transformY-50 fxt-transition-delay-2">                                              
                                        <input id="password" type="password" class="form-control" name="password" placeholder="********" required="required">
                                        <i toggle="#password" class="toggle-password field-icon"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-3">  
                                        <div class="fxt-checkbox-area">
                                            <!--<div class="checkbox">
                                                <input id="checkbox1" type="checkbox">
                                                <label for="checkbox1">Keep me logged in</label>
                                            </div>-->
                                            <a href="<?php echo base_url(); ?>Forgotpass" class="switcher-text">Forgot Password</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="fxt-transformY-50 fxt-transition-delay-4">  
                                        <button type="submit" class="fxt-btn-fill">Log in</button>
                                    </div>
                                </div>
                            </form>                
                        </div> 
                       <!-- <div class="fxt-style-line"> 
                            <div class="fxt-transformY-50 fxt-transition-delay-5">                                
                                <h3>Or Login With</h3> 
                            </div>
                        </div>-->
                      <!--  <ul class="fxt-socials">
                            <li class="fxt-google">
                                <div class="fxt-transformY-50 fxt-transition-delay-6">  
                                <a href="#" title="google"><i class="fab fa-google-plus-g"></i><span>Google +</span></a>
                                </div>
                            </li>                                    
                            <li class="fxt-twitter"><div class="fxt-transformY-50 fxt-transition-delay-7">  
                                <a href="#" title="twitter"><i class="fab fa-twitter"></i><span>Twitter</span></a>
                                </div>
                            </li>
                            <li class="fxt-facebook"><div class="fxt-transformY-50 fxt-transition-delay-8">  
                                <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i><span>Facebook</span></a>
                                </div>
                            </li>                                    
                        </ul>-->
                        <!--<div class="fxt-footer">
                            <div class="fxt-transformY-50 fxt-transition-delay-9">  
                                <p>Don't have an account?<a href="register-7.html" class="switcher-text2">Register</a></p>
                            </div> 
                        </div>--> 
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