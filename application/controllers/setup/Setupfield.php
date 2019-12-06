<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setupfield extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setup/msetupfield');
	}

	public function index()
	{
		$data['getproduk'] = $this->msetupfield->getproduk();
        $data['getmaster'] = $this->msetupfield->getmaster();
		$this->template();
        $this->load->view('setup/setupfield/content',$data);
        $this->footer();
        $this->load->view('setup/setupfield/content_js'); 		
	}


	public function ajax_data()
    {
        $page = $this->input->get('page');
        $produk = $this->input->get('produk');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->msetupfield->get($offset,$limit,$search,$produk);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
         $row->btnedit = '<button class="btn btn-warning btn-flat" id="edit-'.$row->id_produk.'-'.$row->id_field.'"><i class="fa fa-pencil"></i> Edit</button>
                    <script>
                    $(document).on("click", "#edit-'.$row->id_produk.'-'.$row->id_field.'", function() {
                        editfield("'.$row->id_field.'","'.$row->caption.'","'.$row->type_field.'","'.$row->ex_value.'","'.$row->lov.'");
                    });
                    </script>
         ';
         $row->btndelete ='<button class="btn btn-danger btn-flat" id="delete-'.$row->id_produk.'-'.$row->id_field.'"><i class="fa fa-trash"></i> Delete</button>
                    <script>
                    $(document).on("click", "#delete-'.$row->id_produk.'-'.$row->id_field.'", function() {
                        deletefield("'.$row->id_produk.'","'.$row->id_field.'");
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
        $produk = $this->input->get('produk');
        if($search!= ''){
            $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        }
        $getpage = $this->msetupfield->getpage($search,$produk);
        $countpage = 1;
        $limit = 10;
            foreach ($getpage->result() as $row) {
              $countpage = ceil(intval($row->page)/$limit);
            } 
            if($countpage > 0){
                echo '<input type="hidden" id="countpage" value="'.$countpage.'">';
                echo '<button class="btn btn-flat btn-info page1"><i class="fa fa-fast-backward"></i></button>';
                for ($i=1; $i <= $countpage ; $i++) { 
                  echo '<button class="btn btn-flat btn-info page'.$i.'"">'.$i.'</button>';
                }
                echo '<button class="btn btn-flat btn-info page'.$countpage.'"><i class="fa fa-fast-forward"></i></button>';
            }
            else{
                echo 0;
            }
    }


    public function save()
    {
        $save = $this->msetupfield->save(
            $this->input->post('id_produk'),
            $this->input->post('id_field'),
            $this->input->post('caption'),
            $this->input->post('type'),
            $this->input->post('ex'),
            $this->input->post('lov')
        );

        echo $save;
    }

    public function update()
    {
        $update = $this->msetupfield->update(
            $this->input->post('id_produk'),
            $this->input->post('id_field'),
            $this->input->post('caption'),
            $this->input->post('type'),
            $this->input->post('ex'),
            $this->input->post('lov')
        );
    }

    public function delete()
    {
        $delete = $this->msetupfield->delete(
            $this->input->post('id_produk'),
            $this->input->post('id_field')
        );
    }
}

/* End of file setupfield.php */
/* Location: ./application/controllers/setup/setupfield.php */