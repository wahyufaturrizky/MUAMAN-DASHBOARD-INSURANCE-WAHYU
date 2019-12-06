<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usermanagement extends MY_Controller {
public function __construct()
{
	parent::__construct();
	$this->load->model('m_user');
}
	public function index()
	{	$data['getuser']= $this->m_user->getuser();
		$this->template();
		$this->load->view('user/vuser',$data);
		$this->footer();
		$this->load->view('user/user_js',$data);
		}

	public function ajax_data()
	{	
		$getuser= $this->m_user->getuser();
		$rows = array();
		foreach ($getuser->result() as $row) {
		 $rows[] = array_values((array)$row);
		}
		$this->output->set_content_type('application/json');
		$data['ajax_data'] = json_encode(array('aaData'=> $rows));
		$this->load->view('ajax/ajax_data',$data);
	}

	public function detail()
	{
		$id = $this->input->post('id');
		$data['getdetail']= $this->m_user->getdetail($id);
		$this->template();
		$this->load->view('user/detail',$data);
		$this->footer();
		$this->load->view('user/user_js');
	}

	public function priviledge()
	{
		$data['id']= $this->input->post('id');
		$data['getpriviledge'] = $this->m_user->getpriviledge($data['id']);
		$this->template();
		$this->load->view('user/priviledge',$data);
		$this->footer();
		$this->load->view('user/user_js');
	}

	public function savepriviledge()
	{	
		$data['menu'] = $this->input->post('menu');
		$data['id'] = $this->input->post('id');
		$clean = $this->m_user->clean($data['id']);
		foreach ($data['menu'] as $resmenu) {
		$this->m_user->savepriviledge($resmenu);
		}
	}
}

/* End of file usermanagement.php */
/* Location: ./application/controllers/usermanagement.php */