<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_roles extends MX_Controller
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
			$this->load->model('add_roles_model');
			$permission = $this->add_roles_model->get_permissions();
			$data = array('perms' => $permission);
			$roles_info = $this->add_roles_model->get_roles();
			if($roles_info){
				$data['roles'] = $roles_info;
				
			}
			else{
				$data['roles'] = array();
				
			}
			 
			$this->load->view('add-roles-view', $data);

		}
	}// end of index function 
}// end of class admin dashboard