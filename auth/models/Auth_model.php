<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Auth_model extends CI_model
{
	function __construct() {
parent::__construct();
	}

	

	function populate_perm()
    {
      $this->db->select('perm_name');
      $q = $this->db->get('permissions');


      if($q->num_rows() > 0)
      {
          return $q->result_array();
      } 
      return false;
    }// end of populate permission

    function verify_user($username, $password )
    {
      //$pswd = sha1($password);
  
       
      $this->db->select('u.*, i.path, i.file_name');
      $this->db->from('users u');
      $this->db->join('images i', 'i.ref_id = u.user_id', 'left');
      $this->db->where('user_id',$username);
      $this->db->or_where('email', $username);
      
      $this->db->where('pwd', $password);

      $q = $this->db->get();
    


      if ($q->num_rows() > 0)
      {
          return $q->row_array();
      } 
      return false;
    }// varify user function


    function get_role($user_id, $project_id){
        $this->db->select('ra.project_id, r.role_id, r.role_name');
        $this->db->from('role_assigned ra');
        $this->db->join('roles r', 'r.role_id = ra.role_id');
        $this->db->where('ra.user_id', $user_id);
         $this->db->where('ra.project_id', $project_id);
        $q = $this->db->get();
        return $q->row_array();
    }// end of get role function


    function get_permission($role_id){
      $this->db->select('p.perm_name');
      $this->db->from('role_perm rp');
      $this->db->join('permissions p', 'rp.perm_id = p.perm_id');
       $this->db->where('role_id', $role_id);
      $q = $this->db->get();

      if($q->num_rows() > 0)
      {
          return $q->result_array();
      } 
      return false;
    }// end of get permission

    function check_email($email){
    $this->db->select('*');
    $this->db->where('email', $email);
    $q2 = $this->db->get('users');
   
    if($q2->num_rows()>0)
    {
      return $q2->row_array();
    }
    else
      return false;
  }// end of check email function 

  function set_pw_reset_code($email, $data_user){
       $this->db->where('email', $email);
      $q = $this->db->update('users', $data_user);

      if($q){
        return true;
      }
      else{
        return false;
      }
  }// end of set pw reset code

  function verify_code($code){

    $this->db->select('*');
    $this->db->where('pw_reset_code', $code);
    $q2 = $this->db->get('users');
   
    if($q2->num_rows()>0)
    {
      return true;
    }
    else
      return false;

  }

  function password_reset($pw_reset_code, $password){
    $data_user = array('pwd' => $password, 'pw_reset_code' => null, 'is_phone_verified' => 1);
    $this->db->where('pw_reset_code', $pw_reset_code);
      $q = $this->db->update('users', $data_user);

      if($q){
        return true;
      }
      else{
        return false;
      }
  }// end of password reset function

}// end of auth model class