<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Itemreport extends Admin_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }




function index() {
	
	
	if (!$this->rbac->hasPrivilege('item_report', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Inventory');
        $this->session->set_userdata('sub_menu', 'itemreport/index');
        //$data['title'] = 'Item Categorey List';
       
		$itemstore = $this->itemstore_model->get();
        $data['itemstore'] = $itemstore;
		
	
		$this->load->view('layout/header', $data);
        $this->load->view('admin/itemreport/itemreport', $data);
        $this->load->view('layout/footer', $data); 
		 
	
}





    function storewise() {
        if (!$this->rbac->hasPrivilege('item_report', 'can_view')) {
            access_denied();
        }
        $this->session->set_userdata('top_menu', 'Inventory');
        $this->session->set_userdata('sub_menu', 'itemreport/index');
        //$data['title'] = 'Item Categorey List';
       
		$itemstore = $this->itemstore_model->get();
        $data['itemstore'] = $itemstore;
		
		
		 if($this->input->server('REQUEST_METHOD') == "GET") {
		
		$this->load->view('layout/header', $data);
        $this->load->view('admin/itemreport/itemreport', $data);
        $this->load->view('layout/footer', $data); 
		 
		
		
		 }
		else
		
		{
		
		$search=$this->input->post('search');
		
		
		if(isset($search))
		{
		if($search=='search_filter')
		{
		
		$this->form_validation->set_rules('store','Store','required');
		
		if($this->form_validation->run() == FALSE) {
        $this->load->view('layout/header', $data);
        $this->load->view('admin/itemreport/itemreport', $data);
        $this->load->view('layout/footer', $data);
        } 
		
		else
		{
		  $id=$this->input->post('store');
		  $data['id']=$id;
		  $store=$this->itemstock_model->get_storewise($id);	
		  $data['store']=$store;
		  
		
		   
		}
		}
		$this->load->view('layout/header', $data);
        $this->load->view('admin/itemreport/itemreport', $data);
        $this->load->view('layout/footer', $data);  
		} } 
    }







    /*function delete($id) {
        if (!$this->rbac->hasPrivilege('item_category', 'can_delete')) {
            access_denied();
        }
        $data['title'] = 'Item Categorey List';
        $this->itemcategory_model->remove($id);
        redirect('admin/itemcategory/index');
    }

    function create() {
        if (!$this->rbac->hasPrivilege('item_category', 'can_add')) {
            access_denied();
        }
        $data['title'] = 'Add Item category';
        $category_result = $this->itemcategory_model->get();
        $data['categorylist'] = $category_result;
        $this->form_validation->set_rules('itemcategory', 'Item Categorey', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/itemcategory/itemcategoryList', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'item_category' => $this->input->post('itemcategory'),
                'description' => $this->input->post('description'),
            );
            $this->itemcategory_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success text-left">Item Categorey added successfully</div>');
            redirect('admin/itemcategory/index');
        }
    }

    function edit($id) {
        if (!$this->rbac->hasPrivilege('item_category', 'can_edit')) {
            access_denied();
        }
        $data['title'] = 'Edit Item Categorey';
        $category_result = $this->itemcategory_model->get();
        $data['categorylist'] = $category_result;
        $data['id'] = $id;
        $category = $this->itemcategory_model->get($id);
        $data['itemcategory'] = $category;
        $this->form_validation->set_rules('itemcategory', 'Item Categorey', 'trim|required|xss_clean');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('layout/header', $data);
            $this->load->view('admin/itemcategory/itemcategoryEdit', $data);
            $this->load->view('layout/footer', $data);
        } else {
            $data = array(
                'id' => $id,
                'item_category' => $this->input->post('itemcategory'),
                'description' => $this->input->post('description'),
            );
            $this->itemcategory_model->add($data);
            $this->session->set_flashdata('msg', '<div class="alert alert-success">Item Categorey updated successfully</div>');
            redirect('admin/itemcategory/index');
        }
    }*/

}

?>