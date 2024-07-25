<?php

/**
 * 
 */
class Homework extends Student_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library("customlib");
        $this->load->model("homework_model");
        $this->load->model("staff_model");
        $this->load->model("student_model");
        $this->load->helper('date');

    }

    public function index() {

        $this->session->set_userdata('top_menu', 'Homework');
        $data["created_by"] = "";
        $data["evaluated_by"] = "";
        $userdata = $this->customlib->getLoggedInUserData();
        $student_id = $userdata["student_id"];
        $result = $this->student_model->getRecentRecord($student_id);
        // var_dump($userdata);exit;
        $class_id = $result["class_id"];
        
        $section_id = $result["section_id"];
        // var_dump( $section_id);exit;
        $homeworklist = $this->homework_model->getStudentHomework($class_id, $section_id);
        $data["homeworklist"] = $homeworklist;
        // $status=$this->db->select('status')->where('student_id',$student_id)->get('homework_upload')->result_array();
        // $data['status']=$status;
        // var_dump( $data["status"]);exit;
        $data["class_id"] = $class_id;
        $data["section_id"] = $section_id;
        $data["subject_id"] = "";

        foreach ($homeworklist as $key => $value) {

            // var_dump($value);exit;
            $report = $this->homework_model->getEvaluationReportForStudent($value["id"], $student_id);

           //  echo "<pre>";
           // print_r($report);
                       $data["homeworklist"][$key]["report"] = $report;

        }
//exit();
        $this->load->view("layout/student/header");
        $this->load->view("user/homework/homeworklist", $data);
        $this->load->view("layout/student/footer");
    }

    public function homework_detail($id) {
        $data["title"] = "Homework Evaluation";
        $data['id']=$id;
        $userdata = $this->customlib->getLoggedInUserData();
        $student_id = $userdata["student_id"];
        $result = $this->homework_model->getRecord($id);
        $class_id = $result["class_id"];
        $section_id = $result["section_id"];
        $studentlist = $this->homework_model->getStudents($class_id, $section_id,$id);
        
        $data["studentlist"] = $studentlist;
        // var_dump( $data["studentlist"]);exit;
        $data["result"] = $result;
        $report = $this->homework_model->getEvaluationReportForStudent($id, $student_id);
        $data["report"] = $report;
        $data["created_by"] = "";
        $data["evaluated_by"] = "";
       

    
        if (!empty($report)) {
            $create_data = $this->staff_model->get($result["created_by"]);
            $eval_data = $this->staff_model->get($result["evaluated_by"]);
            $created_by = $create_data["name"];
            $evaluated_by = $eval_data["name"];
            $data["created_by"] = $created_by;
            $data["evaluated_by"] = $evaluated_by;
        }
        $currentTimestamp = now();
        if (isset($_FILES["work_assigned"]) && !empty($_FILES['work_assigned']['name'])) {
            $fileInfo = pathinfo($_FILES["work_assigned"]["name"]);
            $img_name = $currentTimestamp . '.' . $fileInfo['extension'];
            move_uploaded_file($_FILES["work_assigned"]["tmp_name"], "./uploads/homework/" . $img_name);
            $data_img = array('homework_id' => $id,'student_id'=>$student_id ,'uploads' => 'uploads/homework/' . $img_name);
            $this->itemstock_model->homeworkupload($data_img);
            redirect('user/homework');
          
        }
    
        $this->load->view("user/homework/homework_detail", $data);
    }
    public function download($id, $doc) {
        $this->load->helper('download');
        $name = $this->uri->segment(5);
        $ext = explode(".", $name);
        $filepath = "./uploads/homework/" . $id . "." . $ext[1];
        $data = file_get_contents($filepath);
        force_download($name, $data);
    }

}

?>