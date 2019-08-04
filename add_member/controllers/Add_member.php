<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_member extends MX_Controller
{
	
	function __construct() 
		{
			Parent::__construct();
			$this->load->helper(array('form', 'file','url'));
			
		}

		public function _remap($method, $params = array())
		{
    		// get controller name
    		$controller = mb_strtolower(get_class($this));
     
    		if ($controller === mb_strtolower($this->uri->segment(1))) {
        		// if requested controller and this controller have the same name
        		// show 404 error
        		show_404();
   			} elseif (method_exists($this, $method))
    		{
        		// if method exists
        		// call method and pass any parameters we recieved onto it.
        		return call_user_func_array(array($this, $method), $params);
    		} else {
        		// method doesn't exist, show error
        		show_404();
   					 }
		}

	function index(){

		if(isset($this->session->userdata['sessiondata']['user_id'])  && ($this->session->userdata['sessiondata']['user_type']==2) )
		{
			$flashdata = $this->session->flashdata('data');
			if($flashdata){
				$data = $flashdata; 
			}else{
				$data = array('msg' => '','error' => '', 'code'=> '');
			}

			$this->load->module('members_list');
			$this->load->model('members_list_model');
			$organisations = $this->members_list_model->get_orgs();
			$members = $this->members_list_model->get_members();


			if($organisations){
				$data['orgs'] = $organisations;
				
			}
			else{
				$data['orgs'] = array();
				
			}

			if($members){
				$data['members'] = $members;
			}else{
				$data['members'] = array();
			}

			
			$this->load->view('add-member-view', $data);
		}
	}// end of index function 
}// end of class admin dashboard 