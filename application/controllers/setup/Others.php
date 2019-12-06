<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Others extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setup/mothers');
	}

	public function index()
	{
		//$this->cekpriviledge();
		$sessionpolisdetail = array(
            'polisdetail' => base64_decode($this->input->get('iddetail'))
        );
        
        $this->session->set_userdata( $sessionpolisdetail );
		$this->template();
        $this->load->view('setup/others/content');
        $this->footer();
        $this->load->view('setup/others/content_js'); 	
	}


	public function ajax_data()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mothers->get($offset,$limit,$search);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->btnedit = '<button class="btn btn-warning btn-flat" id="edit-'.$row->id_form.'"><i class="fa fa-pencil"></i> Edit</button>
                    <script>
                    $(document).on("click", "#edit-'.$row->id_form.'", function() {
                        edit("'.$row->policy_cost.'","'.$row->stamp_duty.'","'.$row->internal_admin_cost.'","'.$row->insurer_admin_cost.'","'.$row->id_form.'");
                    });
                    </script>
            ';
            $row->btndelete ='<button class="btn btn-danger btn-flat" id="delete-'.$row->id_form.'"><i class="fa fa-trash"></i> Delete</button>
                    <script>
                    $(document).on("click", "#delete-'.$row->id_form.'", function() {
                       deleteothers("'.$row->id_form.'"); 
                    });
                    </script>   
            '; 
            $row->policy_cost = 'Rp. '.number_format($row->policy_cost,2);
            $row->stamp_duty = 'Rp. '.number_format($row->stamp_duty,2);
            $row->internal_admin_cost = 'Rp. '.number_format($row->internal_admin_cost,2);
            $row->insurer_admin_cost = 'Rp. '.number_format($row->insurer_admin_cost,2);
            $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    function paging()
    {
        $search = addslashes($this->input->get('search'));

        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $getpage = $this->mothers->getpage($search);
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


    public function save()
    {
        $save = $this->mothers->save(
            $this->input->post("policy_cost"),
            $this->input->post("stamp_duty"),
            $this->input->post("internal_admin_cost"),
            $this->input->post("insurer_admin_cost")
        );
        echo $save;
    }

    public function delete()
    {
        $delete = $this->mothers->delete(
            $this->input->post("id")
        );
        echo $delete;
    }

    public function update()
    {
    $update = $this->mothers->update(
            $this->input->post("policy_cost"),
            $this->input->post("stamp_duty"),
            $this->input->post("internal_admin_cost"),
            $this->input->post("insurer_admin_cost"),
            $this->input->post("id")
        );
        echo $update;
    }
}

/* End of file others.php */
/* Location: ./application/controllers/setup/others.php */