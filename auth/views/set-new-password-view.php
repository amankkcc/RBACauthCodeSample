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
                                <a href="<?php echo base_url() ?>home" >
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

            <div class="container home-container">
                <div class="row">
                   
                    <div class="col-md-12 col-sm-8 p-t-25">
                        <div class="signup_text">
                            <!-- TITLE AND DESC -->
                            <h1>Welcome To SiteControl</h1>
                            <p class="">For projects before Time & Below Cost</p>
                           
                            <div class="col-md-5 padding5  margintop20">
                                
                                <div class="well">
                             	<form id="loginForm" method="POST" action="<?php echo base_url(); ?>auth/save_new_password" novalidate="novalidate">
                                    <div class="form-group">
                                        <label for="username" class="control-label">Email</label>
                                        <input type="password" class="form-control" id="password1" name="pass1" value="" required="" title="Please enter you email" placeholder="Enter new password">
                                        <span class="help-block"></span>
                                        <input type="password" class="form-control" id="password2" name="pass2" value="" required="" title="Please enter you email" placeholder="Confirm new password">
                                        <input type="hidden" name="reset_code" value="<?php echo $reset_code; ?>">
                                    </div>
                                   
                                    
                                    <div id="pass_msg" class="text-danger ">Password mismatch</div>
                                    <button type="submit" id="bt_reset" class="btn btn-success btn-block">Set new password</button>
                                  
                                </form>
                                </div>
                            </div>

                           
                           
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

    



<!-- Modal -->



    <script src="<?php echo base_url(); ?>js/jquery.min.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/bootstrap.min.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/owl.carousel.js?v=1.0"></script>
 
    <script src="<?php echo base_url(); ?>js/wow.min.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/script.js?v=1.0"></script>
    <script src="<?php echo base_url(); ?>js/password_match.js?v=1.0"></script>
 
   
</body>
</html>

<script type="text/javascript">
        var base_url = '<?php echo base_url(); ?>';
    </script>asdfg
<script type="text/javascript">
var check_pass = true;
$(document).ready(function(){
    $('#pass_msg').hide();
});
      $('#password2').change(function(){
    var pass2=$('#password2').val();
    var pass1=$('#password1').val();

  if(pass1!=pass2){
    $('#pass_msg').show();
     check_pass = false;
    $('#bt_reset').attr("disabled","disabled");
  }
    
  else{
    $('#pass_msg').hide();
    check_pass = true;
    if(check_pass){
               $('#bt_reset').removeAttr('disabled');
            }
  }
  });

    

</script>