<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Assets extends MY_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('assets/massets');
        $this->limit = 10;
    }

    public function index()
    {
        $this->cekpriviledge();
        $this->setsessionnasabah();
        $data['jenisassets'] = $this->massets->getjenisassets();
        $this->template();
        $this->load->view('assets/content', $data);
        $this->footer();
        $this->load->view('assets/content_js'); 
    }

    function rupiah($angka){
	
        $hasil_rupiah = "Rp " . number_format($angka);
        return $hasil_rupiah;
     
    }

    public function ajax_data()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND a.name LIKE \'%'.$search.'%\'  OR a.address LIKE \'%'.$search.'%\' OR a.tsi LIKE \'%'.$search.'%\' ';
        }
        $limit = $this->limit;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->massets->get($offset,$limit,$search);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {

         $row->tsi = $this->rupiah($row->tsi);
         $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    public function setsessionnasabah()
    {
        $getnasabahid = $this->massets->getnasabahid($this->session->userdata('userid'));
        $nasabahsess = array(
            'nasabah_id' => $getnasabahid[0]['apm_nasabah_id']
        );
        
        $this->session->set_userdata( $nasabahsess );
    }

    public function save()
    {
        $save = $this->massets->save(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('tsi'),
                    $this->input->post('idnasabah'),
                    $this->input->post('idassets'),
                    $this->input->post('idjenis')
                 );
        echo $save;

    }


    public function update()
    {
        $update = $this->massets->update(
                    $this->input->post('nama'),
                    $this->input->post('alamat'),
                    $this->input->post('tsi'),
                    $this->input->post('id'),
                    $this->input->post('idjenis')
                 );
    }

    public function request()
    {
        $update = $this->massets->updateProtected(
                    $this->input->post('idassets')
                 );
    }

    public function delete()
    {
        $delete =   $this->massets->delete(
                    $this->input->post('id')
                 );
    }


    function paging()
    {
         $search = addslashes($this->input->get('search'));
         if($search!= ''){
            $search = 'AND a.name LIKE \'%'.$search.'%\'  OR a.address LIKE \'%'.$search.'%\' OR a.tsi LIKE \'%'.$search.'%\' ';
         }
         $getpage = $this->massets->getpage($search);
         $countpage = 1;
          $limit = $this->limit;
            foreach ($getpage->result() as $row) {
              $countpage = ceil(intval($row->page)/$limit);
            } 

            echo '<input type="hidden" id="countpageassets" value="'.$countpage.'">';
            echo '<button class="btn btn-flat btn-info pageassets1"><i class="fa fa-fast-backward"></i></button>';
            for ($i=1; $i <= $countpage ; $i++) { 
              echo '<button class="btn btn-flat btn-info pageassets'.$i.'"">'.$i.'</button>';
            }
            echo '<button class="btn btn-flat btn-info pageassets'.$countpage.'"><i class="fa fa-fast-forward"></i></button>';
    }
    
}