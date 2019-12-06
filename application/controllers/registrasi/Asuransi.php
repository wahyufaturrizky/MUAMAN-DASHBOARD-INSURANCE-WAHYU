<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Asuransi extends MY_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('asuransi/masuransi');
    }

    public function index()
    {
        $this->cekpriviledge();
        $this->template();
        $data['getproduk'] = $this->masuransi->getproduk();
        $this->load->view('asuransi/content',$data);
        $this->footer();
        $this->load->view('asuransi/content_js'); 
    }

    public function ajax_data()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND name LIKE \'%'.$search.'%\' OR address LIKE \'%'.$search.'%\' OR telp LIKE \'%'.$search.'%\' OR email LIKE \'%'.$search.'%\' ';
        }
        $limit = 3;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->masuransi->get($offset,$limit,$search);
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
        $save = $this->masuransi->save(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('email'),
                    $this->input->post('telp')
                 );
    }

    public function save_user()
    {
        $save = $this->masuransi->save_user(
                    $this->input->post('username'),
                    $this->input->post('password'),
                    $this->input->post('id_user')
                 );
    }

    public function update()
    {
        $update = $this->masuransi->update(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('email'),
                    $this->input->post('telp'),
                    $this->input->post('id')
                 );
    }

    public function delete()
    {
        $delete =   $this->masuransi->delete(
                    $this->input->post('id')
                 );
    }


    function paging()
    {
         $search = addslashes($this->input->get('search'));
         if($search!= ''){
            $search = 'AND name LIKE \'%'.$search.'%\' OR address LIKE \'%'.$search.'%\' OR telp LIKE \'%'.$search.'%\' OR email LIKE \'%'.$search.'%\' ';
         }
         $getpage = $this->masuransi->getpage($search);
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
    
    public function produkasuransi()
    {
        $getprodukasuransi = $this->masuransi->getprodukasuransi(
            $this->input->post('id_asuransi')
        );
        if($getprodukasuransi->num_rows()>0){
            $no = 1;
            foreach ($getprodukasuransi->result() as $k) {
                echo $no.'. '.$k->nama_produk.'<br>';
                $no++;
            }
        }
        else{
            echo 'ASURANSI BELUM MEMILIKI PRODUK';
        }
    }

    public function deleteproduk()
    {
        $delete =   $this->masuransi->deleteproduk(
                    $this->input->post('id'),
                    $this->input->post('produk')
                 );
    }

    public function saveproduk()
    {
        $save =   $this->masuransi->saveproduk(
                    $this->input->post('id'),
                    $this->input->post('produk')
                 );
    }
}