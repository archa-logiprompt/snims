<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class File_reader_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

   

   public function postDiamond($data,$class_id,$section_id)
   {

        $sql="SELECT student_fees_master.id as 'student_fees_master_id'  from student_fees_master where student_session_id=(SELECT student_session.id from student_session where student_session.student_id=(SELECT students.id as student_id from students where students.admission_no=".$this->db->escape($data['Admission Number']).")and student_session.class_id=".$this->db->escape($class_id)." and student_session.section_id=".$this->db->escape($section_id).") and student_fees_master.fee_session_group_id=(SELECT fee_session_groups.id from fee_session_groups where fee_session_groups.fee_groups_id=(SELECT fee_groups.id from fee_groups where fee_groups.name LIKE '%" . $data['Fee Group'] . "%')) ";
                 $q =$this->db->query($sql);
                 $result=$q->row(); 

       $this->db->select('fee_groups_feetype.id as fee_groups_feetype_id')->from('fee_groups_feetype');
       $this->db->join('fee_groups','fee_groups.id=fee_groups_feetype.fee_groups_id');
       $this->db->join('feetype','feetype.id=fee_groups_feetype.feetype_id');

        $this->db->like('fee_groups.name',$data['Fee Group']);
        $this->db->like('feetype.type',$data['Fee Head']);
        $this->db->where('fee_groups_feetype.session_id',$this->current_session);
         $res=$this->db->get()->row();

    
     

           

      

              //print_r($result);
              
               $fee_date=date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($data['Date']));
               $invoice=$this->check_date($result->student_fees_master_id,$fee_date);

              $admin=$this->session->userdata('admin');
              $collected_by = " Collected By: " .$this->customlib->getAdminSessionUserName();
              $json_array = array(
                'amount' => $data['Amount'],
                'date' =>$fee_date ,
                'amount_discount'=>$data['Discount'] ,
                'amount_fine' => $data['Fine'],
                'description' =>$data['Cash/Bank'] . $collected_by,
                'payment_mode' =>$data['Cash/Bank'],
                
                
            );
            
           

             $deposit=array(
              'centre_id'=>$admin['centre_id'],
              'student_fees_master_id'=>$result->student_fees_master_id,
              'fee_groups_feetype_id'=>$res->fee_groups_feetype_id,
              'amount_detail'=>$json_array,
              'created_at' => date('Y-m-d')
               );
               
               
                 
               if(!empty($invoice))
               {
                  $this->excel_fee_total($deposit,$invoice);   
               }
               else{
                 $this->excel_fee_deposit($deposit);
               }
             
                


           
          
   }
 

     function check_date($student_fees_master_id,$date)
     {

      $this->db->select('*')->from('student_fees_deposite')->where('student_fees_master_id',$student_fees_master_id);
      $res=$this->db->get()->result_array();

        
        if(!empty($res))
        {
          
        foreach($res as $key=>$val)
        {
        
        $fee_date= date('Y-m-d',strtotime($date));
        $a=json_decode($val['amount_detail']);

        foreach($a as $t_key=>$fee)
        {
         if($fee->date == $fee_date)
          {

          
           $s=$fee->inv_no;    }
                 
                 }
               }
              }

         return $s;




     }
        

   function excel_fee_deposit($deposit)
    
  {

     $this->db->where('student_fees_master_id', $deposit['student_fees_master_id']);
     $this->db->where('fee_groups_feetype_id', $deposit['fee_groups_feetype_id']);
     $q = $this->db->get('student_fees_deposite');
        
        $admin=$this->session->userdata('admin');
        $invoice=$this->inv_no();



        if ($q->num_rows() > 0) {
            $desc = $deposit['amount_detail']['description'];
            $this->db->trans_start(); // Query will be rolled back
            $row = $q->row();
            $this->db->where('id', $row->id);
            $a = json_decode($row->amount_detail, true);
            
            
            $inv_no = max(array_keys($a)) + 1;
            $deposit['amount_detail']['inv_no'] = $invoice;
            $a[$invoice] = $deposit['amount_detail'];
            
            $deposit['amount_detail'] = json_encode($a);
            $this->db->update('student_fees_deposite', $deposit);
            
            $deposit_id['student_fee_deposit_id']= $row->id;
            $this->db->where(array('invoice.year'=>$admin['financial_year'],'invoice.invoice_no'=>$invoice));
            $this->db->update('invoice',$deposit_id);
            
            
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();

                return FALSE;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $row->id, 'sub_invoice_id' => $invoice));
            }
        }

       else {

            $this->db->trans_start(); // Query will be rolled back
            $deposit['amount_detail']['inv_no'] = $invoice;
            $desc = $deposit['amount_detail']['description'];
            $deposit['amount_detail'] = json_encode(array( $invoice => $deposit['amount_detail']));
            $this->db->insert('student_fees_deposite', $deposit);
            $inserted_id = $this->db->insert_id();
            
            
            $deposit_id['student_fee_deposit_id']= $inserted_id;
            $this->db->where(array('invoice.year'=>$admin['financial_year'],'invoice.centre_id'=>$admin['centre_id'],'invoice.invoice_no'=>$invoice));
            $this->db->update('invoice', $deposit_id);
            
            
            
            

            $this->db->trans_complete(); # Completing transaction

            if ($this->db->trans_status() === FALSE) {

                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $inserted_id, 'sub_invoice_id' => 1));
            }
        }
           
  }

  
   function excel_fee_total($deposit,$invoice)
    
  {

   

     $this->db->where('student_fees_master_id', $deposit['student_fees_master_id']);
     $this->db->where('fee_groups_feetype_id', $deposit['fee_groups_feetype_id']);
     $q = $this->db->get('student_fees_deposite');
        
        $admin=$this->session->userdata('admin');
        


        if ($q->num_rows() > 0) {
            $desc = $deposit['amount_detail']['description'];
            $this->db->trans_start(); // Query will be rolled back
            $row = $q->row();
            $this->db->where('id', $row->id);
            $a = json_decode($row->amount_detail, true);
            
            
            $inv_no = max(array_keys($a)) + 1;
            $deposit['amount_detail']['inv_no'] = $invoice;
            $a[$invoice] = $deposit['amount_detail'];
            
            $deposit['amount_detail'] = json_encode($a);
            $this->db->update('student_fees_deposite', $deposit);
            
            $deposit_id['student_fee_deposit_id']= $row->id;
            $this->db->where(array('invoice.year'=>$admin['financial_year'],'invoice.centre_id'=>$admin['centre_id'],'invoice.invoice_no'=>$invoice));
            $this->db->update('invoice',$deposit_id);
            
            
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();

                return FALSE;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $row->id, 'sub_invoice_id' => $invoice));
            }
        }

       else {

            $this->db->trans_start(); // Query will be rolled back
            $deposit['amount_detail']['inv_no'] = $invoice;
            $desc = $deposit['amount_detail']['description'];
            $deposit['amount_detail'] = json_encode(array( $invoice => $deposit['amount_detail']));
            $this->db->insert('student_fees_deposite', $deposit);
            $inserted_id = $this->db->insert_id();
            
            
            $deposit_id['student_fee_deposit_id']= $inserted_id;
            $this->db->where(array('invoice.year'=>$admin['financial_year'],'invoice.centre_id'=>$admin['centre_id'],'invoice.invoice_no'=>$invoice));
            $this->db->update('invoice', $deposit_id);
            
            
            
            

            $this->db->trans_complete(); # Completing transaction

            if ($this->db->trans_status() === FALSE) {

                $this->db->trans_rollback();
                return FALSE;
            } else {
                $this->db->trans_commit();
                return json_encode(array('invoice_id' => $inserted_id, 'sub_invoice_id' => 1));
            }
        }
           


 }





    

 function inv_no()
    {
        $admin=$this->session->userdata('admin');
        $this->db->select('starting_inv')->where('centre_id',$admin['centre_id'])->from('starting_invoice');
        $q=$this->db->get();
        $row=$q->row_array();   
        
    
    
     $res=$this->db->select('invoice.*')->where('year',$admin['financial_year'])->get('invoice');
     
    if($res->num_rows() >0)
    {
    
     $result=max($res->result_array());
     $max_no=$result['number']+1;
     $inv_no=$admin['financial_year'].'/'.$max_no;
     $data=array(
     'number'=>$max_no,
	 'centre_id'=>$admin['centre_id'],
     'year'=>$admin['financial_year'],
     'invoice_no'=> $inv_no
     
     );
     
     $this->db->insert('invoice',$data);    
    
        
    }
     
    else
    {
    
    $inv_no=$admin['financial_year'].'/'.$row['starting_inv'];
     $data=array(
     'number'=>$row['starting_inv'],
     'year'=>$admin['financial_year'],
     'centre_id'=>$admin['centre_id'],
      'invoice_no'=>$inv_no
     
     );
     
      $this->db->insert('invoice',$data);
        
        
        }
    
    
    return $inv_no;
        
    }


    /* public function posttotalfee($data,$class_id,$section_id,$invoice)
   {

      

     $sql="SELECT student_fees_master.id as 'student_fees_master_id'  from student_fees_master where student_session_id=(SELECT student_session.id from student_session where student_session.student_id=(SELECT students.id as student_id from students where students.admission_no=".$this->db->escape($data['Admission Number']).")and student_session.class_id=".$this->db->escape($class_id)." and student_session.section_id=".$this->db->escape($section_id).")";
                 $q =$this->db->query($sql);
                 $result=$q->row();



       $this->db->select('fee_groups_feetype.id as fee_groups_feetype_id')->from('fee_groups_feetype');
       $this->db->join('fee_groups','fee_groups.id=fee_groups_feetype.fee_groups_id');
       $this->db->join('feetype','feetype.id=fee_groups_feetype.feetype_id');

        $this->db->like('fee_groups.name',$data['Fee Group']);
        $this->db->like('feetype.type',$data['Fee Head']);
        $this->db->where('fee_groups_feetype.session_id',$this->current_session);
         $res=$this->db->get()->row();

             
                
             
              //$invoice=$this->inv_no();
        
              $admin=$this->session->userdata('admin');
              $collected_by = " Collected By: " . $this->customlib->getAdminSessionUserName();
              $json_array = array(
                'amount' => $data['Amount'],
                'date' => date('Y-m-d', $this->customlib->datetostrtotime($data['Date'])),
                'amount_discount'=>$data['Discount'] ,
                'amount_fine' => $data['Fine'],
                'description' =>$data['Cash/Bank'] . $collected_by,
                'payment_mode' =>$data['Cash/Bank'],
                
                
            );
            
             $deposit=array(

              'student_fees_master_id'=>$result->student_fees_master_id,
              'fee_groups_feetype_id'=>$res->fee_groups_feetype_id,
              'amount_detail'=>$json_array,
              'created_at' => date('Y-m-d')
               );
             
                $this->excel_fee_total($deposit,$invoice);


          
   }*/


 



 







    
    
}
