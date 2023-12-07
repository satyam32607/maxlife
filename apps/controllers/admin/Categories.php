<?php
error_reporting(-1);
ini_set('display_errors', 1);
defined('BASEPATH') OR exit('No direct script access allowed');
class Categories extends CI_Controller {
public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'A');	
		$this->load->model('admin/category_model');
	}
	
	
	public function add()
	{
		  $data['title'] = title." | Add Category";
		  $data['main_heading'] = "Categories";
		  $data['heading'] = "Add Category";
		  $data['already_msg']="";
		  
		  $this->form_validation->set_rules('category_type_id', 'Category Type', 'trim');
		  $this->form_validation->set_rules('company_id', 'Company', 'trim');	
		 // $this->form_validation->set_rules('category_name', 'Category name', 'required|trim');
		if ($this->form_validation->run()) {
			
		 	$result =  $this->category_model->insert_category($_POST['group-a']);
			if($result=='0')
			   $msg = "There is some error in Save Category Data.";
			 else  
			   $msg = "Category have been created successfully.";
			 
			  $this->session->set_flashdata('success_message', $msg);
			 redirect(base_url() . 'admin/categories/view');  
			
	    } //end of add  functionality
		
	   $this->load->view('admin/category/add.php', $data);
	}
	
	
	public function view()
	{
		$data=array();
		$data['title'] = title." | View Categories";
		$data['main_heading'] ="Categories";
		$data['heading'] = "View Categories";
		
		if($this->input->post('company_id'))
		     $company_id = $this->input->post('company_id');
	      elseif($this->uri->segment('4'))
			 $company_id=$this->uri->segment('4');
		  else
			 $company_id='0';
			 
		$results = $this->category_model->view_categories($company_id);
		  
		$data['results'] = $results;
		$num_rows = count($results);	
		$data['num_rows'] = $num_rows;
		  
		$this->load->view('admin/category/view', $data);
		
    } //end of view functionality
	
	
		public function edit($category_id){
		
		  $data['title'] = title." | Edit Category";
		  $data['main_heading'] = "Categories";
		  $data['heading'] = "Edit Category";
          $data['already_msg']="";
		  
		 
		  $this->form_validation->set_rules('category_type_id', 'Category Type', 'trim');	
		  $this->form_validation->set_rules('category_name', 'Category name', 'required|trim');
		 if ($this->form_validation->run()) {
		  // Update records 
		  
		  $quote_feild = array('company_id' =>$this->input->post('company_id'),'parent_id' =>$this->input->post('parent_id'),'category_name' =>trim($this->input->post('category_name')));
		  $unique_id = array('category_id' =>$category_id);
		  $item_result = check_unique_edit('categories',$quote_feild,$unique_id);
		  if($item_result==1)
		  {
			 $data['already_msg']=''.$this->input->post('category_name').' already exists, Please try another.';
		  }
		 else
		  {
		   $result =  $this->category_model->update_category($this->input->post('category_id'));
		   if($result=='1')
			   $msg = "Category record has been updated successfully.";
			else
			   $msg="There is some error in update record."; 
			   
		  $this->session->set_flashdata('success_message', $msg);
		  redirect(base_url() . "admin/categories/view/".$this->input->post('category_id'));
		  
		  }
		}
		  $result =  $this->category_model->category_edit($category_id);	
		  $data['edit_data'] = $result;
		  
		  $this->load->view('admin/category/edit.php', $data);
		 
	}//end of Edit functionality*/
	
	public function status($category_id,$status)
	{
		 // Update status  
	     $result = $this->category_model->update_status($category_id,$status);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Status has been updated successfully.');
           redirect(base_url() . "admin/categories/view");		
		 }
		 
	}//end of Status  functionality*/
	
}	
?>