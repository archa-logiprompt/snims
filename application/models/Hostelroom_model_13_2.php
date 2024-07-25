<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Hostelroom_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    /**
     * This funtion takes id as a parameter and will fetch the record.
     * If id is not provided, then it will fetch all the records form the table.
     * @param int $id
     * @return mixed
     */
    public function get($id = null) {

        $admin=$this->session->userdata('admin');
        $this->db->select()->from('hostel_rooms');
        $this->db->where('centre_id',$admin['centre_id']);
        if ($id != null) {
            $this->db->where('id', $id);
        } else {
            $this->db->order_by('id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    /**
     * This function will delete the record based on the id
     * @param $id
     */
    public function remove($id) {
        $this->db->where('id', $id);
        $this->db->delete('hostel_rooms');
    }

    public function getRoomByHoselID($hostel_id) {
        $this->db->select('hostel_rooms.*,room_types.room_type');
        $this->db->from('hostel_rooms');
        $this->db->join('room_types', 'hostel_rooms.room_type_id = room_types.id');
        $this->db->where('hostel_rooms.hostel_id', $hostel_id);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * This function will take the post data passed from the controller
     * If id is present, then it will do an update
     * else an insert. One function doing both add and edit.
     * @param $data
     */
    public function add($data) {

        $admin=$this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('hostel_rooms', $data);

            $room_no = $data['room_no'];
            $hostel = $data['hostel_id'];

            $feegroup_name = 'Hostel Fee_'.$room_no.'_'.$hostel;  

            $feegroupdata = array( 
                'name' => $feegroup_name, 
            );

            $this->db->where('hostel_room_id',$data['id'])->update('fee_groups',$feegroupdata); 

            $feegroupid =  $this->db->where('hostel_room_id',$data['id'])->get('fee_groups')->row()->id;

            $feesessiondata = array( 
                'fee_groups_id' => $feegroupid, 
                'amount' => $this->input->post('cost_per_bed'),  
            ); 

            $this->db->where('fee_groups_id',$feegroupid)->update('fee_groups_feetype',$feesessiondata); 

            return $data['id'];

        } else {

            $this->db->insert('hostel_rooms', $data);
            
            $hostel_room_id =  $this->db->insert_id();
            $room_no = $data['room_no'];
            $hostel = $data['hostel_id'];

            $feegroup_name = 'Hostel Fee_'.$room_no.'_'.$hostel;  

            $data = array(
                'centre_id'=>$centre_id,
                'name' => $feegroup_name,
                'year'=>22,
                'class_id'=>'',
                'is_system'=>0,
                'section_id'=>'',
                'description' => 'for hostel fee collection',
                'hostel_room_id'=>$hostel_room_id
            );

            $insert_id = $this->feegroup_model->add($data); 
            $feetype = $this->db->where('centre_id',$centre_id)->like('type','Hostel')->get('feetype')->row()->id;

            $insert_array = array(
                'centre_id'=>$centre_id,
                'fee_groups_id' => $insert_id,
                'feetype_id' => $feetype,
                'amount' => $this->input->post('cost_per_bed'), 
                'session_id' => $this->setting_model->getCurrentSession(), 
                'amounttype'=>0,
                'finetype'=>0,
                'fixedamount'=>0,
                'percentage'=>0,
                'addfine'=>0,
                'is_visible'=>0
            ); 

            $this->feesessiongroup_model->add($insert_array);
            return $hostel_room_id;
        }
    }

    public function lists() {
        $admin=$this->session->userdata('admin');
        $this->db->select('hostel_rooms.*,b.hostel_name,c.room_type');
        $this->db->from('hostel_rooms');
        $this->db->join('hostel b', 'b.id=hostel_rooms.hostel_id');
        $this->db->join('room_types c', 'c.id=hostel_rooms.room_type_id');
        $this->db->where('hostel_rooms.centre_id',$admin['centre_id']);
        $listroomtype = $this->db->get();
        return $listroomtype->result_array();
    }
   public function listsstudent() {
        $admin=$this->session->userdata('student');
        $id = $admin['student_id']; 
        $this->db->select('hostel_rooms.*,b.hostel_name,c.room_type');
        $this->db->from('hostel_rooms');
        $this->db->join('hostel b', 'b.id=hostel_rooms.hostel_id');
        $this->db->join('room_types c', 'c.id=hostel_rooms.room_type_id');
        $this->db->join('students', 'students.hostel_room_id=hostel_rooms.id');
        $this->db->where('hostel_rooms.centre_id',$admin['centre_id']);
        $this->db->where('students.id',$id);
        $listroomtype = $this->db->get();
        return $listroomtype->result_array();
    }

    public function studentHostelDetails($carray = null) {
        
        $admin=$this->session->userdata('admin');
        $userdata = $this->customlib->getUserData();

        if (($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {
            if (!empty($carray)) {

                $this->db->where_in("student_session.class_id", $carray);
            } else {
                $this->db->where_in("student_session.class_id", "");
            }
        }
        $query = $this->db->select('students.firstname,students.id as sid,students.guardian_phone,students.admission_no,classes.class,sections.section,students.lastname,students.mobileno,hostel_rooms.*,hostel.hostel_name,room_types.room_type')->join('student_session', 'students.id = student_session.student_id')->join('sections', 'sections.id = student_session.section_id')->join('classes', 'classes.id = student_session.class_id')->join('hostel_rooms', 'hostel_rooms.id = students.hostel_room_id')->join('hostel', 'hostel.id = hostel_rooms.hostel_id')->join('room_types', 'room_types.id = hostel_rooms.room_type_id')->where('students.is_active', 'yes')->where('students.centre_id',$admin['centre_id'])->get("students");

        return $query->result_array();
    }

    public function searchHostelDetails($section_id, $class_id, $hostel_name = "") {
       
       $admin=$this->session->userdata('admin');
        if (!empty($hostel_name)) {

            $condition = array('student_session.section_id' => $section_id, 'student_session.class_id' => $class_id, 'hostel.hostel_name' => $hostel_name, 'students.is_active' => 'yes');
        } else {
            $condition = array('student_session.section_id' => $section_id, 'student_session.class_id' => $class_id, 'students.is_active' => 'yes');
        }
        $query = $this->db->select('students.firstname,students.id as sid, students.admission_no,,students.guardian_phone,classes.class,sections.section,students.lastname,students.mobileno,hostel_rooms.*,hostel.hostel_name,room_types.room_type')->join('student_session', 'students.id = student_session.student_id')->join('sections', 'sections.id = student_session.section_id')->join('classes', 'classes.id = student_session.class_id')->join('hostel_rooms', 'hostel_rooms.id = students.hostel_room_id')->join('hostel', 'hostel.id = hostel_rooms.hostel_id')->join('room_types', 'room_types.id = hostel_rooms.room_type_id')->where('students.centre_id',$admin['centre_id'])->where($condition)->order_by('students.firstname')->get("students");

        return $query->result_array();
    }

}
