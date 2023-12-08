<?php



class Services_model extends CI_Model

{

			

	

	

	function view_services()

		{

			$this->db->select('user_services.*, users.*, services.*, categories.category_name');
			$this->db->from('user_services');
			$this->db->where('user_services.user_id', $_SESSION['user_id']);
			$this->db->join('users', 'user_services.user_id = users.user_id', 'inner');
			$this->db->join('services', 'user_services.service_id = services.service_id', 'inner');
			$this->db->join('categories', 'services.category_id = categories.category_id', 'inner');

			$query = $this->db->get();

			$result = $query->result();

		

			return $result;

	

		} //End of View function

		

	



	



	

}