<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Add_roles_model extends CI_model
{
	function __construct() {
parent::__construct();
	}

	function rolesubmit($roles_data, $perms){
		$perm = array_filter($perms);
		$this->db->trans_begin();
		$result1 = $this->db->insert('roles', $roles_data);
		$role_id = $this->db->insert_id();

		foreach ($perm as $key => $value) {
			$this->db->insert('role_perm', array('role_id'=>$role_id, 'perm_id'=>(int)$value));
		}

		if (($result1==true) && (count($perm)>0)){

			$this->db->trans_commit();
			return true;
			exit;
		}
		else{

			$this->db->trans_rollback();
			return false;
			exit;
		}
	 

	} // end of function roles submit

	function updaterolesubmit($role_id, $role_title, $perms){
		$user_id = $this->session->userdata['sessiondata']['user_id'];
		$perm = array_filter($perms);
		$this->db->trans_begin();
		$this->db->set('role_name', $role_title);
		$this->db->where('role_id', $role_id);
		$this->db->where('admin_user_id', $user_id);
		$result1 = $this->db->update('roles');
		

		$this->db->where('role_id', $role_id);
  		$result2 = $this->db-> delete('role_perm');
		foreach ($perm as $key => $value) {
			
			$this->db->insert('role_perm', array('role_id'=>$role_id, 'perm_id'=>(int)$value));
			
		}

		if (($result1==true)&&($result2==true)){

			$this->db->trans_commit();
			return true;
			exit;
		}
		else{

			$this->db->trans_rollback();
			return false;
			exit;
		}


	}// end 

	function get_permissions(){

		
		$prms = $this->db->get('permissions');
		return $prms->result_array();

	}// end of function get roles data

	function get_roles(){

		$user_id = $this->session->userdata['sessiondata']['user_id'];
		$this->db->select('role_name, role_id');
		$this->db->where('admin_user_id', $user_id);
		   	$db_result = $this->db->get('roles');
  			
  			if ($db_result->num_rows()>0) {
  				return $db_result->result_array(); 
  			}
  			else{
			return false;
		}
  		}
  	function get_role_details($role_id){

  		$user_id = $this->session->userdata['sessiondata']['user_id'];  		
  		$this->db->select('*');
		$this->db->where('role_id', $role_id);
		$db_result = $this->db->get('roles');
		   	if ($db_result->num_rows()>0) {
  				return $db_result->result_array(); 
  			}
  			else{
			return false;
		}
  	}//end of get_role_details function

  function get_perms($permissions, $role_id){

  	$perms = array();
  	

  	$this->db->select('perm_id');
  	$this->db->where('role_id', $role_id);
  	$q = $this->db->get('role_perm');

  	$role_perms = $q->result_array();

  		$role_perm_data = array();

			foreach( $role_perms as $value)
			{
				array_push($role_perm_data, $value['perm_id']);
				
			}




  	foreach ($permissions as $key => $value) {
  		# code...
  	
  		
  		if( in_array( $value['perm_id'], $role_perm_data)){
  		 $perms[$value['perm_id']] = 1;
  		}else{
  			$perms[$value['perm_id']] = 0;
  		}
		
  	}// end of foreach

  		return $perms;
  	
  }//end of get perms
  	
  	function delete_role_details($role_id){
  		$this->db->trans_begin();
  		$this->db->where('role_id', $role_id);
  		$result1 = $this->db-> delete('roles');

  		$this->db->where('role_id', $role_id);
  		$result2 = $this->db-> delete('role_perm');

  		if (($result1==true)&&($result2==true)){

			$this->db->trans_commit();
			return true;
			exit;
		}
		else{

			$this->db->trans_rollback();
			return false;
			exit;
		}

  	}// end of delete role details 
  
}// end of class