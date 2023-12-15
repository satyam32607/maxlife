<?php

class Partners_model extends CI_Model
{

    function add()
    {
       $salt = create_salt($password=NULL);
       $password  = $this->input->post("userpass");	
        $data        = array(
           'name'   => $this->input->post("comp_name"),
           'email'     => strtolower($this->input->post("email")),
           'password'=> SHA1($password.$salt),
           'salt'=>  $salt,
           'user_type'   => 'V',
           'first_name'   => $this->input->post("first_name"),
           'last_name'     => $this->input->post("last_name"),
           'mobile_no1'     => $this->input->post("mobile_no1"),
           'mobile_no2'     => $this->input->post("mobile_no2"),
           'alternate_email'     => $this->input->post("alternate_email"),
           'landline_no'     => $this->input->post("landline_no"),
           'company_profile'   => $this->input->post("profile"),
		   'pan_no'   => $this->input->post("pan_no"),
		   'gst_no'   => $this->input->post("gst_no"),
		   'bank_name'   => $this->input->post("bank_name"),
		   'bank_beneficiary_name'   => $this->input->post("bank_beneficiary_name"),
		   'bank_account_no'   => $this->input->post("bank_account_no"),
		   'bank_ifsc_code'   => $this->input->post("bank_ifsc_code"),
           'created_by'   => $this->session->userdata('user_id'),
           'is_master'   =>'0',
           'master_id'   => $this->input->post("company_id"),
           'created_on'      => date('Y-m-d H:i:s'),
       );
       $result   = $this->db->insert('users', $data);
       $user_id  = $this->db->insert_id();
       if($result > 0)
       {
         if($this->input->post("country_id")!='')
         {
           $user_address_id = $this->insertUserAddress($user_id);
           $update_data =array( 
               'user_address_id' => $user_address_id,
            );	
            $this->db->where('user_id', $user_id);
            $result = $this->db->update('users', $update_data);
          }
          
        }
        if($result){
           
           return $user_id;
        }
       else
           return 0;


   } //End of add function
   
   
   function insertUserAddress($user_id)
      {
          $address_data =array( 
               'user_id' => $user_id,
               'country_id' => $this->input->post("country_id"),
               'state_id' => $this->input->post("state_id"),
               'city_id' => $this->input->post("city_id"),
               'address' => $this->input->post("address"),
               'pin_code' => $this->input->post("pin_code"),
               'is_primary'=>'1',
               'post_date'      => date('Y-m-d H:i:s')
            );	
            $result= $this->db->insert('user_address',$address_data);	
            $user_address_id  = $this->db->insert_id();
           if($result)
               return $user_address_id;
           else
               return 0;
     }


	function view_partners($company_id,$user_id)
		{
			$this->db->select('users.*,user_address.country_id,user_address.state_id,user_address.city_id,user_address.pin_code,user_address.address');
			$this->db->join('user_address', 'user_address.user_address_id = users.user_address_id');
			$this->db->where('users.is_master', '0');
			$this->db->where('users.is_active', '1');
			$this->db->where('users.user_type', 'V');
			if($user_id!='0')
            $this->db->where('users.user_id',$user_id);
            if($company_id!='0')
            $this->db->where('users.master_id',$company_id);
			$this->db->order_by('users.email','ASC');
			$this->db->from('users');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			foreach ($result as $row) {
				
				 $row->total_invoices= $this->count_invoices($row->user_id);
				//$row->total_participants = $this->countparticipants($row->user_id);
				
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
		
		
		function countparticipants($user_id)
		{
			$this->db->where('user_type', 'U');
			$this->db->where('master_id', $user_id);
			$this->db->from('users');
			$query = $this->db->get();
			 //echo $this->db->last_query();
			 //echo "<br>";
			return $query->num_rows();
	
		} //End of Count function
	
	
	
	
	function partner_edit($user_id)
		{
			if ($user_id == '') {
				redirect(base_url() . "admin/partners/view");
			}
			$this->db->select('users.*,user_address.country_id,user_address.state_id,user_address.city_id,user_address.pin_code,user_address.address');
			$this->db->from('users');
			$this->db->join('user_address', 'user_address.user_address_id = users.user_address_id');
			$this->db->where('user_address.is_primary', '1');
			$this->db->where('users.user_type', 'V');
			$this->db->where('users.user_id', $user_id);
			$query = $this->db->get();
			// echo $this->db->last_query();echo "<pre>";print_r($query->row());die;
			return $query->row();
	
		} //End of edit function
	
	
		 function update_partner($user_id,$user_address_id)
		 {
			$data = array(
				'name'   => $this->input->post("comp_name"),
				'email'     => strtolower($this->input->post("email")),
				'first_name'   => $this->input->post("first_name"),
				'last_name'     => $this->input->post("last_name"),
				'mobile_no1'     => $this->input->post("mobile_no1"),
				'mobile_no2'     => $this->input->post("mobile_no2"),
				'alternate_email'     => $this->input->post("alternate_email"),
				'landline_no'     => $this->input->post("landline_no"),
				'company_profile'   => $this->input->post("profile"),
				'created_by'   => $this->session->userdata('user_id'),
				'company_profile'   => $this->input->post("company_profile"),
				'pan_no'   => $this->input->post("pan_no"),
			    'gst_no'   => $this->input->post("gst_no"),
			    'bank_name'   => $this->input->post("bank_name"),
			    'bank_beneficiary_name'   => $this->input->post("bank_beneficiary_name"),
			    'bank_account_no'   => $this->input->post("bank_account_no"),
			    'bank_ifsc_code'   => $this->input->post("bank_ifsc_code"),
				'master_id'   => $this->input->post("company_id"),
			 );
			$this->db->where('user_id', $user_id);
			$this->db->where('user_type','V');
			$result = $this->db->update('users', $data);
			if($result > 0)
   		    {
				if($this->input->post("country_id")!='')
				 {
					$user_address_id = $this->updateUserAddress($user_id,$user_address_id);
				  }
		    }
			if ($result)
			   return 1;
			 else
			   return 0;
			
		 } //End of Update function
		 
	
	 function updateUserAddress($user_id,$user_address_id)
		 {		$address_data =array( 
				  'country_id' => $this->input->post("country_id"),
				  'state_id' => $this->input->post("state_id"),
				  'city_id' => $this->input->post("city_id"),
				  'address' => $this->input->post("address"),
				  'pin_code' => $this->input->post("pin_code")
			   );	
			   $this->db->where('user_address_id', $user_address_id);
			   $this->db->where('user_id', $user_id);	
			   $result = $this->db->update('user_address', $address_data);
			  if($result)
				  return 1;
			  else
				  return 0;
		}

		 
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
	
	
	function view_vendors($company_id)
		{
			$this->db->select('users.*,user_address.country_id,user_address.country_code,user_address.state_id,user_address.city_id,user_address.pin_code,user_address.address');
			$this->db->from('users');
			$this->db->join('user_address', 'user_address.user_address_id = users.user_address_id');
			$this->db->where('user_address.is_primary', '1');
			$this->db->where('users.user_type', 'C');
			$this->db->where('users.is_master', '0');
			if($company_id!='0')
			$this->db->where('users.master_id', $company_id);
			$this->db->order_by('users.name', 'ASC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$results = $query->result();
			return $results;
	
		} //End of View function
		
		
   function view_participants($company_id,$designation_id,$role_id,$search_by,$search_value,$status,$limit, $start)
    {
		$this->db->select('users.user_id,users.first_name,users.last_name,users.email,users.gender,users.date_of_birth,users.date_of_joining,users.designation_id,users.mobile_no1,users.master_id,users.expiry_date,users.post_user_id,users.reg_date,users.is_active,user_roles.role_id,user_address.country_id,user_address.country_code,user_address.state_id,user_address.city_id,user_address.pin_code,user_address.address');
		$this->db->where('users.master_id',$company_id);
		$this->db->where('users.user_type','U');
		$this->db->where('user_roles.is_active','1');
		$this->db->join('user_address', 'user_address.user_address_id = users.user_address_id');
		$this->db->join('user_roles', 'users.user_id = user_roles.user_id');
		if($designation_id!='0')
		$this->db->where('users.designation_id', $designation_id);
		if($role_id!='0')
		$this->db->where('user_roles.role_id', $role_id);
		if($search_by!='0' && $search_value!='0')
		{  if($search_by=='1') 	
		   $this->db->like('users.mobile_no1', $search_value);
		   elseif($search_by=='2') 	
		   $this->db->where("CONCAT( first_name,  ' ', last_name ) LIKE  '%".trim($search_value)."%'");
		   elseif($search_by=='3') 	
		   $this->db->like('users.email', $search_value);
		}
		if($status!='0')
		{	if($status == 'a')
			{	$status = '1';
			}
			else
			{	$status = '0';
			}
			$this->db->where('users.is_active',$status);
		}	
		$this->db->group_by('users.user_id'); 
		$this->db->order_by('users.first_name ASC, users.last_name ASC');
		if($limit!=null || $start!=null)
		{
			$this->db->limit($limit,$start);
		}	
        $this->db->from('users');
        $query = $this->db->get();
	   //echo "--->".$this->db->last_query();
	    $result = $query->result();
		/*echo "<pre>";
		print_r($result);
		echo "</pre>";*/
       
        return $result;

    } //End of View  function
	
	
	function count_participants($company_id,$designation_id,$role_id,$search_by,$search_value,$status) {
			
			$this->db->where('users.master_id',$company_id);
			$this->db->where('users.user_type','U');
			$this->db->where('user_roles.is_active','1');
			$this->db->join('user_address', 'user_address.user_address_id = users.user_address_id');
			$this->db->join('user_roles', 'users.user_id = user_roles.user_id');
			if($designation_id!='0')
			$this->db->where('users.designation_id', $designation_id);
			if($role_id!='0')
			$this->db->where('user_roles.role_id', $role_id);
			if($search_by!='0' && $search_value!='0')
			{  if($search_by=='1') 	
			   $this->db->like('users.mobile_no1', $search_value);
			   elseif($search_by=='2') 	
			   $this->db->where("CONCAT( first_name,  ' ', last_name ) LIKE  '%".trim($search_value)."%'");
			   elseif($search_by=='3') 	
			   $this->db->like('users.email', $search_value);
			}
			if($status!='0')
			{	if($status == 'a')
				{	$status = '1';
				}
				else
				{	$status = '0';
				}
				$this->db->where('users.is_active',$status);
			}	
			$this->db->group_by('users.user_id'); 
			$query=$this->db->get('users');		
			//echo "--------------------->". $this->db->last_query();	   
			return $query->num_rows();
			
		}     //End of Count function
		
	
	

}
