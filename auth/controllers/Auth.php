<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require  APPPATH . 'third_party/vendor/autoload.php';
use Mailgun\Mailgun;
class Auth extends MX_Controller
{
	protected $permissions;
	protected $roles;
	function __construct() 
		{
			Parent::__construct();
			$this->load->model('auth_model');
			$this->load->module('template');
		}

	function index(){
		$msg = $this->session->flashdata('msg');
		if($msg){
			$data = $msg;
			$this->load->view('auth-view',$data);
		}
		else{
			if(isset($this->session->userdata['sessiondata']['user_id'])  ){
				$ses_data = $this->session->userdata['sessiondata'];

				$this->template->index($ses_data);

			}
			else
				{
					$this->session->sess_destroy();
					redirect('home');
				}
			
		}

	}// end of auth index function

	function populate_permissions(){
			$result = $this->auth_model->populate_perm();

			foreach($result as $val)
			{
				$this->permissions[$val["perm_name"]]= false;
			}
	}// end of populate permissions function

	function login(){

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->populate_permissions();

		$user = $this->auth_model->verify_user($username, $password);
		
		$data = array(
			'user_id' => $user['user_id'],
			'name'	   => $user['first_name'],
			'is_active' =>$user['is_active'],
			'is_phone_verified' => $user['is_phone_verified'],
			'email'		=>$user['email'],
			'user_type' => $user['user_type'],
			'ipath'		=> $user['path'],
			'ifile_name' => $user['file_name'],
			'login_count' =>0

    	);
		if($user){

			if($user['is_phone_verified']){

					if($data['user_type'] == 2){
								
								$this->roles["role_id"] = NULL;

								foreach ($this->permissions as $key => $value) {
									$this->permissions[$key] = true;
								}

					}
					

					//$sessiondata = array_merge($data, $this->permissions, $this->roles);
		    		$this->session->set_userdata('sessiondata',$data);

		    		redirect('auth');
    		}// end of if phone verification check
    		else{

    			$this->load->view('email-verification-view', $data);
    		}

		}else{
			$msg = array('msg' => 'Username or Password is wrong!');
				
				$this->session->set_flashdata('msg', $msg);
                redirect(base_url().'auth');
		}

	}// end of login function 

	public function logout_user()
		{
			$this->session->sess_destroy();
			redirect('auth');

		}


	function password_reset(){
		$msg = $this->session->flashdata('msg');
		if($msg){
			$data = $msg;
			$this->load->view('password-reset-view', $data);
		}
		else{
			
			$data = array('msg' => '');
			$this->load->view('password-reset-view', $data);
		}
	}// end of function password_reset


	function enter_email(){
		$email = $this->input->post('email');
		$user = $this->auth_model->check_email($email);

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
		

		$msg = array('msg' => 'Password reset link is sent to email id : <h5>'.$email. '</h5> if this email id is associated with the account you will receive the email ! If you did not receive the email try sending again or check your email id.');
				
				$this->session->set_flashdata('msg', $msg);
                redirect(base_url().'auth/password_reset');


	}// end of enter email function 


	function set_new_password(){
		$code = $this->input->get('code');
		$is_exist = $this->auth_model->verify_code($code);

		$data = array('reset_code' => $code);
		if($is_exist){
			$this->load->view('set-new-password-view', $data);
		}
		else{
			$msg = array('msg' => 'The link is expired . Get new link again.');
			$this->session->set_flashdata('msg', $msg);
                redirect(base_url().'auth/password_reset');
		}
		
	}// end of set new password


	function save_new_password(){
		$password = $this->input->post('pass1');
		$pw_reset_code = $this->input->post('reset_code');

		$is_exist = $this->auth_model->verify_code($pw_reset_code);

		if($is_exist){
			$pass_reset_result = $this->auth_model->password_reset($pw_reset_code, $password);
			if($pass_reset_result){
				$msg = array('msg' => 'New password is set, please login again with new password.');
				
				$this->session->set_flashdata('msg', $msg);
                redirect(base_url().'auth');
			}
		}
		else{
			$msg = array('msg' => 'The link is expired . Get new link again.');
			$this->session->set_flashdata('msg', $msg);
                redirect(base_url().'auth/password_reset');
		}
		
	}// end of save new password



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
					                            <p class="sub" style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="left">If you�re having trouble with the button above, copy and paste the URL below into your web browser.</p>
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
					                      <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">� 2017 [Product Name]. All rights reserved.</p>
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

}// end of class admin dashboard