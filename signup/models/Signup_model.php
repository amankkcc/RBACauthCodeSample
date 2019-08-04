<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Signup_model extends CI_model
{
	function __construct() {
parent::__construct();
	}


	function register($data){

		$data_users = array(
			'user_id'    	=> $data['user_id'],
			'user_type'		=> 2,
			'first_name'	=> $data['f_name'],
			'last_name'		=> $data['l_name'],
			'email'			=> $data['email'],
			'phone_number' 	=> $data['phone_number'],
			'pwd'			=> $data['password1'],
			'created'		=> date("Y-m-d H:i:s"),
			'modified'		=> date("Y-m-d H:i:s"),
			'last_login'	=> NULL,
			'login_count'	=> 0,
			'is_active'		=> 0,
			'otp_key'		=> $data['otp']
			);

		$data_user_info = array(
			'user_id'		=> $data['user_id'],
			'org_type'		=> $data['org_type'],
			'organisation'	=> $data['organisation'],
			'designation'	=> $data['designation']
			);

			$this->db->trans_begin();

			$result1 = $this->db->insert('users', $data_users);
			$result2 = $this->db->insert('user_info', $data_user_info);

			 if(($result1 ===true) && ($result2===true))
			 	{
          			$this->db->trans_commit();
          			return true;
          			exit;

      			}
	
      		else
      			{

          			$this->db->trans_rollback();
          			return false;
         		 	exit;
      			}
      			
	}// end of register function


	function check_phone($phone_number){
		$this->db->select('*');
    	$this->db->where('phone_number', $phone_number);
    	$q2 = $this->db->get('users');
   
    	if($q2->num_rows()>0)
    	{
      		return true;
    	}
    	else
     	 return false;
	}// end of phone number

	function check_email($email){
		$this->db->select('*');
    $this->db->where('email', $email);
    $q2 = $this->db->get('users');
   
    if($q2->num_rows()>0)
    {
      return true;
    }
    else
      return false;
	}// end of check email function 


	function verify_otp($data){
		$this->db->select('otp_key');
		$this->db->where('user_id',$data['user_id']);
		$q = $this->db->get('users');
		$row = $q->row();

		if($row->otp_key===$data['otp'])
		{
			$this->db->where('user_id',$data['user_id']);
			$data = array(
               'is_phone_verified' => 1
              
                           );
            $r = $this->db->update('users', $data);	
			return $r;
		}
	} // end of verify otp

}// end of model class