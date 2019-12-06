<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formasuransi extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setup/mformasuransi');
	}

	public function index()
	{
        $this->cekpriviledge();
		$data['getasuransi'] = $this->mformasuransi->getasuransi();
		$this->template();
        $this->load->view('setup/formasuransi/content',$data);
        $this->footer();
        $this->load->view('setup/formasuransi/content_js'); 		
	}


    public function getprodukasuransi()
    {
        $getprodukasuransi = $this->mformasuransi->getprodukasuransi(
            $this->input->post("asuransi")
        );

        echo '<option value= "-">Produk Asuransi('.$getprodukasuransi->num_rows().')</option>';
        foreach ($getprodukasuransi->result() as $k) {
            echo '<option value="'.$k->id_produk.'">
                 '.$k->nama_produk.'
                 </option>';
        }
    }

    public function getfieldlist()
    {
        $getfieldlist = $this->mformasuransi->getfieldlist(
            $this->input->post("produk")
        );

        echo '<option value="-">Field List('.$getfieldlist->num_rows().')</option>';
        foreach ($getfieldlist->result() as $k) {
            echo '<option value="'.$k->id_field.'|'.$k->caption.'|'.$k->ex_value.'">
                 '.$k->id_field.' : 
                 '.$k->caption.'
                 </option>';
        }
    }

	public function ajax_data()
    {
        $page = $this->input->get('page');
        $produk = $this->input->get('produk');
        $asuransi = $this->input->get('asuransi');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mformasuransi->get($offset,$limit,$search,$produk,$asuransi);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->btnopen ='<button class="btn btn-info btn-flat" id="open-'.$row->id_form.'"><i class="fa fa-search"></i> Preview</button>
                    <script>
                    $(document).on("click", "#open-'.$row->id_form.'", function() {
                        openform("'.$row->field_id.'","'.$row->id_form.'");
                        $("#setupform").slideUp("fast");
                    });
                    </script>
            ';
            $row->btnedit = '<button class="btn btn-warning btn-flat" id="edit-'.$row->id_form.'"><i class="fa fa-pencil"></i> Edit</button>
                    <script>
                    $(document).on("click", "#edit-'.$row->id_form.'", function() {
                        editform("'.$row->field_id_list.'","'.$row->field_list.'","'.$row->example.'");
                    });
                    </script>
            ';
            $row->field_id = '<ul><li>'.str_replace("|", "</li><li>", $row->field_id).'</li></ul>';
            $row->field_caption = '<ul><li>'.str_replace("|", "</li><li>", $row->field_caption).'</li></ul>';
            
            $row->btndelete ='<button class="btn btn-danger btn-flat" id="delete-'.$row->id_form.'"><i class="fa fa-trash"></i> Delete</button>
                    <script>
                    $(document).on("click", "#delete-'.$row->id_form.'", function() {
                        deleteform("'.$row->id_form.'");
                    });
                    </script>
            ';

            $row->btndownload ='<button class="btn btn-success btn-flat" id="csv-'.$row->id_form.'"><i class="fa fa-download"></i> Download</button>
                    <script>
                    $(document).on("click", "#csv-'.$row->id_form.'", function() {
                        downloadcsv("'.$row->field_mandatory_list."|".$row->field_list.'","'.$row->example_mandatory."|".$row->example.'");
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
        $asuransi = $this->input->get('asuransi');
        $produk = $this->input->get('produk');
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $getpage = $this->mformasuransi->getpage($search,$produk,$asuransi);
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
        $save = $this->mformasuransi->save(
            $this->input->post('asuransi'),
            $this->input->post('produk'),
            $this->input->post('field_id_concat'),
            $this->input->post('field_caption_concat'),
            $this->input->post('field_example_concat'),
            $this->input->post('mandatory_id'),
            $this->input->post('mandatory_caption'),
            $this->input->post('mandatory_example')

        );

        echo $save;
    }

    public function update()
    {
        $update = $this->mformasuransi->update(
            $this->input->post('asuransi'),
            $this->input->post('produk'),
            $this->input->post('field_id_concat'),
            $this->input->post('field_caption_concat'),
            $this->input->post('field_example_concat'),
            $this->input->post('mandatory_id'),
            $this->input->post('mandatory_caption'),
            $this->input->post('mandatory_example')
        );
    }

    public function delete()
    {
        $delete = $this->mformasuransi->delete(
            $this->input->post('id_form')
        );
    }

    public function generatedform()
    {
        $field_id = explode("|", $this->input->post('field_id_concat'));
        $bulkdata = '';
        $comma='';
        //echo session_id();
        for ($i=0; $i < count($field_id) ; $i++) { 
            $bulkdata = $bulkdata.$comma."('".session_id()."','".$field_id[$i]."',CURDATE(),".$i.",".$this->input->post('id_form').",'".$this->input->post('produk')."')";
            $comma = ',';
        }
        $inserttotemp= $this->mformasuransi->inserttotemp($bulkdata);
        if($inserttotemp){
            $data['getform'] = $this->mformasuransi->getform(
                $this->input->post('id_form')
            );

            $this->load->view('setup/form/content',$data);
            $this->load->view('setup/form/content_js');
        }   
    }

    public function getkota()
    {
        $getkota = $this->mformasuransi->getkota(
            $this->input->post("provinsi")
        );

        echo '<option value="">KOTA('.$getkota->num_rows().')</option>';
        foreach ($getkota->result() as $k) {
            echo '<option value="'.$k->id.'">
                 '.$k->kota.'
                 </option>';
        }
    }

    public function getkecamatan()
    {
        $getkecamatan = $this->mformasuransi->getkecamatan(
            $this->input->post("kota")
        );

        echo '<option value="">KECAMATAN('.$getkecamatan->num_rows().')</option>';
        foreach ($getkecamatan->result() as $k) {
            echo '<option value="'.$k->id.'">
                 '.$k->kecamatan.'
                 </option>';
        }
    }

    public function getkelurahan()
    {
        $getkelurahan = $this->mformasuransi->getkelurahan(
            $this->input->post("kecamatan")
        );

        echo '<option value="">KELURAHAN('.$getkelurahan->num_rows().')</option>';
        foreach ($getkelurahan->result() as $k) {
            echo '<option value="'.$k->id.'">
                 '.$k->kelurahan.'
                 </option>';
        }
    }

    public function getprovinsi()
    {
        $getprovinsi = $this->mformasuransi->getprovinsi();

        echo '<option value="">PROVINSI('.$getprovinsi->num_rows().')</option>';
        foreach ($getprovinsi->result() as $k) {
            echo '<option value="'.$k->id.'">
                 '.$k->provinsi.'
                 </option>';
        }
    }

    public function getgender()
    {
        $getgender = $this->mformasuransi->getgender();

        echo '<option value="">PILIHAN('.$getgender->num_rows().')</option>';
        foreach ($getgender->result() as $k) {
            echo '<option value="'.$k->id.'">
                 '.$k->gender.'
                 </option>';
        }
    }

    public function downloadcsv()
    {
        $header = $this->input->get('header');
        $content = $this->input->get('example');
        $output= $header.PHP_EOL.$content;
        header("Content-type: application/txt");
        header('Content-Disposition: attachment; filename="TEMPLATE_BULK_PURCHASE_'.trim($this->input->get('produk')).'_'.trim($this->input->get('asuransi')).'.csv"');
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');
        fputs($handle,$output);
        fclose($handle);
        exit;
    }

    public function cleartemp()
    {
        $this->mformasuransi->cleartemp();
    }

    public function getmandatoryfield()
    {
         $getmandatoryfield = $this->mformasuransi->getmandatoryfield(
            ''
         );   
         $mandatory_id ='';
         $mandatory_caption ='';
         $mandatory_example ='';
         $delimiter = '';
         foreach ($getmandatoryfield->result() as $k) {
             echo'
            <div class="row form-group" id="'.$k->id_field.'">
                <div class="col-sm-2">
                    <input type="text" class="form-control field_idm" value="'.$k->id_field.'" readonly>
                </div>
                <div class="col-sm-9"> 
                    <input type="text" class="form-control field_captionm" value="'.$k->caption.'" readonly>
                    <input type="hidden" class="form-control field_examplem" value="'.$k->ex_value.'" readonly>
                </div>            
                <div class="col-sm-1">
                    <button class="btn btn-flat btn-danger" id="btn-'.$k->id_field.'" disabled><i class="fa fa-trash"></i></button>
                </div>
            </div>';
            $mandatory_id = $mandatory_id.$delimiter.$k->id_field;
            $mandatory_caption = $mandatory_caption.$delimiter.$k->caption;
            $mandatory_example = $mandatory_example.$delimiter.$k->ex_value;
            $delimiter = "|";
         }
         echo '
                <input type="hidden" id="mandatory_id" value="'.$mandatory_id.'">
                <input type="hidden" id="mandatory_caption" value="'.$mandatory_caption.'">
                <input type="hidden" id="mandatory_example" value="'.$mandatory_example.'">
            ';
    }

}

/* End of file formasuransi.php */
/* Location: ./application/controllers/setup/formasuransi.php */