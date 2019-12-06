<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bank extends CI_Controller {

    function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('bank/mbank');
		$this->load->library('form_validation');
	}

    public function index()
    {
        $data['bank'] = $this->mbank->get();
        echo '<pre>'; print_r($data); echo '</pre>';
        $data['content'] = $this->load->view('bank/list', '', TRUE);
        $this->load->view('layout', $data);
    }
    
}
