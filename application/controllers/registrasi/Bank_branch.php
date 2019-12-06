<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class bank_branch extends MY_Controller {
    
    function __construct(){
        parent::__construct();
		$this->load->model('bank/mbank_branch');
    }

    public function index()
    {   
        if(!$this->input->get('id_parent')){
            redirect(site_url().'registrasi/bank/');
            }
        else{
            $data['id_parent'] = $this->input->get('id_parent');
            $data['parent_name'] = $this->input->get('parent_name');
            $this->template();
            $this->load->view('bank/branch/content',$data);
            $this->footer();
            $this->load->view('bank/branch/content_js');
        
        }
    }

    public function ajax_data()
    {
        $id_parent = $this->input->get('id_parent');
        $page = $this->input->get('page');
        $search = $this->input->get('search');
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND (name LIKE \'%'.$search.'%\' OR address LIKE \'%'.$search.'%\' OR telp LIKE \'%'.$search.'%\' OR email LIKE \'%'.$search.'%\' )';
        }
        $limit = 3;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mbank_branch->get($id_parent,$offset,$limit,$search);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
         $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    public function save()
    {
        $save = $this->mbank_branch->save(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('email'),
                    $this->input->post('telp'),
                    $this->input->post('id_parent')
                 );
    }

    public function update()
    {
        $update = $this->mbank_branch->update(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('email'),
                    $this->input->post('telp'),
                    $this->input->post('id')
                 );
    }

    public function delete()
	{
		$delete =   $this->mbank_branch->delete(
                    $this->input->post('id')
                 );
	}

    function paging()
    {
         $id_parent = $this->input->get('id_parent');
         $search = $this->input->get('search');
         if($search!= ''){
            $search = ' AND (name LIKE \'%'.$search.'%\' OR address LIKE \'%'.$search.'%\' OR telp LIKE \'%'.$search.'%\' OR email LIKE \'%'.$search.'%\' )';
         }
         $getpage = $this->mbank_branch->getpage($search,$id_parent);
         $countpage = 1;
          $limit = 3;
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

}
