<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Produk extends MY_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('produk/mproduk');
    }

    public function index()
    {
        $this->cekpriviledge();
        $this->template();
        $this->load->view('produk/content');
        $this->footer();
        $this->load->view('produk/content_js'); 
    }

    public function ajax_data()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND nama_produk LIKE \'%'.$search.'%\' ';
        }
        $limit = 5;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mproduk->get($offset,$limit,$search);
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
        $save = $this->mproduk->save(
                    $this->input->post('nama')
                 );
    }

    public function update()
    {
        $update = $this->mproduk->update(
                    $this->input->post('nama'),
                    $this->input->post('id')
                 );
    }

    public function delete()
    {
        $delete =   $this->mproduk->delete(
                    $this->input->post('id')
                 );
    }

    public function uploadData()
    {
        $path = $_SERVER['DOCUMENT_ROOT']."/muaman/assets/files/";
        $config['upload_path'] = $path;
        $config['allowed_types'] = 'csv';
        $config['max_size'] = '5000000000';

        print_r($path);
        
        $this->load->library('upload', $config);
         
        if ( ! $this->upload->do_upload()){
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } 
        else{
            $success_data = $this->upload->data();
            $path2 = $path.$success_data['file_name'];
            if($query = $this->mproduk->uploadData2($path2)){
                echo(1);
            }else{
                echo(0); 
            } 
            redirect(base_url().'registrasi/produk/');
        }   

    }


    function paging()
    {
         $search = addslashes($this->input->get('search'));
         if($search!= ''){
            $search = 'AND nama_produk LIKE \'%'.$search.'%\' ';;
         }
         $getpage = $this->mproduk->getpage($search);
         $countpage = 1;
          $limit = 5;
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