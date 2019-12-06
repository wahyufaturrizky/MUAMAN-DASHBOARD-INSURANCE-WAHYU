<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Polisinduk extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setup/mpolisinduk');
	}

	public function index()
	{
		$this->cekpriviledge();
		$data['getasuransi'] = $this->mpolisinduk->getasuransi();
		$data['getnasabah'] = $this->mpolisinduk->getnasabah();
		$this->template();
        $this->load->view('setup/polisinduk/content',$data);
        $this->footer();
        $this->load->view('setup/polisinduk/content_js'); 	
	}

	public function getprodukasuransi()
    {
        $getprodukasuransi = $this->mpolisinduk->getprodukasuransi(
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
        $id_polis = $this->input->post('id_polis');
        $pemegang = $this->input->post('pemegang');
        $filename = $this->input->post('filename');
        $nama = $this->input->post('nama');
        $state = $this->input->post('state');
        $polisdetail = $this->input->post('polisdetail');
        $polisdetail = $this->input->post('polisdetail');
        $jenispolis = $this->input->post('jenispolis');
        $periodestart = $this->input->post('periodestart');
        $periodeend = $this->input->post('periodeend');
        $file = $_FILES['userfile']['tmp_name'];
        if (file_exists($file)){
            $filename = 'POLIS-'.$id_polis.'-'.str_replace(".","_",$polisdetail).'-'.$asid.$prodid.$client.'.pdf';
            $config['upload_path']          = './assets/upload/polisinduk/';
    		$config['allowed_types']        = 'pdf';
    		$config['overwrite']            = TRUE;
    		$config['max_size']             = 100000;
    		$config['file_name']            = $filename;
            
            $this->load->library('upload', $config);
             
            if ( ! $this->upload->do_upload()){
                $error = array('error' => $this->upload->display_errors());
                //print_r($error);
            } 
            else{

            }
        }
            $inserttopolisinduk = $this->mpolisinduk->inserttopolisinduk(
                $asid,
                $prodid,
                $client,
                $id_polis,
                $pemegang,
                $nama,
                $state,
                $filename,
                $polisdetail,
                $jenispolis,
                $periodestart,
                $periodeend
            );
            echo $inserttopolisinduk;
    }

	public function ajax_data()
    {
        $page = $this->input->get('page');
        $produk = $this->input->get('produk');
        $asuransi = $this->input->get('asuransi');
        $nasabahid = $this->input->get('nasabahid');
        $id_polis = $this->input->post('id_polis');
        $pemegang = $this->input->post('pemegang');
        $nama = $this->input->post('nama');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mpolisinduk->get($offset,$limit,$search,$produk,$asuransi,$nasabahid);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->btnedit = '<button class="btn btn-warning btn-flat" id="edit-'.$row->id_form.'"><i class="fa fa-pencil"></i> Edit</button>
                    <script>
                    $(document).on("click", "#edit-'.$row->id_form.'", function() {
                        $("#id_polis").val("'.$row->id_polis_induk.'");
                        $("#id_polis").prop("readOnly",true);
                        $("#pemegang").val("'.$row->pemegang_polis.'");
                        $("#nama").val("'.$row->nama_pemegang_polis.'");
                        $("#filename").val("'.$row->pdffile.'");
                        $("#state").val("'.$row->state.'");
                        $("#polisdetail").val("'.$row->id_polis_detail.'");
                        $("#jenispolis").val("'.$row->jenis_polis.'");
                        $("#periodestart").val("'.$row->periode_start.'");
                        $("#periodeend").val("'.$row->periode_end.'");
                        $("#modalasuransi").val("'.$row->asuransi_id.'");
						$("#modalproduk").val("'.$row->produk_id.'");
						$("#modalclient").val("'.$row->client.'");
                        $("#modalupload").modal("show");
                    });
                    </script>
            ';
            $row->btndelete ='<button class="btn btn-danger btn-flat" id="delete-'.$row->id_form.'"><i class="fa fa-trash"></i> Delete</button>
                    <script>
                    $(document).on("click", "#delete-'.$row->id_form.'", function() {
                        deleteform("'.$row->id_form.'","'.$row->pdffile.'");
                    });
                    </script>
            ';
            if($row->btndownload!=''){
                $row->btndownload ='<a href="'.site_url().'/assets/upload/polisinduk/'.$row->pdffile.'" target="_blank"><button class="btn btn-info btn-flat" id="csv-'.$row->id_form.'"><i class="fa fa-download"></i> Download '.$row->pdffile.'</button></a>
                ';
            }else{
                $row->btndownload ='dokumen tidak ditemukan';
            }
            $row->btndiscount ='<a href="'.site_url().'/setup/discount?iddetail='.base64_encode($row->id_form).'" target="_blank"><button class="btn btn-info btn-flat"><i class="fa fa-gears"></i> Setup</button></a>
            ';
            $row->btncommision ='<a href="'.site_url().'/setup/commision?iddetail='.base64_encode($row->id_form).'" target="_blank"><button class="btn btn-info btn-flat"><i class="fa fa-gears"></i> Setup</button></a>
            ';
            $row->btnothers ='<a href="'.site_url().'/setup/others?iddetail='.base64_encode($row->id_form).'" target="_blank"><button class="btn btn-info btn-flat"><i class="fa fa-gears"></i> Setup</button></a>
            ';
            $row->btnformula ='<a href="'.site_url().'/setup/formula2?iddetail='.base64_encode($row->id_form).'" target="_blank"><button class="btn btn-info btn-flat"><i class="fa fa-gears"></i> Setup</button></a>
            ';
            if($row->state=='1'){
                $row->state = 'AKTIF';
            }else{
                $row->state = 'TIDAK AKTIF';
            }
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
        $id_polis = $this->input->post('id_polis');
        $pemegang = $this->input->post('pemegang');
        $nama = $this->input->post('nama');
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $getpage = $this->mpolisinduk->getpage($search,$produk,$asuransi,$nasabahid);
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
    	$this->mpolisinduk->delete(
    		$this->input->post("id")
    	);
    	unlink("./assets/upload/polisinduk/".$this->input->post("filename"));
    }
}

/* End of file polisinduk.php */
/* Location: ./application/controllers/setup/polisinduk.php */