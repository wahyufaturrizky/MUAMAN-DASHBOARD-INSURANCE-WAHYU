<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Kendaraan extends MY_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('polis/kendaraan/mkendaraan');
    }

    public function index()
    {
        $data['getproduk'] = $this->mkendaraan->getproduct();
        $data['getasuransi'] = $this->mkendaraan->getasuransi();
        $this->template();
        $this->load->view('kendaraan/content',$data);
        $this->footer();
        $this->load->view('kendaraan/content_js'); 
    }

    

    public function quotesave()
    {
        $getidbroker = $this->mkendaraan->getidbroker(
            $this->session->userdata('userid')
            );
        $idbroker = null;
        foreach ($getidbroker->result() as $row) {
            $idbroker = $row->apm_broker_user_id;
        }
        $save = $this->mkendaraan->save(
                    $this->input->post('registrasi'),
                    $this->input->post('periode1'),
                    $this->input->post('periode2'),
                    $this->input->post('produk'),
                    $this->input->post('rate'),
                    $this->input->post('premi'),
                    $this->input->post('namanasabah'),
                    $this->input->post('idnasabah'),
                    $this->input->post('idassets'),
                    $this->input->post('asuransi'),
                    $idbroker
                 );
    }

    // public function save_user()
    // {
    //     $save = $this->masuransi->save_user(
    //                 $this->input->post('username'),
    //                 $this->input->post('password'),
    //                 $this->input->post('id_user')
    //              );
    // }

    // public function update()
    // {
    //     $update = $this->masuransi->update(
    //                 $this->input->post('nama'),
    //                 $this->input->post('alamat'),
    //                 $this->input->post('email'),
    //                 $this->input->post('telp'),
    //                 $this->input->post('id')
    //              );
    // }

    // public function delete()
    // {
    //     $delete =   $this->masuransi->delete(
    //                 $this->input->post('id')
    //              );
    // }

    public function ajax_data()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND a.name LIKE \'%'.$search.'%\' OR a.address LIKE \'%'.$search.'%\' OR a.telp LIKE \'%'.$search.'%\' OR a.email LIKE \'%'.$search.'%\' ';
        }
        $limit = 3;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mkendaraan->get($offset,$limit,$search);
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
         if($search!= ''){
            $search = 'AND a.name LIKE \'%'.$search.'%\' OR a.address LIKE \'%'.$search.'%\' OR a.telp LIKE \'%'.$search.'%\' OR a.email LIKE \'%'.$search.'%\' ';
         }
         $getpage = $this->mkendaraan->getpage($search);
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

    function ajax_data_asset()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND a.name LIKE \'%'.$search.'%\' OR b.name LIKE \'%'.$search.'%\' OR a.address LIKE \'%'.$search.'%\' OR a.tsi LIKE \'%'.$search.'%\' ';
        }
        $limit = 3;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mkendaraan->getassets($offset,$limit,$search);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
         $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    function pagingasset()
    {
         $search = addslashes($this->input->get('search'));
         if($search!= ''){
            $search = 'AND a.name LIKE \'%'.$search.'%\' OR b.name LIKE \'%'.$search.'%\' OR a.address LIKE \'%'.$search.'%\' OR a.tsi LIKE \'%'.$search.'%\' ';   
         }
         $getpage = $this->mkendaraan->getpageassets($search);
         $countpage = 1;
          $limit = 3;
            foreach ($getpage->result() as $row) {
              $countpage = ceil(intval($row->page)/$limit);
            } 

            echo '<input type="hidden" id="countpageasset" value="'.$countpage.'">';
            echo '<button class="btn btn-flat btn-info pageasset1"><i class="fa fa-fast-backward"></i></button>';
            for ($i=1; $i <= $countpage ; $i++) { 
              echo '<button class="btn btn-flat btn-info pageasset'.$i.'"">'.$i.'</button>';
            }
            echo '<button class="btn btn-flat btn-info pageasset'.$countpage.'"><i class="fa fa-fast-forward"></i></button>';
    }
    
}