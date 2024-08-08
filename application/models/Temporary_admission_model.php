<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Temporary_admission_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }
    public function update_status($id)
    {
     
        $this->db->where('id', $id);
        $this->db->update('temporary_admission', array('status' => 2));
        
    }
    public function create($data)
    {
        $this->db->insert('temporary_admission', $data);

        // $this->session->set_userdata('sub_menu', 'temporary/create');
    }
    public function upload_signature($data)
    {
        $this->db->insert('upload_signature', $data);
        return $this->db->insert_id(); // Return the inserted ID
    }
    public function signdelete($id)
    {
        $this->db->where('id',$id);
        $this->db->delete('upload_signature');
        $this->session->set_flashdata('msg', '<div class="alert alert-success"> Signature deleted successfully</div>');
        redirect('admin/temporary_admission/upload_signature');
    }
    
    public function update_signature($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('upload_signature', $data);
    }
    public function getalldocuments()
    {
       $res= $this->db->select('*')->get('upload_signature')->result_array();
       return $res;

    }

    public function getDocumentById($id)
{
    $query = $this->db->get_where('upload_signature', array('id' => $id));
    return $query->row_array();
}
        public function checkUser($username, $otp)
    {

        $user_id = $this->db->select('id,phone')->where('user_id', $username)->get('temporary_admission')->row();
        $this->db->where('id', $user_id->id)->update('temporary_admission', ['otp' => $otp]);
        return $user_id;
    }

    public function checkOtp($id, $otp)
    {
        $user_data = $this->db->where('id', $id)->where('otp', $otp)->get('temporary_admission')->row();
        return ($user_data);
    }
    public function getamountbasedoncategory($id)
    {
        $result = $this->db->select('temp_user.id as tid,admissionfees.id as aid ,admissionfees.*,admision_quota.id as aqid,admision_quota.*,feetype.id as fid,feetype.*')
            ->from('temp_user') // Specify the primary table
            ->where('temp_user.user_id', $id)
            ->join('admision_quota', 'admision_quota.id = temp_user.quota')
            ->join('admissionfees', 'admissionfees.fee_groups_id = admision_quota.id')
            ->join('feetype', 'feetype.id=admissionfees.feetype_id')
            ->get()
            ->result_array();
        // echo $this->db->last_query();exit;

        return $result;
    }
    public function getquota()
    {

        $res = $this->db->select('admision_quota.*')->from('admision_quota')->get()->result_array();

        return $res;

    }
    public function getdetails($txn_id)
    {
        $res=$this->db->select('details')->where('transaction_id', $txn_id)->get('admission_payment_session')->row_array();
  
        return $res;

    }
    public function pickupupdate($id, $curuserdata)
    {

        $data = array(
            'picked_by' => $curuserdata
        );
        $this->db->where('id', $id);
        $this->db->update('temporary_admission', $data);
        // echo $this->db->last_query();exit;

    }
    public function status($id)
    {

        $data = array(
            'status' => 1
        );
        $this->db->where('id', $id);
        $this->db->update('temporary_admission', $data);
        // echo $this->db->last_query();exit;

    }

    public function getstatus($id)
    {
        $res = $this->db->select('status')->from('temporary_admission')->where('id', $id)->get()->row_array();

        return $res;
    }
    public function pickedbyupdate($id)
    {

        $this->db->where('id', $id);
        $this->db->update('temporary_admission', ['picked_by' => null]);
    }
    public function getSectionByClass($class_id)
    {
        $result = $this->db->select('section,sections.id as section_id')->join('sections', 'sections.id=class_sections.section_id')->where('class_id', $class_id)->get('class_sections')->result_array();
        echo json_encode($result);
    }

    public function getscholar($id = null)
    {

        $this->db->select()->from('scholarship');
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
    public function getClass()
    {
        $result = $this->db->select('class,id')->where('centre_id', 2)->get('classes')->result_array();
        return $result;
    }
    public function getsections()
    {
        $result = $this->db->select('*')->get('sections')->result_array();

        return $result;
    }
    public function getcat($id = null)
    {

        $this->db->select()->from('categories');
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
    public function getfee($id = null)
    {

        $this->db->select()->from('feeyear');
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
    public function getexistingdetails($id)
    {
        $result = $this->db->select('firstname,lastname,email,phone')->where('id', $id)->from('temporary_admission')->get()->row();
        return $result;
    }
    public function getstudentdetails($id)
    {

        $result = $this->db->select('temp_user.*, temporary_admission.*,classes.*,sections.*,temporary_admission.id as uid')
            ->from('temp_user')
            ->join('temporary_admission', 'temporary_admission.id = temp_user.user_id')
            ->join('classes', 'temp_user.class_id=classes.id')
            ->join('sections', 'temp_user.section_id=sections.id')
            ->where('temp_user.user_id', $id)
            ->get()
            ->row_array();

        return $result;
    }
    public function getdatafromstudentdetails($id)
    {
        $result = $this->db->select('temp_user.*, temporary_admission.*')
            ->from('temporary_admission')
            ->join('temp_user', 'temp_user.user_id = temporary_admission.id', 'left')
            ->where('temporary_admission.id', $id)
            ->get()
            ->row();
        // echo $this->db->last_query();exit;
        return $result;

    }
    public function paymentsucceess($id)
    {
        $payment = $this->db->select('payment_suceess.*,temporary_admission.*')
            ->from('payment_suceess')
            // ->join('payment_suceess', 'payment_suceess.temporary_student_id = temporary_admission.id')
            ->join('temporary_admission', 'temporary_admission.id =payment_suceess.temporary_student_id')
            ->where('payment_suceess.temporary_student_id', $id)
            ->get()
            ->row_array();
            //   echo $this->db->last_query();exit;
        return $payment;
    }
    public function addcomment($data)
    {

        $this->db->insert('admission_comment', $data);
        // echo $this->db->last_query();exit;

    }
    public function commentdetails($id)
    {
        $res = $this->db->select('*')
            ->from('admission_comment')
            ->where('stud_id', $id)
            ->get()
            ->result_array();
        return $res;
    }

    public function add($data)
    {
        if (!empty($data) && isset($data['user_id'])) {
            $this->db->where('user_id', $data['user_id']);
            $query = $this->db->get('temp_user')->row();

            if ($query) {

                $this->db->where('user_id', $data['user_id']);
                $this->db->update('temp_user', $data);

                return $data['user_id'];
            } else {
                $this->db->insert('temp_user', $data);
                return $this->db->insert_id();
            }
        }
    }




}
