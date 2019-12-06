<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Template_email extends MY_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('setup/mtemplateemail');
       
    }

    public function index()
    {
        $data['getproduk'] = '';
        $this->template();
        $this->load->view('setup/template_email/content',$data);
        $this->footer();
        $this->load->view('setup/template_email/content_js'); 
    }

    public function ajax_data()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND nama_template LIKE \'%'.$search.'%\' ';
        }
        $limit = 5;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mtemplateemail->get($offset,$limit,$search);
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
            $search = 'AND nama_template LIKE \'%'.$search.'%\' ';;
         }
         $getpage = $this->mtemplateemail->getpage($search);
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