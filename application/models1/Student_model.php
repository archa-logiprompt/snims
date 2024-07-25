<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Student_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
        $this->current_date = $this->setting_model->getDateYmd();
    }

    public function getStudents()
    {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,users.is_active as `user_tbl_active`')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->where('users.role', 'student');

        $this->db->order_by('students.id');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function getRecentRecord($id = null)
    {
        // $admin = $this->session->userdata('admin');
        // $centre_id = $admin['centre_id'];
        // $this->db->select('classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is')->from('students');
        // $this->db->join('student_session', 'student_session.student_id = students.id');
        // $this->db->join('classes', 'student_session.class_id = classes.id');
        // $this->db->join('sections', 'sections.id = student_session.section_id');
        // $this->db->where('student_session.session_id', $this->current_session);
        // $this->db->where('students.centre_id', $centre_id);
        // if ($id != null) {
        //     $this->db->where('students.id', $id);
        // } else {

        // }
        // $this->db->order_by('students.id', 'desc');
        // $this->db->limit(5);
        // $query = $this->db->get();
        // // echo $this->db->last_query();exit;
        // if ($id != null) {
        //     return $query->row_array();
        // } else {
        //     return $query->result_array();
        // }
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];

        $this->db->select('student_session.transport_fees,scholarship.id as scholarship_id,scholarship.name,scholarship.description,students.vehroute_id,vehicle_routes.route_id,vehicle_routes.vehicle_id,transport_route.route_title,vehicles.vehicle_no,hostel_rooms.room_no,vehicles.driver_name,vehicles.driver_contact,hostel.id as `hostel_id`,hostel.hostel_name,room_types.id as `room_type_id`,room_types.room_type ,students.hostel_room_id,student_session.id as `student_session_id`,student_session.fees_discount,classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.centre_id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode , students.note, students.religion, students.cast, school_houses.house_name,   students.dob ,students.current_address, students.previous_school,students.scholarship,
            students.guardian_is,students.parent_id,
            students.permanent_address,students.category_id,students.adhar_no,students.samagra_id,students.kuhs_reg_no,students.annual_income,students.year,students.nationality,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.father_pic ,students.height ,students.weight,students.measurement_date, students.mother_pic , students.guardian_pic , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.blood_group,students.school_house_id,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is,students.rte,students.guardian_email')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('hostel_rooms', 'hostel_rooms.id = students.hostel_room_id', 'left');
        $this->db->join('hostel', 'hostel.id = hostel_rooms.hostel_id', 'left');
        $this->db->join('room_types', 'room_types.id = hostel_rooms.room_type_id', 'left');
        $this->db->join('vehicle_routes', 'vehicle_routes.id = students.vehroute_id', 'left');
        $this->db->join('transport_route', 'vehicle_routes.route_id = transport_route.id', 'left');
        $this->db->join('vehicles', 'vehicles.id = vehicle_routes.vehicle_id', 'left');
        $this->db->join('school_houses', 'school_houses.id = students.school_house_id', 'left');
        $this->db->join('scholarship', 'students.scholarship=scholarship.id', 'left');
        if ($this->current_session != null) {
            $this->db->where('student_session.session_id', $this->current_session);
        }
        if ($centre_id != null) {
            $this->db->where('students.centre_id', $centre_id);
        }
        if ($id != null) {
            $this->db->where('students.id', $id);
        } else {
            $this->db->where('students.is_active', 'yes');
            $this->db->order_by('students.id', 'desc');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    
    }

    public function getRecentRecordStudent($id = null) {
        $admin=$this->session->userdata('student');
        $centre_id=$admin['centre_id'];
 
        if($admin['role']=='parent'){
            $centre_id=$this->db->where('id',$id)->get('students')->row()->centre_id;

        }
        $this->db->select('classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.centre_id',$centre_id);
        if ($id != null) {
            $this->db->where('students.id', $id);
        } else {
            
        }
        $this->db->order_by('students.id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    } 

    public function get($id = null)
    {

        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];

        $this->db->select('student_session.transport_fees,scholarship.id as scholarship_id,scholarship.name,scholarship.description,students.vehroute_id,vehicle_routes.route_id,vehicle_routes.vehicle_id,transport_route.route_title,vehicles.vehicle_no,hostel_rooms.room_no,vehicles.driver_name,vehicles.driver_contact,hostel.id as `hostel_id`,hostel.hostel_name,room_types.id as `room_type_id`,room_types.room_type ,students.hostel_room_id,student_session.id as `student_session_id`,student_session.fees_discount,classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.centre_id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode , students.note, students.religion, students.cast, school_houses.house_name,   students.dob ,students.current_address, students.previous_school,students.scholarship,
            students.guardian_is,students.parent_id,
            students.permanent_address,students.category_id,students.adhar_no,students.samagra_id,students.kuhs_reg_no,students.annual_income,students.year,students.nationality,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.father_pic ,students.height ,students.weight,students.measurement_date, students.mother_pic , students.guardian_pic , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.blood_group,students.school_house_id,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is,students.rte,students.guardian_email')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('hostel_rooms', 'hostel_rooms.id = students.hostel_room_id', 'left');
        $this->db->join('hostel', 'hostel.id = hostel_rooms.hostel_id', 'left');
        $this->db->join('room_types', 'room_types.id = hostel_rooms.room_type_id', 'left');
        $this->db->join('vehicle_routes', 'vehicle_routes.id = students.vehroute_id', 'left');
        $this->db->join('transport_route', 'vehicle_routes.route_id = transport_route.id', 'left');
        $this->db->join('vehicles', 'vehicles.id = vehicle_routes.vehicle_id', 'left');
        $this->db->join('school_houses', 'school_houses.id = students.school_house_id', 'left');
        $this->db->join('scholarship', 'students.scholarship=scholarship.id', 'left');
        if ($this->current_session != null) {
            $this->db->where('student_session.session_id', $this->current_session);
        }
        if ($centre_id != null) {
            $this->db->where('students.centre_id', $centre_id);
        }
        if ($id != null) {
            $this->db->where('students.id', $id);
        } else {
            $this->db->where('students.is_active', 'yes');
            $this->db->order_by('students.id', 'desc');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function search_student()
    {
        $this->db->select('classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode , tudents.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id,    students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->where('student_session.session_id', $this->current_session);
        if ($id != null) {
            $this->db->where('students.id', $id);
        } else {
            $this->db->order_by('students.id');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }

    public function getstudentdoc($id)
    {
        $this->db->select()->from('student_doc');
        $this->db->where('student_id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchByClassSection($class_id = null, $section_id = null, $subject_id = null)
    {
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id as student_id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state , classes.awarded_by,  students.city , students.pincode ,     students.religion, students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.kuhs_reg_no,students.nationality,students.date_completion, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender,students.year,students.email,students.virtual_acc_no')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        //$this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');

        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', "yes");


        if ($class_id != null) {
            $this->db->where('students.centre_id', $centre_id);
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }

        $this->db->order_by('students.firstname');

        // $this->db->order_by('students.admission_no','asc');

        $query = $this->db->get();

        return $query->result_array();

    }

    public function searchAllByClassSection($class_id = null, $section_id = null, $subject_id = null)
    {
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id as student_id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state , classes.awarded_by,  students.city , students.pincode ,     students.religion, students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.kuhs_reg_no,students.nationality,students.date_completion, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender,students.year,students.email,students.virtual_acc_no')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        //$this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');

        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', "yes");


        if ($class_id != null) {
            $this->db->where('students.centre_id', $centre_id);
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }

        //$this->db->order_by('students.id');
        $this->db->order_by('students.admission_no', 'asc');

        $query = $this->db->get();

        return $query->result_array();

    }

    public function searchByClassSectionFull($class_id = null, $section_id = null, $subject_id = null)
    {
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id as student_id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state , classes.awarded_by,  students.city , students.pincode ,     students.religion, students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.kuhs_reg_no,students.nationality,students.date_completion, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender,students.year,students.email,students.virtual_acc_no')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        //$this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');

        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', "yes");


        if ($class_id != null) {
            $this->db->where('students.centre_id', $centre_id);
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }

        //$this->db->order_by('students.id');
        $this->db->order_by('students.admission_no', 'asc');

        $query = $this->db->get();

        return $query->result_array();

    }

    public function getstudentByclasssection($class, $section)
    {

        $this->db->select('clinical_group.student_session_id')->from('clinical_group');
        $this->db->where('session_id', $this->current_session);
        $res = $this->db->get();
        $student = $res->result_array();

        $ar = array();


        foreach ($student as $st) {
            array_push($ar, $st['student_session_id']);

        }



        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id as student_id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state , classes.awarded_by,  students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.kuhs_reg_no,students.nationality,students.date_completion, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', "yes");

        $this->db->where('student_session.class_id', $class);

        $this->db->where('student_session.section_id', $section);
        if (!empty($ar)) {
            $this->db->where_not_in('student_session.id', $ar);
        }

        $this->db->order_by('students.admission_no', 'asc');

        $query = $this->db->get();

        return $query->result_array();



    }

    public function getstudentByclasssectionforgroup($class, $section)
    {

        $this->db->select('our_group.student_session_id')->from('our_group');
        $this->db->where('session_id', $this->current_session);
        $res = $this->db->get();
        $student = $res->result_array();

        $ar = array();


        foreach ($student as $st) {
            array_push($ar, $st['student_session_id']);

        }



        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id as student_id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state , classes.awarded_by,  students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.kuhs_reg_no,students.nationality,students.date_completion, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', "yes");

        $this->db->where('student_session.class_id', $class);

        $this->db->where('student_session.section_id', $section);
        if (!empty($ar)) {
            $this->db->where_not_in('student_session.id', $ar);
        }

        $this->db->order_by('students.admission_no', 'asc');

        $query = $this->db->get();

        return $query->result_array();



    }







    public function searchbygroup($class, $section)
    {


        $this->db->select('clinical_group.group_id,clinical_group.student_session_id,clinical_groupname.group_name')->from('clinical_group');

        $this->db->join('clinical_groupname', 'clinical_groupname.id=clinical_group.group_id');
        $this->db->where('clinical_group.class_id', $class);

        $this->db->where('clinical_group.section_id', $section);

        $this->db->group_by('clinical_group.group_id');
        $res = $this->db->get();
        return $res->result_array();


    }












    public function searchByClassSectionWithoutCurrent($class_id = null, $section_id = null, $student_id = null)
    {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', "yes");
        $this->db->where('students.id !=', $student_id);
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        $this->db->order_by('students.id');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function searchByClassSectionCategoryGenderRte(
        $class_id = null,
        $section_id = null
        ,
        $category = null,
        $gender = null,
        $rte = null
    ) {

        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,students.category_id, categories.category,   students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->where('students.centre_id', $centre_id);
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        if ($category != null) {
            $this->db->where('students.category_id', $category);
        }
        if ($gender != null) {
            $this->db->where('students.gender', $gender);
        }
        if ($rte != null) {
            $this->db->where('students.rte', $rte);
        }
        $this->db->order_by('students.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchFullText($searchterm, $carray = null)
    {
        $userdata = $this->customlib->getUserData();

        if (($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {
            if (!empty($carray)) {

                $this->db->where_in("student_session.class_id", $carray);
            } else {
                $this->db->where_in("student_session.class_id", "");
            }
        }




        $this->db->select('classes.id AS `class_id`,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,      students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.gender,students.rte,student_session.session_id')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->group_start();

        $this->db->like('students.full_name', $searchterm);
        $this->db->or_like('students.firstname', $searchterm);
        $this->db->or_like('students.lastname', $searchterm);
        $this->db->or_like('students.guardian_name', $searchterm);
        $this->db->or_like('students.adhar_no', $searchterm);
        $this->db->or_like('students.samagra_id', $searchterm);
        $this->db->or_like('students.roll_no', $searchterm);
        $this->db->or_like('students.admission_no', $searchterm);
        $this->db->group_end();
        $this->db->order_by('students.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getStudentListBYStudentsessionID($array)
    {
        $array = implode(',', $array);
        $sql = ' SELECT students.* FROM students INNER join (SELECT * FROM `student_session` WHERE `student_session`.`id` IN (' . $array . ')) as student_session on students.id=student_session.student_id';
        $query = $this->db->query($sql);
        return $query->result();
    }

    public function remove($id)
    {
        $this->db->trans_start();

        $sql = "SELECT * FROM `users` WHERE childs LIKE '%," . $id . ",%' OR childs LIKE '" . $id . ",%' OR childs LIKE '%," . $id . "' OR childs = " . $id;
        $query = $this->db->query($sql);


        if ($query->num_rows() > 0) {
            $result = $query->row();
            $array_slice = explode(',', $result->childs);
            if (count($array_slice) > 1) {
                $arr = array_diff($array_slice, array($id));
                $update = implode(",", $arr);
                $data = array('childs' => $update);

                $this->db->where('id', $result->id);
                $this->db->update('users', $data);
            } else {
                $this->db->where('id', $result->id);
                $this->db->delete('users');
            }
        }

        $this->db->where('id', $id);
        $this->db->delete('students');

        $this->db->where('student_id', $id);
        $this->db->delete('student_session');



        $this->db->where('user_id', $id);
        $this->db->where('role', 'student');
        $this->db->delete('users');
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        } else {
            return true;
        }
    }

    public function doc_delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('student_doc');

        $this->db->where('documents', $id);
        $this->db->delete('student_returndoc');

    }

    public function returnsubmit($id)
    {
        $data = array('status' => 0);
        $this->db->where('documents', $id);
        $this->db->update('student_returndoc', $data);
    }

    public function add($data)
    {

        
        $userdata = $this->customlib->getLoggedInUserData();
        $centre_id = $userdata['centre_id'];
        $data['centre_id'] = $centre_id;
        if (isset($data['id'])) {
            // var_dump($data);exit;
            $this->db->where('id', $data['id']);
            $this->db->update('students', $data);
        } else {
            $this->db->insert('students', $data);
            // echo $this->db->last_query();exit;

            return $this->db->insert_id();
        }
    }

    public function add_student_sibling($data_sibling)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('student_sibling', $data_sibling);
        } else {
            $this->db->insert('student_sibling', $data_sibling);
            return $this->db->insert_id();
        }
    }

    public function add_student_session($data)
    {
        $this->db->where('session_id', $data['session_id']);
        $this->db->where('student_id', $data['student_id']);
        $q = $this->db->get('student_session');
        if ($q->num_rows() > 0) {
            $rec = $q->row_array();
            $this->db->where('id', $rec['id']);
            $this->db->update('student_session', $data);
        } else {
            $this->db->insert('student_session', $data);
            return $this->db->insert_id();
        }
    }

    public function add_student_session_update($data)
    {
        $this->db->where('session_id', $data['session_id']);
        $q = $this->db->get('student_session');
        if ($q->num_rows() > 0) {
            $this->db->where('session_id', $student_session);
            $this->db->update('student_session', $data);
        } else {
            $this->db->insert('student_session', $data);
            return $this->db->insert_id();
        }
    }

    public function addreturndoc($data)
    {
        $this->db->insert('student_returndoc', $data);
        return $this->db->insert_id();
    }


    public function adddoc($data)
    {
        $this->db->insert('student_doc', $data);
        return $this->db->insert_id();
    }

    public function read_siblings_students($parent_id)
    {
        $this->db->select('*')->from('students');
        $this->db->where('parent_id', $parent_id);
        $this->db->where('students.is_active', 'yes');
        $query = $this->db->get();
        return $query->result();
    }

    public function getMySiblings($parent_id, $student_id)
    {


        $this->db->select('students.*,classes.id as `class_id`,classes.class,sections.id as `section_id`,sections.section,student_session.session_id as `session_id`')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where_not_in('students.id', $student_id);
        $this->db->where('students.parent_id', $parent_id);
        $this->db->where('students.is_active', 'yes');
        $query = $this->db->get();
        return $query->result();
    }

    public function getAttedenceByDateandClass($date)
    {
        $sql = "SELECT IFNULL(student_attendences.id, 0) as attencence FROM `student_session`left JOIN student_attendences on student_attendences.student_session_id=student_session.id and student_attendences.date=" . $this->db->escape($date) . " and student_attendences.attendence_type_id != 2 where student_session.class_id=7 and student_session.session_id=$this->current_session";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function searchCurrentSessionStudents()
    {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);

        $this->db->order_by('students.firstname', 'asc');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchLibraryStudent($class_id = null, $section_id = null)
    {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,
           IFNULL(libarary_members.id,0) as `libarary_member_id`,
           IFNULL(libarary_members.library_card_no,0) as `library_card_no`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image, students.mobileno, students.email ,students.state ,   students.city , students.pincode ,students.religion,students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('libarary_members', 'libarary_members.member_id = students.id and libarary_members.member_type = "student"', 'left');


        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        $this->db->order_by('students.id');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchNameLike($searchterm)
    {
        $this->db->select('classes.id AS `class_id`,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,      students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.gender,students.rte,student_session.session_id')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->group_start();
        $this->db->like('students.firstname', $searchterm);
        $this->db->or_like('students.lastname', $searchterm);
        $this->db->group_end();
        $this->db->order_by('students.id');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchGuardianNameLike($searchterm)
    {
        $this->db->select('classes.id AS `class_id`,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.gender,students.guardian_email,students.rte,student_session.session_id')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'yes');
        $this->db->group_start();
        $this->db->like('students.guardian_name', $searchterm);

        $this->db->group_end();
        $this->db->order_by('students.id');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function searchByClassSectionWithSession($class_id = null, $section_id = null, $session_id = null)
    {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        $this->db->order_by('students.id');

        $query = $this->db->get();
        return $query->result_array();
    }

    function getPreviousSessionStudent($previous_session_id, $class_id, $section_id)
    {
        $admin = $this->session->userdata('admin');

        $sql = "SELECT student_session.student_id as student_id, student_session.id as current_student_session_id, student_session.class_id as current_session_class_id ,previous_session.id as previous_student_session_id,students.firstname,students.lastname,students.admission_no,students.roll_no,students.father_name,students.admission_date FROM `student_session` left JOIN (SELECT * FROM `student_session` where session_id=$previous_session_id) as previous_session on student_session.student_id=previous_session.student_id INNER join students on students.id =student_session.student_id where student_session.session_id=$this->current_session and student_session.class_id=$class_id and student_session.section_id=$section_id and students.is_active='yes' and students.centre_id=" . $admin['centre_id'] . "  ORDER BY students.firstname ASC";

        $query = $this->db->query($sql);
        return $query->result();
    }

    function studentGuardianDetails($carray)
    {
        $userdata = $this->customlib->getUserData();
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $this->db->SELECT("students.admission_no,students.firstname,students.mobileno,students.father_phone,students.mother_phone,students.lastname,students.father_name,students.mother_name,students.guardian_name,students.guardian_relation,students.guardian_phone,students.id,classes.class,sections.section");
        $this->db->join("student_session", "student_session.student_id = students.id");
        $this->db->join("classes", "student_session.class_id = classes.id");
        $this->db->join("sections", "student_session.section_id = sections.id");
        $this->db->where("students.is_active", "yes");
        $this->db->where('students.centre_id', $centre_id);
        $this->db->where('student_session.session_id', $this->current_session);
        if (($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {

            if (!empty($carray)) {

                $this->db->where_in("student_session.class_id", $carray);
            } else {
                $this->db->where_in("student_session.class_id", "");
            }
        }
        $query = $this->db->get("students");

        return $query->result_array();
    }

    function searchGuardianDetails($class_id, $section_id)
    {

        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $this->db->SELECT("students.admission_no,students.firstname,students.lastname,students.mobileno,students.father_phone,students.mother_phone,students.father_name,students.mother_name,students.guardian_name,students.guardian_relation,students.guardian_phone,students.id,classes.class,sections.section");
        $this->db->join("student_session", "student_session.student_id = students.id");
        $this->db->join("classes", "student_session.class_id = classes.id");
        $this->db->join("sections", "student_session.section_id = sections.id");
        $this->db->where("students.is_active", "yes");
        $this->db->where('students.centre_id', $centre_id);
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where(array('student_session.class_id' => $class_id, 'student_session.section_id' => $section_id, ));
        $query = $this->db->get("students");

        return $query->result_array();
    }

    function studentAdmissionDetails($carray = null)
    {

        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $userdata = $this->customlib->getUserData();
        if (($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {

            if (!empty($carray)) {

                $this->db->where_in("student_session.class_id", $carray);
            } else {
                $this->db->where_in("student_session.class_id", "");
            }
        }
        $query = $this->db->SELECT("students.firstname,students.lastname,students.is_active, students.mobileno, students.id as sid ,students.admission_no, students.admission_date, students.guardian_name, students.guardian_relation, students.guardian_phone, classes.class, sessions.id, sections.section")->join("student_session", "students.id = student_session.student_id")->join("classes", "student_session.class_id = classes.id")->join("sections", "student_session.section_id = sections.id")->join("sessions", "student_session.session_id = sessions.id")->where('students.centre_id', $centre_id)->group_by("students.id")->get("students");

        return $query->result_array();
    }

    function studentSessionDetails($id)
    {

        $query = $this->db->query("SELECT min(sessions.session) as start , max(sessions.session) as end, min(classes.class) as startclass, max(classes.class) as endclass from sessions join student_session on (sessions.id = student_session.session_id) join classes on (classes.id = student_session.class_id) where student_session.student_id = " . $id);



        return $query->row_array();
    }

    public function searchAdmissionDetails($class_id, $year)
    {

        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        if (!empty($year)) {

            $data = array('year(admission_date)' => $year);
        } else {
            $data = array('student_session.class_id' => $class_id);
        }


        $query = $this->db->SELECT("students.firstname,students.lastname,students.is_active, students.mobileno, students.id as sid ,students.admission_no, students.admission_date, students.guardian_name, students.guardian_relation, students.guardian_phone, classes.class, sessions.id, sections.section")->join("student_session", "students.id = student_session.student_id")->join("classes", "student_session.class_id = classes.id")->join("sections", "student_session.section_id = sections.id")->join("sessions", "student_session.session_id = sessions.id")->where('students.centre_id', $centre_id)->where($data)->group_by("students.id")->get("students");

        return $query->result_array();
    }

    public function admissionYear()
    {

        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $query = $this->db->SELECT("distinct(year(admission_date)) as year")->where('centre_id', $centre_id)->get("students");

        return $query->result_array();
    }

    public function getStudentSession($id)
    {

        $query = $this->db->query("SELECT  max(sessions.id) as student_session_id, max(sessions.session) as session from sessions join student_session on (sessions.id = student_session.session_id)  where student_session.student_id = " . $id);

        return $query->row_array();

    }

    public function studentSessionlist($id)
    {
        $query = $this->db->query("SELECT student_session.session_id   from student_session   where student_session.student_id = " . $id);

        return $query->result_array();

    }





    public function valid_student_roll()
    {
        $roll_no = $this->input->post('roll_no');
        $student_id = $this->input->post('studentid');
        $class = $this->input->post('class_id');

        if ($roll_no != "") {

            if (!isset($student_id)) {
                $student_id = 0;
            }

            if ($this->check_rollno_exists($roll_no, $student_id, $class)) {
                $this->form_validation->set_message('check_exists', 'Roll Number should be unique at Class level');
                return FALSE;
            } else {
                return TRUE;
            }
        }
        return TRUE;
    }

    function check_rollno_exists($roll_no, $student_id, $class)
    {
        $admin = $this->session->userdata('admin');

        if ($student_id != 0) {
            $data = array('students.id != ' => $student_id, 'student_session.class_id' => $class, 'students.roll_no' => $roll_no);
            $query = $this->db->where($data)->where('students.centre_id', $admin['centre_id'])->join("student_session", "students.id = student_session.student_id")->get('students');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else {
            $this->db->where('students.centre_id', $admin['centre_id']);
            $this->db->where(array('class_id' => $class, 'roll_no' => $roll_no));
            $query = $this->db->join("student_session", "students.id = student_session.student_id")->get('students');
            if ($query->num_rows() > 0) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

    }

    function gethouselist()
    {

        $query = $this->db->where("is_active", "yes")->get("school_houses");

        return $query->result_array();
    }

    function disableStudent($id, $data)
    {

        $this->db->where("id", $id)->update("students", $data);
    }

    function getdisableStudent()
    {

        $this->db->select('classes.id AS `class_id`,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,      students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.gender,students.rte,student_session.session_id')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'no');
        $this->db->order_by('students.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    function disablestudentByClassSection($class, $section)
    {

        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', "no");
        if ($class != null) {
            $this->db->where('student_session.class_id', $class);
        }
        if ($section != null) {
            $this->db->where('student_session.section_id', $section);
        }
        $this->db->order_by('students.id');

        $query = $this->db->get();
        return $query->result_array();
    }

    function disablestudentFullText($searchterm)
    {
        $userdata = $this->customlib->getUserData();
        $this->db->select('classes.id AS `class_id`,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,      students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code ,students.father_name , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.gender,students.rte,student_session.session_id')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', 'no');
        if (($userdata["role_id"] == 2) && ($userdata["class_teacher"] == "yes")) {

            if (!empty($carray)) {

                $this->db->where_in("student_session.class_id", $carray);
            } else {
                $this->db->where_in("student_session.class_id", "");
            }
        } else {
            $this->db->group_start();
            $this->db->like('students.firstname', $searchterm);
            $this->db->or_like('students.lastname', $searchterm);
            $this->db->or_like('students.guardian_name', $searchterm);
            $this->db->or_like('students.adhar_no', $searchterm);
            $this->db->or_like('students.samagra_id', $searchterm);
            $this->db->or_like('students.roll_no', $searchterm);
            $this->db->or_like('students.admission_no', $searchterm);
            $this->db->group_end();
        }
        $this->db->order_by('students.id');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getClassSection($id)
    {

        $query = $this->db->SELECT("*")->join("sections", "class_sections.section_id = sections.id")->where("class_sections.class_id", $id)->get("class_sections");
        return $query->result_array();
    }

    public function getStudentClassSection($id, $sessionid)
    {

        $query = $this->db->SELECT("students.firstname,students.admission_no,students.id,students.lastname,students.image,student_session.section_id")->join("student_session", "students.id = student_session.student_id")->where("student_session.class_id", $id)->where("student_session.session_id", $sessionid)->where("students.is_active", "yes")->get("students");

        return $query->result_array();
        //SELECT `students`.`firstname`, `students`.`id`, `students`.`lastname`, `students`.`image`, `student_session`.`section_id` FROM `students` JOIN `student_session` ON `students`.`id` = `student_session`.`student_id` WHERE `student_session`.`class_id` = '1' AND `student_session`.`session_id` = '14' AND `students`.`is_active` = 'yes'
    }

    // public function getStudentsByArray($array) {
    //     $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,students.blood_group ,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.mother_name,students.updated_at,students.father_name,students.rte,students.gender,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,users.is_active as `user_tbl_active`')->from('students');
    //     $this->db->join('student_session', 'student_session.student_id = students.id');
    //     $this->db->join('classes', 'student_session.class_id = classes.id');
    //     $this->db->join('sections', 'sections.id = student_session.section_id');
    //     $this->db->join('categories', 'students.category_id = categories.id', 'left');
    //     $this->db->join('users', 'users.user_id = students.id', 'left');
    //     $this->db->where('student_session.session_id', $this->current_session);
    //     $this->db->where('users.role', 'student');
    //     $this->db->where_in('students.id', $array);
    //     $this->db->order_by('students.id');

    //     $query = $this->db->get();
    //     return $query->result();
    // }

    public function getStudentsByArray($array)
    {
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,students.blood_group ,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.mother_name,students.updated_at,students.father_name,students.rte, if (gender="male","He","She") as gender,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,users.is_active as `user_tbl_active`')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->join('users', 'users.user_id = students.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('users.role', 'student');
        
        $this->db->where_in('students.id', $array);
        $this->db->order_by('students.id');
        $this->db->group_by('student_session_id');

        $query = $this->db->get();
        // echo $this->db->last_query();
        return $query->result();
    }

    function get_studentsession($student_session_id)
    {

        $query = $this->db->select('sessions.session')->join("student_session", "sessions.id = student_session.session_id")->where('student_session.id', $student_session_id)->get("sessions");
        return $query->row_array();
    }


    public function searchByFeereport($class_id = null, $section_id = null)
    {
        $this->db->select('class.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id, students.roll_no,students.firstname,  students.lastname,students.image, students.mobileno, students.email ,students.state ,   students.city , students.pincode , students.religion, students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', "yes");
        if ($class_id != null) {
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        $this->db->order_by('students.id');
        $this->db->order_by('students.admission_no', 'asc');

        $query = $this->db->get();

        return $query->result_array();
    }


    /*public function getStudentsByArray($array) {
          $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode ,     students.religion,     students.dob ,students.current_address,students.blood_group ,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.mother_name,students.updated_at,students.father_name,students.rte,students.gender,users.id as `user_tbl_id`,users.username,users.password as `user_tbl_password`,users.is_active as `user_tbl_active`')->from('students');
          $this->db->join('student_session', 'student_session.student_id = students.id');
          $this->db->join('classes', 'student_session.class_id = classes.id');
          $this->db->join('sections', 'sections.id = student_session.section_id');
          $this->db->join('categories', 'students.category_id = categories.id', 'left');
          $this->db->join('users', 'users.user_id = students.id', 'left');
          $this->db->where('student_session.session_id', $this->current_session);
          $this->db->where('users.role', 'student');
          $this->db->where_in('students.id', $array);
          $this->db->order_by('students.id');

          $query = $this->db->get();
          return $query->result();
      }*/








    public function scholarship($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('scholarship', $data);
        } else {
            $data['session_id'] = $this->current_session;
            $this->db->insert('scholarship', $data);
            return $this->db->insert_id();
        }
    }




    public function getscholarship($id = null)
    {
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $this->db->select()->from('scholarship');
        $this->db->where('centre_id', $centre_id);
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


    public function removescholar($id)
    {
        $this->db->where('id', $id)->delete('scholarship');


    }



    public function getstudent_scholarship($id)
    {

        $this->db->select('student_session.*,classes.class,sections.section,students.*')->from('student_session');
        $this->db->join('students', 'student_session.student_id=students.id');
        $this->db->join('classes', 'student_session.class_id=classes.id');
        $this->db->join('sections', 'sections.id=student_session.section_id');
        $this->db->where('students.scholarship', $id);
        $query = $this->db->get();
        return $query->result();
    }



    /*$this->db->select('student.*,sch.scholarsip')->from('students');
    $this->db->where('classes_id', $classes_id);
    $this->db->where('section_id', $section_id);
    $this->db->join('classes', 'classes.id = student.parent_id');
    $this->db->where('class_sections.class_id', $class_id);
    $this->db->join('sections', 'sections.id = class_sections.section_id');
    $this->db->where('class_sections.section_id', $section_id);
    $query = $this->db->get();
    return $query->result_array();*/

    public function removeward($id)
    {
        $this->db->where('id', $id);

        $this->db->delete('warddetail');
    }



    public function edit($id = null)
    {
        $this->db->select()->from('warddetail');

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

    public function get_warddetails($id = null)
    {
        $this->db->select()->from('warddetail');

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




    public function warddetails()
    {

        $this->db->select('warddetail.id,warddetail.wardname,warddetail.aliasname')->from('warddetail');
        $res = $this->db->get();
        return $res->result_array();

    }





    public function add_warddetail($data)
    {
        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('warddetail', $data);
        } else {
            $this->db->insert('warddetail', $data);
            return $this->db->insert_id();
        }
    }



    public function assign_ward($data)
    {

        $this->db->insert('assign_ward', $data);
        return $this->db->insert_id();
    }

    public function add_clinical_department($data)
    {

        if (isset($data['id'])) {
            $this->db->where('id', $data['id']);
            $this->db->update('clinical_department', $data);
        } else {
            $this->db->insert('clinical_department', $data);

            return $this->db->insert_id();
        }
    }

    public function get_clinical_department($id = null)
    {
        $this->db->select()->from('clinical_department');

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


    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('clinical_department');
    }



    public function viewassign_ward($class_id, $section_id)
    {

        $this->db->select('assign_ward.id as assign_ward_id,assign_ward.class_id,assign_ward.section_id,assign_ward.group_id,assign_ward.ward_id,assign_ward.datefrom,assign_ward.dateto,clinical_groupname.group_name,sections.section,classes.class,warddetail.wardname,warddetail.aliasname,warddetail.deptnames,clinical_department.deptname')->from('assign_ward');
        $this->db->join('warddetail', 'warddetail.id=assign_ward.ward_id');
        $this->db->join('clinical_department', 'clinical_department.id=warddetail.deptnames');
        $this->db->join('clinical_groupname', 'clinical_groupname.id=assign_ward.group_id');
        $this->db->join('sections', 'sections.id=assign_ward.section_id');
        $this->db->join('classes', 'classes.id=assign_ward.class_id');

        $this->db->where(array('assign_ward.class_id' => $class_id, 'assign_ward.section_id' => $section_id, 'assign_ward.session_id' => $this->current_session));

        $res = $this->db->get();
        $result = $res->result_array();


        $arr = array();
        if (!empty($res)) {

            foreach ($result as $key => $val) {
                $a = new stdClass();
                $a->assign_ward_id = $val['assign_ward_id'];
                $a->section_id = $val['section_id'];
                $a->class_id = $val['class_id'];
                $a->wardname = $val['wardname'];
                $a->aliasname = $val['aliasname'];
                $a->deptname = $val['deptname'];
                $a->datefrom = $val['datefrom'];
                $a->dateto = $val['dateto'];
                $a->section = $val['section'];
                $a->class = $val['class'];
                $a->group_name = $val['group_name'];
                $a->group_id = $val['group_id'];
                $a->student_count = $this->get_countofstudent($val['group_id']);
                $arr[] = $a;

            }


            return $arr;


        }



    }





    function get_countofstudent($group_id)
    {

        $this->db->select('clinical_group.student_session_id')->from('clinical_group');
        $this->db->where('group_id', $group_id);
        $val = $this->db->get();
        $student = $val->result();
        $c = count($student);
        return $c;


    }


    public function viewallassign_ward()
    {

        $this->db->select('assign_ward.id as assign_ward_id,assign_ward.class_id,assign_ward.section_id,assign_ward.group_id,assign_ward.ward_id,assign_ward.datefrom,assign_ward.dateto,clinical_groupname.group_name,sections.section,classes.class,warddetail.wardname,warddetail.aliasname,warddetail.deptnames,clinical_department.deptname')->from('assign_ward');
        $this->db->join('warddetail', 'warddetail.id=assign_ward.ward_id');
        $this->db->join('clinical_groupname', 'clinical_groupname.id=assign_ward.group_id');
        $this->db->join('sections', 'sections.id=assign_ward.section_id');
        $this->db->join('classes', 'classes.id=assign_ward.class_id');
        $this->db->join('clinical_department', 'clinical_department.id=warddetail.deptnames');
        //$this->db->where(array('assign_ward.class_id'=>$class_id,'assign_ward.section_id'=>$section_id));
        $this->db->order_by('sections.id');

        $res = $this->db->get();
        $result = $res->result_array();


        $arr = array();
        if (!empty($res)) {

            foreach ($result as $key => $val) {
                $a = new stdClass();
                $a->assign_ward_id = $val['assign_ward_id'];
                $a->section_id = $val['section_id'];
                $a->class_id = $val['class_id'];
                $a->wardname = $val['wardname'];
                $a->aliasname = $val['aliasname'];
                $a->deptname = $val['deptname'];
                $a->datefrom = $val['datefrom'];
                $a->dateto = $val['dateto'];
                $a->section = $val['section'];
                $a->class = $val['class'];
                $a->group_name = $val['group_name'];
                $a->group_id = $val['group_id'];
                $a->student_count = $this->get_countofstudent($val['group_id']);
                $arr[] = $a;

            }


            return $arr;


        }



    }














    public function getstudentdetail($group_id)
    {

        $this->db->select('clinical_group.student_session_id,student_session.student_id,students.firstname,students.lastname,students.roll_no,students.admission_no')->from('clinical_group');
        $this->db->join('student_session', 'student_session.id=clinical_group.student_session_id');
        $this->db->join('students', 'students.id=student_session.student_id');
        $this->db->where('clinical_group.group_id', $group_id);

        $res = $this->db->get();
        return $res->result_array();



    }




    /* $this->db->select('assign_ward.*,warddetail.id as ward_id,warddetail.wardname,warddetail.aliasname,sections.section,classes.class,clinical_department.deptname');
        $this->db->join('warddetail','warddetail.id=assign_ward.ward_id');
        $this->db->join('sections','sections.id=assign_ward.section_id');
        $this->db->join('classes','classes.id=assign_ward.class_id');
        $this->db->join('clinical_department','clinical_department.id=warddetail.deptnames','left');
        $this->db->where(array('section_id'=>$section_id,'class_id'=>$class_id));
        $this->db->from('assign_ward');
        $res=$this->db->get();
        return $result=$res->result_array();
       */







    public function department_edit($id = null)
    {
        $this->db->select()->from('clinical_department');

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



    public function check_exists($str)
    {
        $name = $this->security->xss_clean($str);
        $id = $this->input->post('id');



        if (!isset($id)) {
            $id = 0;
        }

        if ($this->check_data_exists($name, $id)) {
            $this->form_validation->set_message('check_exists', 'Record already exists');
            return FALSE;


        } else {
            return TRUE;
        }
    }


    function check_data_exists($name, $id)
    {
        $this->db->where('deptname', $name);
        $this->db->where('id !=', $id);

        $query = $this->db->get('clinical_department')->num_rows();

        if ($query > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function addgroup($data)
    {
        $this->db->insert('clinical_group', $data);
        return $this->db->insert_id();


    }


    function add_groupname($data_new)
    {
        $this->db->insert('clinical_groupname', $data_new);
        return $this->db->insert_id();


    }


    function addour_groupname($data_new)
    {
        $this->db->insert('new_batch', $data_new);
        return $this->db->insert_id();


    }

    function addourgroup($data)
    {
        $this->db->insert('our_group', $data);
        return $this->db->insert_id();


    }






    public function check_exists_group($str)
    {
        $name = $this->security->xss_clean($str);
        $id = $this->input->post('id');



        if (!isset($id)) {
            $id = 0;
        }

        if ($this->check_group_exists($name, $id)) {
            $this->form_validation->set_message('check_exists_group', 'Group Name already exists');
            return FALSE;


        } else {
            return TRUE;
        }
    }


    public function check_exists_ourgroup($str)
    {
        $name = $this->security->xss_clean($str);
        $id = $this->input->post('id');



        if (!isset($id)) {
            $id = 0;
        }

        if ($this->check_group_ourexists($name, $id)) {
            $this->form_validation->set_message('check_exists_ourgroup', 'Group Name already exists');
            return FALSE;


        } else {
            return TRUE;
        }
    }

    function check_group_exists($name, $id)
    {
        $this->db->where('group_name', $name);
        $this->db->where('id !=', $id);

        $query = $this->db->get('clinical_groupname')->num_rows();

        if ($query > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }



    function check_group_ourexists($name, $id)
    {
        $this->db->where('group_name', $name);
        $this->db->where('id !=', $id);

        $query = $this->db->get('new_batch')->num_rows();

        if ($query > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }


    public function view_clinical_group()
    {

        $this->db->select('*')->from('clinical_groupname');
        $this->db->where('session_id', $this->current_session);
        return $this->db->get()->result_array();

    }


    public function view_addour_group()
    {

        $this->db->select('*')->from('new_batch');
        $this->db->where('session_id', $this->current_session);
        return $this->db->get()->result_array();

    }

    public function get_studentBygroup($group_id)
    {

        $this->db->select('clinical_group.id as clinical_group_id,clinical_group.class_id,clinical_group.student_session_id,clinical_group.section_id,student_session.student_id,student_session.class_id,students.roll_no,student_session.section_id,classes.class,sections.section,students.firstname,students.lastname')->from('clinical_group');
        $this->db->join('student_session', 'student_session.id=clinical_group.student_session_id');
        $this->db->join('students', 'student_session.student_id=students.id');
        $this->db->join('sections', 'sections.id=student_session.section_id');
        $this->db->join('classes', 'classes.id=student_session.class_id');
        $this->db->where('clinical_group.group_id', $group_id);
        $res = $this->db->get();
        return $res->result();


    }


    public function get_studentByournewgroup($group_id)
    {

        $this->db->select('our_group.id as new_group_id,our_group.class_id,our_group.student_session_id,our_group.section_id,student_session.student_id,student_session.class_id,students.roll_no,student_session.section_id,classes.class,sections.section,students.firstname,students.lastname')->from('our_group');
        $this->db->join('student_session', 'student_session.id=our_group.student_session_id');
        $this->db->join('students', 'student_session.student_id=students.id');
        $this->db->join('sections', 'sections.id=student_session.section_id');
        $this->db->join('classes', 'classes.id=student_session.class_id');
        $this->db->where('our_group.group_id', $group_id);
        $res = $this->db->get();
        return $res->result();


    }

    public function release($stud_sess)
    {
        $this->db->where('student_session_id', $stud_sess);
        $this->db->delete('clinical_group');

    }

    public function releasestudents($stud_sess)
    {
        $this->db->where('student_session_id', $stud_sess);
        $this->db->delete('our_group');

    }

    public function check_Exits_group($data)
    {
        $this->db->select('*');
        $this->db->from('assign_ward');
        //$this->db->where('session_id', $this->current_session);
        $this->db->where('ward_id', $data['ward_id']);
        $this->db->where('group_id', $data['group_id']);
        $this->db->where('datefrom', $data['datefrom']);
        $this->db->where('dateto', $data['dateto']);
        //$this->db->limit(1);
        $query = $this->db->get();
        $q = $query->row();

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_cumulative_record($student_session_id)
    {
        $this->db->select('students.id as student_id,students.firstname,students.lastname,students.admission_no,students.roll_no,students.image,students.gender,students.dob,students.gender,students.admission_date,students.religion,students.cast,students.permanent_address,students.father_name,students.guardian_is,students.guardian_name,students.date_completion,student_session.session_id')->from('students');
        $this->db->join('student_session', 'student_session.student_id=students.id');
        $this->db->where(array('student_session.id' => $student_session_id, 'student_session.session_id' => $this->current_session));
        $query = $this->db->get();
        return $query->row_array();




    }


    public function get_markdetails($student_id)
    {


        $this->db->select(' student_session.id as student_session_id,student_session.section_id,student_session.class_id,sections.*')->from('student_session');
        $this->db->join('sections', 'sections.id=student_session.section_id');
        $this->db->where('student_session.student_id', $student_id);
        $query = $this->db->get();
        $val = $query->result_array();

        $array = array();
        if (!empty($val)) {
            foreach ($val as $key => $value) {
                $sub = new stdClass();

                $sub->section = $value['section'];


                $sub->subject = $this->getsubject($value['section_id'], $value['class_id'], $value['student_session_id'], $student_id);


                $array[] = $sub;

            }
        }

        return $array;
    }



    function getsubject($section_id, $class_id, $student_session_id, $student_id)
    {


        $this->db->select('teacher_subjects.id as teacher_subject_id,teacher_subjects.subject_id, class_sections.id as class_sections, subjects.name');
        $this->db->from('teacher_subjects');
        $this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');
        $this->db->join('class_sections', 'teacher_subjects.class_section_id = class_sections.id');
        $this->db->where(array('class_sections.section_id' => $section_id, 'class_sections.class_id' => $class_id));

        $sub = $this->db->get();
        $subject = $sub->result_array();




        $subarray = array();
        if (!empty($subject)) {
            foreach ($subject as $key => $val) {
                $a = new stdClass();
                $a->name = $val['name'];


                $a->type = $val['type'];
                $a->marks_secured = $this->marks_secured($val['subject_id'], $student_id);
                $a->conducted = $this->conducted($val['teacher_subject_id']);
                $a->total_hour = $this->totalminutes($val['teacher_subject_id'], $student_session_id);
                $a->clinical_totalhr = $this->clinical_totalhr($student_session_id, $val['teacher_subject_id']);
                $a->clinical_conducted = $this->clinic_conducted($val['teacher_subject_id']);

                $subarray[] = $a;
            }


        }

        return $subarray;


    }

    function conducted($teacher_subject_id)
    {

        $this->db->select('student_attendences.date')->from('student_attendences');
        $this->db->where(array('subject_id' => $teacher_subject_id, 'session_id' => $this->current_session));
        $this->db->group_by(date);
        $res = $this->db->get();
        $final = $res->result_array();
        $ar = array();
        $total_min = 0;
        foreach ($final as $key => $hr) {

            $day = date('l', strtotime($hr['date']));
            $this->db->select('timetables.total_time')->from('timetables');
            $this->db->where('teacher_subject_id', $teacher_subject_id);
            $this->db->where('timetables.day_name', $day);
            $val = $this->db->get()->result();
            foreach ($val as $min) {
                $total_min = $total_min + $min->total_time;
            }
        }
        $total_hour = $total_min / 60;

        return round($total_hour);


    }








    function totalminutes($teacher_subject_id, $student_session_id)
    {


        $this->db->select('student_attendences.*');
        $this->db->from('student_attendences');
        $this->db->where(array('student_session_id' => $student_session_id, 'subject_id' => $teacher_subject_id));
        $min = $this->db->get();
        $query = $min->result_array();



        //$res=array();
        if (!empty($query)) {
            $total_min = 0;
            foreach ($query as $key => $val) {

                $total_min = $total_min + $val['total_hour'];

                $total_hour = $total_min / 60;

                //$total=new stdClass();
                //$total->hour=$val['total_hour'];
                //$total->totalmin=$total_hour+$val['total_hour'];	

                //$total->total_hour=$total->totalmin/60;

            }
            //$res[]=$total;


        }

        return round($total_hour);



    }


    function marks_secured($subject_id, $student_id)
    {
        $this->db->select('universitymarks.marks')->from('universitymarks');
        $this->db->where(array('universitymarks.subject_id' => $subject_id, 'universitymarks.student_id' => $student_id));
        $query = $this->db->get();
        return $query->row();


    }


    function clinical_totalhr($student_session_id, $subject_id)
    {
        $sql = "SELECT sum(total_minutes) as `total_hr` FROM clinical_attendance WHERE student_session_id=" . $this->db->escape($student_session_id) . "and subject_id=" . $this->db->escape($subject_id);
        $query = $this->db->query($sql);
        $res = $query->result();

        return $res[0]->total_hr;

    }

    function clinic_conducted($subject_id)
    {
        $sql = "SELECT sum(total_minutes) as `total_hr` FROM clinical_attendance WHERE  subject_id=" . $this->db->escape($subject_id) . "and session_id=" . $this->current_session;
        $query = $this->db->query($sql);
        $res = $query->result();

        return $res[0]->total_hr;

    }





    public function add_remarks($data)
    {
        $this->db->insert('character_conduct', $data);


    }


    public function get_remarks($class_id, $section_id, $student_id)
    {
        $this->db->select('character_conduct.remarks,sections.section')->from('character_conduct');

        $this->db->join('sections', 'sections.id=character_conduct.section_id');
        $this->db->where(array('character_conduct.class_id' => $class_id, 'character_conduct.section_id' => $section_id, 'character_conduct.student_id' => $student_id));

        $result = $this->db->get();
        return $result->result_array();


    }

    public function get_working_days($student_session_id)
    {

        $this->db->select('sections.section,sections.id')->from('student_session');
        $this->db->join('sections', 'student_session.section_id=sections.id');
        $this->db->where('student_session.id', $student_session_id);

        $val = $this->db->get();
        $res = $val->result_array();

        $ar = array();
        foreach ($res as $key => $value) {

            $a['section'] = $value['section'];
            $a['annual_leave'] = $this->annual_leave($student_session_id);
            $a['sick_leave'] = $this->sick_leave($student_session_id);
            $a['anyother_leave'] = $this->anyother_leave($student_session_id);

            $a['working_day'] = $this->workingdays($value['id']);

            $ar[] = $a;

        }

        return $ar;

    }



    function annual_leave($student_session_id)
    {
        $this->db->select('student_attendences.id')->from('student_attendences');
        $this->db->where('attendence_type_id', 5);
        $this->db->where('student_session_id', $student_session_id);
        $res = $this->db->get()->result_array();
        return count($res);

    }

    function sick_leave($student_session_id)
    {
        $this->db->select('student_attendences.id')->from('student_attendences');
        //$this->db->where('attendence_type_id',4);
        $this->db->where('student_session_id', $student_session_id);
        $this->db->where('remark', 1);
        $res = $this->db->get()->result_array();
        return count($res);
    }

    function anyother_leave($student_session_id)
    {
        $this->db->select('student_attendences.id')->from('student_attendences');
        //$this->db->where('attendence_type_id',1);
        $this->db->where('student_session_id', $student_session_id);
        $this->db->where('remark', 2);
        $res = $this->db->get()->result_array();
        return count($res);
    }

    function workingdays($section_id)
    {
        $this->db->select('student_attendences.id,student_session.section_id')->from('student_attendences');
        $this->db->join('student_session', 'student_attendences.student_session_id=student_session.id');
        $this->db->where('student_attendences.attendence_type_id !=', 5);
        $this->db->where('student_session.section_id', $section_id);

        $this->db->group_by('student_attendences.date');
        $query = $this->db->get();
        $result = $query->result_array();
        return count($result);

    }


    public function get_appearence($student_id)
    {



        $this->db->select('classes.id as class_id,classes.class,sections.id as section_id,sections.section')->from('student_session')->join('classes', 'classes.id=student_session.class_id')->join('sections', 'sections.id=student_session.section_id')->where('student_session.student_id', $student_id);
        $res = $this->db->get();
        $result = $res->result_array();
        if (isset($result)) {
            $ar = array();
            foreach ($result as $key => $val) {
                $a = new stdClass();
                $a->class = $val['class'];
                $a->section = $val['section'];
                $a->appear = $this->appearence($val['class_id'], $val['section_id'], $student_id);

                $ar[] = $a;


            }

        }
        return $ar;

    }



    function appearence($class_id, $section_id, $student_id)
    {

        $this->db->select('stud_exam_appeared.appeared,stud_exam_appeared.date')->from('stud_exam_appeared');
        $this->db->where(array('student_id' => $student_id, 'class_id' => $class_id, 'section_id' => $section_id));
        $val = $this->db->get();
        $result = $val->result_array();



        if (isset($result)) {

            $array = array();
            foreach ($result as $r_key => $res) {

                $app['appeared'] = $res['appeared'];
                $app['date'] = $res['date'];
                $app['chance'] = $this->get_chances_mark($res['appeared'], $student_id);

                $array[] = $app;
            }

            return $array;



        }

    }

    function getallscholarship()
    {
        $result = $this->db->select('*')->from('scholarship')->get()->result_array();
        return $result;
    }


    function get_chances_mark($appeared, $student_id)
    {
        $this->db->select('supplementry_exam.get_marks,exam_schedules.full_marks,exam_schedules.passing_marks')->from('supplementry_exam')->join('exam_schedules', 'exam_schedules.id=supplementry_exam.exam_schedule_id');

        $this->db->where('supplementry_exam.no_chances', $appeared);
        $this->db->where('supplementry_exam.student_id', $student_id);

        $result = $this->db->get();

        return $result->result_array();



    }



    function up_kuhs($data)
    {

        $this->db->where('id', $data['id']);
        $this->db->update('students', $data);

    }

    public function getnewval($id = null)
    {

        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];

        $this->db->select('student_session.transport_fees,scholarship.id as scholarship_id,scholarship.name,scholarship.description,students.vehroute_id,vehicle_routes.route_id,vehicle_routes.vehicle_id,transport_route.route_title,vehicles.vehicle_no,hostel_rooms.room_no,vehicles.driver_name,vehicles.driver_contact,hostel.id as `hostel_id`,hostel.hostel_name,room_types.id as `room_type_id`,room_types.room_type ,students.hostel_room_id,student_session.id as `student_session_id`,student_session.fees_discount,classes.id AS `class_id`,classes.class,sections.id AS `section_id`,sections.section,students.id,students.centre_id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state ,   students.city , students.pincode , students.note, students.religion, students.cast, school_houses.house_name,   students.dob ,students.current_address, students.previous_school,students.scholarship,
            students.guardian_is,students.parent_id,
            students.permanent_address,students.category_id,students.adhar_no,students.samagra_id,students.kuhs_reg_no,students.annual_income,students.year,students.nationality,students.bank_account_no,students.bank_name, students.ifsc_code , students.guardian_name , students.father_pic ,students.height ,students.weight,students.measurement_date, students.mother_pic , students.guardian_pic , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.father_phone,students.blood_group,students.school_house_id,students.father_occupation,students.mother_name,students.mother_phone,students.mother_occupation,students.guardian_occupation,students.gender,students.guardian_is,students.rte,students.guardian_email')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        //$this->db->join('student_attendences', 'student_attendences.student_session_id = student_session.id');
        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('hostel_rooms', 'hostel_rooms.id = students.hostel_room_id', 'left');
        $this->db->join('hostel', 'hostel.id = hostel_rooms.hostel_id', 'left');
        $this->db->join('room_types', 'room_types.id = hostel_rooms.room_type_id', 'left');
        $this->db->join('vehicle_routes', 'vehicle_routes.id = students.vehroute_id', 'left');
        $this->db->join('transport_route', 'vehicle_routes.route_id = transport_route.id', 'left');
        $this->db->join('vehicles', 'vehicles.id = vehicle_routes.vehicle_id', 'left');
        $this->db->join('school_houses', 'school_houses.id = students.school_house_id', 'left');
        $this->db->join('scholarship', 'students.scholarship=scholarship.id', 'left');
        if ($this->current_session != null) {
            $this->db->where('student_session.session_id', $this->current_session);
        }
        if ($centre_id != null) {
            $this->db->where('students.centre_id', $centre_id);
        }
        if ($id != null) {
            $this->db->where('students.id', $id);
        } else {
            $this->db->where('students.is_active', 'yes');
            $this->db->order_by('students.id', 'desc');
        }
        $query = $this->db->get();
        if ($id != null) {
            return $query->row_array();
        } else {
            return $query->result_array();
        }
    }







    public function staffssearchByClassSection($class_id = null, $section_id = null, $subject_id = null, $staff_id = null)
    {
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];
        $this->db->select('classes.id AS `class_id`,student_session.id as student_session_id,students.id as student_id,classes.class,sections.id AS `section_id`,sections.section,students.id,students.admission_no , students.roll_no,students.admission_date,students.firstname,  students.lastname,students.image,    students.mobileno, students.email ,students.state , classes.awarded_by,  students.city , students.pincode ,     students.religion, students.dob ,students.current_address,    students.permanent_address,IFNULL(students.category_id, 0) as `category_id`,IFNULL(categories.category, "") as `category`,students.adhar_no,students.samagra_id,students.bank_account_no,students.bank_name, students.kuhs_reg_no,students.nationality,students.date_completion, students.ifsc_code , students.guardian_name , students.guardian_relation,students.guardian_phone,students.guardian_address,students.is_active ,students.created_at ,students.updated_at,students.father_name,students.rte,students.gender,students.year,students.email,students.virtual_acc_no')->from('students');
        $this->db->join('student_session', 'student_session.student_id = students.id');
        //$this->db->join('subjects', 'teacher_subjects.subject_id = subjects.id');

        $this->db->join('classes', 'student_session.class_id = classes.id');
        $this->db->join('student_attendences', 'students.id = student_attendences.id');
        $this->db->join('staff', 'staff.id = student_attendences.staff_id');
        $this->db->join('sections', 'sections.id = student_session.section_id');
        $this->db->join('categories', 'students.category_id = categories.id', 'left');
        $this->db->where('student_session.session_id', $this->current_session);
        $this->db->where('students.is_active', "yes");

        if ($class_id != null) {
            $this->db->where('students.centre_id', $centre_id);
            $this->db->where('student_session.class_id', $class_id);
        }
        if ($section_id != null) {
            $this->db->where('student_session.section_id', $section_id);
        }
        if ($staff_id != null) {
            $this->db->where('student_attendences.staff_id', $staff_id);
        }

        //$this->db->order_by('students.id');
        $this->db->order_by('students.admission_no', 'asc');

        $query = $this->db->get();

        return $query->result_array();
    }



    function getfeedparent()
    {
        $this->db->select('*')->from('feedback');

        $result = $this->db->get();
        return $result->result_array();

    }

    function gettpreport()
    {
        // $this->db->distinct();
        $this->db->select('*,staff_evaluation.stime as strtime,staff_evaluation.etime as endtime')->from('staff_evaluation');
        $this->db->join('staff', 'staff.id=staff_evaluation.sid');
        // $this->db->join('student_attendences','staff.id=student_attendences.staff_id'); 
        // $this->db->group_by('staff_evaluation.date');
        $result = $this->db->get();
        return $result->result_array();

    }
    function getclireport()
    {
        $this->db->distinct();
        $this->db->select('*')->from('clinical_evaluation');
        $this->db->join('staff', 'staff.id=clinical_evaluation.sid');
        $this->db->join('clinical_attendance', 'staff.id=clinical_attendance.sid');
        $this->db->join('clinical_groupname', 'clinical_groupname.id=clinical_attendance.group_id');
        $this->db->group_by('staff.id');
        $result = $this->db->get();
        return $result->result_array();

    }






    function getfeedparentnew($id)
    {
        $this->db->select('*')->from('feedback');
        $this->db->where('feedback.id', $id);
        // $this->db->join('sections','sections.id=character_conduct.section_id');
        // $this->db->where(array('character_conduct.class_id'=>$class_id,'character_conduct.section_id'=>$section_id,'character_conduct.student_id'=>$student_id));

        $result = $this->db->get();
        return $result->row_array();

    }

    function CheckKuhsDuplicate($value)
    {
        $result = $this->db->select('kuhs_reg_no')->where('kuhs_reg_no', $value)->get('students')->result_array();
        return $result;
    }




}
