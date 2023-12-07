<?php

class Dashboard_model extends CI_Model
{
	
	 function campaigns_consolidated() {
			
		    $sql = "SELECT count( * ) AS total, campaign_id,start_date  FROM `campaigns` where is_active='1' GROUP BY start_date order by `start_date` desc"; 
			$query = $this->db->query($sql);
			//echo $this->db->last_query();
			 $result = $query->result();
			//Count Total Approved Students Records
			foreach ($result as $row) {
				
				$row->total_candidates= $this->count_campaigns_candidates($row->campaign_id);
			}
	    	return $result;
		
		}     //End of Count function
		
		
	 function count_campaigns_candidates($campaign_id) {
			
			$this->db->where('campaign_id',$campaign_id);
			$this->db->order_by('campaign_log_id','DESC');
			$this->db->from('campaign_logs');
			$query = $this->db->get();
			// echo $this->db->last_query();
			//echo "<br>";
			return $query->num_rows();
			
		}     //End of Count function
		
				
		
	 function candidates_consent_consolidated() {
			
			$sql = "SELECT DATE_FORMAT( `consent_update_on` , GET_FORMAT( DATE, 'ISO' ) ) AS 
dt , count( * ) AS total FROM `consent_candidates` where is_active='1' and consent_status='3'  GROUP BY DATE_FORMAT( `consent_update_on` , GET_FORMAT( DATE, 'ISO' ) )  order by `consent_update_on` desc "; 
			$query = $this->db->query($sql);
			//echo $this->db->last_query();
			return $query->result();
			
		}     //End of Count function	
		
	 
	
		
		 function centre_stud_consolidated() {
			
		    $sql = "SELECT count( * ) AS total, master_id  FROM `users`,course_batches,courses where courses.course_id = course_batches.course_id and  course_batches.batch_id = users.user_batch_id  and 
			users.user_type='S'    GROUP BY users.master_id  order by `users`.`reg_date` desc"; 
			$query = $this->db->query($sql);
			//echo $this->db->last_query();
			 $result = $query->result();
			//Count Total Approved Students Records
			foreach ($result as $row) {
				
				$row->total_approved= $this->count_approved_students($row->master_id);
			}
		
        	return $result;
		
		}     //End of Count function	
		
		
		 function count_approved_students($user_id)
   		 {
			$this->db->where('users.user_type','S');
			$this->db->where('users.corporate_status', '1');
			//$this->db->where('users.is_active','1');
			//$this->db->where('users.is_alumni', '0');
			$this->db->join('course_batches','course_batches.batch_id = users.user_batch_id');
			$this->db->join('courses', 'courses.course_id  = course_batches.course_id');
			$this->db->where('master_id', $user_id);
			$this->db->group_by('users.user_id'); 
			$this->db->from('users');
			$query = $this->db->get();
			
			//echo "<br>";
			return $query->num_rows();

  	   } //End of Count function
	   


	
}