<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Site Control</title>
    <link href='https://fonts.googleapis.com/css?family=Raleway:500,600,700,800,900,400,300' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,900,300italic,400italic' rel='stylesheet' type='text/css'>
    <link href="<?php echo base_url(); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/font-awesome.min.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <link href="<?php echo base_url(); ?>css/style_home.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/signup.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>css/animate.css" rel="stylesheet">
    <!--<link href="css/responsive.css?v=1.0" rel="stylesheet">-->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
    <div class="spn_hol">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
<section class="header parallax home-parallax page" id="HOME">
        <h2></h2>
        <div class="section_overlay">
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo base_url(); ?>home">
                            <img src="<?php echo base_url(); ?>images/logo_home.png" alt="Logo">
                        </a>
                    </div>
                    <div class="collapse navbar-collapse p-r-15" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#">
                                    <div class="white p-t-">
                                        <i class="fa fa-envelope-o f-siz-19"></i> <label class="p-l-5">info@sitecontrol.in</label>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="white p-t-">
                                        <i class="fa fa-phone f-siz-19"></i> <label class="p-l-5">9591333278</label>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#" data-toggle="modal" data-target="#loginModal">
                                    <span class="white p-t-">login</span>
                                </a>
                            </li>
                            <li class="">
                                <a href="<?php echo base_url(); ?>signup" class="sign-up">
                                    <span  class="btn dgreen-bg p-l-15 p-r-15">Sign Up</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container home-container">
                <div class="row">
                    <div class="col-md-3  col-sm-4 p-t-25">
                        <div class="home-iphone2">
                            <img src="<?php echo base_url(); ?>images/site_control.png" alt="">
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-8 p-t-25">
                        <div class="signup_text">
                            <!-- TITLE AND DESC -->
                            <h1>Welcome To SiteControl</h1>
                            <p class="">For projects before Time & Below Cost</p>
                            <form id="signup_form" >
                            <div class="col-md-4 padding0 signup_inp margintop20">
                                <input type="text" class="form-control" id="email" name="email" placeholder="Email/Username">
                                <label id="email_msg" class="text-white">Email already registered, use something else.</label>
                                <input type="password" data-minlength="6" class="form-control" id="password1" name="password1" placeholder="Password" required>
                                <input type="password" class="form-control"  name="password2" id="password2"  placeholder="Confirm Password" required>
                                <label id="pass_msg" class="text-white">Password Does not match</label>
                                <input type="text" class="form-control" id="f_name" name="f_name" placeholder="First Name"> 
                                <input type="text" class="form-control" id="l_name" name="l_name" placeholder="Last Name">              
                                 <div class="form-group">
                                    <select class="form-control" name="org_type" id="sel1">
                                        <option value="Architect">Architect</option>
                                        <option value="Project Owner">Project Owner</option>
                                        <option value="Contractor">Contractor</option>
                                        <option value="PMC">PMC</option>
                                    </select>
                                </div>
                                <input type="text" class="form-control" id="org" name="organisation" placeholder="Organisation">
                                <input type="text" class="form-control" id="desg" name="designation" placeholder="Designation">
                                <input type="text" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number">
                              <label id="phone_msg" class="text-white">Phone number already registered, use something else.</label>
                                <button type="button" id="bt_signup"  class="btn btn-default signup_btn " > Submit</button>
                            </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

     <section class="contact page" id="CONTACT">
        <div class="section_overlay">
            <div class="contact_form wow bounceIn">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <div class="">
                                <h2 class="white f-siz-23 p-b-20 text-left">About SiteControl</h2>
                                <p class="white ">Why must they do that who's the baby. The dog smells bad eat grass, throw it back up, make muffins,<br /> for this human feeds me.</p>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <!-- START ERROR AND SUCCESS MESSAGE -->
                            <div class="form_error text-center">
                                <div class="name_error hide error">Please Enter your name</div>
                                <div class="email_error hide error">Please Enter your Email</div>
                                <div class="email_val_error hide error">Please Enter a Valid Email Address</div>
                                <div class="message_error hide error">Please Enter Your Message</div>
                            </div>
                            <div class="Sucess"></div>
                            <!-- END ERROR AND SUCCESS MESSAGE -->
                            <!-- FORM -->
                            <form role="form">
                                <div class="row">
                                    <h2 class="white f-siz-23 p-b-20 text-left m-t-0 p-l-15">Want us to Call you?</h2>
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="name" placeholder="Enter Name">
                                        <input type="email" class="form-control" id="email" placeholder="Company Name">
                                        <select class="form-control">
                                            <option>Role in Project</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <input type="tel" class="form-control" id="" required placeholder="Contact Number">
                                        <input type="text" class="form-control" id="subject" placeholder="Email Id">
                                        <div class="row">
                                            <div class="col-md-6"></div>
                                            <div class="col-md-6">
                                                <button type="button" class="btn btn-default signup_btn form_submit">Call Me</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- END FORM -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12 wow bounceInLeft">
                        <div class="social_icons">
                            <ul>
                                <li>
                                    <a href=""><i class="fa fa-facebook"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-twitter"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-dribbble"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-behance"></i></a>
                                </li>
                                <li>
                                    <a href=""><i class="fa fa-youtube-play"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="copyright">
        <h2></h2>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="copy_right_text">
                        <!-- COPYRIGHT TEXT -->
                        <p>Copyright &copy; 2016. All Rights Reserved.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="scroll_top">
                        <a href="#HOME"><i class="fa fa-angle-up"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- login popup -->
        <div class="modal fade" id="loginModal" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">USER AUTHENTICATION</h4>
                </div>
                <div class="modal-body">
                    
                            <div class="well">
                                <form id="loginForm" method="POST" action="<?php echo base_url(); ?>auth/login" novalidate="novalidate">
                                    <div class="form-group">
                                        <label for="username" class="control-label">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="" required="" title="Please enter you username" placeholder="example@gmail.com">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="control-label">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" value="" required="" title="Please enter your password">
                                        <span class="help-block"></span>
                                    </div>
                                    <div id="loginErrorMsg" class="alert alert-error hide">Wrong username og password</div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" id="remember"> Remember login
                                        </label>
                                        <p class="help-block">(if this is a private computer)</p>
                                    </div>
                                    <button type="submit" class="btn btn-success btn-block">Login</button>
                                    <a href="<?php echo base_url(); ?>auth/password_reset"  class="btn btn-default btn-block">Help to login</a>
                                </form>
                            </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    

    <!-- Modal -->
<div id="register_success" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="text-success modal-title">Congratulations !</h3>
      </div>
      <div class="modal-body">
        <h4>You are registered successfully, please check your email for OTP.</h4>
        <form id="verify_otp_form">
         <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP"> 
         <input type="hidden" name="user_id" id="user_id">
         <label id="worng_otp_msg" class="alert-danger">Wrong OTP, try again or contact customer support.</label>
        </form>
      </div>

      <div class="modal-footer">
        <button type="button" id="bt_otp_verify" class="btn btn btn-success" >Verify</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="register_failed" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="text-error modal-title">Oops ! You did something wrong.</h3>
      </div>
      <div class="modal-body">
        <h4>Please check your email or fill the form again.</h4>
         
      </div>

      <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
     

    <script src="<?php echo base_url(); ?>js/jquery.min.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/owl.carousel.js?v=1.0"></script>
 
    <script src="<?php echo base_url(); ?>js/wow.min.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/script.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/password_match.js?v=1.0"></script>
    <script type="text/javascript">
        var base_url = '<?php echo base_url(); ?>';
    </script>
    <script src="<?php echo base_url(); ?>js/signup.js?v=1.0"></script>
   
</body>
</html>