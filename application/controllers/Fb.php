<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fb extends MY_Controller {

	public function index()
	{
		//$this->template();
		$this->load->view('facebook/fb');
		//$this->footer();
	}

}

/* End of file Fb.php */
/* Location: ./application/controllers/Fb.php */