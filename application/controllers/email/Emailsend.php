<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Emailsend extends CI_Controller {

	public function index()
	{
		//$email_attach = '';
		$email_tujuan = $this->input->post('email_tujuan');
		$email_subject = $this->input->post('email_subject');
		$email_cc = $this->input->post('email_cc');
		$email_attach = $this->input->post('email_attachment');
		$email_content = $this->input->post('email_content');
		//$email_content = 'testing';

		$config = Array(
			'protocol' => 'smtp',
			//'smtp_host' => 'ssl://tiramisu.qwords.net',
			'smtp_host' => 'ssl://smtp.gmail.com',
			'smtp_port' => 465,
			//'smtp_user' => 'reportfif@gmail.com', // change it to yours
			//'smtp_pass' => '@PKP123456', // change it to yours
			'smtp_user' => 'b2b.fif.sim@gmail.com', // change it to yours
			'smtp_pass' => '3mTPkP987&!', // change it to yours
			'mailtype' => 'html',
			'charset' => 'iso-8859-1',
			'wordwrap' => TRUE
		);

		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('b2b.fif.sim@gmail.com', 'MUAMAN TEST');
		//$this->email->to('{$email_tujuan}');
		$this->email->to("$email_tujuan");
		//$this->email->cc('dev-cc@pkp.co.id, sd-cc@pkp.co.id');
		//$this->email->cc('');
		$this->email->bcc('');

		$timestamp = date('d.m.Y H:i'); 

		$this->email->subject("$email_subject");

		$data['content'] = $email_content;
		$body = $this->load->view('email/content_email', $data, TRUE);

		$this->email->message($body);
		$this->email->attach("$email_attach");

		//$this->email->send();
		//echo $this->email->print_debugger();
		if($this->email->send())
		{
		        echo ' Emailsend.';
		}else{
		        show_error($this->email->print_debugger());
		}
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */