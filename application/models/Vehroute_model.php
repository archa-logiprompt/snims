<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vehroute_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function get($id = null) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];

        $this->db->select('vehicle_routes.*,transport_route.route_title,transport_route.fare')->from('vehicle_routes');
        $this->db->join('transport_route', 'transport_route.id = vehicle_routes.route_id');
        $this->db->where('vehicle_routes.centre_id',$centre_id);
        $this->db->group_by('vehicle_routes.route_id');
        if ($id != null) {
            $this->db->where('vehicle_routes.id', $id);
        } else {
            $this->db->order_by('vehicle_routes.id', 'DESC');
        }

        $query = $this->db->get();
        if ($id != null) {
            $vehicle_routes = $query->result_array();

            $array = array();
            if (!empty($vehicle_routes)) {
                foreach ($vehicle_routes as $vehicle_key => $vehicle_value) {
                    $vec_route = new stdClass();
                    $vec_route->id = $vehicle_value['id'];
                    $vec_route->route_title = $vehicle_value['route_title'];
                    $vec_route->fare = $vehicle_value['fare'];
                    $vec_route->route_id = $vehicle_value['route_id'];
                    $vec_route->vehicles = $this->getVechileByRoute($vehicle_value['route_id']);
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
                    $vec_route->route_title = $vehicle_value['route_title'];
                    $vec_route->fare = $vehicle_value['fare'];
                    $vec_route->route_id = $vehicle_value['route_id'];
                    $vec_route->vehicles = $this->getVechileByRoute($vehicle_value['route_id']);
                    $array[] = $vec_route;
                }
            }
            return $array;
        }
    }

    public function getVechileByRoute($route_id) {
        $this->db->select('vehicle_routes.id as vec_route_id,vehicles.*')->from('vehicle_routes');
        $this->db->join('vehicles', 'vehicles.id = vehicle_routes.vehicle_id');

        $this->db->where('vehicle_routes.route_id', $route_id);
        $this->db->order_by('vehicle_routes.id', 'DESC');
        $query = $this->db->get();
        return $vehicle_routes = $query->result();
    }

    public function getVechileDetailByVecRouteID($id) {
        $this->db->select('vehicle_routes.id as vec_route_id,vehicles.*,transport_route.route_title')->from('vehicle_routes');
        $this->db->join('vehicles', 'vehicles.id = vehicle_routes.vehicle_id');
        $this->db->join('transport_route', 'transport_route.id = vehicle_routes.route_id');
        $this->db->where('vehicle_routes.id', $id);
        $query = $this->db->get();
        return $vehicle_routes = $query->row();
    }

    public function listroute() {

        $listroute = $this->route_model->listroute();
        if (!empty($listroute)) {
            foreach ($listroute as $route_key => $route_value) {
                $vehicles = $this->getVechileByRoute($route_value['id']);
                $listroute[$route_key]['vehicles'] = $vehicles;
            }
        }
        return $listroute;
    }
    public function listroutestudent() {

        $listroute = $this->route_model->listrouteStudent();
        if (!empty($listroute)) {
            foreach ($listroute as $route_key => $route_value) {
                $vehicles = $this->getVechileByRoute($route_value['id']);
                $listroute[$route_key]['vehicles'] = $vehicles;
            }
        }
        return $listroute;
    }

    public function remove($route_id, $array) {
        $this->db->where('route_id', $route_id);
        $this->db->where_in('vehicle_id', $array);
        $this->db->delete('vehicle_routes');
    }

    public function removeByroute($route_id) {
        $this->db->where('route_id', $route_id);
        $this->db->delete('vehicle_routes');
    }

    public function add($data) {

        $admin=$this->session->userdata('admin');
        $centre_id = $admin['centre_id'];

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('vehicle_routes', $data);

            $transport_amount = $this->db->select('fare')->where('id',$data['route_id'])->get('transport_route')->row()->fare;

            $feegroupid =  $this->db->where('vehroute_id',$data['id'])->get('fee_groups')->row()->id;


            $feesessiondata = array(  
                'amount' => $transport_amount,  
            ); 
            $this->db->where('fee_groups_id',$feegroupid)->update('fee_groups_feetype',$feesessiondata); 

            return $data['id'];

        } else {
           

            foreach($data as $vehicledata){
                $this->db->insert('vehicle_routes', $vehicledata);

                // TODO Add transport to feemaster
                $vehroute_id = $this->db->insert_id();
                
    
                $transport_amount = $this->db->select('fare')->where('id',$vehicledata['route_id'])->get('transport_route')->row()->fare;
    
                $feegroup_name ='Transport Fee_'.$vehroute_id;   
                $feegroupdata = [
                    'centre_id'=>$centre_id,
                    'name' => $feegroup_name,
                    'year'=>22,
                    'class_id'=>'',
                    'is_system'=>0,
                    'section_id'=>'',
                    'description' => 'for transport fee collection',
                    'vehroute_id'=>$vehroute_id
                ];
                $insert_id = $this->feegroup_model->add($feegroupdata); 
                $feetype = $this->db->where('centre_id',$centre_id)->like('type','Transport')->get('feetype')->row()->id;
                
    
                $insert_array = array(
                    'centre_id'=>$centre_id,
                    'fee_groups_id' => $insert_id,
                    'feetype_id' => $feetype,
                    'amount' => $transport_amount, 
                    'session_id' => $this->setting_model->getCurrentSession(), 
                    'amounttype'=>0,
                    'finetype'=>0,
                    'fixedamount'=>0,
                    'percentage'=>0,
                    'addfine'=>0,
                    'is_visible'=>0
                ); 
    
                $this->feesessiongroup_model->add($insert_array);
            }
            




            return $vehroute_id;
        }
    }

    public function route_exists($str) {
        $route_id = $this->security->xss_clean($str);
        $pre_route_id = $this->input->post('pre_route_id');
        if (isset($pre_route_id)) {
            if ($route_id == $pre_route_id) {
                return TRUE;
            }
        }

        if ($this->check_data_exists($route_id)) {
            $this->form_validation->set_message('route_exists', 'Record already exists');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function check_data_exists($route_id) {
        $admin=$this->session->userdata('admin');
        $this->db->where('route_id', $route_id);
        $this->db->where('centre_id',$admin['centre_id']);
        $query = $this->db->get('vehicle_routes');
        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
