<?php

class Registration_model extends CI_Model
{

    
    function add()
    {
		$obj = json_decode($_POST['result']);
		/*echo "<pre>";
		print_r($obj);
		echo "</pre>";*/
			
		$email_id= xssclean($obj->email);
		/*$prospectus_form_no= xssclean($obj->prospectus_form_no);
		$this->db->select('prospectus_form_no');
		$this->db->where('prospectus_form_no', $prospectus_form_no);
		$this->db->from('users');
		$prospectus_query = $this->db->get();*/
		
		$this->db->select('email');
		$this->db->where('email', $email_id);
		$this->db->from('users');
		$query = $this->db->get();
		//echo $this->db->last_query();
		if($query -> num_rows() > 0)
		{		 return '0|||2';//User email is already exists
		}
		/*elseif($prospectus_query -> num_rows() > 0)
		{		 return '0|||3';  //User Prospectus no is already exists
		}*/
		else
		{
		 $salt           = create_salt($password=NULL);
		 $password  =  xssclean($obj->userpass);	
		 if($obj->identity_proof_no!='')
		 $identity_proof_type = xssclean($obj->identity_proof_type);
		 else
		 $identity_proof_type = '';
		 
		 $this->db->where('centre_id',$obj->centre_id);
		 $this->db->where('course_id',$obj->course_id);
		 $this->db->where('start_year',date('Y'));
		 $this->db->order_by('start_year','ASC');
		 $query = $this->db->get('course_batches');	
		 $batchrow = $query->row();
		 //echo $this->db->last_query();
		// die();
		 $batch_id = $batchrow->batch_id;
		 $semester_id = '1';
		 
		if($obj->course_id=='17' || $obj->course_id=='18')
		 { $corporate_status = '1';
		   $expiry_date=date("Y-m-d",strtotime("+3 months",strtotime(date("Y-m-d")))); 
		 }
		 else
		 { $corporate_status = '0';
		   $expiry_date=NULL;
		 }
		
         $email       = strtolower(xssclean($obj->email));
         $data        = array(
            'email'         => $email,
            'user_type'     => 'S',
			'password'=> SHA1($password.$salt),
			'salt'=>$salt,
			'corporate_status'=>$corporate_status,
			'expiry_date'=>$expiry_date,
            'first_name'     => xssclean($obj->first_name),
			'last_name'     => xssclean($obj->last_name),
			'guardian_name'     => xssclean($obj->guardian_name),
			'gender'     => xssclean($obj->gender),
			'date_of_birth'    => xssclean($obj->date_of_birth),
			'mobile_no'   => xssclean($obj->mobile_no),
			'landline_no'   => xssclean($obj->landline_no),
			'state_id'       => xssclean($obj->state_id),
			'city_id'       => xssclean($obj->city_id),
			'address'       => xssclean($obj->address),
            'pin_code'   => xssclean($obj->pin_code),
			'blood_group'   => xssclean($obj->blood_group),
			'identity_proof_type'   => $identity_proof_type,
			'identity_proof_no'   => xssclean($obj->identity_proof_no),
			'master_id'   => xssclean($obj->centre_id),
			'user_stream'   => xssclean($obj->course_stream),
			'user_course_id'   =>xssclean($obj->course_id),
			'user_batch_id'   =>xssclean($batch_id),
			'user_semester_id'   =>xssclean($semester_id),
			'prospectus_form_no'      => xssclean($obj->prospectus_form_no),
			'reg_date'      => date('Y-m-d H:i:s'), 
        );
        $result   = $this->db->insert('users', $data);
		$user_id = $this->db->insert_id();
	   if($user_id) {
		   // Add student in account heads table
		   $account_heads=array(
		   'centre_id'=>xssclean($obj->centre_id),
		   'acc_name'=>xssclean($obj->first_name).' '.xssclean($obj->last_name),
		   'acc_external_ref_id'=>$user_id,
		    );
			$result_acc_head   = $this->db->insert('accounts_heads', $account_heads);
		   // end
		   
		   // Add group in account head table
			$fee_head_id='1';
			$category_id='0';
			$centre_id=xssclean($obj->centre_id);
			$course_id=xssclean($obj->course_id);
			$batch_id=xssclean($batch_id);
			$semester_id=xssclean($semester_id);
			
			if($obj->course_id!='17' && $obj->course_id!='18')
		    {
			 $this->db->select('fee_group_id,fee_head_id');
			 $this->db->from('fee_groups');
			 $this->db->where('fee_head_id',$fee_head_id);
			 $this->db->where('category_id',$category_id); 
			 $this->db->where('centre_id',$centre_id); 
			 $this->db->where('course_id',$course_id); 
			 $this->db->where('batch_id',$batch_id); 
			 $this->db->where('semester_id',$semester_id); 
			 $fee_group_result = $this->db->get();
			// echo $this->db->last_query();
			// die();
			 if($fee_group_result->num_rows() > 0 )
			 {     $feegroup_row  =  $fee_group_result->row();
				   $fee_group_id = $feegroup_row->fee_group_id;
				   $fee_grp_info=get_table_info('fee_groups','fee_group_id',$fee_group_id);
				   $fee_head_pay=$fee_grp_info->fee_head_id;
					
			 }
			 else
			 {		$fee_group_id=fee_groups($fee_head_id,$category_id,$centre_id,$course_id,$batch_id,$semester_id);
					$fee_grp_info=get_table_info('fee_groups','fee_group_id',$fee_group_id);
					$fee_head_pay=$fee_grp_info->fee_head_id;
					
			 }
		   // end
		   // Fee Due of student 
		   $tag_head_id=1;
		   if($centre_id!='14057' &&  $centre_id!='21238')
			    {
		   			$fee_due_id=fee_due_student($centre_id,$course_id,$batch_id,$semester_id,$fee_head_pay,$user_id,$fee_group_id,$tag_head_id);
				}
			}
		   //end 
		   
            //Email Send
            $config = Array(
                'protocol' => 'mail',
                'mailtype' => 'html'
            );

            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->from(infoemail); // change it to yours
            $this->email->to($email); // change it to yours";
            $this->email->subject('Your Account is Ready at '.company_name.'');
            $name = ucwords(xssclean($obj->first_name)) . ' ' . ucwords(xssclean($obj->last_name));
			$this->load->model('loginmodel');
			$result = $this->loginmodel->login($email,xssclean($obj->userpass));
           $html = '<!-- HEADER -->
				<table style="width:100% !important;" background="'.base_url().'assets/img/mail/border.png">
					<tr>
						<td></td>
						<td style="clear: both !important;display: block !important;margin: 0 auto !important;max-width: 600px !important;">
							<div style=" display: block;margin: 0 auto;max-width: 600px;padding: 15px;">
								<table>
									<tr>
										<td><img src="'.base_url().'/assets/img/mail/logo.png" /></td>
										<td align="right"><h6 style="color: #444444;font-size: 14px;font-weight: 900;margin: 0 !important;text-transform: uppercase;">&nbsp; </h6></td>
									</tr>
								</table>
							</div>
				
						</td>
						<td></td>
					</tr>
				</table>
				<!-- /HEADER -->
				
				
				<!-- BODY -->
				<table style="width:100%;">
					<tr>
						<td></td>
						<td style="clear: both !important;display: block !important;margin: 0 auto !important;max-width: 600px !important;"
							bgcolor="#FFFFFF">
				
							<div style="display: block;margin: 0 auto;max-width: 600px;padding: 15px;">
								<table>
									<tr>
										<td>
											<h3 style="color:#000000;line-height: 1.1;margin-bottom: 15px;font-size: 27px;font-weight: 500;">Dear  '.$name.',</h3><br>
											<p style="font-size: 14px;font-weight: normal;line-height: 1.6;margin-bottom: 10px;">INIFD Family welcomes you to MYINIFD - my own world of Design</p>	<br>
                                            <p style="font-size: 14px;font-weight: normal;line-height: 1.6;margin-bottom: 10px;">An innovative learning system with complete information and updates on the latest fashion, design and lifestyle trends to keep you updated along-with your regular curriculum.</p>
											<p style="font-size: 14px;font-weight: normal;line-height: 1.6;margin-bottom: 10px;">Your account has been created at <a href="'.base_url().'" style="color:#2BA6CB!important;">'.base_url().'</a></p>																	
											<p style="font-size: 14px;font-weight: normal;line-height: 1.6;margin-bottom: 10px;"><strong>Your username:</strong> '.$email.' </p>							
                                            <p style="font-size: 14px;font-weight: normal;line-height: 1.6;margin-bottom: 10px;"><strong>Your Password:</strong> '.xssclean($obj->userpass).' </p>							
                                            
                                            <p style="font-size: 14px;font-weight: normal;line-height: 1.6;margin-bottom: 10px;">We wish you all the very best for your journey with us which would surely be instrumental in providing you with a platform to achieve success in all your endeavors.</p>
											<p style="font-size: 14px;font-weight: normal;line-height: 1.6;margin-bottom: 10px;">
												Please do not reply to this mail, if you have any technical difficulties, please email us at: <a href="mailto:'.helpemail.'" style="color:#2BA6CB!important;">'.helpemail.'</a>
											</p>
											<p style="font-size: 14px;font-weight: normal;line-height: 1.6;margin-bottom: 10px;">
												Thank you!
												<br /><br />
												Warm Regards,<br>
												Team MYINIFD
											</p>
				
										</td>
									</tr>
								</table>
							</div>
				
						</td>
						<td></td>
					</tr>
				</table>
				<!-- /BODY -->';
            $this->email->message($html);

            if ($this->email->send()) {
                return $user_id.'|||1';
            } else {
                return $user_id.'|||0';
            }
		}
		
     }

    } //End of add function

	function mobile_otp($mobile,$otp){
		$this->db->where('mobile_no',$mobile);
		$query = $this->db->get('users');
		$count=$query->num_rows();
		if($count==0){
			$data_update=array('use_status'=>'1');
			$this->db->where('mobile_no',$mobile);
			$this->db->update('mobile_otp',$data_update);
			 $data        = array(
				'mobile_no'         => $mobile,
				'otp'     => $otp,
				'post_date'      => date('Y-m-d H:i:s'), 
			);
			$result   = $this->db->insert('mobile_otp', $data);
			if($result){
				return '1';
			}else{
				return '0';
			}
		}else{
			return '2';
		}
	}
	
	function check_otp($mobile,$otp){
		 $this->db->where('mobile_no',$mobile);
		 $this->db->where('use_status','0');
		 $this->db->limit('1');
		 $this->db->order_by('mob_otp_id','DESC');
		 $query = $this->db->get('mobile_otp');	
		 $result=$query->num_rows();
		 if($result>0){
			 return $query->row();
		 }else{
			 return false;
		 }
	}
	
	function expire_otp($mobile){
		$data_update=array('use_status'=>'1');
		$this->db->where('mobile_no',$mobile);
		$this->db->update('mobile_otp',$data_update);
	}
	
	function verfiy_mobile_otp($mobile_no,$otp){
		 $this->db->where('mobile_no',$mobile);
		 $this->db->where('otp',$otp);
		 $this->db->where('use_status','0');
		 $this->db->limit('1');
		 $this->db->order_by('mob_otp_id','DESC');
		 $query = $this->db->get('mobile_otp');	
		 $result=$query->num_rows();
		 if($result>0){
			 return true;
		 }else{
			 return false;
		 }
	}
	
}