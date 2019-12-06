<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formula2 extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setup/mformula2');
	}

	public function index()
	{
		//$this->cekpriviledge();
		$sessionpolisdetail = array(
            'polisdetail' => base64_decode($this->input->get('iddetail'))
        );
        
        $this->session->set_userdata( $sessionpolisdetail );
		$this->template();
        $this->load->view('setup/formula2/content');
        $this->footer();
        $this->load->view('setup/formula2/content_js'); 	
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

        $data['getdata']= $this->mformula2->get($offset,$limit,$search);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->btnedit = '<button class="btn btn-warning btn-flat" id="edit-'.$row->id_form.'"><i class="fa fa-pencil"></i> Edit</button>
                    <script>
                    $(document).on("click", "#edit-'.$row->id_form.'", function() {
                        edit(
                                "'.$row->occupation_class.'",
                                "'.$row->age_min.'",
                                "'.$row->age_max.'",
                                "'.$row->gender.'",
                                "'.$row->year_period_min.'",
                                "'.$row->year_period_max.'",
                                "'.$row->premium_type.'",
                                "'.$row->sum_insurer.'",
                                "'.$row->premium_rate.'",
                                "'.$row->premium_amount.'",
                                "'.$row->currency.'",
                                "'.$row->active.'",
                                "'.$row->id_form.'"
                            );
                    });
                    </script>
            ';
            $row->btndelete ='<button class="btn btn-danger btn-flat" id="delete-'.$row->id_form.'"><i class="fa fa-trash"></i> Delete</button>
                    <script>
                    $(document).on("click", "#delete-'.$row->id_form.'", function() {
                       deleteformula2("'.$row->id_form.'"); 
                    });
                    </script>   
            '; 
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
        $getpage = $this->mformula2->getpage($search);
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
        $save = $this->mformula2->save(
                $this->input->post('occupation_class'),
                $this->input->post('age_min'),
                $this->input->post('age_max'),
                $this->input->post('gender'),
                $this->input->post('year_period_min'),
                $this->input->post('year_period_max'),
                $this->input->post('premium_type'),
                $this->input->post('sum_insurer'),
                $this->input->post('premium_rate'),
                $this->input->post('premium_amount'),
                $this->input->post('currency'),
                $this->input->post('active')
        );
        echo $save;
    }

    public function delete()
    {
        $delete = $this->mformula2->delete(
            $this->input->post("id")
        );
        echo $delete;
    }

    public function update()
    {
    $update = $this->mformula2->update(
            $this->input->post('occupation_class'),
            $this->input->post('age_min'),
            $this->input->post('age_max'),
            $this->input->post('gender'),
            $this->input->post('year_period_min'),
            $this->input->post('year_period_max'),
            $this->input->post('premium_type'),
            $this->input->post('sum_insurer'),
            $this->input->post('premium_rate'),
            $this->input->post('premium_amount'),
            $this->input->post('currency'),
            $this->input->post('active'),
            $this->input->post("id")
        );
        echo $update;
    }
}

/* End of file formula2.php */
/* Location: ./application/controllers/setup/formula2.php */