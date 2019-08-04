<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Add_member_model extends CI_model
{
	function __construct() {
parent::__construct();
	}

	function addmem($mem_user_data, $user_data){

		$this->db->trans_begin();

      $email = $user_data['email'];

      $chk_mail = $this->check_mem_email($email);

      if(($chk_mail==1) OR ($chk_mail==false)){
         $result1 = $this->db->insert('users', $user_data);

      }
      else{
         $mem_user_data['user_id'] = $chk_mail['user_id'];
         $result1 = true;
      }
		
		$result2 = $this->db->insert('org_users', $mem_user_data);

		if (($result1==true) && ($result2==true)){

			$this->db->trans_commit();
			return true;
			exit;
		}
		else{

			$this->db->trans_rollback();
			return false;
			exit;
		}

	}// end of addmem funtion

	function save_image_info($image_data){
		$r = $this->db->insert('images', $image_data);

		if($r){
			return true;
		}
		else{
			return false;
		}

	}// end of save image info function 

	 function edit_addmem($edit_mem_user_data, $edit_user_data, $users_id) {
      
      $this->db->trans_begin();
      
      $this->db->where('user_id', $users_id); //which row want to upgrade 
      $edit_result1 = $this->db->update('users', $edit_user_data);
      
      $this->db->where('user_id', $users_id);
      $this->db->where('org_id', $edit_mem_user_data['org_id']);
      $edit_result2 = $this->db->update('org_users', $edit_mem_user_data);
      if (($edit_result1 == true) && ($edit_result2 == true)) {

         $this->db->trans_commit();
         return true;
         exit;
      } else {

         $this->db->trans_rollback();
         return false;
         exit;
      }
   }// end of edit add mem

    function edit_save_image_info($edit_image_data, $users_id) {
      $this->db->select('ref_id');
      $this->db->where('ref_id', $users_id);
      $result1 = $this->db->get('images');

      if ($result1->num_rows() > 0) {
         $this->db->where('ref_id', $users_id); //which row want to upgrade  
         $r = $this->db->update('images', $edit_image_data);
      } else {
         $r = $this->db->insert('images', $edit_image_data);
      }


      if ($r) {
         return true;
      } else {
         return false;
      }
   }// end of edit save image info function 

  
    function delete_mem_details($user_id){
       $admin_user_id = $this->session->userdata['sessiondata']['user_id'];

       $sql =  "delete FROM org_users WHERE org_id IN  (SELECT org_id FROM organisations  WHERE admin_user_id = '".$admin_user_id."') AND user_id = '".$user_id."'";
       
      
       
       $q = $this->db->query($sql);

       if($q)
         return true;
     /*
      $this->db->trans_begin();
      $this->db->where('user_id',$user_id);
      $q1 = $this->db->delete('org_users');

      $this->db->where('user_id',$user_id);
      $q2 = $this->db->delete('users');

      if (($q1 == true) && ($q2 == true)) {

         $this->db->trans_commit();
         return true;
         exit;
      } else {

         $this->db->trans_rollback();
         return false;
         exit;
      }
      */
   }// End of delete function

   function delete_mem_img($user_id){
      $this->db->where('ref_id', $user_id);
      $q = $this->db->get('images');
      $drawing = $q->row_array();
      if (($drawing['path'] > 0) && $drawing['file_name'] > 0) {
         $file_path = 'var/www/html/sitecontrol' . '/' . $drawing['path'] . '/' . $drawing['file_name'];
         if (!unlink($file_path)) {
            return false;
         } else {
            $this->db->where('ref_id', $org_id);
            $q = $this->db->delete('images');
            if ($q) {
               return true;
            } else {
               return false;
            }
         }
      } else {
         return true;
      }
   }// End of delete img function


   function check_mem_email($email){
      $user_id = $this->session->userdata['sessiondata']['user_id'];

      $this->db->select('u.user_id');
      $this->db->from('users u');
      //$this->db->join('org_users ou', 'u.user_id = ou.user_id');
      //$this->db->join('organisations o', 'o.org_id = ou.org_id');
      //$this->db->where('o.admin_user_id', $user_id);
      $this->db->where('u.email', $email);
      $q = $this->db->get();
      
      if(!$q->num_rows()>0){
         return true;
      }
      else{
         return false;
         
      }
   }// end of check mem email


}// end of class