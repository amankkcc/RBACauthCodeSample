<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Add_roles_submit extends MX_Controller
{
	
	function __construct() 
		{
			Parent::__construct();
			
		}

		function roles_save(){

			$this->load->model('add_roles_model');
			$role_title = $this->input->post('role_title');
			$schedule_v = $this->input->post('schedule_v');
			$schedule_e = $this->input->post('schedule_e');
			$schedule_a = $this->input->post('schedule_a');
			$resources_v = $this->input->post('resources_v');
			$resources_e = $this->input->post('resources_e');
			$resources_a = $this->input->post('resources_a');
			
			$drawings_v = $this->input->post('drawings_v');
			$drawings_e = $this->input->post('drawings_e');
			$drawings_a = $this->input->post('drawings_a');
			$boq_v = $this->input->post('boq_v');
			$boq_e = $this->input->post('boq_e');
			$boq_a = $this->input->post('boq_a');
			$site_images_v = $this->input->post('site_images_v');
			$site_images_e = $this->input->post('site_images_e');
			$site_images_a = $this->input->post('site_images_a');
			$mom_v = $this->input->post('mom_v');
			$mom_e = $this->input->post('mom_e');
			$mom_a = $this->input->post('mom_a');
			$quality_v = $this->input->post('quality_v');
			$quality_e = $this->input->post('quality_e');
			$quality_a = $this->input->post('quality_a');
			$safety_v = $this->input->post('safety_v');
			$safety_e = $this->input->post('safety_e');
			$safety_a = $this->input->post('safety_a');
			$measurement_v = $this->input->post('measurement_v');
			$measurement_e = $this->input->post('measurement_e');
			$measurement_a = $this->input->post('measurement_a');
			$billing_v = $this->input->post('billing_v');
			$billing_e = $this->input->post('billing_e');
			$billing_a = $this->input->post('billing_a');

			$perms = array(
				'schedule_v'		=> $schedule_v,
				'schedule_e'		=> $schedule_e,
				'schedule_a'		=> $schedule_a,
				'resources_v'		=> $resources_v,
				'resources_e'		=> $resources_e,
				'resources_a'		=> $resources_a,
				'site_notes_v'		=> 7,
				'site_notes_e'		=> 8,
				'site_notes_a'		=> 9,
				'site_wall_v'		=> 10,
				'site_wall_e'		=> 11,
				'site_wall_a'		=> 12,
				'drawings_v'		=> $drawings_v,
				'drawings_e'		=> $drawings_e,
				'drawings_a'		=> $drawings_a,
				'boq_v'				=> $boq_v,
				'boq_e'				=> $boq_e,
				'boq_a'				=> $boq_a,
				'site_images_v'		=> $site_images_v,
				'site_images_e'		=> $site_images_e,
				'site_images_a'		=> $site_images_a,
				'mom_v'				=> $mom_v,
				'mom_e'				=> $mom_e,
				'mom_a'				=> $mom_a,
				'quality_v'			=> $quality_v,
				'quality_e'			=> $quality_e,
				'quality_a'			=> $quality_a,
				'safety_v'			=> $safety_v,
				'safety_e'			=> $safety_e,
				'safety_a'			=> $safety_a,
				'measurement_v'		=> $measurement_v,
				'measurement_e'		=> $measurement_e,
				'measurement_a'		=> $measurement_a,
				'billing_v'			=> $billing_v,
				'billing_e'			=> $billing_e,
				'billing_a'			=> $billing_a
				);
			$roles_data = array(
				'role_name'			=> $role_title,
				'admin_user_id' 	=> $this->session->userdata['sessiondata']['user_id'],
				'role_created'		=> date("Y-m-d H:i:s")
				);

			$this->add_roles_model->rolesubmit($roles_data, $perms);
			redirect('template/roles_list');

		}// roles submit function ends 

		function update_roles_data(){
			$this->load->model('add_roles_model');

			$role_id = $this->input->post('role_id');

			$role_title = $this->input->post('role_title');

			$schedule_v = $this->input->post('schedule_v');
			$schedule_e = $this->input->post('schedule_e');
			$schedule_a = $this->input->post('schedule_a');
			$resources_v = $this->input->post('resources_v');
			$resources_e = $this->input->post('resources_e');
			$resources_a = $this->input->post('resources_a');
			
			$drawings_v = $this->input->post('drawings_v');
			$drawings_e = $this->input->post('drawings_e');
			$drawings_a = $this->input->post('drawings_a');
			$boq_v = $this->input->post('boq_v');
			$boq_e = $this->input->post('boq_e');
			$boq_a = $this->input->post('boq_a');
			$site_images_v = $this->input->post('site_images_v');
			$site_images_e = $this->input->post('site_images_e');
			$site_images_a = $this->input->post('site_images_a');
			$mom_v = $this->input->post('mom_v');
			$mom_e = $this->input->post('mom_e');
			$mom_a = $this->input->post('mom_a');
			$quality_v = $this->input->post('quality_v');
			$quality_e = $this->input->post('quality_e');
			$quality_a = $this->input->post('quality_a');
			$safety_v = $this->input->post('safety_v');
			$safety_e = $this->input->post('safety_e');
			$safety_a = $this->input->post('safety_a');
			$measurement_v = $this->input->post('measurement_v');
			$measurement_e = $this->input->post('measurement_e');
			$measurement_a = $this->input->post('measurement_a');
			$billing_v = $this->input->post('billing_v');
			$billing_e = $this->input->post('billing_e');
			$billing_a = $this->input->post('billing_a');

			$perms = array(
				'schedule_v'		=> (int)$schedule_v,
				'schedule_e'		=> (int)$schedule_e,
				'schedule_a'		=> (int)$schedule_a,
				'resources_v'		=> (int)$resources_v,
				'resources_e'		=> (int)$resources_e,
				'resources_a'		=> (int)$resources_a,
				'site_notes_v'		=> 7,
				'site_notes_e'		=> 8,
				'site_notes_a'		=> 9,
				'site_wall_v'		=> 10,
				'site_wall_e'		=> 11,
				'site_wall_a'		=> 12,
				'drawings_v'		=> (int)$drawings_v,
				'drawings_e'		=> (int)$drawings_e,
				'drawings_a'		=> (int)$drawings_a,
				'boq_v'				=> (int)$boq_v,
				'boq_e'				=> (int)$boq_e,
				'boq_a'				=> (int)$boq_a,
				'site_images_v'		=> (int)$site_images_v,
				'site_images_e'		=> (int)$site_images_e,
				'site_images_a'		=> (int)$site_images_a,
				'mom_v'				=> (int)$mom_v,
				'mom_e'				=> (int)$mom_e,
				'mom_a'				=> (int)$mom_a,
				'quality_v'			=> (int)$quality_v,
				'quality_e'			=> (int)$quality_e,
				'quality_a'			=> (int)$quality_a,
				'safety_v'			=> (int)$safety_v,
				'safety_e'			=> (int)$safety_e,
				'safety_a'			=> (int)$safety_a,
				'measurement_v'		=> (int)$measurement_v,
				'measurement_e'		=> (int)$measurement_e,
				'measurement_a'		=> (int)$measurement_a,
				'billing_v'			=> (int)$billing_v,
				'billing_e'			=> (int)$billing_e,
				'billing_a'			=> (int)$billing_a
				);
			$roles_data = array(
				'role_name'			=> $role_title,
				'admin_user_id' 	=> $this->session->userdata['sessiondata']['user_id'],
				'role_created'		=> date("Y-m-d H:i:s")
				);
			
			$this->add_roles_model->updaterolesubmit($role_id, $role_title, $perms);
			
			redirect('template/roles_list');

		}// end of function update role data



		function get_role_details(){
		
		$this->load->model('add_roles_model');
		$input = urldecode(file_get_contents('php://input'));

	
		$role_details = $this->add_roles_model->get_role_details($input);

		$permissions = $this->add_roles_model->get_permissions();

		$perms = $this->add_roles_model->get_perms($permissions, $input);
		
		$data = array('role_details' => $role_details, 'perms' => $perms);
		
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
                exit; 
            
		}// end of get role details

		function delete_role_details(){

			$this->load->model('add_roles_model');
			$input = urldecode(file_get_contents('php://input'));

			$result = $this->add_roles_model->delete_role_details($input);
			$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
                exit; 

		}// end of delete_role_details

		function edit_role_details(){

		$this->load->model('add_roles_model');

		$input = urldecode(file_get_contents('php://input'));

	
		$role_details = $this->add_roles_model->get_role_details($input);

		$permissions = $this->add_roles_model->get_permissions();

		$perms = $this->add_roles_model->get_perms($permissions, $input);
		
		$data = array('role_details' => $role_details, 'perms' => $perms);
		
		$this->output
                ->set_status_header(200)
                ->set_content_type('application/json', 'utf-8')
                ->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
                ->_display();
                exit; 

		}// end of function edit role details 
}// end of class 
