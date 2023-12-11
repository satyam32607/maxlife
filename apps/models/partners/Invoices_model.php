<?php

class Invoices_model extends CI_Model
{
	
	function get_services($choose_invoice_month)
		{
			$this->db->select('user_services.*,user_service_documents.doc_status,user_service_documents.doc_approve_date,services.service_name,services.hsn_code,services.category_id');
			$this->db->join('user_service_documents', 'user_service_documents.user_service_id = user_services.user_service_id');
			$this->db->join('services', 'user_service_documents.user_service_id = user_services.user_service_id');
			$this->db->where('user_services.user_id',$this->session->userdata('user_id'));
			$this->db->where('user_services.is_active', '1');
			if($choose_invoice_month!='0')
			$this->db->where('user_services.start_date >=', date(''.$choose_invoice_month.'-01'));
			if($choose_invoice_month!='0')
			$this->db->where('user_services.end_date <=', date(''.$choose_invoice_month.'-31'));
			$this->db->group_by('user_service_documents.service_document_id');
			$this->db->order_by('services.service_name','ASC');
			$this->db->from('user_services');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";*/
			
			return $result;
	
		} //End of View function
		
	
	function get_invoice_no()
	{
		$this->db->select('invoice_no');
		$this->db->from('invoices');
		$this->db->order_by('invoice_no', 'DESC');
		$this->db->limit(1);
		$invoicenoquery = $this->db->get();
		$invrow = $invoicenoquery->row();	
		if($invoicenoquery -> num_rows() == 0)
		   {   $maxinvoice_no='1000';
		   }
		   else
		   {  
			$maxinvoiceno = $invrow->invoice_no;
			$maxinvoice_no = $maxinvoiceno+1;
		   }
	   //echo $CI->db->last_query(); 
	   return $maxinvoice_no;
	} //End of Get Details function
		
	 function add()
     {
		 $invoice_no=$this->get_invoice_no();
         $data        = array(
		    'financial_session_id'   =>'1',
            'invoice_no'     => $invoice_no,
			'company_id'   => $this->session->userdata('master_id'),
			'user_id'     => $this->session->userdata('user_id'),
			'invoice_date' => $this->input->post('invoice_date'),
			'user_remarks'   => $this->input->post('user_remarks'),
			'created_by'   => $this->session->userdata('user_id'),
			'created_on'      => date('Y-m-d H:i:s'),
        );
        $result   = $this->db->insert('invoices', $data);
		$invoice_id  = $this->db->insert_id();
		if($result > 0)
		{
			    $invoice_date = substr($this->input->post('invoice_date'),0,7);
		        $invservresult = $this->insert_invoice_services($invoice_id,$invoice_date);
				return $invoice_id;
		}
		else
		{
			return 0;
		}


    } //End of add function
	
	
	function insert_invoice_services($invoice_id,$invoice_date)
		{
			$this->db->where('user_id',$this->session->userdata('user_id'));
			if($invoice_date!='0')
			$this->db->where('start_date >=', date(''.$invoice_date.'-01'));
			if($invoice_date!='0')
			$this->db->where('end_date <=', date(''.$invoice_date.'-31'));
			$this->db->order_by('user_service_id','ASC');
			$this->db->from('user_services');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			if($query->num_rows() > 0)
			{
			foreach($result as $row){
			  $rowservice=get_table_info('services','service_id',$row->service_id);
			  $inv_data =array( 
				'invoice_id'    =>  $invoice_id,
				'service_id'    =>  $row->service_id,
				'price'    =>  $rowservice->service_price,
				'qty'   =>  $row->qty,
				'gst_amt'   =>  $rowservice->gst_rate,
				'created_by'   =>  $this->session->userdata('user_id'),
				'created_on'      => date('Y-m-d H:i:s')
			   );	
			  $insertresult= $this->db->insert('invoice_services',$inv_data);	
		  	}
				
			}
			return $result;
	
		} //End of View function
		
		function view_invoices()
		{
			$this->db->select('*');
			$this->db->from('invoices');
			$this->db->where('company_id', $this->session->userdata('master_id'));
			$this->db->where('user_id', $this->session->userdata('user_id'));
			$this->db->where('is_active', '1');
			$this->db->order_by('invoice_no', 'DESC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";*/
			
			return $result;
	
		} //End of View function
		
		
	
		


	  function trainer_edit($user_id)
		{
			if ($user_id == '') {
				redirect(base_url() . "vendors/trainers/view");
			}
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('users.user_type', 'T');
			$this->db->where('users.user_id', $user_id);
			$query = $this->db->get();
			return $query->row();
	
		} //End of edit function
	
	
		 function update_vendor($user_id)
		 {
			$data = array(
				'name'   => $this->input->post("trainer_name"),
				'email'     => strtolower($this->input->post("email")),
				'mobile_no1'     => $this->input->post("mobile_no1")
			);
			$this->db->where('user_id', $user_id);
			$this->db->where('user_type','T');
			$result = $this->db->update('users', $data);
			if ($result)
			   return 1;
			 else
			   return 0;
			
		 } //End of Update function
		 
	
	
	function get_user_details()
		{
			$this->db->select('users.pan_no,users.gst_no,users.name,users.first_name,users.last_name,users.email,users.mobile_no1,user_address.country_id,user_address.state_id,user_address.city_id,user_address.pin_code,user_address.address');
			$this->db->join('user_address', 'user_address.user_address_id = users.user_address_id');
			$this->db->from('users');
			$this->db->where('users.user_id', $this->session->userdata('user_id'));
			$query = $this->db->get();
			return $query->row();
	
		} //End of edit function
		
	
			 
	function get_invoice_details($invoice_id)
		{
			$this->db->select('*');
			$this->db->from('invoices');
			$this->db->where('invoice_id', $invoice_id);
			$this->db->where('company_id', $this->session->userdata('master_id'));
			$this->db->where('user_id', $this->session->userdata('user_id'));
			$query = $this->db->get();
			return $query->row();
	
		} //End of edit function
		
		
		function get_invoice_services($invoice_id)
		{
			$this->db->select('invoice_services.*,services.service_name,services.hsn_code');
			$this->db->from('invoice_services');
			$this->db->join('services', 'services.service_id = invoice_services.service_id');
			$this->db->where('invoice_services.invoice_id', $invoice_id);
			$this->db->order_by('invoice_services.invoice_service_id', 'ASC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";*/
			
			return $result;
	
		} //End of View function
	

 
		
	
}