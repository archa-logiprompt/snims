<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Emailconfig_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get($id = null) {
		$admin=$this->session->userdata('admin');
        $this->db->select()->where('centre_id',$admin['centre_id'])->from('email_config');
        $this->db->order_by('id');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_emailbytype($email_type) {
        $this->db->select()->from('email_config');
        $this->db->where('email_type', $email_type);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function update_emailconfig($email_type) {
        $data = array(
            'smtp_username' => $this->input->post('smtp_username'),
            'smtp_password' => $this->input->post('smtp_password')
        );

        $this->db->where('email_type', $email_type);
        $this->db->update('email_config', $data);
    }

    public function add($data) {
		$admin=$this->session->userdata('admin');
        $this->db->select()->where('centre_id',$admin['centre-id'])->from('email_config');
        $q = $this->db->get();
        if ($q->num_rows() > 0) {
            $result = $q->row();
            $this->db->where('id', $result->id);
            $this->db->update('email_config', $data);
        } else {
            $this->db->insert('email_config', $data);
            return $this->db->insert_id();
        }
    }

    public function getActiveEmail() {
		$admin=$this->session->userdata('admin');
        $this->db->select()->where('centre_id',$admin['centre_id'])->from('email_config');
        $this->db->where('is_active', 'yes');
        $query = $this->db->get();
        return $query->row();
    }

}
