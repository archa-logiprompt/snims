<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Newsmslib {

    private $_CI;
	public $user = "";
    public $password = "";
    public $senderId = "";
    var $AUTH_KEY = ""; //your AUTH_KEY here
    //var $senderId = ""; //your senderId here
    var $routeId = ""; //your routeId here
    var $smsContentType = ""; //your smsContentType here

    function __construct() {
        $this->_CI = & get_instance();
        $this->session_name = $this->_CI->setting_model->getCurrentSessionName();
		
    }

	function sendSMS($phone,$message,$params)
	{
		$this->user = $params['username'];
        $this->password = $params['password'];
        $this->senderId = $params['api_id'];
		
		$msg = urlencode($message);
        $mobile =$phone;
 		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL, "http://smsc.a4add.com/api/smsapi.aspx?username=".$this->user."&password=".$this->password."&to=".$mobile."&from=".$this->senderId."&message=".$msg.""); 
		curl_setopt($ch, CURLOPT_HEADER, 0);
 		curl_exec($ch);
 		curl_close($ch);  
		return $response;
	}


    /*function sendSMS($to, $message) {
        $content = 'AUTH_KEY=' . rawurlencode($this->AUTH_KEY) .
                '&message=' . rawurlencode($message) .
                '&senderId=' . rawurlencode($this->senderId) .
                '&routeId=' . rawurlencode($this->routeId) .
                '&mobileNos=' . rawurlencode($to) .
                '&smsContentType=' . rawurlencode($this->smsContentType);
        $ch = curl_init('https://yourapiurl.com' . $content);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }*/

}
?>