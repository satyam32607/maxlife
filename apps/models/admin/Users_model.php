<?php

class Users_model extends CI_Model
{
	 function add()
     {
		$salt = create_salt($password=NULL);
		$password  = $this->input->post("userpass");	
		$data        = array(
		    'email'     => strtolower($this->input->post("email")),
			'password'=> SHA1($password.$salt),
			'salt'=>  $salt,
			'user_type'   => 'U',
			'urn_no'   => strtoupper($this->input->post("urn_no")),
			'first_name'   => $this->input->post("first_name"),
			'last_name'     => $this->input->post("last_name"),
			'date_of_birth'     => $this->input->post("date_of_birth"),
			'gender'     => $this->input->post("gender"),
			'location_name'     => $this->input->post("location_name"),
			'zone_name'     => $this->input->post("zone_name"),
			'state_name'     => $this->input->post("state_name"),
			'location_name'     => $this->input->post("location_name"),
			'mobile_no1'     => $this->input->post("mobile_no1"),
			'created_by'   => $this->session->userdata('user_id'),
			'reg_date'      => date('Y-m-d H:i:s'),
        );
		$result   = $this->db->insert('users', $data);
		$user_id  = $this->db->insert_id();
		if($result > 0)
	    {
			$resultapi = $this->insert_api_data($user_id);
			return $user_id;
		 }
		else
		{
			return 0;
		}


    } //End of add function
	
	
	public function insert_api_data($user_id){	
	      $curl = curl_init();
		  $userrow=get_table_info('users','user_id',$user_id);
		  curl_setopt_array(
            $curl,
            array(
                CURLOPT_RETURNTRANSFER => TRUE,
			    CURLOPT_URL            => "http://dreamweaversindia.com/api/hdfc_new_user.php",
                CURLOPT_POST           => TRUE,
				
			    CURLOPT_POSTFIELDS     => http_build_query(
                    array(
                        'authenticationToken'    => 'Hdfc-eyJ0eXAiOiJ-eyJ1c2VylucH-iZGFkaHdh-QEYgEF-bmlsQGdt',
                        'sponsor'     => 'hdfclife',
                        'candidate_name' => $userrow->first_name .' '.$userrow->last_name,
						'urnNo' => $userrow->urn_no,
						'applicationNo' => $userrow->application_no,
						'location' => $userrow->location_name,
						'agentNo' => '785645',
						'zone' => $userrow->zone_name,
						'state' => $userrow->state_name,
						'date_of_birth' => $userrow->date_of_birth,
						'emailId' => $userrow->email,
						'gender' => $userrow->gender,
						'loginId' => $userrow->urn_no,
						'mobileNo' => $userrow->mobile_no1,
						'course' => '34',
						'api'      => 'ADD_NEW_USER'
                    )
                )
            )
        );
	    $response = json_decode(curl_exec($curl));
		/*echo "<pre>";
		print_r($response);
		echo "</pre>";
		die();*/
		$statusCode = $response[0]->statusCode;
		$authorization = $response[0]->authorization;
		if($statusCode=='200')
		{	$urn_no = $response[0]->loginId;
			$data  = array(
				'api_status'   => '1',
				'authorization'   => $authorization
			);
			$this->db->where('urn_no',$urn_no);
			$result = $this->db->update('users', $data);
		}
		else
		{
			echo "<pre>";
			print_r($response);
			echo "</pre>";
			die();
		}
		
		 curl_close($curl);
		}
		
	
	
	    function view_users()
		{
			$this->db->select('*');
			$this->db->from('users');
			$this->db->where('users.user_type', 'U');
			$this->db->order_by('users.user_id', 'ASC');
			$query = $this->db->get();
			//echo $this->db->last_query();
			$result = $query->result();
			/*echo "<pre>";
			print_r($result);
			echo "</pre>";
			*/
			return $result;
	
		} //End of View function
		
	
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
		$this->db->where('user_type','U');
        $result = $this->db->update('users', $data);
		if($result)
		  return '1';
		 else 
		 return '0';

    } //End of Update status function
	
	
}