<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Classsection_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($classid = null) {
        $this->db->select('class_sections.id,class_sections.section_id,sections.section');
        $this->db->from('class_sections');
        $this->db->join('sections', 'sections.id = class_sections.section_id');
        $this->db->where('class_sections.class_id', $classid);
        $this->db->order_by('class_sections.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update($data) {

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('classes', $data);
        }
    }

    public function add($data, $sections) {
        $this->db->trans_begin();
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('classes', $data);
            $class_id = $data['id'];
        } else {
            $this->db->insert('classes', $data);
            $class_id = $this->db->insert_id();
        }


        $sections_array = array();
        foreach ($sections as $vec_key => $vec_value) {

            $vehicle_array = array(
                'class_id' => $class_id,
                'section_id' => $vec_value,
            );

            $sections_array[] = $vehicle_array;
        }
        $this->db->insert_batch('class_sections', $sections_array);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
    }

    public function getDetailbyClassSection($class_id, $section_id) {
        $this->db->select('class_sections.*,classes.class,sections.section')->from('class_sections');
        $this->db->where('class_id', $class_id);
        $this->db->where('section_id', $section_id);
        $this->db->join('classes', 'classes.id = class_sections.class_id');
        $this->db->where('class_sections.class_id', $class_id);
        $this->db->join('sections', 'sections.id = class_sections.section_id');
        $this->db->where('class_sections.section_id', $section_id);
        $query = $this->db->get();
        return $query->row_array();
    }

    function check_data_exists($data) {
        $this->db->where('class_id', $data['class_id']);
        $this->db->where('section_id', $data['section_id']);
        $query = $this->db->get('class_sections');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function getByID($id = null) {

        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];

        $this->db->select('classes.*')->from('classes');
        $this->db->where('centre_id',$centre_id);
        if ($id != null) {
            $this->db->where('classes.id', $id);
        } else {
            $this->db->order_by('classes.id', 'DESC');
        }

        $query = $this->db->get();
        if ($id != null) {
            $vehicle_routes = $query->result_array();

            $array = array();
            if (!empty($vehicle_routes)) {
                foreach ($vehicle_routes as $vehicle_key => $vehicle_value) {
                    $vec_route = new stdClass();
                    $vec_route->id = $vehicle_value['id'];


                    $vec_route->route_id = $vehicle_value['class'];
					 $vec_route->award = $vehicle_value['awarded_by'];
                    $vec_route->vehicles = $this->getVechileByRoute($vehicle_value['id']);
					
                    $array[] = $vec_route;
                }
            }
            return $array;
        } else {
            $vehicle_routes = $query->result_array();
            $array = array();
            if (!empty($vehicle_routes)) {
                foreach ($vehicle_routes as $vehicle_key => $vehicle_value) {

                    $vec_route = new stdClass();
                    $vec_route->id = $vehicle_value['id'];
                    $vec_route->class = $vehicle_value['class'];

                    $vec_route->vehicles = $this->getVechileByRoute($vehicle_value['id']);
                    $array[] = $vec_route;
                }
            }
            return $array;
        }
    }

    public function getVechileByRoute($route_id) {
        $this->db->select('class_sections.id as class_section_id,class_sections.class_id,class_sections.section_id,sections.*')->from('class_sections');
        $this->db->join('sections', 'sections.id = class_sections.section_id');

        $this->db->where('class_sections.class_id', $route_id);
        $this->db->order_by('class_sections.id', 'asc');
        $query = $this->db->get();
        return $vehicle_routes = $query->result();
    }

    public function remove($class_id, $array) {

        $this->db->where('class_id', $class_id);
        $this->db->where_in('section_id', $array);
        $this->db->delete('class_sections');
    }




    public function get_centre($id = null)
    {
        $admin=$this->session->userdata('admin');
		$this->db->select('*','center');
        if (!empty($id)) {

            $query = $this->db->where("id", $id)->get('centre');
            return $query->row_array();
        } else {

            $query = $this->db->get("centre");
            return $query->result_array();
        }
        
    }
    


  public function addcentre($data) {
       
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('centre', $data);
            //$class_id = $data['id'];
        } else {
            $this->db->insert('centre', $data);
            return $this->db->insert_id();
        }
    }
    




    public function check_exists_code($str) {
        $name = $this->security->xss_clean($str);
        $id = $this->input->post('id');
        
        
        
        if (!isset($id)) {
            $id = 0;
        }

        if ($this->check_duplicate_exists($name, $id)) {
            $this->form_validation->set_message('check_exists_code', 'Record already exists');
            return FALSE;
            
            
        } else {
            return TRUE;
        }
    }

    
function check_duplicate_exists($name, $id) {
        $this->db->where('centre_code', $name);
        $this->db->where('id !=', $id);

        $query = $this->db->get('centre')->num_rows();
        
        if ($query > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function addcentre_as_staff($data2)
    {
        
        
            $this->db->insert('staff', $data2);
            return $this->db->insert_id();
       
        
        
        
    }

    public function role($data)
{
    
    if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('staff_roles', $data);
            //$class_id = $data['id'];
        } else {
            $this->db->insert('staff_roles', $data);
            //return $this->db->insert_id();
        }
        
        }
    
    
 public function remove_centre($id) {

        $this->db->where('id', $id);
       
        $this->db->delete('centre');
    }
    
    



   

}
