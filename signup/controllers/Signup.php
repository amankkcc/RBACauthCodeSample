<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require  APPPATH . 'third_party/vendor/autoload.php';
use Mailgun\Mailgun;
class Signup extends MX_Controller
{
	
	function __construct() 
		{
			Parent::__construct();
			$this->load->library('custom_u_id');
		}

	function index(){
		$this->load->view('signup-view');
	}


	function register(){

		$this->load->model('signup_model');
		$input = urldecode(file_get_contents('php://input'));

			$received = json_decode($input, true);

			$data = array();

			foreach( $received as $value)
			{
				$data[$value['name']] = $value['value'];
			}

		$string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string_shuffled = str_shuffle($string);
        $otp = substr($string_shuffled, 1, 7);

        $a = $this->custom_u_id->construct_id('DIR');
		$user_id = $a;

		$data['user_id'] =  $user_id;			
		$data['otp'] =  $otp;
		
		$contains_empty = count($data) != count(array_filter($data));
		
		$email_exists = $this->signup_model->check_email($data['email']);
		
		if($contains_empty OR $email_exists){
			$result = false;
		}
		else{
			
			$result = $this->signup_model->register($data);

			if($result){


				$html_content = $this->get_html_mail($otp);

				$mgClient = new Mailgun('key-b06d19fddd74ae0bfab2b7df0bf6fbc6');
		    	$domain = "sitecontrol.in";

		    	# Make the call to the client.
		    	$mail_sent_result = $mgClient->sendMessage("$domain",
		      	array('from'    => 'Sitecontrol <noreply@sitecontrol.in>',
		            	'to'      => $data['email'],
		            	'subject' => 'Sitecontrol email verification',
		           		// 'text'    => $mail_body
		            	'html'  => $html_content
		            ));
	    	}
		}// end of else statement

		$resp = array('result' => $result, 'user_id' => $data['user_id']);



		

		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($resp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
                exit;  


	}// end of signup function

	function check_phone_number(){
		$phone_number = urldecode(file_get_contents('php://input'));
		
			$this->load->model('signup_model');
			$result = $this->signup_model->check_phone($phone_number);
			
			
			
				$resp = $result;
				$this->output
        		->set_status_header(200)
        	 	->set_content_type('application/json', 'utf-8')
        		->set_output(json_encode($resp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        		->_display();
        		exit;
	} // end of check phone number function 
	function check_email(){
			$email = urldecode(file_get_contents('php://input'));
		
			$this->load->model('signup_model');
			$result = $this->signup_model->check_email($email);
			
			
			
				$resp = $result;
				$this->output
        		->set_status_header(200)
        	 	->set_content_type('application/json', 'utf-8')
        		->set_output(json_encode($resp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        		->_display();
        		exit;
			
			

		}// end of check function 


		function verify_otp(){
			$this->load->model('signup_model');
			$input = urldecode(file_get_contents('php://input'));

			$received = json_decode($input, true);

			$data = array();

			foreach( $received as $value)
			{
				$data[$value['name']] = $value['value'];
			}
			$result = $this->signup_model->verify_otp($data);
			
			
			
				$resp = $result;
				$this->output
        		->set_status_header(200)
        	 	->set_content_type('application/json', 'utf-8')
        		->set_output(json_encode($resp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
        		->_display();
        		exit;
			
			

		}// end of check function 



		function get_html_mail($otp){

			 $html_body = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                <title>A Simple Responsive HTML Email</title>
                <style type="text/css">
                body {margin: 0; padding: 0; min-width: 100%!important;}
                .content {width: 100%; max-width: 600px;}  
                </style>
            </head>
            <body yahoo bgcolor="#f6f8f1">
                <table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td>
                            <table class="content" align="center" cellpadding="0" cellspacing="0" border="0">
                                <tr>
                                    <td>
                                        Hi There,
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Congratulations ! Your acount is created on sitecontrol. 
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                       Provide the OTP to verify your email .
                                       <h3> Your OTP is : '.$otp.'</h3> 
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
        </html>';

        	return $html_body;

		}// end of get html mail
		
}// end of class