<?php $this->load->view('header'); ?>

<style>
    [class*=overlay_bg_]::before {
    /* background-color: #000; */
    bottom: 0;
    content: "";
    left: 0;
    position: absolute;
    right: 0;
    top: 0;
    z-index: 0;
    background-image: url(https://gigbag.winworldtechs.com/admin/forgot/images/blog_small_img2.jpg);
    background-size: cover;
    
</style>


<style>
    .lgdsnss{
        
       margin-left: 155px ! important ; 
    }
    
</style>


<div class="breadcrumb_section background_bg overlay_bg_50 page_title_light" data-img-src="<?php echo base_url(); ?>forgot/images/blog_small_img2.jpg">
    <div class="container"><!-- STRART CONTAINER -->
        <div class="row">
            <div class="col-sm-12">
                <div class="page-title">
            		<h1>Forgot Password
</h1>
                </div>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="../">Home</a></li>
                    <li class="breadcrumb-item active">Forgot Password
</li>
                </ol>
            </div>
        </div>
    </div><!-- END CONTAINER-->
</div>
<!-- END SECTION BREADCRUMB -->

<!-- STAT SECTION LOGIN --> 
<div class="section">
	<div class="container">
    	<div class="row justify-content-center">
            <div class="col-md-6">
                <div class="padding_eight_all login_wrap">	
                <img class="lgdsnss" src="../assets/images/AppDesign.png" alt="logo">
                    <div class="heading_s1">
                        <h4>Enter your email and we will send you request to your Vision Coach</h4>
                    </div>
                    <form action="<?php echo base_url(); ?>Forgotpassword/forgetPassword" method="post">
                        <div class="form-group">
                            <input type="email" required="" class="form-control" name="email" placeholder="Enter Registered Email">
                        </div>
                     
                        <div class="form-group">
                            <button type="submit" name="submit" class="btn btn-default btn-block">Submit</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END SECTION LOGIN -->

<?php $this->load->view('footer'); ?>

</body>
</html>