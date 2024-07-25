<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mailer {

    public $mail_config;
    private $sch_setting;

    public function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->model('emailconfig_model');
        $this->CI->mail_config = $this->CI->emailconfig_model->getActiveEmail();
        $this->CI->load->model('setting_model');
        $this->sch_setting = $this->CI->setting_model->get();
    }

    public function send_mail($toemail, $subject, $body) {

        
        $school_name = $this->sch_setting[0]['name'];
        
        $email=$toemail;
		
				$message = '<html><body>';
				$message .='<div style="min-height:300px;border:2px solid #0075AA;">';
				$message .='<div style="background:#0075AA;color:#fff;padding:5px;text-align:center;font-size:24px;">'.$subject.'</div>';
			    $message.='<div style="padding:10px;">';
				$message.='<p style="color:red;font-size:18px;"> '.$body.'</p>';
				$message.='</div>'; 
				$message .= "</div>";
				$message .= "</body></html>";
                $headers  = "MIME-Version: 1.0\r\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$headers .= "From:".$school_name."<noreplypcds@gmail.com>\r\n";
				$headers .= "To-Sender: \n";  
				$headers .= "X-Mailer: PHP\n"; // mailer  
				$headers.="Return-Path: noreplypcds@gmail.com\r\n";
                $headers .= "Reply-To: noreplypcds@gmail.com\r\n";
				$subject=$subject;
				mail($email, $subject, $message, $headers,'-fnoreplypcds@gmail.com');
        
        
        //$mail = new PHPMailer();
        
       // if ($this->CI->mail_config->email_type == "smtp") {

           // $mail->IsSMTP();
            //$mail->SMTPAuth = true;
            //$mail->SMTPSecure = $this->CI->mail_config->ssl_tls;
           // $mail->Host = $this->CI->mail_config->smtp_server;
          //  $mail->Port = $this->CI->mail_config->smtp_port;
           // $mail->Username = $this->CI->mail_config->smtp_username;
           // $mail->Password = $this->CI->mail_config->smtp_password;
            
            
            
            //$mail->SMTPSecure = 'ssl';
           // $mail->Host = 'smtp.gmail.com';
            //$mail->Port = 587;
           // $mail->Username = 'noreplypcds@gmail.com';
           // $mail->Password = 'K3lpm@lpm'; 
            
            
            
       // }
       // $mail->SetFrom('noreplypcds@gmail.com', $school_name);
       // $mail->AddReplyTo('noreplypcds@gmail.com', 'K3lpm@lpm');
       // $mail->Subject = $subject;
       // $mail->Body = $body;
       // $mail->AltBody = $body;
        //$mail->AddAddress($toemail);
        ////$res=$mail->Send();
        //var_dump($mail->ErrorInfo);
        //if ($mail->Send()) {
       //  return TRUE;
     //  } else {
         //   return FALSE;
       // }
    }

}
