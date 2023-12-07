<?php 
class Login_model extends CI_Model
{
	 
	function login($email, $password)
		 {
		   $this -> db -> select('*');
		   $this -> db -> from('users');
		   $this -> db -> where('email', $email);
		   $this -> db -> limit(1);
		   $query = $this -> db -> get();
		  // echo $this->db->last_query();
		   if($query -> num_rows() == 1)
		   {
			  $row = $query->row();	
			 /* print_r($row);
			  die();*/
			  	$this->load->library('user_agent');
				if ($this->agent->is_browser())
				{		$agent = $this->agent->browser().' '.$this->agent->version();
				}
				elseif ($this->agent->is_robot())
				{		$agent = $this->agent->robot();
				}
				elseif ($this->agent->is_mobile())
				{		$agent = $this->agent->mobile();
				}
				else
				{		$agent = 'Unidentified User Agent';
				}
					  
			if (SHA1($password.$row->salt) == $row->password)
			{ 
			  if($row->is_active=='0')
			  {
				  return '1';
				  exit();
			  }
		  /*  elseif($row->expiry_date !='0000-00-00' && $row->expiry_date <= date('Y-m-d'))
			  { 
			 	 return '2';  //Validity has been expired.
			     exit();
			  }*/
			 else
			 { 
			 	//unset session values
				$this->session->unset_userdata('user_id');
				$this->session->unset_userdata('f_name');
				$this->session->unset_userdata('l_name');
				$this->session->unset_userdata('name');
				$this->session->unset_userdata('user_type');
				$this->session->unset_userdata('role_id');
				$this->session->unset_userdata('is_master');
				$this->session->unset_userdata('master_id');
				//Set the basic values into the session
				$this->session->set_userdata('user_id', $row->user_id);
				$this->session->set_userdata('f_name', $row->first_name);
				$this->session->set_userdata('l_name', $row->last_name);
				$this->session->set_userdata('name', $row->name);
				$this->session->set_userdata('user_type',$row->user_type);
				$this->session->set_userdata('is_master',$row->is_master);
				$this->session->set_userdata('master_id',$row->master_id);
				
				//Check Master Id Admin/Company Login
				if($row->user_type=='A')
				{
					if($row->is_master=='1')
					{    $this->session->set_userdata('master_id',$row->user_id);
						 $this->session->set_userdata('is_master',$row->user_id);
					}
					else
					 {   $this->db->select('user_id');
						 $this->db->from('users');
						 $this->db->where('user_id',$row->master_id);
						 $query = $this->db->get();
						 $masterrow = $query->row();	
						 $this->session->set_userdata('master_id',$masterrow->user_id);
					 }
				}
				elseif($row->user_type=='C')
				{
					if($row->is_master=='1')
					{    $this->session->set_userdata('master_id',$row->user_id);
						 $this->session->set_userdata('is_master',$row->is_master);
					}
					else
					 {   $this->db->select('user_id');
						 $this->db->from('users');
						 $this->db->where('user_id',$row->master_id);
						 $query = $this->db->get();
						 $masterrow = $query->row();	
						 $this->session->set_userdata('master_id',$masterrow->user_id);
					 }
				}
				elseif($row->user_type=='V')
				{
					if($row->is_master=='0')
					{    $this->db->select('user_id');
						 $this->db->from('users');
						 $this->db->where('user_id',$row->master_id);
						 $query = $this->db->get();
						 $masterrow = $query->row();	
						 $this->session->set_userdata('master_id',$masterrow->user_id);
					}
					else
					 {   $this->session->set_userdata('master_id',$row->user_id);
						 $this->session->set_userdata('is_master',$row->is_master);
					 }
				}
				else
				{	$this->session->set_userdata('master_id',$row->master_id);
				}
				//Insert Log sessions
				 $data = array(
				 'session_id'=>session_id(),
				 'user_id'=>$this->session->userdata('user_id'),
				 'login_time'=>date('Y-m-d H:i:s'),
				 'logout_time'=>date('Y-m-d H:i:s'),
				 'IP_address'=>$_SERVER['REMOTE_ADDR'],
				 'user_agent'=>$agent,				 
				 );
				$result = $this->db->insert('log_sessions',$data);
			
			   return $query->row();
			   exit();
			 }
				
			 }
			
			else
		    {
			 return '0'; //Invalid Password Details
			 exit();
		    }
		   }
		   else
		   {
			 return '0'; //Invalid Email Details
			 exit();
		   }
		 }  //End of login function
		 
}
?>
