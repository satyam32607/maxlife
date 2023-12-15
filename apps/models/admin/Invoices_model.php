<?php

class Invoices_model extends CI_Model
{
		
		function view_invoices($user_id)
		{
			$this->db->select('*');
			$this->db->from('invoices');
			if($user_id!='0')
			$this->db->where('user_id',$user_id);
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
		
	
	
	function get_user_details($user_id)
		{
			$this->db->select('users.pan_no,users.gst_no,users.name,users.first_name,users.last_name,users.email,users.mobile_no1,user_address.country_id,user_address.state_id,user_address.city_id,user_address.pin_code,user_address.address');
			$this->db->join('user_address', 'user_address.user_address_id = users.user_address_id');
			$this->db->from('users');
			$this->db->where('users.user_id',$user_id);
			$query = $this->db->get();
			return $query->row();
	
		} //End of edit function
		
	
			 
	function get_invoice_details($invoice_id)
		{
			$this->db->select('*');
			$this->db->from('invoices');
			$this->db->where('invoice_id', $invoice_id);
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
		
		
	function update_status($invoice_id, $status)
    {
		 if($status=='na')
		 {	$data = array(
				'admin_invoice_status' => $status,
				'admin_approve_date' =>''
			);
		 }
		 else
		 {
			$data = array(
				'admin_invoice_status' => $status,
				'admin_approve_date' => date('Y-m-d H:i:s')
			);
		 }
        $this->db->where('invoice_id', $invoice_id);
	    $result = $this->db->update('invoices', $data);
		if($result)
		  return '1';
		 else 
		 return '0';

    } //End of Update status function
	

 
		
	
}