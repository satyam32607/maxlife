<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Invoices extends CI_Controller {

public function __construct()
	{
		parent:: __construct();
		valid_logged_in(FALSE,'C');	
		$this->load->model('company/invoices_model');
	}
	
	public function view()
	{
		$data=array();
		$data['title'] = title." | View Invoices";
		$data['main_heading'] ="Invoices";
		$data['heading'] = "View Invoices";
	
	    if($this->input->post('user_id'))
		 $user_id = $this->input->post('user_id');
	    elseif($this->uri->segment('4'))
		 $user_id=$this->uri->segment('4');
		else
		 $user_id='0';
		 
		$results = $this->invoices_model->view_invoices($user_id);
		  
		$data['results']  = $results;
		$num_rows         = count($results);	
		$data['num_rows'] = $num_rows;		  
		$this->load->view('company/invoices/view', $data);		
    } //end of view functionality	
	

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
		 
		if($this->input->post('user_id'))
		 $user_id = $this->input->post('user_id');
	    elseif($this->uri->segment('5'))
		 $user_id=$this->uri->segment('5');
		else
		 $user_id='0';
		
		$rowuser = $this->invoices_model->get_user_details($user_id);	 
		$rowinvoice = $this->invoices_model->get_invoice_details($invoice_id,$user_id);
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
		  redirect(base_url() . "company/invoices/view");		
		 
	}//end of Status  functionality*/

	
}	
?>