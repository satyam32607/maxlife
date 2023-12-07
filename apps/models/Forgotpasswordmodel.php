<?php

class Forgotpasswordmodel extends CI_Model
{
    function forgot($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            $row = $query->row();

            //Send Email
            $config = Array(
                'protocol' => 'mail',
			 /* 'smtp_host' => smtp_host,
			  'smtp_port' => 25,
			  'smtp_user' => infoemail, // change it to yours
			  'smtp_pass' => infopass, // change it to yours
			  'mailtype' => 'html',
			  'charset' => 'iso-8859-1',
			  'wordwrap' => TRUE,*/
			    'mailtype' =>'html'
            );

            $this->email->initialize($config);
            $this->email->set_newline("\r\n");
            $this->email->set_mailtype("html");
            $this->email->from(infoemail); // change it to yours
            $this->email->to($email); // change it to yours";
            $this->email->subject('Password Reset Request at '.company_name.'');
            $last_key = random_string('alnum', 50);
			if($row->user_type=='C')
			$name     = ucwords($row->name);
			else
            $name     = ucwords($row->first_name) . ' ' . ucwords($row->last_name);
            $html     = '<table style="width:100% !important;" background="'.base_url().'assets/pages/img/mail/border.png">
		<tr>
		<td></td>
		<td style="clear: both !important;display: block !important;margin: 0 auto !important;max-width: 600px !important;">

			<div style=" display: block;margin: 0 auto;max-width: 600px;padding: 15px;">
				<table>
					<tr>
						<td><img src="'.base_url().'assets/pages/img/mail/myhotline.png" alt="'.company_name.'" title="'.company_name.'" /></td>
						<td align="right"><h6
								style="color: #444444;font-size: 14px;font-weight: 900;margin: 0 !important;text-transform: uppercase;">&nbsp;
							</h6></td>
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
							<h3 style="color:#000000;line-height: 1.1;margin-bottom: 15px;font-size: 27px;font-weight: 500;">
								Hi, '.$name.'</h3>

							<p style="font-size: 14px;font-weight: normal;line-height: 1.6;margin-bottom: 10px;">
								A request was made to change your password at '.company_name.'  <a href="'.base_url().'password/verify/'.$last_key.'" style="color:#2BA6CB!important;">Please click on this link</a> to establish a new password.
							</p>

							 <p style="font-size: 14px;font-weight: normal;line-height: 1.6;margin-bottom: 10px;">
							Please do not reply to this mail, if you have any technical difficulties, please email us at: <a href="mailto:'.helpemail.'" style="color:#2BA6CB!important;">'.helpemail.'</a>
							</p>
							<p style="font-size: 14px;font-weight: normal;line-height: 1.6;margin-bottom: 10px;">
								Thank you!
								<br /><br />
								Warm Regards,<br>
								Team '.company_name.'

							</p>

						
						</td>
					</tr>
				</table>
			</div>
			<!-- /content -->

		</td>
		<td></td>
	</tr>
</table>';
            $this->email->message($html);

            if ($this->email->send()) { //Update Last Key User Records
                $data = array(
                    'last_key'      => $last_key,
                    'last_key_date' => date('Y-m-d H:i:s'),
                );
                $this->db->where('user_id', $row->user_id);
                $this->db->update('users', $data);

                return '1';

            } else {
                //show_error($this->email->print_debugger());
			   return '2';
            }


        } else {
            return '0';
        }
    } //End of Forget Password function

}

?>
