<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Addorg extends MX_Controller {

   function __construct() {
      Parent::__construct();
      $this->load->helper(array('form', 'file', 'url'));
   }

   public function _remap($method, $params = array()) {
      // get controller name
      $controller = mb_strtolower(get_class($this));

      if ($controller === mb_strtolower($this->uri->segment(1))) {
         // if requested controller and this controller have the same name
         // show 404 error
         show_404();
      } elseif (method_exists($this, $method)) {
         // if method exists
         // call method and pass any parameters we recieved onto it.
         return call_user_func_array(array($this, $method), $params);
      } else {
         // method doesn't exist, show error
         show_404();
      }
   }

   function index() {

      if (isset($this->session->userdata['sessiondata']['user_id']) && ($this->session->userdata['sessiondata']['user_type'] == 2)) {

         $user_id = $this->session->userdata['sessiondata']['user_id'];
         $flashdata = $this->session->flashdata('data');
         if ($flashdata) {
            $data = $flashdata;
         } else {
            $data = array('msg' => '', 'error' => '', 'code' => '');
         }

         $this->load->module('organisations_list');
         $this->load->model('organisations_model');
         $this->load->model('addorg_model');
         $org_type = $this->load->addorg_model->get_org_type($user_id);


         $org_type_list = $this->load->addorg_model->get_org_type_list($user_id);

          $data['org_type'] = $org_type;
          $data['org_type_list'] = $org_type_list;
         $orgs = $this->organisations_model->get_orgs();
         //var_dump($orgs);exit();
         if ($orgs) {
            $data['orgs'] = $orgs;
         } else {
            $data['orgs'] = array();
         }

         // var_dump($org_type); exit();
         

         $this->load->view('addorg-view', $data);
      }
   }

// end of index function 
}

// end of class admin dashboard