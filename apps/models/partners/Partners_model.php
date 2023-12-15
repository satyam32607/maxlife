<?php

class Partners_model extends CI_Model
{

	function view_partners($user_id)
		{
			$this->db->select('users.*,user_address.country_id,user_address.state_id,user_address.city_id,user_address.pin_code,user_address.address');
			$this->db->join('user_address', 'user_address.user_address_id = users.user_address_id');
			$this->db->join('invoices', 'invoices.user_id = users.user_id');
			$this->db->where('users.is_master', '0');
			$this->db->where('users.user_type', 'V');
			if($user_id!='0')
            $this->db->where('users.user_id',$user_id);
            $this->db->where('users.master_id',$this->session->userdata('user_id'));
			$this->db->order_by('users.user_id','ASC');
			$this->db->from('users');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			foreach ($result as $row) {
				
				$row->total_invoices= $this->count_invoices($row->user_id);
				
			}
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";*/
			
			return $result;
	
		} //End of View function
		
		
		function count_invoices($user_id)
		{
			$this->db->where('user_id',$user_id);
			$this->db->where('is_active','1');
			$this->db->from('invoices');
			$query = $this->db->get();
			return $query->num_rows();
	
		} //End of Count function
	

}
