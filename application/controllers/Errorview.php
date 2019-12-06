<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Errorview extends MY_Controller {
public function __construct()
{
	parent::__construct();
	
}
	public function index()
	{
		$this->template();
		$this->load->view('error/pageerror');
		$this->footer();
	}
}