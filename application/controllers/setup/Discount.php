<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Discount extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setup/mdiscount');
	}

	public function index()
	{
		//$this->cekpriviledge();
		$sessionpolisdetail = array(
            'polisdetail' => base64_decode($this->input->get('iddetail'))
        );
        
        $this->session->set_userdata( $sessionpolisdetail );
        $data['getasuransi'] = $this->mdiscount->getasuransi();
		$data['getnasabah'] = $this->mdiscount->getnasabah();
		$this->template();
        $this->load->view('setup/discount/content',$data);
        $this->footer();
        $this->load->view('setup/discount/content_js'); 	
	}

	public function getprodukasuransi()
    {
        $getprodukasuransi = $this->mdiscount->getprodukasuransi(
            $this->input->post("asuransi")
        );

        echo '<option value= "-">Produk Asuransi('.$getprodukasuransi->num_rows().')</option>';
        foreach ($getprodukasuransi->result() as $k) {
            echo '<option value="'.$k->id_produk.'">
                 '.$k->nama_produk.'
                 </option>';
        }
    }

    public function getadditionalform()
    {
        $getadditionalform = $this->mdiscount->getadditionalform(
            $this->input->post("asuransi"),
            $this->input->post("produk_id"),
            $this->input->post("client")
        );

        echo '<option value= "-">Form Tambahan('.$getadditionalform->num_rows().')</option>';
        foreach ($getadditionalform->result() as $k) {
            echo '<option value="'.$k->id.'">
                 '.$k->formname.'
                 </option>';
        }
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

        $data['getdata']= $this->mdiscount->get($offset,$limit,$search);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->btnedit = '<button class="btn btn-warning btn-flat" id="edit-'.$row->id_form.'"><i class="fa fa-pencil"></i> Edit</button>
                    <script>
                    $(document).on("click", "#edit-'.$row->id_form.'", function() {
                        edit("'.$row->discount_by.'","'.$row->discount_type.'","'.$row->discount_rate.'","'.$row->discount_amount.'","'.$row->id_form.'");
                    });
                    </script>
            ';
            $row->btndelete ='<button class="btn btn-danger btn-flat" id="delete-'.$row->id_form.'"><i class="fa fa-trash"></i> Delete</button>
                    <script>
                    $(document).on("click", "#delete-'.$row->id_form.'", function() {
                       deletediscount("'.$row->id_form.'"); 
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
        $getpage = $this->mdiscount->getpage($search);
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

    public function getoption()
    {
        $getoption = $this->mdiscount->getoption(
            $this->input->post("asuransi"),
            $this->input->post("produk")
        );

        foreach ($getoption->result() as $k) {
            $field_list = explode("|", $k->field_list);
            echo $field_list;
            for ($i=0; $i <count($field_list); $i++) { 
               echo '<option value="'.$field_list[$i].'">
                 '.$field_list[$i].'
                 </option>';
            }
            
        }
    }

    public function save()
    {
        $save = $this->mdiscount->save(
            $this->input->post("discountby"),
            $this->input->post("discounttype"),
            $this->input->post("discountrate"),
            $this->input->post("discountamount")
        );
        echo $save;
    }

    public function delete()
    {
        $delete = $this->mdiscount->delete(
            $this->input->post("id")
        );
        echo $delete;
    }

    public function update()
    {
    $update = $this->mdiscount->update(
            $this->input->post("discountby"),
            $this->input->post("discounttype"),
            $this->input->post("discountrate"),
            $this->input->post("discountamount"),
            $this->input->post("id")
        );
        echo $update;
    }
}

/* End of file discount.php */
/* Location: ./application/controllers/setup/discount.php */