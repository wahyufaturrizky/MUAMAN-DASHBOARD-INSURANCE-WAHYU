<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Broker extends MY_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('broker/mbroker');
    }

    public function index()
    {
        $this->cekpriviledge();
        $this->template();
        $this->addbrokersession();
        $this->load->view('broker/content');
        $this->footer();
        $this->load->view('broker/content_js'); 
    }


    function addbrokersession()
    {
        $getbrokerdata = $this->mbroker->getbrokerdata($this->session->userdata('userid'));
        if(count($getbrokerdata)>0){
            $brokersession = array(
                'idbroker' => $getbrokerdata[0]['id_broker']
            );
            
            $this->session->set_userdata( $brokersession );
        }
    }

    public function ajax_data()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND (name LIKE \'%'.$search.'%\' OR address LIKE \'%'.$search.'%\' OR telp LIKE \'%'.$search.'%\' OR email LIKE \'%'.$search.'%\' )';
        }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mbroker->get($offset,$limit,$search);
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
        $save = $this->mbroker->save(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('email'),
                    $this->input->post('telp')
                 );
    }

    public function update()
    {
        $update = $this->mbroker->update(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('email'),
                    $this->input->post('telp'),
                    $this->input->post('id')
                 );
    }

    public function delete()
    {
        $delete =   $this->mbroker->delete(
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
            if($query = $this->mbroker->uploadData2($path2)){
                echo(1);
            }else{
                echo(0); 
            } 
            redirect(base_url().'registrasi/broker/');
        }   

    }

    function paging()
    {
         $search = addslashes($this->input->get('search'));
         if($search!= ''){
            $search = 'AND (name LIKE \'%'.$search.'%\' OR address LIKE \'%'.$search.'%\' OR telp LIKE \'%'.$search.'%\' OR email LIKE \'%'.$search.'%\')';
         }
         $getpage = $this->mbroker->getpage($search);
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
    
}
