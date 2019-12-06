<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Nasabah extends MY_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('nasabah/mnasabah');
    }

    public function index()
    {
        $this->cekpriviledge();
        $data['gettype'] = $this->mnasabah->gettype();
        $this->template();
        $this->load->view('nasabah/content',$data);
        $this->footer();
        $this->load->view('nasabah/content_js'); 
    }

    public function ajax_data()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND a.name LIKE \'%'.$search.'%\' OR a.address LIKE \'%'.$search.'%\' OR a.telp LIKE \'%'.$search.'%\' OR a.email LIKE \'%'.$search.'%\' OR b.name LIKE \'%'.$search.'%\' ';
        }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mnasabah->get($offset,$limit,$search);
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
        $save = $this->mnasabah->save(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('email'),
                    $this->input->post('telp'),
                    $this->input->post('type')
                 );
    }

    public function save_user()
    {
        $save = $this->mnasabah->save_user(
                    $this->input->post('username'),
                    $this->input->post('password'),
                    $this->input->post('id_user')
                 );
    }

    public function update()
    {
        $update = $this->mnasabah->update(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('email'),
                    $this->input->post('telp'),
                    $this->input->post('id'),
                    $this->input->post('type')
                 );
    }

    public function delete()
    {
        $delete =   $this->mnasabah->delete(
                    $this->input->post('id')
                 );
    }


    function paging()
    {
         $search = addslashes($this->input->get('search'));
         if($search!= ''){
            $search = 'AND a.name LIKE \'%'.$search.'%\' OR a.address LIKE \'%'.$search.'%\' OR a.telp LIKE \'%'.$search.'%\' OR a.email LIKE \'%'.$search.'%\' OR b.name LIKE \'%'.$search.'%\' ';
         }
         $getpage = $this->mnasabah->getpage($search);
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
    

    function listbank()
    {
        $bank = $this->input->post('bank');
        $getlistbank = $this->mnasabah->getlistbank($bank);
        if($getlistbank->num_rows()>0){
                echo '<option value="">PILIHAN BANK ('.$getlistbank->num_rows().')</option>';
            foreach ($getlistbank->result() as $res) {
                echo '<option value="'.$res->id.'">'.$res->name.'</option>';
            }
        }
        else{
            echo '<option value="">NOT FOUND</option>';
        }
    }

    function listbranch()
    {
        $bank = $this->input->post('bank');
        $getlistbranch = $this->mnasabah->getlistbranch($bank);
        if($getlistbranch->num_rows()>0){
                echo '<option value="">PILIHAN CABANG ('.$getlistbranch->num_rows().')</option>';
            foreach ($getlistbranch->result() as $res) {
                $val = $res->name.'|'.$res->address.'|'.$res->email.'|'.$res->telp;
                echo '<option value="'.$val.'">'.$res->name.'</option>';
            }
        }
        else{
            echo '<option value="">NOT FOUND</option>';
        }
    }
}