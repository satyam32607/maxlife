<?php

class Services_model extends CI_Model
{
			
	 function add()
     {
		$data   = array(
		    'company_id'   => $this->input->post("company_id"),
          	'category_id'     => $this->input->post("category_id"),
			'service_name'     => $this->input->post("service_name"),
			'service_code'   => $this->input->post("service_code"),
			'service_short_name'    => $this->input->post("service_short_name"),
			'service_description'  => $this->input->post("service_description"),
			'hsn_code'     => $this->input->post("hsn_code"),
			'gst_rate'     => $this->input->post("gst_rate"),
			'dw_share'     => $this->input->post("dw_share"),
			'partner_share'  => $this->input->post("partner_share"),
			'short'     => $short,
			'created_by'     => $this->session->userdata('user_id'),
			'created_on'      => date('Y-m-d H:i:s'),
        );
        $result   = $this->db->insert('services', $data);
		$service_id  = $this->db->insert_id();
		if($result > 0)
		{
			return $service_id;
		 }
		else
			return 0;


    } //End of add function
	
	
	function view_services($company_id)
		{
			$this->db->select('users.name,services.*,categories.category_id,categories.category_name');
			$this->db->from('services');
			$this->db->join('users', 'users.user_id = services.company_id');
			$this->db->join('categories', 'categories.category_id = services.category_id');
			if($company_id!='0')
			$this->db->where('services.company_id',$company_id);
			$this->db->where('services.is_active', '1');
			$this->db->order_by('services.service_name', 'ASC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
		
			return $result;
	
		} //End of View function
		
		
	  function service_edit($service_id)
		{
			if ($service_id == '') {
				redirect(base_url() . "admin/services/view");
			}
			$this->db->select('*');
			$this->db->from('services');
			$this->db->where('service_id', $service_id);
			$query = $this->db->get();
			return $query->row();
	
		} //End of edit function
	
	
		 function update_service($service_id)
		 {
			$data = array(
			'company_id'   => $this->input->post("company_id"),
          	'category_id'     => $this->input->post("category_id"),
			'service_name'     => $this->input->post("service_name"),
			'service_code'   => $this->input->post("service_code"),
			'service_short_name'    => $this->input->post("service_short_name"),
			'service_description'  => $this->input->post("service_description"),
			'hsn_code'     => $this->input->post("hsn_code"),
			'gst_rate'     => $this->input->post("gst_rate"),
			'dw_share'     => $this->input->post("dw_share"),
			'partner_share'  => $this->input->post("partner_share"),
			'short'     => $short,
			'modified_on'      => date('Y-m-d H:i:s'),
			);
			$this->db->where('service_id', $service_id);
			$result = $this->db->update('services', $data);
			if ($result)
		    return 1;
			else
			return 0;
			
		 } //End of Update function
		 
	   
	
 function update_status($service_id, $status)
    {
		 if($status=='1')
		 {	$data = array(
				'is_active' => $status,
				'deactive_date' =>''
			);
		 }
		 else
		 {
			$data = array(
				'is_active' => $status,
				'deactive_date' => date('Y-m-d H:i:s')
			);
		 }
        $this->db->where('service_id', $service_id);
	    $result = $this->db->update('services', $data);
		if($result)
		  return '1';
		 else 
		 return '0';

    } //End of Update status function

	

	
}