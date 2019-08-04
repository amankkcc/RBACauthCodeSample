<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require  APPPATH . 'third_party/vendor/autoload.php';
use Mailgun\Mailgun;

class Auth_api extends MX_Controller
{
	protected $permissions;
	protected $roles;
	function __construct() 
		{
			Parent::__construct();
			$this->load->model('auth_model');

			
		}

	function login(){
      $jwt_token = '';
      $input = urldecode(file_get_contents('php://input'));

      $received = json_decode($input, true);
  
     

      $username = $received['username'];
      $password = $received['password'];

      $user = $this->auth_model->verify_user($username, $password);
      if($user){
        if($user['is_phone_verified']){
          if($user['user_type'] !=3){
            $jwt_token = array("error" => "App access is only for members");
          }
          else{
            $jwt_token = array('jwt' => $this->auth_token->get_token($username, $user));
          }
          
        }
        else{
          $jwt_token = array("error" => "User's email is not verified");
        }
        
      }
      else{
        $jwt_token = array("wrong" => "Username or Password is wrong");
      }
      
      $this->output
              ->set_status_header(200)
              ->set_content_type('application/json', 'utf-8')
              ->set_output(json_encode($jwt_token, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
              ->_display();
               exit;
               $data = array();

	
	
	}// end of login function
	
	
  function logout(){

        $decoded = (array)$this->auth_token->get_decoded();
        if(isset($decoded['user_id']))
        {
          $result =  $this->auth_token->token_logout($decoded['id']);

          if($result == 1){
            $resp = 1;
          }

           $this->output
                    ->set_status_header(200)
                    ->set_content_type('application/json', 'utf-8')
                    ->set_output(json_encode($resp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                    ->_display();
                     exit;
                     $data = array();
        }
        else{
            $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
            ->_display();
            exit; 
        }
  }// end of logout function

  function get_user_details(){
      $auth_data = $this->auth_token->verify_token();

      $resp = $auth_data;

      $this->output
          ->set_status_header(200)
          ->set_content_type('application/json', 'utf-8')
          ->set_output(json_encode($resp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
          ->_display();
          exit; 
  }// end of get user detials function

  function enter_email_api(){
      $input = urldecode(file_get_contents('php://input'));

      $received = json_decode($input, true);
      $email = $received['email'];

      $user = $this->auth_model->check_email($email);
      $mail_sent_result = null;
      if($user){
        $string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
         $string_shuffled = str_shuffle($string);
             $pw_reset_code = substr($string_shuffled, 1, 32);
             
             $data_user = array( 'pw_reset_code' => $pw_reset_code);

             $set_pw_result = $this->auth_model->set_pw_reset_code($email, $data_user);

             if($set_pw_result){
              $html_content = $this->get_html_mail($user, $pw_reset_code);

              
          $mgClient = new Mailgun('key-b06d19fddd74ae0bfab2b7df0bf6fbc6');
            $domain = "sitecontrol.in";

            # Make the call to the client.
            $mail_sent_result = $mgClient->sendMessage("$domain",
              array('from'    => 'Sitecontrol <noreply@sitecontrol.in>',
                    'to'      => $email,
                    'subject' => 'Password Reset Link',
                    // 'text'    => $mail_body
                    'html'  => $html_content
                  ));
                  
             }// end of if
      }// end of check if exixt 

      $resp = "Password reset email is sent to your mail id you've entered.";
      $this->output
          ->set_status_header(200)
          ->set_content_type('application/json', 'utf-8')
          ->set_output(json_encode($resp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
          ->_display();
          exit; 
  }// end of get user detials function

	 
  function get_html_mail($user, $pw_reset_code){

    $reset_url = base_url().'auth/set_new_password?code='.$pw_reset_code;
    $html_content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
            <head>
              <meta name="viewport" content="width=device-width, initial-scale=1.0" />
              <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
              <title>Set up a new password for [Product Name]</title>
              
              
            </head>
            <body style="-webkit-text-size-adjust: none; box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; height: 100%; line-height: 1.4; margin: 0; width: 100% !important;" bgcolor="#F2F4F6"><style type="text/css">
          body {
          width: 100% !important; height: 100%; margin: 0; line-height: 1.4; background-color: #F2F4F6; color: #74787E; -webkit-text-size-adjust: none;
          }
          @media only screen and (max-width: 600px) {
            .email-body_inner {
              width: 100% !important;
            }
            .email-footer {
              width: 100% !important;
            }
          }
          @media only screen and (max-width: 500px) {
            .button {
              width: 100% !important;
            }
          }
          </style>
              <span class="preheader" style="box-sizing: border-box; display: none !important; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; mso-hide: all; opacity: 0; overflow: hidden; visibility: hidden;">Use this link to reset your password. The link is only valid for 24 hours.</span>
              <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" bgcolor="#F2F4F6">
                <tr>
                  <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">
                    <table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;">
                      <tr>
                        <td class="email-masthead" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 25px 0; word-break: break-word;" align="center">
                          <a href="https://example.com" class="email-masthead_name" style="box-sizing: border-box; color: #bbbfc3; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
                  Sitecontrol
                </a>
                        </td>
                      </tr>
                      
                      <tr>
                        <td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%; word-break: break-word;" bgcolor="#FFFFFF">
                          <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;" bgcolor="#FFFFFF">
                            
                            <tr>
                              <td class="content-cell" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 35px; word-break: break-word;">
                                <h1 style="box-sizing: border-box; color: #2F3133; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 19px; font-weight: bold; margin-top: 0;" align="left">Hi '.$user['first_name'].',</h1>
                                <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">You recently requested to reset your password for your Sitecontrol account. Use the button below to reset it. <strong style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">This password reset link is only valid for one time.</strong></p>
                                
                                <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;">
                                  <tr>
                                    <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">
                                      
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">
                                        <tr>
                                          <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">
                                            <table border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">
                                              <tr>
                                                <td style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">
                                                  <a href="'.$reset_url.'" class="button button--green" target="_blank" style="-webkit-text-size-adjust: none; background: #22BC66; border-color: #22bc66; border-radius: 3px; border-style: solid; border-width: 10px 18px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); box-sizing: border-box; color: #FFF; display: inline-block; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; text-decoration: none;">Reset your password</a>
                                                </td>
                                              </tr>
                                            </table>
                                          </td>
                                        </tr>
                                      </table>
                                    </td>
                                  </tr>
                                </table>
                                <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">If you did not request a password reset, please ignore this email or <a href="{{support_url}}" style="box-sizing: border-box; color: #3869D4; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">contact support</a> if you have questions.</p>
                                <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Thanks,
                                  <br />The SitecontrolTeam</p>
                                
                                <table class="body-sub" style="border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin-top: 25px; padding-top: 25px;">
                                  <tr>
                                    <td style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">
                                      <p class="sub" style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="left">If you’re having trouble with the button above, copy and paste the URL below into your web browser.</p>
                                      <p class="sub" style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="left">'.$reset_url.'</p>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                      <tr>
                        <td style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">
                          <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0 auto; padding: 0; text-align: center; width: 570px;">
                            <tr>
                              <td class="content-cell" align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 35px; word-break: break-word;">
                                <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">© 2017 [Product Name]. All rights reserved.</p>
                                <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">
                                  [Company Name, LLC]
                                  <br />1234 Street Rd.
                                  <br />Suite 1234
                                </p>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </body>
          </html>
    ';
      return $html_content;
  }// end of get html mail
}// end of class
