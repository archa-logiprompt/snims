<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Api extends CI_Controller {

    function __construct() {
        parent::__construct();
    }


    function storeStudentPunch(){
        
        $data =  $this->db->get('punchlog')->result_array();
        
        foreach($data as $value){
            $data = json_decode($value['log']);
            $insertarr['deviceid'] = $data->DeviceId;
            $insertarr['studentadmno'] = $data->UserId;
            $insertarr['date'] = $data->LogDate;
            
            if($data->DeviceId==23 || $data->DeviceId==24){
                $insertarr['type']='';
                if($data->DeviceId==23){
                    $insertarr['type']=1;
                }else if($data->DeviceId==24){
                    $insertarr['type']=0;
                    
                }
                
                $this->db->insert('studentpunch',$insertarr);
                // exit;
            }
            
            
            
        }
    }

    
   function attendanceApi(){
        
        
        $dataarr =['{"DeviceId":"19","UserId":"123","LogDate":"2023-07-07 09:43:53.000"}','{"DeviceId":"20","UserId":"9999","LogDate":"2023-07-07 09:48:24.000"}'];
        
        foreach($dataarr as $data){
            
       $dataparsed = json_decode($data);
       $insertarr['studentadmno'] = $dataparsed->UserId;
       $insertarr['deviceid'] = $dataparsed->DeviceId;
       $insertarr['date'] = $dataparsed->LogDate; 
       $this->db->insert('studentpunch', $insertarr);
            
        }
         
      
       
       
   }
   
   public function get_data_from_server(){
       
        $postData = file_get_contents("php://input");
    //$data = json_decode(file_get_contents('php://input'), true);
    // print_r($postData);
    
    $this->db->insert('punchlog',['log'=>$postData]);
        $ps = json_decode($postData);

      //  foreach($ps as $postdata){
            
      // $dataparsed = json_decode($postdata);
      // $insertarr['studentadmno'] = $dataparsed->UserId;
      // $insertarr['deviceid'] = $dataparsed->DeviceId;
      // $insertarr['date'] = $dataparsed->LogDate; 
       
    
       
        // $this->db->insert('studentpunch', $insertarr);
            
       // }
        
    print_r($postData);
  
           
   }
   
   public function checkdata(){
       $data = $this->input->post('data');
        var_dump($data);
     foreach($data as $postdata){
         var_dump($postdata);
     }
            
       
   }

   
    public function send_data_to_server() {
        
        
        $data = ['{"DeviceId":"19","UserId":"123","LogDate":"2023-07-07 09:43:53.000"}','{"DeviceId":"20","UserId":"9999","LogDate":"2023-07-07 09:48:24.000"}'];
        
        $this->db->insert('punchlog',['log'=>$data]);
        
        
        

        // Convert the data to JSON
        $json_data = json_encode($data);
        
        

        // URL of the server to send data to
        $target_url = "https://caritas.onedusoft.in/api/get_data_from_server";

        // Perform the POST request using cURL
        $ch = curl_init($target_url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        // Display the response or handle it as needed
        echo $response;
    }

}

?>