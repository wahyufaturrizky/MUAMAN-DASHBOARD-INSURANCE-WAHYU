<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Asuransi_setup extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('asuransi/masuransi_setup');
	}

	public function index()
	{
		$sess_asuransi = array(
			'idasuransi' => $this->input->get('idasuransi'),
			'nameasuransi'=> $this->input->get('asuransiname')
		);

		$data['pertanggungan'] = $this->masuransi_setup->pertanggungan();
		$data['kategoriknd']= $this->masuransi_setup->kategoriknd();
		$data['wilayah'] = $this->masuransi_setup->wilayah();
		
		$this->session->set_userdata( $sess_asuransi );
		$this->template();
        $this->load->view('asuransi/asuransi_setup/content',$data);
        $this->footer();
        $this->load->view('asuransi/asuransi_setup/content_js'); 
	}

	public function ajax_data()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND b.name LIKE \'%'.$search.'%\' OR c.type LIKE \'%'.$search.'%\' OR a.wilayah LIKE \'%'.$search.'%\' ';
        }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->masuransi_setup->get($offset,$limit,$search);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
        	$row->edit = '<button class="btn btn-info btn-flat" id="edit"><i class="fa fa-pencil"></i> Edit</button>';
			$row->hapus = '<button class="btn btn-info btn-flat" id="delete"><i class="fa fa-trash"></i> Delete</button>';
         	$rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    function paging()
    {
        $search = addslashes($this->input->get('search'));
        if($search!= ''){
 			$search = 'AND b.name LIKE \'%'.$search.'%\' OR c.type LIKE \'%'.$search.'%\' OR a.wilayah LIKE \'%'.$search.'%\' ';         
 		}
        $getpage = $this->masuransi_setup->getpage($search);
        $countpage = 1;
       	$limit = 10;
        foreach ($getpage->result() as $row) {
        	$countpage = ceil(intval($row->page)/$limit);
        } 

        echo '<input type="hidden" id="countpage" value="'.$countpage.'">';
        echo '<button class="btn btn-flat btn-info page1"><i class="fa fa-fast-backward"></i></button>';
        for ($i=1; $i <= $countpage ; $i++) { 
          echo '<button class="btn btn-flat btn-info page'.$i.'"">'.$i.'</button>';
        }
        echo '<button class="btn btn-flat btn-info page'.$countpage.'"><i class="fa fa-fast-forward"></i></button>';
    }

    public function save()
    {
        $save = $this->masuransi_setup->save(
                    $this->input->post('wilayah'),
                    $this->input->post('pertanggungan'),
                    $this->input->post('kategoriknd'),
                    $this->input->post('rate')
                 );
    }
}

/* End of file Asuransi_setup.php */
/* Location: ./application/controllers/registrasi/Asuransi_setup.php */