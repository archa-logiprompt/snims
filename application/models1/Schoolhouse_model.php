<?php
class Schoolhouse_model extends CI_model {

    public function get($id = null) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];

        if (!empty($id)) {

            $query = $this->db->where(array("id"=>$id,'centre_id'=>$centre_id))->get("school_houses");

            return $query->row_array();
        } else {
             
            $this->db->where('centre_id',$centre_id);
            $query = $this->db->get("school_houses");
            return $query->result_array();
        }
    }

    public function add($data) {

        if (isset($data["id"])) {

            $this->db->where("id", $data["id"])->update("school_houses", $data);
        } else {
            $this->db->insert("school_houses", $data);
        }
    }

    public function delete($id) {
        $admin=$this->session->userdata('admin');
        $centre_id=$admin['centre_id'];
         $this->db->where('centre_id',$centre_id);
        $this->db->where("id", $id)->delete("school_houses");
    }

}

?>