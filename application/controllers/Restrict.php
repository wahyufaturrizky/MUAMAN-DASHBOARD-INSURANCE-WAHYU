<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restrict extends MY_Controller {
public function __construct()
{
	parent::__construct();
	
}
	public function index()
	{
		$this->template();
		$this->load->view('403/restrict');
		$this->footer();
	}

}

/* End of file pagenotfound.php */
/* Location: ./application/controllers/pagenotfound.php */