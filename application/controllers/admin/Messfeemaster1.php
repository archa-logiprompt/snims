<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Messfeemaster extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        // if(!$this->rbac->hasPrivilege('fees_master','can_add')){
        //        access_denied();
        //        }
        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/mess fee master');
        $data['title'] = 'Feemaster List';
        $feegroup = $this->feegroup_model->get_feegroup();
        $data['feegroupList'] = $feegroup;
        $feetype = $this->feetype_model->get_messtype();
        $data['feetypeList'] = $feetype;
		
        $feegroup_result = $this->feesessiongroup_model->getMessFeesByGroup();
        $data['feemasterList'] = $feegroup_result;

        $this->form_validation->set_rules('feetype_id', 'FeeType', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
		 //$this->form_validation->set_rules('year', 'year', 'required');


         $this->form_validation->set_rules(
                'fee_groups_id', 'FeeGroup', array(
            'required',
            array('check_exists', array($this->feesessiongroup_model, 'messmaster_check_exists'))
                )
        );
		
      
        if ($this->form_validation->run() == FALSE) {
            
        } else {
            
			
			if($this->input->post('is_active_student_img') == 1)  
				 {  
				 $addfine = $this->input->post('is_active_student_img');
              $amount = $this->input->post('amount');
                $finetype = $this->input->post('finetype_id');
				 $amounttype = $this->input->post('amounttype_id');
				 
				  $fixedamount = $this->input->post('fixedamount');
				  
				   $percentage = $this->input->post('percentage');
            } else {
                $addfine = 0;
                $finetype = 0;
				$amounttype=0;
				$fixedamount = 0;
                $percentage = 0;
				$amount=0;
				
            }
            $insert_array = array(
               
                'fee_groups_id' => $this->input->post('fee_groups_id'),
                'feetype_id' => $this->input->post('feetype_id'),
                'amount' => $this->input->post('amount'),
				//'year' => $this->input->post('year');
                'due_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('due_date'))),
				 'session_id' => $this->setting_model->getCurrentSession(), 
			     'amounttype'=>$amounttype,
				 'finetype'=>$finetype,
				 'fixedamount'=>$fixedamount,
				 'percentage'=>$percentage,
				 'addfine'=>$addfine,
           );
            $feegroup_result = $this->feesessiongroup_model->add_messfeemaster($insert_array);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Master added successfully</div>');
            redirect('admin/messfeemaster/index');
        }

        $this->load->view('layout/header', $data);
        $this->load->view('admin/messfeemaster/feemasterList', $data);
        $this->load->view('layout/footer', $data);
    }

    function delete($id) {
        if (!$this->rbac->hasPrivilege('fees_master', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Fees Master List';
        $this->feegrouptype_model->remove_messfeemaster($id);
        redirect('admin/messfeemaster/index');
    }
	
	

    function deletegrp($id) {
        $data['title'] = 'Fees Master List';
        $this->feesessiongroup_model->remove_messfee($id);
        redirect('admin/messfeemaster');
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('fees_master', 'can_edit')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/mess fee master');
        $data['id'] = $id;
        $feegroup_type = $this->feegrouptype_model->getmess($id);
        $data['feegroup_type'] = $feegroup_type;

        $feegroup = $this->feegroup_model->get_feegroup();
        $data['feegroupList'] = $feegroup;
        $feetype = $this->feetype_model->get_messtype();
        $data['feetypeList'] = $feetype;
        $feegroup_result = $this->feesessiongroup_model->getMessFeesByGroup();
        $data['feemasterList'] = $feegroup_result;
	     /*$feeyear = $this->feemaster_model->getfeeyear();
         $data['feeyearlist'] = $feeyear;*/

        $this->form_validation->set_rules('feetype_id', 'FeeType', 'required');
        $this->form_validation->set_rules('amount', 'Amount', 'required');
		
        $this->form_validation->set_rules(
                'fee_groups_id', 'FeeGroup', array(
            'required',
            array('check_exists', array($this->feesessiongroup_model, 'messmaster_check_exists'))
                )
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/messfeemaster/feemasterEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
			
			if($this->input->post('is_active_student_img') == 1)  
				 {  
				 $addfine = $this->input->post('is_active_student_img');
                 $amount = $this->input->post('amount');
                 $finetype = $this->input->post('finetype_id');
				 $amounttype = $this->input->post('amounttype_id');
				 
				 if ($amounttype == 'Fixed Amount' ) {
                
				 $fixedamount = $this->input->post('fixedamount');
				  $percentage = 0;
            } else{
                
				 $percentage = $this->input->post('percentage');
            	 $fixedamount = 0;
			}
				 
				  
            } else {
                $addfine = 0;
                $finetype = 0;
				$amounttype=0;
				$fixedamount = 0;
                $percentage = 0;
				$amount=0;
				
            }
			
			
            $insert_array = array(
                'id' => $this->input->post('id'),
                'feetype_id' => $this->input->post('feetype_id'),
                'due_date' => date('Y-m-d', $this->customlib->datetostrtotime($this->input->post('due_date'))),
                'amount' => $this->input->post('amount'),
				'amounttype'=>$amounttype,
				 'finetype'=>$finetype,
				 'fixedamount'=>$fixedamount,
				 'percentage'=>$percentage,
				 'addfine'=>$addfine,
            );
            $feegroup_result = $this->feegrouptype_model->edit_messmaster($insert_array);

            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Fees Master updated successfully</div>');
            redirect('admin/messfeemaster/index');
        }
    }

    function assign($id) {
        if (!$this->rbac->hasPrivilege('fees_group_assign', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'mess fee');
        $this->session->set_userdata('sub_menu', 'mess fee/mess fee master');
        $data['id'] = $id;
        $data['title'] = 'student fees';
        $class = $this->class_model->get();
        $data['classlist'] = $class;
        $feegroup_result = $this->feesessiongroup_model->getMessFeesByGroup($id);
        $data['feegroupList'] = $feegroup_result;


        $genderList = $this->customlib->getGender();
        $data['genderList'] = $genderList;
        $RTEstatusList = $this->customlib->getRteStatus();
        $data['RTEstatusList'] = $RTEstatusList;

        $category = $this->category_model->get();
        $data['categorylist'] = $category;


        if ($this->input->server('REQUEST_METHOD') == 'POST') {

            $data['category_id'] = $this->input->post('category_id');
            $data['gender'] = $this->input->post('gender');
            $data['rte_status'] = $this->input->post('rte');
            $data['class_id'] = $this->input->post('class_id');
            $data['section_id'] = $this->input->post('section_id');

            $resultlist = $this->studentfeemaster_model->searchAssignMessFeeByClassSection($data['class_id'], $data['section_id'], $id, $data['category_id'], $data['gender'], $data['rte_status']);
			
			 $data['resultlist'] =array();
			
			if(!empty($resultlist))
			{
				  $ar=array();
			 foreach($resultlist as $key=>$val)
			 {
				 
				$id=$this->studentfee_model->check_studentfeeadvance($val['id']);
				$st['advance_id']=$id['id'];
				$st['studentlist']=$val;
				
				$ar[]=$st;
				
				}
				
				}
					
				 $data['resultlist']=$ar;	
				
		 }

        $this->load->view('layout/header', $data);
        $this->load->view('admin/messfeemaster/assign', $data);
        $this->load->view('layout/footer', $data);
    }

}

?>