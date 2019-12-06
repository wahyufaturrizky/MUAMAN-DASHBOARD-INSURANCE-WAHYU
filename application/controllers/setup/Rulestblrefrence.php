<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rulestblrefrence extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setup/mruletblrefrence');
	}

	public function index()
	{
		$this->cekpriviledge();
		$data['getasuransi'] = $this->mruletblrefrence->getasuransi();
		$data['getnasabah'] = $this->mruletblrefrence->getnasabah();
		$this->template();
        $this->load->view('setup/ruletblrefrence/content',$data);
        $this->footer();
        $this->load->view('setup/ruletblrefrence/content_js'); 	
	}

	public function getprodukasuransi()
    {
        $getprodukasuransi = $this->mruletblrefrence->getprodukasuransi(
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
        $getadditionalform = $this->mruletblrefrence->getadditionalform(
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
        $produk = $this->input->get('produk');
        $asuransi = $this->input->get('asuransi');
        $nasabahid = $this->input->get('nasabahid');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mruletblrefrence->get($offset,$limit,$search,$produk,$asuransi,$nasabahid);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->btnedit = '<button class="btn btn-warning btn-flat" id="edit-'.$row->id_form.'"><i class="fa fa-pencil"></i> Edit</button>
                    <script>
                    $(document).on("click", "#edit-'.$row->id_form.'", function() {
                        edit("'.$row->rule_field.'","'.$row->rule_name.'","'.$row->id_form.'");
                    });
                    </script>
            ';
            $row->btndelete ='<button class="btn btn-danger btn-flat" id="delete-'.$row->id_form.'"><i class="fa fa-trash"></i> Delete</button>
                    <script>
                    $(document).on("click", "#delete-'.$row->id_form.'", function() {
                       deleterule("'.$row->id_form.'"); 
                    });
                    </script>
            ';
            $row->btnconfig = '
                <a href="'.site_url().'setup/configrule/?ruleid='.base64_encode($row->id_form).'&fields='.base64_encode($row->rule_field).'&name='.base64_encode($row->rule_name).'">
                    <button class="btn btn-info btn-flat" id="config-'.$row->id_form.'"><i class="fa fa-gears"></i> Configuration</button>
                </a>
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
        $asuransi = $this->input->get('asuransi');
        $produk = $this->input->get('produk');
        $nasabahid = $this->input->get('nasabahid');
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $getpage = $this->mruletblrefrence->getpage($search,$produk,$asuransi,$nasabahid);
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
        $getoption = $this->mruletblrefrence->getoption(
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
        $save = $this->mruletblrefrence->save(
            $this->input->post("asuransi"),
            $this->input->post("produk"),
            $this->input->post("client"),
            $this->input->post("rulename"),
            $this->input->post("rulefield")
        );
        echo $save;
    }

    public function delete()
    {
        $delete = $this->mruletblrefrence->delete(
            $this->input->post("id")
        );
        if($delete>0){
            $deleteconfig = $this->mruletblrefrence->deleteconfig(
                $this->input->post("id")
            );
        }
        echo $deleteconfig;
    }

    public function update()
    {
    $update = $this->mruletblrefrence->update(
            $this->input->post("asuransi"),
            $this->input->post("produk"),
            $this->input->post("client"),
            $this->input->post("rulename"),
            $this->input->post("rulefield"),
            $this->input->post("id")
        );
        echo $update;
    }
}

/* End of file ruletblrefrence.php */
/* Location: ./application/controllers/setup/ruletblrefrence.php */