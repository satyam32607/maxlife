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
			where("user_service_id",$user_service_id)->
			join('services', 'services.service_id = user_service_documents.service_id', 'inner');
			$query = $this->db->get();

			$result = $query->result();

			return $result;

		}

		function getServiceObject($service_id)
		{
			return $this->db->from('services')->where("service_id",$service_id)->get()->result()[0];
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
			$totalDocuments = 	count($_POST['document_name_1']);
			$documentsID	=	!empty($_POST['document_id']) ? array_values(array_filter($_POST['document_id'])) : [];
			$partnerId = $_POST['partner_id'];
			$uploadPath = './assets/static/2/partners/';
			// Ensure the upload directory exists
			if (!is_dir($uploadPath)) {
				mkdir($uploadPath, 0777, true);
			}
			
			for ($i = 0; $i < $totalDocuments; $i++) {
				$documentData = [];
				$serviceDocumentId = empty($documentsID[$i]) ? null : $documentsID[$i];
				if (!empty($_POST['document_name_1'][$i]) && !empty($_FILES['document_file_1']['name'][$i]) &&
					$_FILES['document_file_1']['error'][$i] === 0)
				{
					$uploadedFile = $_FILES['document_file_1']['name'][$i];
					$file_name = $uploadedFile;
					$destination = $uploadPath . $partnerId . '/' . $file_name;
					if (!is_dir($uploadPath.$partnerId)) {
						mkdir($uploadPath.$partnerId, 0777, true);
					}
					if(!empty($serviceDocumentId))
					{
						$oldFile	=	$uploadPath . $partnerId . '/' .$this->db->from("user_service_documents")->where('service_document_id', $serviceDocumentId)->get()->result()[0]->document_file_name1;
						if(file_exists($oldFile))
						{
							
							unlink($oldFile);
						}
					}
					if (move_uploaded_file($_FILES['document_file_1']['tmp_name'][$i], $destination)) {
						$documentData += [
							"document_name1" => $_POST['document_name_1'][$i],
							"document_file_name1" => $file_name,
							"doc_status"=>"P",
							"user_service_id"	=>	$_POST['user_service_id'],
							"service_id"	=>	$_POST['user_service_id'],
						];
					}
					$this->session->set_flashdata('success_message', "Documents Submitted");
				}

				if (!empty($documentData))
				{
					if(!empty($serviceDocumentId))
					{
						$this->db->where('service_document_id', $serviceDocumentId);
						$this->db->update('user_service_documents', $documentData);
					}
					else
					{
						$this->db->insert('user_service_documents', $documentData);
					}
				}
			}
			// for ($i = 0; $i < $totalDocuments; $i++) {
			// 	$documentData = [];
			// 	$serviceDocumentId = $documentsID[$i];
			// 	// Process document 1, document 2, document 3 dynamically
			// 	for ($j = 1; $j <= 3; $j++) {
			// 		$fieldName = "document_file_{$j}";
			// 		$documentNameField = "document_name_{$j}";

			// 		if (
			// 			!empty($_POST[$documentNameField][$i]) &&
			// 			!empty($_FILES[$fieldName]['name'][$i]) &&
			// 			$_FILES[$fieldName]['error'][$i] === 0
			// 		) {
			// 			$uploadedFile = $_FILES[$fieldName]['name'][$i];
			// 			$file_name = $uploadedFile;
			// 			$destination = $uploadPath . $partnerId . '/' . $file_name;
			// 			if (!is_dir($uploadPath.$partnerId)) {
			// 				mkdir($uploadPath.$partnerId, 0777, true);
			// 			}
			// 			$oldFile	=	$uploadPath . $partnerId . '/' .$this->db->from("user_service_documents")->where('service_document_id', $serviceDocumentId)->get()->result()[0]->document_file_name1;
			// 			if(file_exists($oldFile))
			// 			{
							
			// 				//unlink($oldFile);
			// 			}
			// 			// Move the uploaded file to the destination
			// 			if (move_uploaded_file($_FILES[$fieldName]['tmp_name'][$i], $destination)) {
			// 				$documentData += [
			// 					"document_name{$j}" => $_POST[$documentNameField][$i],
			// 					"document_file_name{$j}" => $file_name,
			// 					"doc_status"=>"P"
			// 				];
			// 			}
			// 			$this->session->set_flashdata('success_message', "Documents Submitted");	
			// 		}
			// 	}
		
			// 	// Update the database with document data for the current serviceDocumentId
			// 	if (!empty($documentData)) {
			// 		$this->db->where('service_document_id', $serviceDocumentId);
			// 		$this->db->update('user_service_documents', $documentData);
			// 	}
			// }

		}
		

		function getDocumentStatus($user_service_id)
		{
		$result					=	$this->db->where("user_service_id",$user_service_id)->where("document_file_name1",null)->from("user_service_documents")->get()->num_rows();
		$defaultDataResult		=	$this->db->where("user_service_id",$user_service_id)->from("user_service_documents")->get()->num_rows();

		if($result>0 || $defaultDataResult==0)
		{
			return "Not Submitted";
		}
		else
		{
			return "Submitted";
		}

		}

}