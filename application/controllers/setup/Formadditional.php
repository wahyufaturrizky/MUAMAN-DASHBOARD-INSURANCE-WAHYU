<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formadditional extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setup/mformadditional');
	}

	public function index()
	{
		$this->cekpriviledge();
		$data['getasuransi'] = $this->mformadditional->getasuransi();
		$data['getnasabah'] = $this->mformadditional->getnasabah();
		$this->template();
        $this->load->view('setup/formadditional/content',$data);
        $this->footer();
        $this->load->view('setup/formadditional/content_js');
	}

	public function getprodukasuransi()
    {
        $getprodukasuransi = $this->mformadditional->getprodukasuransi(
            $this->input->post("asuransi")
        );

        echo '<option value= "-">Produk Asuransi('.$getprodukasuransi->num_rows().')</option>';
        foreach ($getprodukasuransi->result() as $k) {
            echo '<option value="'.$k->id_produk.'">
                 '.$k->nama_produk.'
                 </option>';
        }
    }

	public function uploaddata()
	{
        $asid = $this->input->post('id_asuransi');
        $prodid = $this->input->post('id_produk');
        $client = $this->input->post('id_client');
        $formname = $this->input->post('formname');

		// add str_replace for remove space to "_" (underscore)
        $filename = str_replace(" ", "_",'FILE-'.$formname.'-'.$asid.'-'.$prodid.'-'.$client.'.pdf');

        $config['upload_path']          = './assets/upload/additionalform/';
		$config['allowed_types']        = 'pdf';
		$config['overwrite']            = TRUE;
		$config['max_size']             = 100000;
		$config['file_name']            = $filename;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload()){
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }
        else{
        	$inserttoadditional = $this->mformadditional->inserttoadditional(
        	 	$asid,
        	 	$prodid,
        	 	$client,
        	 	$formname,
        	 	$filename
        	);
        	echo $inserttoadditional;
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

        $data['getdata']= $this->mformadditional->get($offset,$limit,$search,$produk,$asuransi,$nasabahid);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->btnedit = '<button class="btn btn-warning btn-flat" id="edit-'.$row->id_form.'"><i class="fa fa-pencil"></i> Edit</button>
                    <script>
                    $(document).on("click", "#edit-'.$row->id_form.'", function() {
                        $("#formname").val("'.$row->formname.'")
                        $("#formname").prop("readOnly",true);
                        $("#modalasuransi").val("'.$row->asuransi_id.'");
						$("#modalproduk").val("'.$row->produk_id.'");
						$("#modalclient").val("'.$row->user_id.'");
                        $("#modalupload").modal("show");
                    });
                    </script>
            ';
            $row->btndelete ='<button class="btn btn-danger btn-flat" id="delete-'.$row->id_form.'"><i class="fa fa-trash"></i> Delete</button>
                    <script>
                    $(document).on("click", "#delete-'.$row->id_form.'", function() {
                        deleteform("'.$row->id_form.'","'.$row->filename.'");
                    });
                    </script>
            ';
            $row->btndownload ='<a href="'.site_url().'/assets/upload/additionalform/'.$row->filename.'" target="_blank"><button class="btn btn-success btn-flat" id="csv-'.$row->id_form.'"><i class="fa fa-download"></i> Download</button></a>
            ';
            $row->filename = '<span class="text-red"><i class="fa fa-file-pdf-o"></i></span> '.$row->filename;
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
        $getpage = $this->mformadditional->getpage($search,$produk,$asuransi,$nasabahid);
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

    function delete(){
    	$this->mformadditional->delete(
    		$this->input->post("id")
    	);
    	unlink("./assets/upload/additionalform/".$this->input->post("filename"));
    }
}

/* End of file Formadditional.php */
/* Location: ./application/controllers/setup/Formadditional.php */
