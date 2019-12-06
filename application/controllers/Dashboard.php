<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Dashboard extends CI_Controller {
    
    function __construct(){
        parent::__construct();
		date_default_timezone_set('Asia/Jakarta');        
    }

    public function index()
    {
        $vdata = [];
        echo '<pre>'; print_r($_SESSION); echo '</pre>';
        $data['content'] = $this->load->view('dashboard', $vdata, TRUE);
        $this->load->view('layout', $data);
    }
}