<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memberbank extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_member_bank');
	}

	public function index()
	{
		$data['master_nasabah'] = $this->m_member_bank->master_nasabah();
		$this->template();
        $this->load->view('member_bank/content',$data);
        $this->footer();
        $this->load->view('member_bank/content_js'); 
	}

	public function ajax_data()
    {
        $page = $this->input->get('page');
        $asuransi = $this->input->get('asuransi');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        /*if($search!= ''){
            $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        }*/
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->m_member_bank->get($offset,$limit,$search,$asuransi);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
         $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    function paging()
    {
        $search = addslashes($this->input->get('search'));
        $asuransi = $this->input->get('asuransi');
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $getpage = $this->m_member_bank->getpage($search,$asuransi);
        $countpage = 1;
        $limit = 10;
            foreach ($getpage->result() as $row) {
              $countpage = ceil(intval($row->page)/$limit);
            } 
            if($countpage>0){
                echo '<input type="hidden" id="countpage" value="'.$countpage.'">';
                echo '<button class="btn btn-flat btn-info page1"><i class="fa fa-fast-backward"></i></button>';
                for ($i=1; $i <= $countpage ; $i++) { 
                  echo '<button class="btn btn-flat btn-info page'.$i.'"">'.$i.'</button>';
                }
                echo '<button class="btn btn-flat btn-info page'.$countpage.'"><i class="fa fa-fast-forward"></i></button>';
            }else{
                echo '0';
            }
    }

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */