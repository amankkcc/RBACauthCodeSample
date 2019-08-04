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
    <section  class="header parallax home-parallax page" id="HOME">
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
                                <a href="<?php echo base_url(); ?>home"  >
                                    <span class="white p-t-">Go to home</span>
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

            <div style="height: 400px;" class="container home-container">
                <div class="row">
                   
                    <div class="col-md-12 col-sm-8 p-t-25">
                        <div class="signup_text">
                            <!-- TITLE AND DESC -->
                            <h1>Welcome To SiteControl</h1>
                            <p class="">For projects before Time & Below Cost</p>
                           
                                <div class="col-md-5 padding5  margintop20">
                                
                                    <h4>You are registered successfully, please check your email for OTP.</h4>
                                            <form id="verify_otp_form">
                                             <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter OTP"> 
                                             <input type="hidden" value="<?php echo $user_id; ?>" name="user_id" id="user_id">
                                             <br>
                                             <label id="worng_otp_msg" class="alert-danger">Wrong OTP, try again or contact customer support.</label>
                                            </form>

                                            <br>

                                            <button type="button" id="bt_otp_verify" class="btn btn btn-success" >Verify</button>
                                           
                                        
                                    </div>
                                </div>
                    </div>

                            
                           
                        </div>
                    </div>


                </div>
            </div>




        </div>
    </section>

     

    <section  class="copyright">
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
<script type="text/javascript">
        var base_url = '<?php echo base_url(); ?>';
    </script>asdfg
    <script src="<?php echo base_url(); ?>js/jquery.min.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/owl.carousel.js?v=1.0"></script>
 
    <script src="<?php echo base_url(); ?>js/wow.min.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/script.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/password_match.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/verify_email.js?v=1.0"></script>
   
</body>
</html>