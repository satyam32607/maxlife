<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(-1);
ini_set('display_errors', 1);
use Dompdf\Dompdf;
use Dompdf\Options;
class Candidate extends CI_Controller {

var $pdf_path;
public function __construct()
	{
		parent:: __construct();
		$this->load->model('hdfclife/candidate_model');
		$this->load->helper('download');
		
		$this->pdf_path = realpath('assets/static/applicant_pdf');
	}


	
	public function testmail()
	{
		//$resultemail = $this->send_candidates_email('105','105');
		//	echo "---Send Email---------->".$resultemail;
			
		/*$resultpdf = $this->generate_application_form_pdf('105','105');
	    echo "-resultpdf------------>".$resultpdf;
		echo "<br>";
		if($resultpdf=='1')
		{*/
			$resultemail = $this->send_candidates_email('255','255');
			echo "---Send Email---------->".$resultemail;
			
		//}
		
		
	}
	
	
	public function generate_application_form_pdf($camp_log_id,$cand_id)
	{
		 $cand_row =  $this->candidate_model->get_candidate_info($camp_log_id,$cand_id);
		//echo "---application_no---------->".$cand_row->application_no;
		 $application_no = trim($cand_row->application_no);
		 $data['row'] = $cand_row;
       //  $this->load->view('hdfclife/candidates/hdfclife_application_form_pdf', $data);

		 $html = $this->load->view('hdfclife/candidates/hdfclife_application_form_pdf', $data, TRUE);
	 
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
			$pdfroot = 'assets/static/applicant_pdf/'.$file_name.".pdf";
			 
			$result_tcc  = file_put_contents($pdfroot, $output);
			
			
			if($result_tcc)
			{   return '1';
			}else
			{	return '0';
			}
		
    } //end of view Details functionality
	
	public function send_candidates_email($candidate_id,$camplogid)
	{
			$this->db->select('consent_candidates.application_no,consent_candidates.applicant_full_name,consent_candidates.email_id,consent_candidates.mobile_no,campaign_logs.campaign_log_id,campaign_logs.campaign_log_id,campaign_logs.candidate_id,campaign_logs.unique_id');
			$this->db->from('consent_candidates');
			$this->db->join('campaign_logs', 'campaign_logs.candidate_id = consent_candidates.candidate_id');
			$this->db->where('consent_candidates.consent_status', '3');
			$this->db->where('campaign_logs.campaign_log_id',$camplogid);
			$this->db->where('campaign_logs.candidate_id',$candidate_id);
			$query = $this->db->get();
			$camplogrow =  $query->row();

			//$camplogrow->campaign_link = campaign_link.'/v/'.$camplogrow->unique_id;
			//print_r($camplogrow);
			//die();
			//echo $this->db->last_query();
			$applicant_full_name = strtolower($camplogrow->applicant_full_name);
			$name = ucwords($applicant_full_name);
			$application_no = trim($camplogrow->application_no);
			$camplogrow->applicant_name=$name;
			$mobile_no = $camplogrow->mobile_no;
			$to_email = strtolower($camplogrow->email_id);
			$campaign_log_id = $camplogrow->campaign_log_id;
			$candidate_id = $camplogrow->candidate_id;
						
			$file_name='';	
			$file_name = $application_no.".pdf";
			
			$applicant_pdf_path='';
			$applicant_pdf_path = $_SERVER['DOCUMENT_ROOT'].'/assets/static/applicant_pdf/'.$file_name;
			
			$templaterow=get_table_info('mail_sms_templates','template_id','3');
			
			$email_subject = $templaterow->template_subject;
			$email_body = $templaterow->template_body;
			//echo "-email_body--------------->".$email_body;
			$replaced_email_body=templatedata($email_body,$camplogrow);
			
		    //$to_email='dreamweaversgroup1@gmail.com';
			//$to_email='ajaykumar1286@gmail.com';
			$alternate_email='';
		    $terms_file_name = 'POSP T&C Annexure.pdf';
			$attachment1=$applicant_pdf_path;
			$attachment2=$_SERVER['DOCUMENT_ROOT'].'/assets/img/'.$terms_file_name;
			
			//echo $replaced_email_body;
			//echo "----------->".$attachment1;
			//echo "----------->".$attachment2;
			//die();
			//$to_email='ajaykumar1286@gmail.com';
			$sendresult =  common_mail($to_email,$alternate_email,$email_subject,$replaced_email_body,$attachment1,$attachment2);
			if ($sendresult) {
			  return $sendresult;
			
		}
			
		
		
    } //end of view Details functionality
	

	
	

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