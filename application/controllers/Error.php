<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends MY_Controller {
public function __construct()
{
	parent::__construct();
	
}
	public function index()
	{
		$this->template();
		$this->load->view('404/pagenotfound');
		$this->footer();
	}
}