<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Add extends CI_Controller {
 
    public function index()
    {
        $data['content'] = $this->load->view('user/add', '', TRUE);
        $this->load->view('layout', $data);
    }
}
