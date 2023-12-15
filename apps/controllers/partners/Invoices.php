<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoices extends CI_Controller {

	
public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'V');	
		$this->load->model('partners/invoices_model');
		$this->load->library('upload');
		$this->load->library('image_lib');
	}
	

	public function view()
	{
		$data=array();
		$data['title'] = title." | View Invoices";
		$data['main_heading'] ="Invoices";
		$data['heading'] = "View Invoices";
	
		$results = $this->invoices_model->view_invoices();
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$this->load->view('partners/invoices/view', $data);		
    } //end of view functionality	
	
	
	public function add()
	{
	      $data['title'] = title." | Add Invoice";
		  $data['main_heading'] = "Invoices";
		  $data['heading'] = "Add Invoice";
		  $data['already_msg']="";
		  $results="";
		  $total_results="";
		  
		 /* echo "<pre>";
		  print_r($_POST);
		  echo "</pre>";*/
		   
		   
		  if($this->input->post('form_type')=='1')
		  {
			$this->form_validation->set_rules('choose_invoice_month', 'Choose Invoice Month', 'required|trim');  
		   $results = $this->invoices_model->get_services($this->input->post('choose_invoice_month'));
		   $total_results = count($results);
		   // die();
		  }
		 
		 
	  if($this->input->post('form_type')=='2')
	  {
		  $this->form_validation->set_rules('invoice_date', 'Invoice Date', 'required|trim');
		  $this->form_validation->set_rules('user_remarks', 'User Remarks', 'trim');
			   
		if ($this->form_validation->run()) {
			  	
			$invoice_date = substr($this->input->post('invoice_date'),0,7);	
		    $this->db->select('*');
		    $this->db->from('invoices');
		    $this->db->where('company_id',$this->session->userdata('master_id'));
		    $this->db->where('user_id',$this->session->userdata('user_id'));
		   // $this->db->where('MONTH(invoice_date)',$this->input->post('choose_invoice_month'));
  		    $this->db->where("DATE_FORMAT(invoice_date,'%Y-%m')",$invoice_date);
		    $query = $this -> db -> get();
		   // echo $this->db->last_query();
			//echo "<br><br>";
		   	//die();
		   if($query->num_rows() > 0)
		   {
		    $data['already_msg']=' This Month Invoice '.$this->input->post('invoice_date').' is already exists, Please try another.';
		  }
		 else
		  {			  
			 $invoice_id =  $this->invoices_model->add();	
			 if($invoice_id!='0'){
			 	  
			     if($invoice_id=='0')
			       $msg = "There is some error in Save Invoice Record.";
			     else  
			       $msg = "Invoice has been created successfully.";
				   			 
			    $this->session->set_flashdata('success_message', $msg);	
			    redirect(base_url() . 'partners/invoices/view');				
			}  
		  }
	    } //end of add  functionality
	  }
		
		$data['results'] =$results;
		$data['total_results'] =$total_results;
		
	   $data['choose_invoice_month']= $this->input->post('choose_invoice_month');
	   $this->load->view('partners/invoices/add.php', $data);
	}
	
	public function edit($invoice_id){
		
		  
		  $data['title'] = title." | Edit Invoice";
		  $data['main_heading'] = "Invoices";
		  $data['heading'] = "Edit Invoice";
          $data['already_msg']="";
			 
		  $this->form_validation->set_rules('invoice_date', 'Invoice Date', 'required|trim');
		  $this->form_validation->set_rules('user_remarks', 'User Remarks', 'trim');
		  
		if ($this->form_validation->run()) {
		   
		     $editresult =  $this->invoices_model->update_invoice($this->input->post('invoice_id'));	
			
		      if($editresult=='1')
			   $msg = "Invoice record has been updated successfully.";
			  else
			   $msg="There is some error in update record."; 
			   
		      $this->session->set_flashdata('success_message', $msg);
		      redirect(base_url() . "partners/invoices/view/".$this->input->post('invoice_id'));								
		}

		  $result =  $this->invoices_model->invoice_edit($invoice_id);
		  $data['edit_data'] = $result;
  
		  $this->load->view('partners/invoices/edit.php', $data);
		 
	}//end of Edit functionality*/
	
	
	
	public function details($invoice_id)
	{	
	  $data=array();
		$data['title'] = title." | View Invoices";
		$data['main_heading'] ="Invoices";
		$data['heading'] = "View Invoices";
	
	   if($this->input->post('invoice_id'))
		 $invoice_id = $this->input->post('invoice_id');
	   elseif($this->uri->segment('4'))
		 $invoice_id=$this->uri->segment('4');
		else
		 $invoice_id='0';
		
		$rowuser = $this->invoices_model->get_user_details();	 
		$rowinvoice = $this->invoices_model->get_invoice_details($invoice_id);
		$results = $this->invoices_model->get_invoice_services($invoice_id);
		
		$data['rowuser']  = $rowuser;   
		$data['rowinvoice']  = $rowinvoice;  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		
		$this->load->view('partners/invoices/details.php', $data);
		 
	}//end of Status  functionality*/

	
	
	public function status($invoice_id,$status)
	{	 // Update status  
	     $result = $this->invoices_model->update_status($invoice_id,$status);
		 if($result=='1')
		 {
		   $this->session->set_flashdata('success_message', 'Status has been updated successfully.');
		 }
		 else
		 {
			 $this->session->set_flashdata('warning_message', 'There is some error in status updation.');
		 }
		  redirect(base_url() . "partners/invoices/view");		
		 
	}//end of Status  functionality*/

	
}	
?>