<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Broker_user extends MY_Controller {
    
    function __construct(){
        parent::__construct();
		$this->load->model('broker/mbroker_user');
    }

    public function index()
    {   
        if(!$this->input->get('id_broker')){
            redirect(site_url().'registrasi/broker/');
            }
        else{
            $data['id_broker'] = $this->input->get('id_broker');
            $data['broker_name'] = $this->input->get('broker_name');
            $data['part_of_id'] = $this->mbroker_user->getpartofid();
            $this->template();
            $this->load->view('broker/brokeruser/content',$data);
            $this->footer();
            $this->load->view('broker/brokeruser/content_js');
        
        }
    }

    public function ajax_data()
    {
        $id_broker = $this->input->get('id_broker');
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));

        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND (a.name LIKE \'%'.$search.'%\' OR b.brokerdetailpos LIKE \'%'.$search.'%\' OR a.email LIKE \'%'.$search.'%\' )';
        }
        $limit = 10;
        $offset = ($page-1)*$limit; 
        
        $data['getdata']= $this->mbroker_user->get($id_broker,$offset,$limit,$search);
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
        $save = $this->mbroker_user->save(
                    $this->input->post('nama'),
                    $this->input->post('part_of_id'),
                    $this->input->post('email'),
                    $this->input->post('id_broker')
                 );
    }

    public function save_user()
    {
        $save = $this->mbroker_user->save_user(
                    $this->input->post('username'),
                    $this->input->post('password'),
                    $this->input->post('id_user'),
                    $this->input->post('part_of_id')
                 );
    }

    public function update()
    {
        $update = $this->mbroker_user->update(
                    $this->input->post('nama'),
                    $this->input->post('part_of_id'),
                    $this->input->post('email'),
                    $this->input->post('id')
                 );
    }

    public function delete()
	{
		$delete =   $this->mbroker_user->delete(
                    $this->input->post('id')
                 );
	}

    public function uploadData()
    {
        $id_broker = $this->input->post('id_broker');
        $nama_broker = $this->input->post('nama_broker');
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
            if($query = $this->mbroker_user->uploadData2($path2,$id_broker)){
                echo(1);
            }else{
                echo(0); 
            } 
            redirect(base_url().'registrasi/Broker_user/?id_broker='.$id_broker.'&broker_name='.$nama_broker);
        }   

    }

    function paging()
    {
         $id_broker = $this->input->get('id_broker');
         $search = addslashes($this->input->get('search'));
         if($search!= ''){
            $search = ' AND (a.name LIKE \'%'.$search.'%\' OR b.brokerdetailpos LIKE \'%'.$search.'%\' OR a.email LIKE \'%'.$search.'%\' )';
         }
         $getpage = $this->mbroker_user->getpage($search,$id_broker);
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
