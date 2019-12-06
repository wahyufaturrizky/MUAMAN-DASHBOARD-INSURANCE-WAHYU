<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Testpdf extends CI_Controller {

	public function index()
	{
		$this->load->library('pdfgenerator');
		$data['users']=array(
			array('firstname'=>'Agung','lastname'=>'Setiawan','email'=>'ag@setiawan.com'),
			array('firstname'=>'Hauril','lastname'=>'Maulida Nisfar','email'=>'hm@setiawan.com'),
			array('firstname'=>'Akhtar','lastname'=>'Setiawan','email'=>'akh@setiawan.com'),
			array('firstname'=>'Gitarja','lastname'=>'Setiawan','email'=>'git@setiawan.com')
		);
 
	    $html = $this->load->view('testpdf', $data, true);
	    
	    $this->pdfgenerator->generate($html,'contoh');
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */