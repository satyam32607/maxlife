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

		

	

		function getServices($user_service_id)
		{

			$this->db->from('user_service_documents')->
			where("user_service_id",$user_service_id);
			$query = $this->db->get();

			$result = $query->result();

			return $result;

		}

		function getPartnerId($user_service_id)
		{
			$this->db->from('user_services')->
			where("user_service_id",$user_service_id);
			$query = $this->db->get();
			$result = $query->result();
			return $result[0]->user_id;
		}

		public function storeUserServices()
		{
			$totalDocuments = count($_POST['document_id']);
			$partnerId = $_POST['partner_id'];
			$uploadPath = './assets/static/2/partners/';
		
			// Ensure the upload directory exists
			if (!is_dir($uploadPath)) {
				mkdir($uploadPath, 0755, true);
			}
		
			for ($i = 0; $i < $totalDocuments; $i++) {
				$documentData = [];
				$serviceDocumentId = $_POST['document_id'][$i];
		
				// Process document 1, document 2, document 3 dynamically
				for ($j = 1; $j <= 3; $j++) {
					$fieldName = "document_file_{$j}";
					$documentNameField = "document_name_{$j}";
		
					if (
						!empty($_POST[$documentNameField][$i]) &&
						!empty($_FILES[$fieldName]['name'][$i]) &&
						$_FILES[$fieldName]['error'][$i] === 0
					) {
						$uploadedFile = $_FILES[$fieldName]['name'][$i];
						$file_name = $uploadedFile;
						$destination = $uploadPath . $partnerId . '/' . $file_name;
		
						// Move the uploaded file to the destination
						if (move_uploaded_file($_FILES[$fieldName]['tmp_name'][$i], $destination)) {
							$documentData += [
								"document_name{$j}" => $_POST[$documentNameField][$i],
								"document_file_name{$j}" => $file_name,
							];
						}
					}
				}
		
				// Update the database with document data for the current serviceDocumentId
				if (!empty($documentData)) {
					$this->db->where('service_document_id', $serviceDocumentId);
					$this->db->update('user_service_documents', $documentData);
				}
			}
		}
		

	

}