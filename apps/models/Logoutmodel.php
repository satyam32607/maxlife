<?php 
class Logoutmodel extends CI_Model
{
	function logout()
	{ 
			//Update log sessions table records
			$data = array(
					 'logout_time'=>date('Y-m-d H:i:s'),
					 'log_status'=>'o',
					);
			$this->db->where('session_id',session_id());
			$this->db->where('user_id',$this->session->userdata('user_id'));
			$this->db->update('log_sessions',$data); 
			 
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('f_name');
			$this->session->unset_userdata('l_name');
			$this->session->unset_userdata('name');
			$this->session->unset_userdata('user_type');
			$this->session->unset_userdata('role_id');
			$this->session->unset_userdata('user_rights');
			$this->session->unset_userdata('user_modules');
			$this->session->unset_userdata('is_master');
			$this->session->unset_userdata('master_id');
			$this->session->sess_destroy(); 
		    redirect(base_url(),'refresh');	
		 }  //End of Logout function
}
?>