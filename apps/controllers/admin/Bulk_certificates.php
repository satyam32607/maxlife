<?php
//ini_set("memory_limit","512M");
ini_set('memory_limit', '1024M');
//error_reporting(-1);
//ini_set('display_errors', 1);

use Dompdf\Dompdf;
use Dompdf\Options;
defined('BASEPATH') OR exit('No direct script access allowed');
class Bulk_certificates extends CI_Controller {

  var $upload_path;
  var $zip_path;
public function __construct()
	{
		parent:: __construct();
		
		$this->load->model('admin/bulk_certificatesmodel');
		$this->load->library('csvimport');
		$this->load->library('zip');
		$this->load->helper('file');
		$this->load->helper('download');
		
		$this->upload_path = realpath('assets/static/sdata');
		$this->zip_path = realpath('assets/static/consentdata/all');
	}
	
	
	public function download()
	{
		$data['title'] = title." | Bulk Certificates";
		$data['heading'] = title." | Bulk Certificates";
		$data['msg'] = "";
		$data['error'] = "";
		$user_exists = '';
		
		//echo "---------->Hello";
		//print_r($_FILES); 
		$this->form_validation->set_rules('heading_title', 'Heading Title', 'required');
		$this->form_validation->set_rules('userfile', 'CSV File', 'trim');
		
		if ($this->form_validation->run()) {
		
		$this->recursiveRemoveDirectory($this->zip_path);
			
		$data['error'] = '';   
        $config['upload_path'] = $this->upload_path;
        $config['allowed_types'] = '*';
        $config['max_size'] = 1024 * 3;
 
 		if(isset($_FILES["userfile"]["name"]) && ($_FILES["userfile"]["name"]!=''))
		{	$path_info = pathinfo($_FILES["userfile"]["name"]);
			$fileExtension = $path_info['extension'];
			$file_name = time(true).'.'.$fileExtension ;   
			$config['file_name'] = $file_name;
		}
				
        $this->load->library('upload', $config);
 
        // If upload failed, display error
        if (!$this->upload->do_upload()) {
            $data['error'] = $this->upload->display_errors();
        } else {
            $file_data = $this->upload->data();
		
			 $file_path =  $config['upload_path'].'/'.$file_name;
			 //echo "----------------->".$file_path;
		   
		    if ($this->csvimport->get_array($file_path)) {
                $csv_array = $this->csvimport->get_array($file_path);
				$count_csv_column = count($csv_array[0]);
				
				$x=0;
				$done=0;
				$already=0;
				$err='';
				
				if($count_csv_column!=1)
				$data['error'] ='Total Columns does not match.<br>';
				
			
			    foreach ($csv_array as  $row) {
					
					$x++;
					if(isset($row['application_no']))
					{
						if($row['application_no']=='')
						$err .='Row No ' .$x.' Application NO. required.<br>';
					}
					else
					{	$err ='Invalid  Application NO. Column.<br>';
					}
					
				}
				
			        foreach ($csv_array as  $row) {
					
					$application_no = $row['application_no'];
					
			      	$cand_row=$this->bulk_certificatesmodel->get_candidate_info($application_no);
					if($cand_row!='0')
					{
						$application_no = strtoupper($cand_row->application_no);
						
						$data['row'] = $cand_row;
						//$this->load->view('hdfclife/candidates/hdfclife_application_form_pdf', $data);
						 $html = $this->load->view('hdfclife/candidates/hdfclife_application_form_pdf', $data, TRUE);
						  ob_start();  
						  require_once("assets/dompdf/autoload.inc.php");
						  $dompdf = new Dompdf();
						
							$dompdf->load_html($html);
							$paper_size='a3';
							$orientation='portrait';
							$dompdf->set_paper($paper_size, $orientation);
							//$dompdf->set_option('enable_html5_parser', TRUE);
							$options = $dompdf->getOptions();
							//$options->setDefaultFont('times-roman');
							$dompdf->setOptions($options);
							
							$dompdf->render();
							$output = $dompdf->output();
							
							//print $output;die;	
							$file_name =$application_no;
							$pdfroot = 'assets/static/consentdata/all/'.$file_name.".pdf";
							 
							$result_tcc  = file_put_contents($pdfroot, $output);
					 }
					
					}	
	
			     $dir = $this->zip_path;
					// Open a directory, and read its contents
					if (is_dir($dir)){
					  if ($dh = opendir($dir)){
						while (($file = readdir($dh)) !== false){
						 // echo "filename:" . $file . "<br>";
						 
						  $file_path = $this->zip_path.'/'.$file;
						  $this->zip->read_file($file_path);
						}
						closedir($dh);
					  }
					}
					

				// Download
				$filename = "consent-certificates.zip";
				$this->zip->download($filename);
			
				$data['err']=$err;
		         
               
            } else 
                $data['error'] = "Error occured";
                
            }
 
        } 
	 
	 
	   $this->load->view('admin/campaigns/bulk_certificates.php', $data);
   }
   
   
   
	function recursiveRemoveDirectory($dir)
	{
		foreach(glob("{$dir}/*") as $file)
		{
			if(is_dir($file)) { 
				$this->recursiveRemoveDirectory($file);
			} else {
				unlink($file);
			}
		}
	}


}	
?>