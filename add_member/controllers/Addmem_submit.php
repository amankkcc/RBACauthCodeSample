<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require  APPPATH . 'third_party/vendor/autoload.php';
use Mailgun\Mailgun;
class Addmem_submit extends MX_Controller
{
	
	function __construct() 
		{
			Parent::__construct();
			$this->load->library('custom_u_id');
			
		}


	function save_member(){
		$this->load->model('add_member_model');
		$mem_id = $this->custom_u_id->construct_id('MEM');
		$f_name = $this->input->post('f_name');
		$l_name = $this->input->post('l_name');
		$org_id = $this->input->post('org_id');
		$designation = $this->input->post('designation');
		$email = $this->input->post('email');
		$contact_no = $this->input->post('contact_no');
	

		$mem_user_data = array(
			'user_id'	=> $mem_id, 
			'org_id'	=> $org_id,
			'desg'	=> $designation
			);

		$user_data = array(
			'user_id'    =>$mem_id,
			'user_type'		 => 3,
			'first_name'	 =>$f_name,
			'last_name'		 =>$l_name,
			'email'			 =>$email,
			'phone_number'	 =>$contact_no,
			'pwd'			 =>$contact_no,
			'created'		 => date("Y-m-d H:i:s"),
			'modified'		 => date("Y-m-d H:i:s"),
			'last_login'	 =>	null,
			'login_count'	 =>0,
			'is_phone_verified'  =>0,
			'is_active'		 =>1,
			'otp_key'		 =>0
			);

		$result = $this->add_member_model->addmem($mem_user_data, $user_data);
		

		if($result){
      // -------------------- send email to the member added --------------------------------
     
      $r_first_name = $user_data['first_name'];
      $r_email = $user_data['email'];

      $s_first_name = $this->session->userdata['sessiondata']['name'];

      $string = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $string_shuffled = str_shuffle($string);
           

           $pw_reset_code = substr($string_shuffled, 1, 32);
           
           $data_user = array( 'pw_reset_code' => $pw_reset_code);

           $this->load->module('auth');
           $set_pw_result = $this->auth_model->set_pw_reset_code($email, $data_user);

           if($set_pw_result){
            $html_content = $this->get_html_mail($r_first_name, $s_first_name, $pw_reset_code);

            
        $mgClient = new Mailgun('key-b06d19fddd74ae0bfab2b7df0bf6fbc6');
          $domain = "sitecontrol.in";

          # Make the call to the client.
          $mail_sent_result = $mgClient->sendMessage("$domain",
            array('from'    => 'Sitecontrol <noreply@sitecontrol.in>',
                  'to'      => $r_email,
                  'subject' => 'Invited to sitecontrol',
                  // 'text'    => $mail_body
                  'html'  => $html_content
                ));
        }
      // -------------------- end of email sending division -----------------------------



				$new_name = date('ymd').time();
				$path = '/var/www/html/sitecontrol/uploads/' . $mem_id . '/profile_pic';

				 if (!file_exists($path)) 
		         {
		               mkdir($path, 0755, true);
		         }

		         $config['upload_path']   = $path; 
		         $config['allowed_types'] = 'gif|jpg|png|jpeg'; 
		         $config['max_size']      = 800; 
		         $config['max_width']     = 1366; 
		         $config['max_height']    = 768; 
		         $config['file_name'] = $new_name; 
		         $this->load->library('upload', $config);

				
				 if ( ! $this->upload->do_upload('profile_pic')) {
		            

		            $data = array('msg' => 'Member is created successfully. ', 'error' =>$this->upload->display_errors(),
		                           'code' => 0);
		            $this->session->set_flashdata('data', $data);
		            redirect(base_url().'template/add_member');
		            
		           
		            
		         }
					
		         else { 
		            
		         	
		         	$img_path  = 'uploads/'.$mem_id.'/profile_pic';
		            $image_data = array('ref_id' => $mem_id,
		                                 'path' => $img_path,
		                                 'file_name' => $this->upload->data('file_name'),
		                                 'album_name' => 'member_pic',
		                                 'datetime_uploaded' => date("Y-m-d H:i:s")
		                                 );

		            

		            $result2 = $this->add_member_model->save_image_info($image_data);

		            if(!$result2){
		               $data = array('msg' => $this->upload->display_errors(),
		                           'code' => 0);
		           	 	$this->session->set_flashdata('data', $data);
		            	redirect(base_url().'template/add_member');
		            
		            }else
		            {
		               $data = array('msg' => 'Member has been created and file successfully uploaded !', 'error' => '',
		                           'code' => 1);
		           
		               $this->session->set_flashdata('data', $data);
		               redirect(base_url().'template/add_member',$data);
		            }
		           
		         } 
		}// end of if check for data successfully inserted
		else{
			$data = array('msg' => 'Memnber could not be added, contact customer support.','code' => 0);
		    $this->session->set_flashdata('data', $data);
		    redirect(base_url().'template/add_member');
		}
	}// end of save member submit function


	function edit_member() {
      $this->load->model('add_member_model');
     
      $edit_f_name = $this->input->post('edit_f_name');
      $edit_l_name = $this->input->post('edit_l_name');
      $edit_designation = $this->input->post('edit_designation');
      $edit_org_id 		=  $this->input->post('edit_org_id');
      $edit_email = $this->input->post('edit_email');
      $edit_contact_no = $this->input->post('edit_contact_no');
      $users_id = $this->input->post('users_id');





      
      $edit_mem_user_data = array(
          'desg' => $edit_designation,
          'org_id' => $edit_org_id
      );

      $edit_user_data = array(
          'first_name' => $edit_f_name,
          'last_name' => $edit_l_name,
          'email' => $edit_email,
          'phone_number' => $edit_contact_no,
          'modified'	=> date("Y-m-d H:i:s")
      );

    

      $edit_result = $this->add_member_model->edit_addmem($edit_mem_user_data, $edit_user_data, $users_id);


      if ($edit_result) {


         $edit_new_name = date('ymd') . time();
         $path = '/var/www/html/sitecontrol/uploads/' . $users_id . '/profile_pic';

         if (!file_exists($path)) {
            mkdir($path, 0755, true);
         }

         $config['upload_path'] = $path;
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
         $config['max_size'] = 0;
        // $config['max_width'] = 1366;
         //$config['max_height'] = 768;
         $config['file_name'] = $edit_new_name;
         $this->load->library('upload', $config);
         if (!$this->upload->do_upload('profile_pic')) {
            $data = array('msg' => 'Member is Updated successfully. ', 'error' => $this->upload->display_errors(),
                'code' => 0);
            $this->session->set_flashdata('data', $data);
            redirect(base_url() . 'template/add_member');
         } else {


            $img_path = 'uploads/' . $users_id . '/profile_pic';
            $edit_image_data = array('ref_id' => $users_id,
                'path' => $img_path,
                'file_name' => $this->upload->data('file_name'),
                'album_name' => 'member_pic',
                'datetime_uploaded' => date("Y-m-d H:i:s")
            );



            $result2 = $this->add_member_model->edit_save_image_info($edit_image_data,$users_id);

            if (!$result2) {
               $data = array('msg' =>  'Member detials updated ! But database error occured.' , 'error' => 'Image table data could not be inserted.',
		                           'code' => 0);
		           	 	$this->session->set_flashdata('data', $data);
		            	redirect(base_url().'template/add_member');
            } else {
                $data = array('msg' => 'Member detials has been updated and file successfully uploaded !', 'error' => '',
		                           'code' => 1);
		           
		               $this->session->set_flashdata('data', $data);
		               redirect(base_url().'template/add_member');
            }
         }
      }// end of if check for data successfully inserted
      else {
         $data = array('msg' => 'Memeber could not be Updated, contact customer support.', 'code' => 0);
         $this->session->set_flashdata('data', $data);
         redirect(base_url() . 'template/add_member');
      }
    
   }// end of edit member update function


    function delete_details() {

      $input = urldecode(file_get_contents('php://input'));
      
      $this->load->model('add_member_model');
      $result = $this->add_member_model->delete_mem_img($input);
      $delete_img = $this->add_member_model->delete_mem_details($input);
      $this->output
              ->set_status_header(200)
              ->set_content_type('application/json', 'utf-8')
              ->set_output(json_encode($delete_img, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
              ->_display();
      exit;
   }// end of delete details


   function check_email(){
      
      $email = urldecode(file_get_contents('php://input'));
      
      $this->load->model('add_member_model');
      
      $user = $this->add_member_model->check_mem_email($email);
      
      
      $resp = $user;
      $this->output
          ->set_status_header(200)
          ->set_content_type('application/json', 'utf-8')
          ->set_output(json_encode($resp, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
          ->_display();
          exit;
   }// end of check email function 

   function get_html_mail($r_first_name, $s_first_name, $reset_link){
    $help_url =   base_url().'help';
    $reset_url = base_url().'auth/set_new_password?code='.$reset_link;
    $html_content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> '.$s_first_name.' invited you to sitecontrol</title>
    
    
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
    <span class="preheader" style="box-sizing: border-box; display: none !important; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 1px; line-height: 1px; max-height: 0; max-width: 0; mso-hide: all; opacity: 0; overflow: hidden; visibility: hidden;">'.$s_first_name.' with sitecontrol has invited you to use sitecontrol to collaborate with them.</span>
    <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;" bgcolor="#F2F4F6">
      <tr>
        <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">
          <table class="email-content" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%;">
            <tr>
              <td class="email-masthead" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 25px 0; word-break: break-word;" align="center">
                <a href="https://example.com" class="email-masthead_name" style="box-sizing: border-box; color: #bbbfc3; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: 0 1px 0 white;">
        sitecontrol
      </a>
              </td>
            </tr>
            
            <tr>
              <td class="email-body" width="100%" cellpadding="0" cellspacing="0" style="-premailer-cellpadding: 0; -premailer-cellspacing: 0; border-bottom-color: #EDEFF2; border-bottom-style: solid; border-bottom-width: 1px; border-top-color: #EDEFF2; border-top-style: solid; border-top-width: 1px; box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0; padding: 0; width: 100%; word-break: break-word;" bgcolor="#FFFFFF">
                <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 0 auto; padding: 0; width: 570px;" bgcolor="#FFFFFF">
                  
                  <tr>
                    <td class="content-cell" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; padding: 35px; word-break: break-word;">
                      <h1 style="box-sizing: border-box; color: #2F3133; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 19px; font-weight: bold; margin-top: 0;" align="left">Hi, '.$r_first_name.'!</h1>
                      <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left"> '.$s_first_name.' with sitecontrol has invited you to use sitecontrol to collaborate with them. Use the button below to set up your account and get started:</p>
                      
                      <table class="body-action" align="center" width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; margin: 30px auto; padding: 0; text-align: center; width: 100%;">
                        <tr>
                          <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">
                            
                            <table width="100%" border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">
                              <tr>
                                <td align="center" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">
                                  <table border="0" cellspacing="0" cellpadding="0" style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">
                                    <tr>
                                      <td style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; word-break: break-word;">
                                        <a href="'.$reset_url.'" class="button button--" target="_blank" style="-webkit-text-size-adjust: none; background: #3869D4; border-color: #3869d4; border-radius: 3px; border-style: solid; border-width: 10px 18px; box-shadow: 0 2px 3px rgba(0, 0, 0, 0.16); box-sizing: border-box; color: #FFF; display: inline-block; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; text-decoration: none;">Set up account</a>
                                      </td>
                                    </tr>
                                  </table>
                                </td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                      <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">If you have any questions for '.$s_first_name.',  feel free to <a href="support@sitecontrol.in" style="box-sizing: border-box; color: #3869D4; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">contact our customer success team</a> anytime. (We\'re lightning quick at replying.)</p>
                      <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left">Welcome aboard,
                        <br />The sitecontrol Team</p>
                      <p style="box-sizing: border-box; color: #74787E; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 16px; line-height: 1.5em; margin-top: 0;" align="left"><strong style="box-sizing: border-box; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">P.S.</strong> Need help getting started? Check out our <a href="'.$help_url.'" style="box-sizing: border-box; color: #3869D4; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;">help documentation</a>.</p>
                      
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
                      <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">© 2017 sitecontrol. All rights reserved.</p>
                      <p class="sub align-center" style="box-sizing: border-box; color: #AEAEAE; font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif; font-size: 12px; line-height: 1.5em; margin-top: 0;" align="center">
                        sitecontrol.in
                       
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
   }// end of function get html mail

   

}// end of class 