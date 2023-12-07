<?php

class Groups_model extends CI_Model
{
	 function add()
     {
		$salt = create_salt($password=NULL);
		$password  = $this->input->post("userpass");	
		$role_rights=$this->input->post('role_rights');
		$user_rights = json_encode($role_rights);
		$user_modules=$this->input->post('user_modules');
		$user_modules = json_encode($user_modules);
		
         $data        = array(
		    'name'   => $this->input->post("comp_name"),
            'email'     => strtolower($this->input->post("email")),
			'password'=> SHA1($password.$salt),
			'salt'=>  $salt,
			'user_type'   => 'G',
			'alternate_email'     => $this->input->post("alternate_email"),
			'time_zone'    => $this->input->post("time_zone"),
			'first_name'   => $this->input->post("first_name"),
			'last_name'     => $this->input->post("last_name"),
			'landline_no'     => $this->input->post("landline_no"),
			'mobile_no1'     => $this->input->post("mobile_no1"),
			'mobile_no2'     => $this->input->post("mobile_no2"),
			'company_profile'   => $this->input->post("company_profile"),
			'user_rights'   => $user_rights,
			'user_modules'   => $user_modules,
			'post_user_id'   => $this->session->userdata('user_id'),
			'reg_date'      => date('Y-m-d H:i:s'),
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
		 	$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
			$update_by_id = json_encode($update_by);
			$table_name = "users";
			$operation = "Record added";
			createLogFile($operation,$user_id,$update_by_id,$table_name);
			  
			$path = "./assets/static/"; 
			$slash = '/'; strpos( $path, $slash ) ? '' : $slash = '\\';
			define( 'BASE_DIR', $path . $slash );
			$folder_name =   $user_id;   // User folder path
			$userDir =  BASE_DIR. "/$user_id/";   //  folder path
			$userphotoDir = BASE_DIR . $folder_name. '/user_photos/';   // User images folder path
			$thumbnail_dirPath = BASE_DIR . $folder_name. '/user_photos/resized/';   // thumbnail images folder path
			$medium_dirPath = BASE_DIR . $folder_name. '/user_photos/original/';   // medium images folder path
			$documents_dirPath = BASE_DIR . $folder_name. '/documents/';   // medium images folder path
			
			
			@chmod("$userDir", 0777); 
			$dirPath = BASE_DIR;   // Main folder path
			$rs = @mkdir( "$userPath", 0777);
			if (!file_exists($userDir) && !is_dir($userDir)) {
				$rs = @mkdir( "$dirPath", 0777);
				@mkdir( "$userDir", 0777);
				@mkdir( "$userphotoDir", 0777);
				@mkdir( "$thumbnail_dirPath", 0777);
				@mkdir( "$medium_dirPath", 0777);
				@mkdir( "$documents_dirPath", 0777);
			 } 
		 }
		 if($result){
			 $user_result = gettableinfo('users',array('user_id'=>$user_id));
			 $fields = array(
				'email'=>$user_result->email,
				'name'=>$user_result->name,
				'first_name'=>$user_result->first_name,
				'last_name'=>$user_result->last_name,
			);
			common_mail('e',1,$fields);
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
				'country_code' => $this->input->post("country_code"),
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
	
	
	function view_groups()
		{
			$this->db->select('users.*,user_address.country_id,user_address.country_code,user_address.state_id,user_address.city_id,user_address.pin_code,user_address.address');
			$this->db->from('users');
			$this->db->join('user_address', 'user_address.user_address_id = users.user_address_id');
			$this->db->where('user_address.is_primary', '1');
			$this->db->where('users.is_master', '1');
			$this->db->where('users.user_type', 'G');
			$this->db->order_by('users.name', 'ASC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			//Count Company Alias Admin,Users Records
			foreach ($result as $row) {
				
				$row->total_companies= $this->count_companies($row->user_id);
				
			}
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";
			*/
			return $result;
	
		} //End of View function
		
		function count_companies($user_id)
		{
			$this->db->where('user_type', 'C');
			$this->db->where('is_master', '0');
			$this->db->where('master_id', $user_id);
			$this->db->from('users');
			$query = $this->db->get();
			return $query->num_rows();
	
		} //End of Count function\
		
		
		function count_users1($user_id)
		{
			$this->db->where('user_type', 'C');
			$this->db->where('is_master', '0');
			$this->db->where('master_id', $user_id);
			$this->db->from('users');
			$query = $this->db->get();
			return $query->num_rows();
	
		} //End of Count function\
		
	    function view_companies()
		{
			$this->db->select('users.*,user_address.country_id,user_address.country_code,user_address.state_id,user_address.city_id,user_address.pin_code,user_address.address');
			$this->db->from('users');
			$this->db->join('user_address', 'user_address.user_address_id = users.user_address_id');
			$this->db->where('user_address.is_primary', '1');
			$this->db->where('users.is_master', '1');
			$this->db->where('users.is_active', '1');
			$this->db->where('users.user_type', 'C');
			$this->db->order_by('users.name', 'ASC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			//Count Company Alias Admin,Users Records
			foreach ($result as $row) {
				
				$row->total_users = $this->count_user($row->user_id);
				
			}
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";
			*/
			return $result;
	
		} //End of View function
		
		
			
		function count_user($user_id)
		{
			$this->db->where('user_type', 'U');
			$this->db->where('master_id', $user_id);
			$this->db->from('users');
			$query = $this->db->get();
			 //echo $this->db->last_query();
			 //echo "<br>";
			return $query->num_rows();
	
		} //End of Count function
	
	   
	
	
	function updateUserAddress($user_id,$user_address_id)
 	  {			$address_data =array( 
				'country_id' => $this->input->post("country_id"),
				'country_code' => $this->input->post("country_code"),
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
	
	
	
	function group_edit($user_id)
		{
			if ($user_id == '') {
				redirect(base_url() . "admin/groups/view");
			}
			$this->db->select('users.*,user_address.country_id,user_address.country_code,user_address.state_id,user_address.city_id,user_address.pin_code,user_address.address');
			$this->db->from('users');
			$this->db->join('user_address', 'user_address.user_address_id = users.user_address_id');
			$this->db->where('user_address.is_primary', '1');
			$this->db->where('users.user_type', 'G');
			$this->db->where('users.user_id', $user_id);
			$query = $this->db->get();
			// echo $this->db->last_query();echo "<pre>";print_r($query->row());die;
			return $query->row();
	
		} //End of edit function
	
	
		 function update_group($user_id,$user_address_id)
		 {
			$role_rights=$this->input->post('role_rights');
			$user_rights = json_encode($role_rights);
			$user_modules=$this->input->post('user_modules');
			$user_modules = json_encode($user_modules);
			$data = array(
				'name'   => $this->input->post("comp_name"),
				'email'     => strtolower($this->input->post("email")),
				'alternate_email'     => $this->input->post("alternate_email"),
				'mobile_no1'     => $this->input->post("mobile_no1"),
				'mobile_no2'     => $this->input->post("mobile_no2"),
				'landline_no'     => $this->input->post("landline_no"),
				'first_name'   => $this->input->post("first_name"),
				'last_name'     => $this->input->post("last_name"),
				'time_zone'    => $this->input->post("time_zone"),
				'company_profile'   => $this->input->post("company_profile"),
				'user_rights'   => $user_rights,
				'user_modules'   => $user_modules
			);
			$this->db->where('user_id', $user_id);
			$this->db->where('user_type','G');
			$result = $this->db->update('users', $data);
			if($result > 0)
   		    {
				if($this->input->post("country_id")!='')
				 {
					$user_address_id = $this->updateUserAddress($user_id,$user_address_id);
				  }
				$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
				$update_by_id = json_encode($update_by);
				$table_name = "users";
				$operation = "Record updated";
				createLogFile($operation,$user_id,$update_by_id,$table_name);
				
				$path = "./assets/static/"; 
				$slash = '/'; strpos( $path, $slash ) ? '' : $slash = '\\';
				define( 'BASE_DIR', $path . $slash );
				$folder_name =   $user_id;   // User folder path
				$userDir =  BASE_DIR. "/$user_id/";   //  folder path
				$userphotoDir = BASE_DIR . $folder_name. '/user_photos/';   // User images folder path
				$thumbnail_dirPath = BASE_DIR . $folder_name. '/user_photos/resized/';   // thumbnail images folder path
				$medium_dirPath = BASE_DIR . $folder_name. '/user_photos/original/';   // medium images folder path
				$documents_dirPath = BASE_DIR . $folder_name. '/documents/';   // medium images folder path
				
				@chmod("$userDir", 0777); 
				$dirPath = BASE_DIR;   // Main folder path
				$rs = @mkdir( "$userPath", 0777);
				if (!file_exists($userDir) && !is_dir($userDir)) {
					$rs = @mkdir( "$dirPath", 0777);
					@mkdir( "$userDir", 0777);
					@mkdir( "$userphotoDir", 0777);
					@mkdir( "$thumbnail_dirPath", 0777);
					@mkdir( "$medium_dirPath", 0777);
					@mkdir( "$documents_dirPath", 0777);
				 } 
				 
		    }
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
		$this->db->where('user_type','C');
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
		$this->db->where('user_type','G');
        $result = $this->db->update('users', $data);
		if($result)
		  return '1';
		 else 
		 return '0';

    } //End of Update status function
	
	
		
		
   function view_users($company_id,$designation_id,$role_id,$search_by,$search_value,$status,$limit, $start)
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
	
	
	
	
	function count_users($company_id,$designation_id,$role_id,$search_by,$search_value,$status) {
			
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