<?php 
/*$userdata=$this->session->userdata('user');
$user_id=$userdata['id'];
$username=$userdata['username'];*/

?>

<style>
    .nk-sidebar{
        
        /*background-color: #131432 !important;*/
    }
    
    [data-sibebarbg="color_1"] .nk-sidebar .metismenu {
    /*background-color: #131432 !important;*/
    color: black;
}

.nk-sidebar .metismenu > li.active > a {
    background: white  !important;
    color: black !important;
    
}
[data-sibebarbg="color_1"] .nk-sidebar .metismenu > li ul a {
    color: black;
    background-color: white !important;
}
    
     li.active span {
    color: black !important;
}

.nav-text{
    color: black !important;
    
}

    .menu-icon{
    
    color: black !important;
    
}

.nk-sidebar .metismenu a {
    position: relative;
    display: block;
    padding: 0.8125rem 1.25rem;
    outline-width: 0;
    transition: all .3s ease-out;
    color: black;
}

.nk-sidebar .metismenu > li.active i {
    color: black !important;
}

a:hover{
    
    /*background-color: #242651 !important;*/
}

.nk-sidebar{
    
    position:fixed !important;
}
    .nav-header {
    background-color: #00ADEE !important;
}
  
  .btn-primary {
    color: #fff;
    background-color: #00ADEE !important;
}
    .page-item.active .page-link {
    background-color: #00ADEE !important;
   
}
    
.page-title-icon {
    background-color: #00ADEE !important;
}
    
</style>

<div class="nk-sidebar">           
            <div class="nk-nav-scroll">
                <ul class="metismenu" id="menu">
                    <!--<li class="nav-label"><a href="<?php echo base_url(); ?>Dashboard">Dashboard</a></li>-->
                      <li>
                        <a href="<?php echo base_url(); ?>Dashboard">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                        <span class="nav-text" style="padding-left: 10px;">Dashboard</span>
                        </a>
                      
                    </li>
                    
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <svg width="24" height="20.466" stroke="currentColor"><defs><style>.Tutorials-selected_svgr__prefix__cls-1{fill:#11ece5}</style></defs><g id="Tutorials-selected_svgr__prefix__Tutorials_icon" data-name="Tutorials icon" transform="translate(-686.623 -542.66)"><path id="Tutorials-selected_svgr__prefix__Path_771" d="M129.736 391.16h-8.153c-.322 0-.582.121-.582.442s.261.434.582.434h8.153c.322 0 .582-.113.582-.434s-.261-.442-.582-.442z" class="Tutorials-selected_svgr__prefix__cls-1" data-name="Path 771" transform="translate(572.414 168.167)"></path><path id="Tutorials-selected_svgr__prefix__Path_772" d="M21.978 46.435h1.634c.394 0 .713-.121.713-.515s-.287-.349-.681-.349h-7.381c1.8-1.568 2.345-4.024 2.345-6.414 0-2.034-.429-3.783-2.325-4.523a4.439 4.439 0 00-3.5.5 2.632 2.632 0 012.261-2.541c.394 0 .593 0 .593-.4s-.2-.536-.593-.536a3.4 3.4 0 00-3.456 3.472 4.4 4.4 0 00-3.484-.5c-1.9.74-2.325 2.489-2.325 4.523 0 2.39.542 4.846 2.345 6.414H3.6a3.3 3.3 0 00-3.6 3.2 3.4 3.4 0 003.563 3.355h20.049a.713.713 0 00.713-.713c0-.394-.319-.367-.713-.367h-1.634a3.791 3.791 0 010-4.611zM6.719 39.157c0-2.193 1.045-3.242 1.9-3.574a2.856 2.856 0 012.973.754c.569.415.631.421 1.2 0a2.852 2.852 0 012.974-.754c.851.332 1.858 1.381 1.858 3.574 0 5.581-3.562 6.423-5.425 6.423s-5.472-.842-5.472-6.423zM3.563 51.046a2.262 2.262 0 01-2.138-2.275 2.319 2.319 0 012.138-2.336h17.189a5.5 5.5 0 000 4.611z" class="Tutorials-selected_svgr__prefix__cls-1" data-name="Path 772" transform="translate(686.623 511)"></path></g></svg>
                            <span class="nav-text" style="padding-left:5px;">Coach</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>Teachers/">View All</a></li>
                            
                        </ul>
                    </li>
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <svg width="24" height="20.466" stroke="currentColor"><defs><style>.Tutorials-selected_svgr__prefix__cls-1{fill:#11ece5}</style></defs><g id="Tutorials-selected_svgr__prefix__Tutorials_icon" data-name="Tutorials icon" transform="translate(-686.623 -542.66)"><path id="Tutorials-selected_svgr__prefix__Path_771" d="M129.736 391.16h-8.153c-.322 0-.582.121-.582.442s.261.434.582.434h8.153c.322 0 .582-.113.582-.434s-.261-.442-.582-.442z" class="Tutorials-selected_svgr__prefix__cls-1" data-name="Path 771" transform="translate(572.414 168.167)"></path><path id="Tutorials-selected_svgr__prefix__Path_772" d="M21.978 46.435h1.634c.394 0 .713-.121.713-.515s-.287-.349-.681-.349h-7.381c1.8-1.568 2.345-4.024 2.345-6.414 0-2.034-.429-3.783-2.325-4.523a4.439 4.439 0 00-3.5.5 2.632 2.632 0 012.261-2.541c.394 0 .593 0 .593-.4s-.2-.536-.593-.536a3.4 3.4 0 00-3.456 3.472 4.4 4.4 0 00-3.484-.5c-1.9.74-2.325 2.489-2.325 4.523 0 2.39.542 4.846 2.345 6.414H3.6a3.3 3.3 0 00-3.6 3.2 3.4 3.4 0 003.563 3.355h20.049a.713.713 0 00.713-.713c0-.394-.319-.367-.713-.367h-1.634a3.791 3.791 0 010-4.611zM6.719 39.157c0-2.193 1.045-3.242 1.9-3.574a2.856 2.856 0 012.973.754c.569.415.631.421 1.2 0a2.852 2.852 0 012.974-.754c.851.332 1.858 1.381 1.858 3.574 0 5.581-3.562 6.423-5.425 6.423s-5.472-.842-5.472-6.423zM3.563 51.046a2.262 2.262 0 01-2.138-2.275 2.319 2.319 0 012.138-2.336h17.189a5.5 5.5 0 000 4.611z" class="Tutorials-selected_svgr__prefix__cls-1" data-name="Path 772" transform="translate(686.623 511)"></path></g></svg>
                            <span class="nav-text" style="padding-left:5px;">Students</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>Student/">View All</a></li>
                            
                        </ul>
                    </li>
                   <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <svg width="24" height="20.466" stroke="currentColor"><defs><style>.Tutorials-selected_svgr__prefix__cls-1{fill:#11ece5}</style></defs><g id="Tutorials-selected_svgr__prefix__Tutorials_icon" data-name="Tutorials icon" transform="translate(-686.623 -542.66)"><path id="Tutorials-selected_svgr__prefix__Path_771" d="M129.736 391.16h-8.153c-.322 0-.582.121-.582.442s.261.434.582.434h8.153c.322 0 .582-.113.582-.434s-.261-.442-.582-.442z" class="Tutorials-selected_svgr__prefix__cls-1" data-name="Path 771" transform="translate(572.414 168.167)"></path><path id="Tutorials-selected_svgr__prefix__Path_772" d="M21.978 46.435h1.634c.394 0 .713-.121.713-.515s-.287-.349-.681-.349h-7.381c1.8-1.568 2.345-4.024 2.345-6.414 0-2.034-.429-3.783-2.325-4.523a4.439 4.439 0 00-3.5.5 2.632 2.632 0 012.261-2.541c.394 0 .593 0 .593-.4s-.2-.536-.593-.536a3.4 3.4 0 00-3.456 3.472 4.4 4.4 0 00-3.484-.5c-1.9.74-2.325 2.489-2.325 4.523 0 2.39.542 4.846 2.345 6.414H3.6a3.3 3.3 0 00-3.6 3.2 3.4 3.4 0 003.563 3.355h20.049a.713.713 0 00.713-.713c0-.394-.319-.367-.713-.367h-1.634a3.791 3.791 0 010-4.611zM6.719 39.157c0-2.193 1.045-3.242 1.9-3.574a2.856 2.856 0 012.973.754c.569.415.631.421 1.2 0a2.852 2.852 0 012.974-.754c.851.332 1.858 1.381 1.858 3.574 0 5.581-3.562 6.423-5.425 6.423s-5.472-.842-5.472-6.423zM3.563 51.046a2.262 2.262 0 01-2.138-2.275 2.319 2.319 0 012.138-2.336h17.189a5.5 5.5 0 000 4.611z" class="Tutorials-selected_svgr__prefix__cls-1" data-name="Path 772" transform="translate(686.623 511)"></path></g></svg>
                            <span class="nav-text" style="padding-left:5px;">Coupon</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>Coupon/">View Coupon</a></li>
                            
                        </ul>
                    </li>
                    
                    
                    
                    
                    
                    
                     <!--<li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <svg width="20" height="24" stroke="currentColor"><defs><style>.Contributors_svgr__prefix__cls-1{fill:#92abcf}.Contributors_svgr__prefix__cls-2{fill:transparent;stroke:#92abcf;stroke-linecap:round}</style></defs><g id="Contributors_svgr__prefix__Contributors_icon" data-name="Contributors icon" transform="translate(-684.701 -432.057)"><g id="Contributors_svgr__prefix__Contributors_icon-2" data-name="Contributors icon" transform="translate(687.636 432.057)"><path id="Contributors_svgr__prefix__Path_3" d="M140.54 9.582h.108a3 3 0 002.376-1.123c1.3-1.6 1.082-4.338 1.058-4.6a3.832 3.832 0 00-1.635-3.34A3.5 3.5 0 00140.635 0h-.057a3.5 3.5 0 00-1.813.5 3.832 3.832 0 00-1.655 3.355c-.024.261-.239 3 1.058 4.6a2.985 2.985 0 002.372 1.127zm-2.531-5.631v-.029c.115-2.64 1.83-2.922 2.565-2.922h.04c.91.022 2.457.427 2.561 2.924a.077.077 0 000 .029c0 .026.239 2.53-.832 3.848a2.124 2.124 0 01-1.736.788h-.034a2.117 2.117 0 01-1.732-.788c-1.064-1.312-.835-3.828-.832-3.85z" class="Contributors_svgr__prefix__cls-1" data-name="Path 3" transform="translate(-130.289)"></path><path id="Contributors_svgr__prefix__Path_4" d="M49.916 263.824v-.103c-.02-.729-.064-2.434-1.527-2.979l-.034-.011a9.392 9.392 0 01-2.8-1.392.431.431 0 00-.634.121.527.527 0 00.111.692 10.142 10.142 0 003.077 1.536c.785.306.873 1.223.9 2.062a.807.807 0 000 .092 7.292 7.292 0 01-.071 1.138 12.44 12.44 0 01-11.887 0 6.9 6.9 0 01-.071-1.138v-.092c.024-.84.111-1.757.9-2.062a10.237 10.237 0 003.077-1.536.526.526 0 00.111-.692.431.431 0 00-.634-.122 9.289 9.289 0 01-2.8 1.392l-.034.011c-1.463.549-1.507 2.254-1.527 2.979a.807.807 0 010 .092v.011a6.148 6.148 0 00.172 1.668.466.466 0 00.175.232A11.958 11.958 0 0043 267.48a11.994 11.994 0 006.579-1.76.486.486 0 00.175-.232 6.453 6.453 0 00.162-1.664z" class="Contributors_svgr__prefix__cls-1" data-name="Path 4" transform="translate(-32.685 -249.434)"></path></g></g></svg>
                            <span class="nav-text" style="padding-left: 10px;">Sample Request</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>Samplerequest/">View Sample Request</a></li>
                           
                        </ul>
                    </li>-->
                    
                     <!--<li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <svg width="20" height="24" stroke="currentColor"><defs><style>.Contributors_svgr__prefix__cls-1{fill:#92abcf}.Contributors_svgr__prefix__cls-2{fill:transparent;stroke:#92abcf;stroke-linecap:round}</style></defs><g id="Contributors_svgr__prefix__Contributors_icon" data-name="Contributors icon" transform="translate(-684.701 -432.057)"><g id="Contributors_svgr__prefix__Contributors_icon-2" data-name="Contributors icon" transform="translate(687.636 432.057)"><path id="Contributors_svgr__prefix__Path_3" d="M140.54 9.582h.108a3 3 0 002.376-1.123c1.3-1.6 1.082-4.338 1.058-4.6a3.832 3.832 0 00-1.635-3.34A3.5 3.5 0 00140.635 0h-.057a3.5 3.5 0 00-1.813.5 3.832 3.832 0 00-1.655 3.355c-.024.261-.239 3 1.058 4.6a2.985 2.985 0 002.372 1.127zm-2.531-5.631v-.029c.115-2.64 1.83-2.922 2.565-2.922h.04c.91.022 2.457.427 2.561 2.924a.077.077 0 000 .029c0 .026.239 2.53-.832 3.848a2.124 2.124 0 01-1.736.788h-.034a2.117 2.117 0 01-1.732-.788c-1.064-1.312-.835-3.828-.832-3.85z" class="Contributors_svgr__prefix__cls-1" data-name="Path 3" transform="translate(-130.289)"></path><path id="Contributors_svgr__prefix__Path_4" d="M49.916 263.824v-.103c-.02-.729-.064-2.434-1.527-2.979l-.034-.011a9.392 9.392 0 01-2.8-1.392.431.431 0 00-.634.121.527.527 0 00.111.692 10.142 10.142 0 003.077 1.536c.785.306.873 1.223.9 2.062a.807.807 0 000 .092 7.292 7.292 0 01-.071 1.138 12.44 12.44 0 01-11.887 0 6.9 6.9 0 01-.071-1.138v-.092c.024-.84.111-1.757.9-2.062a10.237 10.237 0 003.077-1.536.526.526 0 00.111-.692.431.431 0 00-.634-.122 9.289 9.289 0 01-2.8 1.392l-.034.011c-1.463.549-1.507 2.254-1.527 2.979a.807.807 0 010 .092v.011a6.148 6.148 0 00.172 1.668.466.466 0 00.175.232A11.958 11.958 0 0043 267.48a11.994 11.994 0 006.579-1.76.486.486 0 00.175-.232 6.453 6.453 0 00.162-1.664z" class="Contributors_svgr__prefix__cls-1" data-name="Path 4" transform="translate(-32.685 -249.434)"></path></g></g></svg>
                            <span class="nav-text" style="padding-left: 10px;">Discount Request</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>Custmizesample/">View Discount Request</a></li>
                            
                        </ul>
                    </li>-->
                    
                    <!-- <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <svg width="20" height="24" stroke="currentColor"><defs><style>.Contributors_svgr__prefix__cls-1{fill:#92abcf}.Contributors_svgr__prefix__cls-2{fill:transparent;stroke:#92abcf;stroke-linecap:round}</style></defs><g id="Contributors_svgr__prefix__Contributors_icon" data-name="Contributors icon" transform="translate(-684.701 -432.057)"><g id="Contributors_svgr__prefix__Contributors_icon-2" data-name="Contributors icon" transform="translate(687.636 432.057)"><path id="Contributors_svgr__prefix__Path_3" d="M140.54 9.582h.108a3 3 0 002.376-1.123c1.3-1.6 1.082-4.338 1.058-4.6a3.832 3.832 0 00-1.635-3.34A3.5 3.5 0 00140.635 0h-.057a3.5 3.5 0 00-1.813.5 3.832 3.832 0 00-1.655 3.355c-.024.261-.239 3 1.058 4.6a2.985 2.985 0 002.372 1.127zm-2.531-5.631v-.029c.115-2.64 1.83-2.922 2.565-2.922h.04c.91.022 2.457.427 2.561 2.924a.077.077 0 000 .029c0 .026.239 2.53-.832 3.848a2.124 2.124 0 01-1.736.788h-.034a2.117 2.117 0 01-1.732-.788c-1.064-1.312-.835-3.828-.832-3.85z" class="Contributors_svgr__prefix__cls-1" data-name="Path 3" transform="translate(-130.289)"></path><path id="Contributors_svgr__prefix__Path_4" d="M49.916 263.824v-.103c-.02-.729-.064-2.434-1.527-2.979l-.034-.011a9.392 9.392 0 01-2.8-1.392.431.431 0 00-.634.121.527.527 0 00.111.692 10.142 10.142 0 003.077 1.536c.785.306.873 1.223.9 2.062a.807.807 0 000 .092 7.292 7.292 0 01-.071 1.138 12.44 12.44 0 01-11.887 0 6.9 6.9 0 01-.071-1.138v-.092c.024-.84.111-1.757.9-2.062a10.237 10.237 0 003.077-1.536.526.526 0 00.111-.692.431.431 0 00-.634-.122 9.289 9.289 0 01-2.8 1.392l-.034.011c-1.463.549-1.507 2.254-1.527 2.979a.807.807 0 010 .092v.011a6.148 6.148 0 00.172 1.668.466.466 0 00.175.232A11.958 11.958 0 0043 267.48a11.994 11.994 0 006.579-1.76.486.486 0 00.175-.232 6.453 6.453 0 00.162-1.664z" class="Contributors_svgr__prefix__cls-1" data-name="Path 4" transform="translate(-32.685 -249.434)"></path></g></g></svg>
                            <span class="nav-text" style="padding-left: 10px;">Enquiry Before Buy</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>Enquiryb4buy/">View Enquiries</a></li>
                            
                        </ul>
                    </li>-->
                    
                  <!-- <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            <span class="nav-text" style="padding-left:10px">Blogs</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>Blogs/">View Blogs</a></li>
                            
                        </ul>
                    </li>-->
                    
                     <!--<li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            <span class="nav-text" style="padding-left:10px">News</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>News/">View News</a></li>
                            
                        </ul>
                    </li>-->
        
                    
                    
                    <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>

                            <span class="nav-text" style="padding-left:10px;">Gigs</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>Gig/">View Gigs</a></li>
                            <li><a href="<?php echo base_url(); ?>Categories/">View Category</a></li>
                            
                        </ul>
                    </li>
                    
                        <li>
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>

                            <span class="nav-text" style="padding-left:10px;">Class</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>Classess/">View Class</a></li>
                           
                            
                        </ul>
                    </li>
                    
                    <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                            <svg width="24" height="20.466" stroke="currentColor"><defs><style>.Tutorials-selected_svgr__prefix__cls-1{fill:#11ece5}</style></defs><g id="Tutorials-selected_svgr__prefix__Tutorials_icon" data-name="Tutorials icon" transform="translate(-686.623 -542.66)"><path id="Tutorials-selected_svgr__prefix__Path_771" d="M129.736 391.16h-8.153c-.322 0-.582.121-.582.442s.261.434.582.434h8.153c.322 0 .582-.113.582-.434s-.261-.442-.582-.442z" class="Tutorials-selected_svgr__prefix__cls-1" data-name="Path 771" transform="translate(572.414 168.167)"></path><path id="Tutorials-selected_svgr__prefix__Path_772" d="M21.978 46.435h1.634c.394 0 .713-.121.713-.515s-.287-.349-.681-.349h-7.381c1.8-1.568 2.345-4.024 2.345-6.414 0-2.034-.429-3.783-2.325-4.523a4.439 4.439 0 00-3.5.5 2.632 2.632 0 012.261-2.541c.394 0 .593 0 .593-.4s-.2-.536-.593-.536a3.4 3.4 0 00-3.456 3.472 4.4 4.4 0 00-3.484-.5c-1.9.74-2.325 2.489-2.325 4.523 0 2.39.542 4.846 2.345 6.414H3.6a3.3 3.3 0 00-3.6 3.2 3.4 3.4 0 003.563 3.355h20.049a.713.713 0 00.713-.713c0-.394-.319-.367-.713-.367h-1.634a3.791 3.791 0 010-4.611zM6.719 39.157c0-2.193 1.045-3.242 1.9-3.574a2.856 2.856 0 012.973.754c.569.415.631.421 1.2 0a2.852 2.852 0 012.974-.754c.851.332 1.858 1.381 1.858 3.574 0 5.581-3.562 6.423-5.425 6.423s-5.472-.842-5.472-6.423zM3.563 51.046a2.262 2.262 0 01-2.138-2.275 2.319 2.319 0 012.138-2.336h17.189a5.5 5.5 0 000 4.611z" class="Tutorials-selected_svgr__prefix__cls-1" data-name="Path 772" transform="translate(686.623 511)"></path></g></svg>
                            <span class="nav-text" style="padding-left:5px;">Attendance</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>Attendance/">View Attendance</a></li>
                            
                        </ul>
                    </li>
                    
                    
                  <!--  <li class="mega-menu mega-menu-sm">
                        <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                            <span class="nav-text" style="padding-left:10px">Website Content</span>
                        </a>
                        <ul aria-expanded="false">
                            <li><a href="<?php echo base_url(); ?>Homeslider/">Home Slider</a></li>
                            <li><a href="<?php echo base_url(); ?>Studentsreview/">Students Review</a></li>
                            <li><a href="<?php echo base_url(); ?>Aboutus/">About Us</a></li>
                            <li><a href="<?php echo base_url(); ?>Privacypolicy/">Privacy Policy</a></li>
                            <li><a href="<?php echo base_url(); ?>Termsconditions/">Terms & Conditions</a></li>
                            <li><a href="<?php echo base_url(); ?>Sociallinks/">Social Media Links</a></li>
                        </ul>
                    </li>-->
                    
                   
                   
                </ul>
            </div>
        </div>
