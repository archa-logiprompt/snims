<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Temporary_admission extends Admin_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("live_class_model");
        $this->load->model("temporary_admission_model");
        $this->load->library('form_validation');
        $this->load->model("Temporary_admission_model");
    }

    public function index()
    {
        $admin = $this->session->userdata('admin');
        $centre_id = $admin['centre_id'];

        if (!$this->rbac->hasPrivilege('temporary_admission', 'can_add') || $centre_id != 2) {
            access_denied();
        }

        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'temporary_admission/index');
        $this->form_validation->set_rules('class_id', 'Course', 'trim|required|xss_clean');
        $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
        if (empty($_FILES['file']['name'])) {
            // $this->form_validation->set_rules('file', 'Document', 'required');
        }

        $data['classlist'] = $this->class_model->get('', $classteacher = 'yes');
        $data['sessionlist'] = $this->session_model->getsessionlist();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('student/temporary_admission/create', $data);
            $this->load->view('layout/footer', $data);
        } else {
            if (isset($_FILES["file"]) && !empty($_FILES['file']['name'])) {
                $ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
                if ($ext == 'csv') {
                    $file = $_FILES['file']['tmp_name'];
                    $this->load->library('CSVReader');
                    $result = $this->csvreader->parse_file($file);
                    $class_id = $this->input->post('class_id');
                    $section_id = $this->input->post('section_id');
                    $session_id = $this->input->post('session_list');
                    foreach ($result as $row) {
                        $user_id = $this->MakeUserId(5);

                        $array = array(
                            'class_id' => $class_id,
                            'section_id' => $section_id,
                            'user_id' => $user_id,
                            'session' => $session_id,
                        );

                        // $this->sendLoginSms($user_id, $row['phone']);
                        $row = array_merge($row, $array);
                        $this->temporary_admission_model->create($row);
                    }
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">Temporary Students has been added.</div>');
                    redirect('admin/temporary_admission');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Please upload CSV file only.</div>');
                    $this->load->view('layout/header', $data);
                    $this->load->view('student/temporary_admission/create', $data);
                    $this->load->view('layout/footer', $data);
                }
            }
            $this->load->view('layout/header', $data);
            $this->load->view('student/temporary_admission/create', $data);
            $this->load->view('layout/footer', $data);
        }
    }


    // public function search()
    // {
       
    //     $this->session->set_userdata('top_menu', 'Student Information');
    //     $this->session->set_userdata('sub_menu', 'temporary_admission/search');
    //     $data['sessionlist'] = $this->session_model->getsessionlist();
    //     $class = $this->Temporary_admission_model->getClass();
    //     $data['classlist'] = $class;

    //     $this->load->view('layout/header');
    //     $this->load->view('student/temporary_admission/search',$data);
    //     $this->load->view('layout/footer');
    // }
    function search()
    {

        if (!$this->rbac->hasPrivilege('student', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Student Information');
        $this->session->set_userdata('sub_menu', 'temporary_admission/search');
        $data['title'] = 'Student Search';
        $data['sessionlist'] = $this->session_model->getsessionlist();
        $class = $this->Temporary_admission_model->getClass();
        $data['classlist'] = $class;
        $userdata = $this->session->userdata();
        $data['userdata']=$userdata['admin'];
        // var_dump($data['userdata']);exit;
        $userdata = $this->customlib->getUserData();
        $carray = array();

        if (!empty($data["classlist"])) {
            foreach ($data["classlist"] as $ckey => $cvalue) {

                $carray[] = $cvalue["id"];
            }
        }

        $button = $this->input->post('search');
        if ($this->input->server('REQUEST_METHOD') == "GET") {
            $this->load->view('layout/header');
        $this->load->view('student/temporary_admission/search',$data);
        $this->load->view('layout/footer');
        } else {
            $class = $this->input->post('class_id');
            $section = $this->input->post('section_id');
            $session_id = $this->input->post('session_list');
            $search = $this->input->post('search');
        
            $search_text = $this->input->post('search_text');
            if (isset($search)) {
                if ($search == 'search_filter') {
                    $this->form_validation->set_rules('class_id', 'Class', 'trim|required|xss_clean');
                    $this->form_validation->set_rules('section_id', 'Section', 'trim|required|xss_clean');
                    if ($this->form_validation->run() == FALSE) {

                    } else {
                        $data['searchby'] = "filter";
                        $data['class_id'] = $this->input->post('class_id');
                        $data['section_id'] = $this->input->post('section_id');
                        $data['session_id']=$this->input->post('session_id');
                        $data['search_text'] = $this->input->post('search_text');
                        $resultlist = $this->student_model->searchtemporarystudentadmission($class, $section,$session_id);
                        $data['resultlist'] = $resultlist;
                        $title = $this->classsection_model->getDetailbyClassSection($data['class_id'], $data['section_id']);
                        $data['title'] = 'Student Details for ' . $title['class'] . "(" . $title['section'] . ")";
                    }
                } else if ($search == 'search_full') {
                    $data['searchby'] = "text";

                    $data['search_text'] = trim($this->input->post('search_text'));



                    $resultlist = $this->student_model->searchFullText($search_text, $carray);
                    $data['resultlist'] = $resultlist;

                    $data['title'] = 'Search Details: ' . $data['search_text'];
                }
                //var_dump($resultlist);
            }
            $this->load->view('layout/header');
        $this->load->view('student/temporary_admission/search',$data);
        $this->load->view('layout/footer');
        }
    }
    public function pickup($id)
    {
        $userdata = $this->session->userdata();
        $curuserdata=$userdata['admin'];
        $data['sessionlist'] = $this->session_model->getsessionlist();
        $class = $this->Temporary_admission_model->getClass();
        $data['classlist'] = $class;
        $userdata = $this->session->userdata();
        $pickup=$this->temporary_admission_model->pickupupdate($id,$curuserdata['id']);
       
        
        $this->load->view('layout/header');
        $this->load->view('student/temporary_admission/search',$data);
        $this->load->view('layout/footer');
    }
    public function leave()
    {
    $id=$this->input->post('id');
    $this->Temporary_admission_model->pickedbyupdate($id);
    echo ( 'success');
    }
    private function MakeUserId($length)
    {
        $salt = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $len = strlen($salt);
        $makepass = '';
        mt_srand(10000000 * (float) microtime());
        for ($i = 0; $i < $length; $i++) {
            $makepass .= $salt[mt_rand(0, $len - 1)];
        }
        return $makepass;
    }

    private function sendLoginSms($user_id, $phone)
    {
        $password = "test";
        $fullApi = 'http://prioritysms.a4add.com/api/sendhttp.php?authkey=341137A6fjmQ8YSgq95f588459P1&mobiles={num}&message={msg}&sender=AMCSFN&route=4&country=91&unicode=1&DLT_TE_ID={tid}';
        $tid = '1207162731815046564';
        $msg = "AMCSFNCK B.Sc Nursing Application 2024-25. Your Applicant ID: " . $user_id . " and Password: " . $password . ".\n For more details www.amcsfnck.com or https://bit.ly/3AR0uPs";
        ;
        $msg = urlencode($msg);
        $num = $phone;
        $api = str_replace(['{msg}', '{num}', '{tid}'], [$msg, $num, $tid], $fullApi);

        $url = $api;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        $info = curl_getinfo($ch);
        $http_result = $info['http_code'];
        curl_close($ch);
    }
}
