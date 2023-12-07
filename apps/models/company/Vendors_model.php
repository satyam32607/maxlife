<?php

class Vendors_model extends CI_Model
{
	 function add()
     {
		$salt = create_salt($password=NULL);
		$password  = $this->input->post("userpass");	
         $data        = array(
		    'name'   => $this->input->post("vendor_name"),
            'email'     => strtolower($this->input->post("email")),
			'password'=> SHA1($password.$salt),
			'salt'=>  $salt,
			'user_type'   => 'V',
			'mobile_no1'     => $this->input->post("mobile_no1"),
			'is_master' =>'0',
			'master_id'   =>$this->session->userdata('user_id'),
			'created_by'   => $this->session->userdata('user_id'),
			'created_on'      => date('Y-m-d H:i:s'),
        );
        $result   = $this->db->insert('users', $data);
		$user_id  = $this->db->insert_id();
		if($result > 0)
				return $user_id;
		else
			return 0;


    } //End of add function
	
	

	
	function view_vendors()
		{
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('users.master_id',$this->session->userdata('master_id'));
			$this->db->where('users.user_type', 'V');
			$this->db->order_by('users.name', 'ASC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			foreach ($result as $row) {
				
				$row->total_trainers= $this->count_trainers($row->user_id);
				
			}
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";
			*/
			return $result;
	
		} //End of View function
		
		function count_vendors()
		{
			$this->db->where('user_type', 'U');
			$this->db->where('users.master_id',$this->session->userdata('master_id'));
			$this->db->from('users');
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->num_rows();
	
		} //End of Count function
		
	
	function count_trainers($user_id)
		{
			$this->db->where('user_type', 'T');
			$this->db->where('master_id', $user_id);
			$this->db->from('users');
			$query = $this->db->get();
			//echo $this->db->last_query();
			return $query->num_rows();
	
		} //End of Count function
			


	  function vendor_edit($user_id)
		{
			if ($user_id == '') {
				redirect(base_url() . "company/vendors/view");
			}
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('users.user_type', 'V');
			$this->db->where('users.user_id', $user_id);
			$query = $this->db->get();
			return $query->row();
	
		} //End of edit function
	
	
		 function update_vendor($user_id)
		 {
			$data = array(
				'name'   => $this->input->post("vendor_name"),
				'email'     => strtolower($this->input->post("email")),
				'mobile_no1'     => $this->input->post("mobile_no1")
			);
			$this->db->where('user_id', $user_id);
			$this->db->where('user_type','V');
			$result = $this->db->update('users', $data);
			if ($result)
			   return 1;
			 else
			   return 0;
			
		 } //End of Update function
		 
	 
	function update_photo($user_id,$file_name)
    {
        $data = array(
			'user_photo'   => $file_name,
        );
        $this->db->where('user_id', $user_id);
		$this->db->where('user_type','V');
        $result = $this->db->update('users', $data);
		if($result)
		{
		  return 1;
		}
        
    } //End of Update User function
	 
    function update_status($user_id, $status)
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
        $this->db->where('user_id', $user_id);
		$this->db->where('user_type','V');
        $result = $this->db->update('users', $data);
		if($result)
		  return '1';
		 else 
		 return '0';

    } //End of Update status function
	
	
		

		
	
}