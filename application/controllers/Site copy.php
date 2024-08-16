<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class Site extends Public_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->check_installation();
        if ($this->config->item('installed') == true) {
            $this->db->reconnect();
        }

        $this->load->model("staff_model");
        $this->load->model("temporary_admission_model");
        $this->load->model("Temporary_admission_model");

        $this->load->library('Auth');
        $this->load->library('Enc_lib');
        $this->load->library('mailer');
        $this->load->config('ci-blog');
        $this->mailer;
        $this->load->library('session');
    }

    public function privacy_policy()
    {
        $this->load->view('privacy_policy');
    }

    function mailtest()
    {
        //change this to your email. 
        // $to = "govindr.logiprompt@gmail.com";
        // $from = "govindr.logiprompt@gmail.com";
        // $subject = "Hello! This is HTML email";

        //begin of HTML message 

        // Multiple recipients
        $to = "govindr.logiprompt@gmail.com";

        $subject = 'Birthday Reminders for August';

        // Message
        $message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body>
  <p>Here are the birthdays upcoming in August!</p>
  <table>
    <tr>
      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
    </tr>
    <tr>
      <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
    </tr>
    <tr>
      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
    </tr>
  </table>
</body>
</html>
';

        // To send HTML mail, the Content-type header must be set
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';

        // Additional headers
        $headers[] = 'To: Mary <govindr.logiprompt@gmail.com>';
        $headers[] = 'From: Birthday Reminder <govindr.logiprompt@gmail.com>';

        // Mail it
        var_dump(mail($to, $subject, $message, implode("\r\n", $headers)));
    }

    private function check_installation()
    {
        if ($this->uri->segment(1) !== 'install') {
            $this->load->config('migration');
            if ($this->config->item('installed') == false && $this->config->item('migration_enabled') == false) {
                redirect(base_url() . 'install/start');
            } else {
                if (is_dir(APPPATH . 'controllers/install')) {
                    echo '<h3>Delete the install folder from application/controllers/install</h3>';
                    die;
                }
            }
        }
    }

    function login()
    {

        if ($this->auth->logged_in()) {
            $this->auth->is_logged_in(true);
        }

        $data = array();
        $data['title'] = 'Login';
        $school = $this->setting_model->get();
        $notice_content = $this->config->item('ci_front_notice_content');
        $notices = $this->cms_program_model->getByCategory($notice_content, array('start' => 0, 'limit' => 5));
        $data['notice'] = $notices;
        $data['school'] = $school[0];
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/login', $data);
        } else {
            $login_post = array(
                'email' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $setting_result = $this->setting_model->get();
            $result = $this->staff_model->checkLogin($login_post);
            $f_year = $this->setting_model->get_financial_year($result->centre_id);

            if ($result) {
                if ($result->is_active) {
                    $setting_result = $this->setting_model->loginget($result->centre_id);

                    $session_data = array(
                        'id' => $result->id,
                        'username' => $result->name,
                        'centre_id' => $result->centre_id,
                        'email' => $result->email,
                        'roles' => $result->roles,
                        'financial_year' => $f_year['value'],
                        'date_format' => $setting_result['date_format'],
                        'currency_symbol' => $setting_result['currency_symbol'],
                        'start_month' => $setting_result['start_month'],
                        'school_name' => $setting_result['name'],
                        'timezone' => $setting_result['timezone'],
                        'sch_name' => $setting_result['name'],
                        'language' => array('lang_id' => $setting_result['lang_id'], 'language' => $setting_result['language']),
                        'is_rtl' => $setting_result['is_rtl'],
                        'theme' => $setting_result['theme'],
                    );
                    $this->session->set_userdata('admin', $session_data);
                    $role = $this->customlib->getStaffRole();
                    $role_name = json_decode($role)->name;
                    $this->customlib->setUserLog($this->input->post('username'), $role_name);

                    if (isset($_SESSION['redirect_to']))
                        redirect($_SESSION['redirect_to']);
                    else
                        redirect('admin/admin/dashboard');
                } else {
                    $data['error_message'] = 'Your account is disabled please contact to administrator';

                    $this->load->view('admin/login', $data);
                }
            } else {
                $data['error_message'] = 'Invalid Username or Password';
                $this->load->view('admin/login', $data);
            }
        }
    }

    function logout()
    {
        $admin_session = $this->session->userdata('admin');
        $student_session = $this->session->userdata('student');
        $temporary_session = $this->session->userdata('temporary_student');

        $this->auth->logout();
        if ($admin_session) {
            redirect('site/login');
        } else if ($student_session) {
            redirect('site/userlogin');
        } else if ($temporary_session) {
            redirect('site/temporarystudentlogin');
        } else {
            redirect('site/userlogin');
        }
    }

    function forgotpassword()
    {


        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required|xss_clean');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('admin/forgotpassword');
        } else {
            $email = $this->input->post('email');

            $result = $this->staff_model->getByEmail($email);

            if ($result && $result->email != "") {

                $verification_code = $this->enc_lib->encrypt(uniqid(mt_rand()));
                $update_record = array('id' => $result->id, 'verification_code' => $verification_code);
                $this->staff_model->add($update_record);
                $name = $result->name;

                $resetPassLink = site_url('admin/resetpassword') . "/" . $verification_code;

                $body = $this->forgotPasswordBody($name, $resetPassLink);
                $body_array = json_decode($body);

                if (!empty($this->mail_config)) {
                    $result = $this->mailer->send_mail($result->email, $body_array->subject, $body_array->body);
                }

                $this->session->set_flashdata('message', "Please check your email to recover your password");

                redirect('site/login', 'refresh');
            } else {
                $data = array(
                    'error_message' => 'Invalid Email'
                );
            }
            $this->load->view('admin/forgotpassword', $data);
        }
    }

    //reset password - final step for forgotten password
    public function admin_resetpassword($verification_code = null)
    {
        if (!$verification_code) {
            show_404();
        }

        $user = $this->staff_model->getByVerificationCode($verification_code);

        if ($user) {
            //if the code is valid then display the password reset form
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            if ($this->form_validation->run() == false) {


                $data['verification_code'] = $verification_code;
                //render
                $this->load->view('admin/admin_resetpassword', $data);
            } else {

                // finally change the password
                $password = $this->input->post('password');
                $update_record = array(
                    'id' => $user->id,
                    'password' => $this->enc_lib->passHashEnc($password),
                    'verification_code' => ""
                );

                $change = $this->staff_model->update($update_record);
                if ($change) {
                    //if the password was successfully changed
                    $this->session->set_flashdata('message', "Password Reset successfully");
                    redirect('site/login', 'refresh');
                } else {
                    $this->session->set_flashdata('message', "Something went wrong");
                    redirect('admin_resetpassword/' . $verification_code, 'refresh');
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', 'Invalid Link');
            redirect("site/forgotpassword", 'refresh');
        }
    }

    //reset password - final step for forgotten password
    public function resetpassword($role = null, $verification_code = null)
    {
        if (!$role || !$verification_code) {
            show_404();
        }

        $user = $this->user_model->getUserByCodeUsertype($role, $verification_code);

        if ($user) {
            //if the code is valid then display the password reset form
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]');
            if ($this->form_validation->run() == false) {

                $data['role'] = $role;
                $data['verification_code'] = $verification_code;
                //render
                $this->load->view('resetpassword', $data);
            } else {

                // finally change the password

                $update_record = array(
                    'id' => $user->user_tbl_id,
                    'password' => $this->input->post('password'),
                    'verification_code' => ""
                );

                $change = $this->user_model->saveNewPass($update_record);
                if ($change) {
                    //if the password was successfully changed
                    $this->session->set_flashdata('message', "Password Reset successfully");
                    redirect('site/userlogin', 'refresh');
                } else {
                    $this->session->set_flashdata('message', "Something went wrong");
                    redirect('user/resetpassword/' . $role . '/' . $verification_code, 'refresh');
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', 'Invalid Link');
            redirect("site/ufpassword", 'refresh');
        }
    }

    function ufpassword()
    {
        $this->form_validation->set_rules('username', 'Email', 'trim|required|xss_clean');
        $this->form_validation->set_rules('user[]', 'User Type', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('ufpassword');
        } else {
            $email = $this->input->post('username');
            $usertype = $this->input->post('user[]');

            $result = $this->user_model->forgotPassword($usertype[0], $email);

            if ($result && $result->email != "") {

                $verification_code = $this->enc_lib->encrypt(uniqid(mt_rand()));
                $update_record = array('id' => $result->user_tbl_id, 'verification_code' => $verification_code);
                $this->user_model->updateVerCode($update_record);
                if ($usertype[0] == "student") {
                    $name = $result->firstname . " " . $result->lastname;
                } else {
                    $name = $result->name;
                }
                $resetPassLink = site_url('user/resetpassword') . '/' . $usertype[0] . "/" . $verification_code;

                $body = $this->forgotPasswordBody($name, $resetPassLink);
                $body_array = json_decode($body);

                if (!empty($this->mail_config)) {
                    $result = $this->mailer->send_mail($result->email, $body_array->subject, $body_array->body);
                }

                $this->session->set_flashdata('message', "Please check your email to recover your password");
                redirect('site/userlogin', 'refresh');
            } else {
                $data = array(
                    'error_message' => 'Invalid Email or User Type'
                );
            }
            $this->load->view('ufpassword', $data);
        }
    }

    function forgotPasswordBody($name, $resetPassLink)
    {
        //===============
        $subject = "Password Update Request";
        $body = 'Dear ' . $name . ', 
                <br/>Recently a request was submitted to reset password for your account. If you didn\'t make the request, just ignore this email. Otherwise you can reset your password using this link <a href="' . $resetPassLink . '"><button>Click here to reset your password</button></a>';
        $body .= '<br/><hr/>if you\'re having trouble clicking the password reset button, copy and paste the URL below into your web browser';
        $body .= '<br/>' . $resetPassLink;
        $body .= '<br/><br/>Regards,
                <br/>' . $this->customlib->getSchoolName();

        //======================
        return json_encode(array('subject' => $subject, 'body' => $body));
    }

    function landingpage()
    {
        //redirect('site/userlogin');

        $this->load->view('landingpage');
    }


    // temporary admission mail approval fns
    function approvemail($mail, $id)
    {

        $this->db->where(['signer_email' => $mail, 'temp_user_id' => $id])->update('temp_admission_approval', ['status' => 1]);
        $this->updateStatus($id);
        return 'Approved';
    }

    public function updateStatus($id)
    {
        $result = $this->db->where(['temp_user_id' => $id, 'status' => 1])->order_by('order_no', 'desc')->get('temp_admission_approval')->result_array();


       
        $student_details = $this->db->select('*')->where('id', $id)->get('temporary_admission')->row_array();
        if (count($result) > 0) {


            $order_no = $result[0]['order_no'];

            $signer_details = $this->db->where('orders', $order_no + 1)->get('upload_signature')->row_array();

            if ($signer_details['role'] == '42') {
                $documentName = $this->welcomedocument($id, $order_no + 1);
                $this->sendmail($documentName, $signer_details['mail'], $id);

                

            } else {
                $documentName = $this->sampledocument($id, $order_no);

            }


        } else {
            $order_no = 1;
            $signer_details = $this->db->where('orders', $order_no)->get('upload_signature')->row_array();
            $documentName = $this->sampledocument($id, $order_no);

        }



        $max_order = $this->db->select_max('orders')->get('upload_signature')->row_array();

        $arr = [
            'temp_user_id' => $id,
            'sign_id' => $signer_details['id'],
            'signer_email' => $signer_details['mail'],
            'order_no' => $signer_details['orders'],
            'status' => 0
        ];





        // $documentName = $this->createDocument($id);



        if ($result[0]['order_no'] == $max_order['orders']) {

            $this->sendmail($documentName, $student_details['email'], $id, true);

        } else {
            $this->db->insert('temp_admission_approval', $arr);

            $this->sendmail($documentName, $signer_details['mail'], $id);
        }



        $response_message = "Document processed and sent to " . $signer_details['mail'] . " for approval.";

        echo json_encode(['message' => $response_message]);
    }
    public function welcomedocument($id, $order_no)
    {
        require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $images = [];

        // Your logic for fetching images remains the same...
        $uploadsignature = $this->Temporary_admission_model->getsignaturedetails($order_no);
        if ($order_no > 0) {
            foreach ($uploadsignature as $key) {
                if ($key['picked_by_id'] == 1) {
                    $staff_details = $this->db->select('staff.*')->where('temporary_admission.id', $id)->join('staff', 'temporary_admission.picked_by=staff.id')->get('temporary_admission')->row_array();
                    $images[] = [
                        'src' => FCPATH . 'uploads/upload_signature/' . $staff_details['sign'],
                        'pageno' => $key['pageno'],
                        'x' => $key['xcordinate'],
                        'y' => $key['ycoordinate'],
                        'width' => 200,
                        'height' => 100,
                    ];
                } else {
                    $images[] = [
                        'src' => $key['file'],
                        'pageno' => $key['pageno'],
                        'x' => $key['xcordinate'],
                        'y' => $key['ycoordinate'],
                        'width' => 200,
                        'height' => 100,
                    ];
                }
            }
        }

        // Updated HTML content
        $html = "<html><head><style>
        .page-break { page-break-before: always; }
        .image-container { position: absolute; }
        </style></head><body>";
        $html .= "
    <div style='position: relative;'>
        <p>Dear Student,</p>
        <p>It is my great pleasure to welcome you all to Sree Narayana Institute of Medical Sciences.</p>
        <p>Today marks the beginning of a significant chapter in your lives, a journey that will shape
        your future as medical professionals and compassionate caregivers.</p>
        <p>At this prestigious institute, you are not just embarking on a journey of acquiring medical
        knowledge; you are becoming part of a legacy—a legacy built on the principles of
        excellence, integrity, and service to humanity. Sree Narayana Guru, the guiding light of our
        institution, stood for the dignity of every individual and the pursuit of knowledge with
        humility and compassion. As you step into this new phase, I urge you to embody these values
        in every aspect of your education and practice.</p>
        <p>Our institute is renowned not just for academic excellence but also for the high standards of
        conduct and professionalism that we uphold. The dignity of our institution is something we
        hold in the highest regard, and it is the collective responsibility of every member of our
        community, including you, to maintain and enhance this dignity. As future doctors and
        healthcare professionals, your actions, both within and outside the classroom, reflect on our
        institution's reputation. Strive to uphold the ethical standards and professionalism that are
        expected of you, not just for yourselves but for the generations of students who will follow in
        your footsteps.</p>
        <p>Welcome to Sree Narayana Institute of Medical Sciences. Together, let us strive to make your
        journey here not just successful, but truly exceptional.</p>
        <p>Thank you.</p>
        <p><strong>Principal</strong><br>
        Sree Narayana Institute of Medical Sciences</p>";

        // Logic to add images to the HTML document (if any)
        foreach ($images as $signature) {
            $impath = $signature['src'];
            $type = pathinfo($impath, PATHINFO_EXTENSION);
            $data = file_get_contents($impath);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

            if ($signature['x'] > 400) {
                $signaturex = $signature['x'] - 400;
                $html .= "<div class='image-container' style='right: {$signaturex}px; bottom: {$signature['y']}px; width: {$signature['width']}px; height: {$signature['height']}px;'>
                        <img src='$base64' style='width: 100%; height: 100%;' />
                      </div>";
            } else {
                $html .= "<div class='image-container' style='left: {$signature['x']}px; bottom: {$signature['y']}px; width: {$signature['width']}px; height: {$signature['height']}px;'>
                        <img src='$base64' style='width: 100%; height: 100%;' />
                      </div>";
            }
        }

        $html .= "</div></body></html>";

        // Load the HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();

        // Save the PDF to a file
        $file_name = $id . '_approval_' . time() . '.pdf';
        $file_path = FCPATH . 'uploads/candidate_documents/' . $file_name;
        file_put_contents($file_path, $dompdf->output());

        return $file_path;
    }


    public function sampledocument($id, $order_no)
    {

        require_once(APPPATH . 'libraries/dompdf/autoload.inc.php');
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf($options);
        $images = [];


        $uploadsignature = $this->Temporary_admission_model->getsignaturedetails($order_no);
        if ($order_no > 0) {


            foreach ($uploadsignature as $key) {

                if ($key['picked_by_id'] == 1) {
                    $staff_details = $this->db->select('staff.*')->where('temporary_admission.id', $id)->join('staff', 'temporary_admission.picked_by=staff.id')->get('temporary_admission')->row_array();
                    $images[] =
                        [
                            'src' => FCPATH . 'uploads/upload_signature/' . $staff_details['sign'],
                            'pageno' => $key['pageno'],
                            'x' => $key['xcordinate'],
                            'y' => $key['ycoordinate'],
                            'width' => 200,
                            'height' => 100,
                        ];
                } else {
                    $images[] =
                        [
                            'src' => $key['file'],
                            'pageno' => $key['pageno'],
                            'x' => $key['xcordinate'],
                            'y' => $key['ycoordinate'],
                            'width' => 200,
                            'height' => 100,
                        ];

                }

            }
            // var_dump($images);exit;
        }

        $getstudentdetails = $this->Temporary_admission_model->getstudentdetails($id);
        $pageIndexArray = [
            [
                'Name' => $getstudentdetails['firstname'] . " " . $getstudentdetails['lastname'],
                'Admission Date' => $getstudentdetails['admission_date'],
                'Course' => $getstudentdetails['class'],
                'Section' => $getstudentdetails['section'],
                'Date of ' => $getstudentdetails['dob'],
                'Phone No' => $getstudentdetails['phone'],
                'Caste' => $getstudentdetails['cast'],
                'Religion' => $getstudentdetails['religion'],
                'Email' => $getstudentdetails['email'],
                'Current Address' => $getstudentdetails['current_address'],
                'Permanent Address' => $getstudentdetails['permanent_address'],
                'Father Name' => $getstudentdetails['father_name'],
                'Father Phone' => $getstudentdetails['father_phone'],
                'Father Occupation' => $getstudentdetails['father_occupation'],
                'Mother Name' => $getstudentdetails['mother_name'],
                'Mother Phone' => $getstudentdetails['mother_phone'],
                'Mother Occupation' => $getstudentdetails['mother_occupation'],
                'Guardian Name' => $getstudentdetails['guardian_name'],
                'Guardian Email' => $getstudentdetails['guardian_email'],
                'Guardian Relation' => $getstudentdetails['guardian_relation'],
                'Guardian Phone' => $getstudentdetails['guardian_phone'],
                'Guardian Occupation' => $getstudentdetails['guardian_occupation'],
                'Guardian Address' => $getstudentdetails['guardian_address'],
                'Nationality' => $getstudentdetails['nationality'],
                'Blood Group' => $getstudentdetails['blood_group'],
                'Previous School' => $getstudentdetails['previous_school'],
                'Adhar No' => $getstudentdetails['adhar_no'],
            ],
            [
                'Name' => $getstudentdetails['firstname'] . " " . $getstudentdetails['lastname'],
                'Admission Date' => $getstudentdetails['admission_date'],
                'Course' => $getstudentdetails['class'],
                'Section' => $getstudentdetails['section'],
                'Date of ' => $getstudentdetails['dob'],
                'Phone No' => $getstudentdetails['phone'],
                'Caste' => $getstudentdetails['cast'],
                'Religion' => $getstudentdetails['religion'],
                'Email' => $getstudentdetails['email'],
                'Current Address' => $getstudentdetails['current_address'],
                'Permanent Address' => $getstudentdetails['permanent_address'],
                'Father Name' => $getstudentdetails['father_name'],
                'Father Phone' => $getstudentdetails['father_phone'],
                'Father Occupation' => $getstudentdetails['father_occupation'],
                'Mother Name' => $getstudentdetails['mother_name'],
                'Mother Phone' => $getstudentdetails['mother_phone'],
                'Mother Occupation' => $getstudentdetails['mother_occupation'],
                'Guardian Name' => $getstudentdetails['guardian_name'],
                'Guardian Email' => $getstudentdetails['guardian_email'],
                'Guardian Relation' => $getstudentdetails['guardian_relation'],
                'Guardian Phone' => $getstudentdetails['guardian_phone'],
                'Guardian Occupation' => $getstudentdetails['guardian_occupation'],
                'Guardian Address' => $getstudentdetails['guardian_address'],
                'Nationality' => $getstudentdetails['nationality'],
                'Blood Group' => $getstudentdetails['blood_group'],
                'Previous School' => $getstudentdetails['previous_school'],
                'Adhar No' => $getstudentdetails['adhar_no'],
            ]
        ];
        $html = "<html><head><style>
        .page-break { page-break-before: always; }
        .image-container { position: absolute; }
        </style></head><body>";
        $html .= "
        <div style='position: relative;'>
                <table border='1' cellpadding='5' cellspacing='0' style='width: 100%;'>
                <tr><th colspan='2'>Student Details</th></tr>";


        foreach ($pageIndexArray as $pageno => $pageData) {
            $pagecontentcount = 0;
            foreach ($pageData as $pageContentTitle => $pageContent) {

                $html .= "<tr><td>" . $pageContentTitle . "</td><td>" . $pageContent . "</td></tr>";

                $pagecontentcount++;

                if ($pagecontentcount == count($pageData)) {
                    $html .= "
                </table><table border='1' cellpadding='5' cellspacing='0' style='width: 100%;'>";

                    $signatureimage = array_filter($images, function ($im) use ($pageno) {
                        return $im['pageno'] == $pageno + 1;
                    });
                    // var_dump($signatureimage);exit;

                    if (count($signatureimage) > 0) {

                        foreach ($signatureimage as $signature) {
                            $impath = $signature['src'];
                            $type = pathinfo($impath, PATHINFO_EXTENSION);
                            $data = file_get_contents($impath);
                            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                            // Create the page content with the image and table
                            if ($signature['x'] > 400) {
                                $signaturex = $signature['x'] - 400;
                                $html .= "
                            <div class='image-container' style='right: {$signaturex}; bottom: {$signature['y']}; width: {$signature['width']}px; height: {$signature['height']}px;'>
                            <img src='$base64' style='width: 100%; height: 100%;' />  
                            </div>";
                            } else {
                                $html .= "
                            <div class='image-container' style='left: {$signature['x']}; bottom: {$signature['y']}; width: {$signature['width']}px; height: {$signature['height']}px;'>
                            <img src='$base64' style='width: 100%; height: 100%;' />  
                            </div>";

                            }

                        }
                    }

                }


            }

            if ($pageno == 1) {

                $html .= " 
                <p style='margin-top: 20px;'><strong>Declaration:</strong> I hereby declare that the information provided above is true and accurate to the best of my knowledge and belief.</p>    
                </div>";
            }
            if (count($pageIndexArray) != $pageno) {

                $html .= " <div class='page-break'></div> ";
            }
        }




        $html .= "</body></html>";

        // Load the HTML content into Dompdf
        $dompdf->loadHtml($html);

        // Set paper size and orientation (optional)
        $dompdf->setPaper('A4', 'portrait');

        // Render the PDF
        $dompdf->render();
        // var_dump( "hi");exit;
        // var_dump( $html);
        // exit;
        // Output the PDF to the browser or save it to a file
        // $dompdf->stream("sample.pdf", ["Attachment" => false]); // Set to true to download the PDF
        $file_name = $id . '_approval_' . time() . '.pdf';

        $file_path = FCPATH . 'uploads/candidate_documents/' . $file_name;
        file_put_contents($file_path, $dompdf->output());


        return $file_path;
    }

    public function sendmail($documentName, $signermail, $tempid, $to_student = false)
    {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $this->load->library('form_validation');
        $this->load->library('email');
        $email_subject = 'Your Registration Details';
        $email_message = '<html><body>';
        $email_message .= '<h3>Thank you for your enquiry. Here are your details:</h3>';
        if (!$to_student) {

            $email_message .= '<table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse;">';
            $email_message .= '<tr><th>Field</th><th>Details</th></tr>';
            $email_message .= '<tr><td>Name</td><td>' . htmlspecialchars($data['name']) . '</td></tr>';
            $email_message .= '<tr><td>Email</td><td>' . htmlspecialchars($data['email']) . '</td></tr>';
            $email_message .= '<tr><td>Phone</td><td>' . htmlspecialchars($data['phone']) . '</td></tr>';
            $email_message .= '<tr><td>City</td><td>' . htmlspecialchars($data['city']) . '</td></tr>';
            $email_message .= '<tr><td>State</td><td>' . htmlspecialchars($data['state']) . '</td></tr>';
            $email_message .= '<tr><td>Course Level</td><td>' . htmlspecialchars($data['courselevel']) . '</td></tr>';
            $email_message .= '<tr><td>Stream</td><td>' . htmlspecialchars($data['stream']) . '</td></tr>';
            $email_message .= '<tr><td>Course</td><td>' . htmlspecialchars($data['course']) . '</td></tr>';
            $email_message .= '<tr><td>Approve</td><td><a href=' . base_url('site/approvemail/' . $signermail . '/' . $tempid) . '>Click here to sign the document</a></td></tr>';
            $email_message .= '</table>';
        }

        $email_message .= '</body></html>';

        // Send the email using PHPMailer
        $file_path = $documentName;
        $Body = "hai";
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 587;
        $mail->SMTPSecure = 'tls';
        $mail->SMTPAuth = true;
        $mail->Username = "medicalcollege@drmoopensmc.ac.in";
        $mail->Password = "ayxuwqtlvgmxwnbi";
        $mail->setFrom("medicalcollege@drmoopensmc.ac.in");
        $mail->addAddress($signermail);
        $mail->Subject = $email_subject;
        $mail->Body = $email_message;
        $mail->Subject = 'Your Enquiry Has been recieved.We will contact You Soon';
        $mail->msgHTML($email_message);
        $mail->addAttachment($file_path, 'document.pdf');
        // $mail->AltBody = 'HTML messaging not supported';
        $mail->send();
    }


    function userlogin()
    {
        //redirect('site/userlogin');
        if ($this->auth->user_logged_in()) {
            $this->auth->user_redirect();
        }
        $data = array();
        $data['title'] = 'Login';
        $school = $this->setting_model->get();
        $notice_content = $this->config->item('ci_front_notice_content');
        $notices = $this->cms_program_model->getByCategory($notice_content, array('start' => 0, 'limit' => 5));
        $data['notice'] = $notices;
        $data['school'] = $school[0];
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('userlogin', $data);
        } else {
            $login_post = array(
                'username' => $this->input->post('username'),
                'password' => $this->input->post('password')
            );
            $login_details = $this->user_model->checkLogin($login_post);

            if (isset($login_details) && !empty($login_details)) {
                $user = $login_details[0];

                if ($user->is_active == "yes") {

                    if ($user->role == "student") {

                        $result = $this->user_model->read_user_information($user->id);
                    } else if ($user->role == "parent") {
                        $result = $this->user_model->checkLoginParent($login_post);
                    }


                    if ($result != false) {
                        $setting_result = $this->setting_model->loginget(1);
                        //var_dump($setting_result);

                        if ($result[0]->role == "student") {
                            $session_data = array(
                                'id' => $result[0]->id,
                                'student_id' => $result[0]->user_id,
                                'centre_id' => $result[0]->centre_id,
                                'role' => $result[0]->role,
                                'username' => $result[0]->firstname . " " . $result[0]->lastname,
                                'date_format' => $setting_result['date_format'],
                                'currency_symbol' => $setting_result['currency_symbol'],
                                'timezone' => $setting_result['timezone'],
                                'sch_name' => $setting_result['name'],
                                'language' => array('lang_id' => $setting_result['lang_id'], 'language' => $setting_result['language']),
                                'is_rtl' => $setting_result['is_rtl'],
                                'theme' => $setting_result['theme'],
                                'image' => $result[0]->image,
                            );
                            $this->session->set_userdata('student', $session_data);
                            $this->customlib->setUserLog($result[0]->username, $result[0]->role);
                            redirect('user/user/dashboard');
                        } else if ($result[0]->role == "parent") {

                            if ($result[0]->guardian_relation == "Father") {
                                $image = $result[0]->father_pic;
                            } else if ($result[0]->guardian_relation == "Mother") {
                                $image = $result[0]->mother_pic;
                            } else if ($result[0]->guardian_relation == "Other") {
                                $image = $result[0]->guardian_pic;
                            }

                            $session_data = array(
                                'id' => $result[0]->id,
                                'student_id' => $result[0]->user_id,
                                'role' => $result[0]->role,
                                'username' => $result[0]->guardian_name,
                                'date_format' => $setting_result['date_format'],
                                'timezone' => $setting_result['timezone'],
                                'sch_name' => $setting_result['name'],
                                'currency_symbol' => $setting_result['currency_symbol'],
                                'language' => array(
                                    'lang_id' => $setting_result['lang_id'],
                                    'language' => $setting_result['language']
                                ),
                                'is_rtl' => $setting_result['is_rtl'],
                                'theme' => $setting_result['theme'],
                                'image' => $image,
                            );

                            $this->session->set_userdata('student', $session_data);
                            $s = array();
                            $user_id = ($result[0]->id);
                            $students_array = $this->student_model->read_siblings_students($user_id);

                            $child_student = array();
                            foreach ($students_array as $std_key => $std_val) {
                                $child = array(
                                    'student_id' => $std_val->id,
                                    'name' => $std_val->firstname . " " . $std_val->lastname
                                );
                                $child_student[] = $child;
                            }
                            $this->session->set_userdata('parent_childs', $child_student);
                            $this->customlib->setUserLog($result[0]->username, $result[0]->role);
                            redirect('parent/parents/dashboard');
                        }
                    } else {
                        $data['error_message'] = 'Account Suspended';
                        $this->load->view('userlogin', $data);
                    }
                } else {
                    $data['error_message'] = 'Your account is disabled please contact to administrator';
                    $this->load->view('userlogin', $data);
                }
            } else {
                $data['error_message'] = 'Invalid Username or Password';
                $this->load->view('userlogin', $data);
            }
        }
    }


    public function temporarystudentlogin()
    {

        if ($this->session->userdata('temporary_student')) {
            redirect('temporary_user/TemporaryUser');
        }

        $type = $this->input->post("type");


        if ($type == "otp") {
            $this->form_validation->set_rules('otp', 'OTP', 'trim|required|xss_clean');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        }

        if ($this->form_validation->run() == FALSE) {
            $data['otp'] = false;
            $this->load->view('student/temporary_admission/temporarylogin', $data);
        } else {


            if ($type == "otp") {
                $user_otp = $this->input->post('otp');
                $id = $this->input->post('id');
                $user_data = $this->temporary_admission_model->checkOtp($id, $user_otp);
                if ($user_data) {
                    $setting_result = $this->setting_model->loginget(2);

                    $session_data = array(
                        'id' => $user_data->id,
                        'username' => $user_data->firstname . " " . $user_data->lastname,
                        'date_format' => $setting_result['date_format'],
                        'currency_symbol' => $setting_result['currency_symbol'],
                        'timezone' => $setting_result['timezone'],
                        'sch_name' => $setting_result['name'],
                        'language' => array('lang_id' => $setting_result['lang_id'], 'language' => $setting_result['language']),
                        'is_rtl' => $setting_result['is_rtl'],
                        'theme' => $setting_result['theme'],
                    );
                    $this->session->set_userdata('temporary_student', $session_data);
                    $this->customlib->setUserLog($user_data->firstname . " " . $user_data->lastname, "Temporary Student");
                    redirect('temporary_user/TemporaryUser');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid OTP</div>');
                    redirect('site/temporarystudentlogin');
                }
            } else {

                $username = $this->input->post('username');


                $otp = $this->generateOTP(6);
                $user = $this->temporary_admission_model->checkUser($username, $otp);
                if ($user) {
                    // $this->sendOtpSms($username, $otp, $user->phone);
                    $data['otp'] = true;
                    $data['id'] = $user->id;
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">OTP send to phone number.</div>');
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">No user found.</div>');
                    redirect('site/temporarystudentlogin');
                }
            }
            $this->load->view('student/temporary_admission/temporarylogin', $data);
        }
    }


    private function sendOtpSms($user_id, $otp, $phone)
    {
        $password = $otp;
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
    // private function generateOTP($length)
    // {
    //     $salt = "0123456789";
    //     $len = strlen($salt);
    //     $makepass = '';
    //     mt_srand(10000000 * (float) microtime());
    //     for ($i = 0; $i < $length; $i++) {
    //         $makepass .= $salt[mt_rand(0, $len - 1)];
    //     }
    //     return $makepass;
    // }
    private function generateOTP($length)
    {
        $salt = "0";
        $len = strlen($salt);
        $makepass = '';
        mt_srand(10000000 * (float) microtime());
        for ($i = 0; $i < $length; $i++) {
            $makepass .= $salt[mt_rand(0, $len - 1)];
        }
        return $makepass;
    }

    public function successadmissionpayment()
    {
        $postData = explode('|', $this->input->post('msg'));

        if ($postData[0] == '0399') {
            $details = $this->Temporary_admission_model->getdetails($postData[3]);
            $res = json_decode($details['details'], true);

            $this->db->insert('payment_suceess', $res);
            $this->Temporary_admission_model->update_status($res['temporary_student_id']);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Payment Successfull</div>');
            redirect('temporary_user/TemporaryUser');
        } else {
            $this->session->set_flashdata('msg', '<div class="alert alert-danger">Payment Failed</div>');
            redirect('temporary_user/TemporaryUser');
        }
    }
}
