<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Addorg_submit extends MX_Controller {

   function __construct() {
      Parent::__construct();
      $this->load->library('custom_u_id');
      $this->load->library('image_lib');
   }




   function add_org() {
      $this->load->model('addorg_model');
      $org_name = $this->input->post('org_name');
      $org_type = $this->input->post('org_type');
      $add_line1 = $this->input->post('add_line1');
      $pin = $this->input->post('pin');
      $city = $this->input->post('city');
      $state = $this->input->post('state');
      $country = $this->input->post('country');
      $contact_name = $this->input->post('contact_name');
      $email = $this->input->post('email');
      $add_line2 = $this->input->post('add_line2');
      $l_number = $this->input->post('l_number');
      $comtact_no = $this->input->post('comtact_no');
      $w = (int) $this->input->post('w');
      $h = (int) $this->input->post('h');
      $x = (int) $this->input->post('x');
      $y = (int) $this->input->post('y');
      $org_id = $this->custom_u_id->construct_id('ORG');
      $user_id = $this->session->userdata['sessiondata']['user_id'];
      // print_r('w=' . $w, 'h=' . $h, 'x=' . $x, 'y =' . $y);exit();

      

      $org_data = array(
          'org_id' => $org_id,
          'admin_user_id' => $user_id,
          'org_name' => $org_name,
          'org_type' => $org_type,
          'address' => $add_line1,
          'city' => $city,
          'pin' => $pin,
          'state' => $state,
          'country' => $country,
          'contact_name' => $contact_name,
          'email' => $email,
          'address2' => $add_line2,
          'l_number' => $l_number,
          'contact_no' => $comtact_no,
          'company_logo_id' => 0,
          'added_on' => date('Y-m-d')
      );

      $result = $this->addorg_model->addorg($org_data, $org_type, $user_id);


      if ($result) {


         $new_name = date('ymd') . time();
         $path = '/var/www/html/sitecontrol/uploads/' . $org_id . '/company_logo';
         if (!file_exists($path)) {
            mkdir($path, 0755, true);
         }
         $config['upload_path'] = $path;
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
         $config['max_size'] = 800;
        // $config['max_width'] = 0;
        // $config['max_height'] = 0;
         $config['file_name'] = $new_name;
         //check for errors
         $is_file_error = FALSE;
         if (!$_FILES) {
            $is_file_error = TRUE;
            $this->handle_error('Select an image file.');
         }

         if (!$is_file_error) {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('company_logo')) {


               $data = array('msg' => 'Organisation is created successfully. ', 'error' => $this->upload->display_errors(),
                   'code' => 0);
               $this->session->set_flashdata('data', $data);
               redirect(base_url() . 'template/addorg');
            } else {

               $image_details = $this->upload->data();
               $config['image_library'] = 'imagemagick';
               $config['library_path'] = 'C:\ImageMagick-7.0.5-Q16';
               $config['source_image'] = $image_details['full_path']; //get original image
               $config['width'] = $w;
               $config['height'] = $h;
               $config['x_axis'] = $x;
               $config['y_axis'] = $y;
               $config['maintain_ratio'] = FALSE;
               $this->load->library('image_lib', $config);
               if (!$this->image_lib->crop()) {
                  $this->handle_error($this->image_lib->display_errors());
               }
               if ($this->image_lib->crop()) {//var_dump( $this->image_lib->crop());exit();
                  //var_dump($config);exit();
                  $img_path = 'uploads/' . $org_id . '/company_logo';
                  $images_data = array(
                      'ref_id' => $org_id,
                      'path' => $img_path,
                      'file_name' => $image_details['file_name'],
                      'album_name' => 'company_logo',
                      'datetime_uploaded' => date("Y-m-d H:i:s")
                  );
                  //var_dump($images_data);exit();
                  //print_r($this->upload->data('file_name'));exit();

                  $result1 = $this->addorg_model->save_image_info($images_data);

                  if (!$result1) {
                     $data = array('msg' => 'Org created and file uploaded ! But database error occured.', 'error' => 'Image table data could not be inserted.',
                         'code' => 0);
                     $this->session->set_flashdata('data', $data);
                     redirect(base_url() . 'template/addorg');
                  } else {
                     $data = array('msg' => 'Organisation has been created and file successfully uploaded !', 'error' => '',
                         'code' => 1);

                     $this->session->set_flashdata('data', $data);
                     redirect(base_url() . 'template/addorg', $data);
                  }
               }
            }
         }
         if ($is_file_error) {
            if ($this->upload->data()) {
               $file = $path . $this->upload->data('file_name');
               if (file_exists($file)) {
                  unlink($file);
               }
            }
         }
      }// end of if check for data successfully inserted
      else {
         $data = array('msg' => 'Organisation could not be created, contact customer support.', 'code' => 0);
         $this->session->set_flashdata('data', $data);
         redirect(base_url() . 'template/addorg');
      }
   }

// end of add org submit function
//  Edit of add org update function

   function edit_add_org() {
      $this->load->model('addorg_model');

      $edit_org_id = $this->input->post('edit_org_id');
      $edit_name = $this->input->post('edit_name');
      $edit_org_type = $this->input->post('edit_org_type');
      $edit_add_line1 = $this->input->post('edit_add_line1');
      $edit_pin = $this->input->post('edit_pin');
      $edit_city = $this->input->post('edit_city');
      $edit_state = $this->input->post('edit_state');
      $edit_country = $this->input->post('edit_country');
      $edit_contact_name = $this->input->post('edit_contact_name');
      $edit_email = $this->input->post('edit_email');
      $edit_add_line2 = $this->input->post('edit_add_line2');
      $edit_l_number = $this->input->post('edit_l_number');
      $edit_comtact_no = $this->input->post('edit_comtact_no');

      $edit_org_data = array(
          'org_name' => $edit_name,
          'org_type' => $edit_org_type,
          'address' => $edit_add_line1,
          'city' => $edit_city,
          'pin' => $edit_pin,
          'state' => $edit_state,
          'country' => $edit_country,
          'contact_name' => $edit_contact_name,
          'email' => $edit_email,
          'address2' => $edit_add_line2,
          'l_number' => $edit_l_number,
          'contact_no' => $edit_comtact_no
      );
      $edit_result = $this->addorg_model->edit_addorg($edit_org_data, $edit_org_id);


      if ($edit_result) {
         $edit_new_name = date('ymd') . time();
         $edit_path = '/var/www/html/sitecontrol/uploads/' . $edit_org_id . '/company_logo';

         if (!file_exists($edit_path)) {
            mkdir($edit_path, 0755, true);
         }
         $config['upload_path'] = $edit_path;
         $config['allowed_types'] = 'gif|jpg|png|jpeg';
         $config['max_size'] = 800;
         $config['max_width'] = 1366;
         $config['max_height'] = 768;
         $config['file_name'] = $edit_new_name;
         $this->load->library('upload', $config);
         if (!$this->upload->do_upload('company_logo')) {

            $data = array('msg' => 'Organisation is Updated successfully. ', 'error' => $this->upload->display_errors(),
                'code' => 0);
            $this->session->set_flashdata('data', $data);
            redirect(base_url() . 'template/addorg');
         } else {

            $edit_img_path = 'uploads/' . $edit_org_id . '/company_logo';

            $edit_images_data = array('ref_id' => $edit_org_id,
                'path' => $edit_img_path,
                'file_name' => $this->upload->data('file_name'),
                'album_name' => 'company_logo',
                'datetime_uploaded' => date("Y-m-d H:i:s")
            );
            $edit_result1 = $this->addorg_model->edit_save_image_info($edit_images_data, $edit_org_id);
            if (!$edit_result1) {
               $data = array('msg' => 'Organisation created and file uploaded. But database error occured.', 'error' => 'Image table data could not be inserted.',
                   'code' => 0);
               $this->session->set_flashdata('data', $data);
               redirect(base_url() . 'template/addorg');
            } else {
               $data = array('msg' => 'Organisation has been Updated and file successfully uploaded !', 'error' => '',
                   'code' => 1);

               $this->session->set_flashdata('data', $data);
               redirect(base_url() . 'template/addorg', $data);
            }
         }
      }// end of if check for data successfully inserted
      else {
         $data = array('msg' => 'Organisation could not be Updated, contact customer support.', 'error' => '', 'code' => 0);
         $this->session->set_flashdata('data', $data);
         redirect(base_url() . 'template/addorg');
      }
   }

   // End  Edit of add org update function

   function delete_details(){

      $input = urldecode(file_get_contents('php://input'));
      //var_dump($input);exit; 
      $this->load->model('addorg_model');
      $result = $this->addorg_model->delete_org_img($input);
      $delete_img = $this->addorg_model->delete_org_details($input);
      //var_dump($delete_img);exit();
      $this->output
              ->set_status_header(200)
              ->set_content_type('application/json', 'utf-8')
              ->set_output(json_encode($delete_img, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
              ->_display();
      exit;
   }//End of delete function
}// end of class 