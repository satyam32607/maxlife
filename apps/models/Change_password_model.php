<?php

class Change_password_model extends CI_Model
{
	
	 function update_password()
     {
		 $salt           = create_salt($password=NULL);
		 $password  = trim($this->input->post("userpass"));
         $data        = array(
            'password'=> SHA1($password.$salt),
			'salt'=>  $salt
        );
        $this->db->where('user_id', $this->session->userdata('user_id'));	
	    $result = $this->db->update('users', $data);
		if($result > 0)
		{
			$user_id =$this->session->userdata('user_id'); 
		 	$update_by[] = array('uid' => $this->session->userdata('user_id'), 'dt' => date('Y-m-d H:i:s'));
			$update_by_id = json_encode($update_by);
			$table_name = "users";
			$operation = "User Password updated";
			createLogFile($operation,$user_id,$update_by_id,$table_name);
		 }
		 if($result)
			return '1';
		else
			return 0;

    } //End of add function
	
	
}