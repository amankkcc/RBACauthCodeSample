<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Addorg_model extends CI_model {

   function __construct() {
      parent::__construct();
   }



   function addorg($org_data, $org_type, $user_id) {

       $org_type_data = array(
          'admin_user_id' => $user_id,
          'org_type_name' => $org_type
      );

      $this->db->select('org_type_name');
      $this->db->where('admin_user_id', $user_id);
      $this->db->where('org_type_name', $org_type);
      $q = $this->db->get('set_org_type');
     
       if ($q->num_rows() > 0) {
         $this->db->set('org_type_name', $org_type);
         $this->db->where('admin_user_id', $user_id);
          $this->db->where('org_type_name', $org_type);
         $this->db->update('set_org_type');

      } else {

         $r1 = $this->db->insert('set_org_type', $org_type_data);
      }
     


      $r = $this->db->insert('organisations', $org_data);

      if ($r) {
         return true;
      } else {
         return false;
      }
   }

// end of add org funtion

   function save_image_info($image_data) {
      $r = $this->db->insert('images', $image_data);

      if ($r) {
         return true;
      } else {
         return false;
      }
   }

// end of save image info function 

   function get_org_type($user_id) {

         $this->db->select('*');
         $this->db->where('user_type', 1);
         $super_admin_data = $this->db->get('users')->row();
         $super_id = $super_admin_data->user_id;

         if ($super_id) {
               $this->db->select('id, org_type_name');
               $this->db->order_by('org_type_name', 'ASC');
               $this->db->where('admin_user_id', $user_id);
               $this->db->or_where('admin_user_id', $super_id);
               $q = $this->db->get('set_org_type');

               if ($q->num_rows() > 0) {
                  return $q->result_array();
               } else {
                  return false;
               }      
         }else{
            $this->db->select('id, org_type_name');
            $this->db->order_by('org_type_name', 'ASC');
            $this->db->where('admin_user_id', $user_id);
            $q = $this->db->get('set_org_type');

            if ($q->num_rows() > 0) {
               return $q->result_array();
            } else {
               return false;
            }
         }

      
   }// end of add project type function 

   function get_org_type_list($user_id){

      $this->db->distinct();
      $this->db->select('org_type');
      $this->db->order_by('org_type', 'ASC');
      $this->db->where('admin_user_id', $user_id);
      $q = $this->db->get('organisations');

      if ($q->num_rows() > 0) {
         return $q->result_array();
      } else {
         return false;
      }

   }//end of function get org type list


   function edit_addorg($edit_org_data, $edit_org_id) {


      //$this->db->set('column_header', $value); //value that used to update column  
      $this->db->where('org_id', $edit_org_id); //which row want to upgrade  

      $result = $this->db->update('organisations', $edit_org_data);

      if ($result) {
         return true;
      } else {
         return false;
      }
   }

// end of edit org funtion

   function edit_save_image_info($edit_image_data, $edit_org_id) {

      $this->db->select('ref_id');
      $this->db->where('ref_id', $edit_org_id);
      $result1 = $this->db->get('images');

      if ($result1->num_rows() > 0) {
         $this->db->where('ref_id', $edit_org_id); //which row want to upgrade  
         $r = $this->db->update('images', $edit_image_data);
      } else {
         $r = $this->db->insert('images', $edit_image_data);
      }


      if ($r) {
         return true;
      } else {
         return false;
      }
   }

// end of edit image info function 

   function delete_org_details($org_id) {

      $this->db->select('client_org_id, arch_org_id');
      $this->db->from('tenders');
      $this->db->where('client_org_id', $org_id);
      $this->db->or_where('arch_org_id', $org_id);
      $t = $this->db->get();

      $this->db->select('client_org_id, arch_org_id, contractor_org_id, pmc_org_id');
      $this->db->where('client_org_id', $org_id);
      $this->db->or_where('arch_org_id', $org_id);
      $this->db->or_where('contractor_org_id', $org_id);
      $this->db->or_where('pmc_org_id', $org_id);
      $this->db->from('projects');
      $p = $this->db->get();

      if ($t->num_rows() > 0 || $p->num_rows() > 0) {
         return false;
         exit();
      } else {
         $this->db->where('org_id', $org_id);
         $q = $this->db->delete('organisations');
         return $q;
      }
   }

// End of delete function

   function delete_org_img($org_id) {
      $this->db->where('ref_id', $org_id);
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
   }

// End of delete img function
}

// end of class