<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formula extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('setup/mformula');
	}

	public function index()
	{
		$this->cekpriviledge();
		$data['getasuransi'] = $this->mformula->getasuransi();
		$data['getnasabah'] = $this->mformula->getnasabah();
		$this->template();
        $data['getsubtotal'] = $this->mformula->getsubtotal();
        $this->load->view('setup/formula/content',$data);
        $this->footer();
        $this->load->view('setup/formula/content_js'); 	
	}

    public function getnett()
    {
        $data['getsubtotal'] = $this->mformula->getsubtotal();
        $data['getadjustment'] = $this->mformula->getadjustment();
        $data['gettax'] = $this->mformula->gettax();
        $data['getshares'] = $this->mformula->getshares();
        $this->load->view('setup/formula/nett/content',$data);
    }

	public function getprodukasuransi()
    {
        $getprodukasuransi = $this->mformula->getprodukasuransi(
            $this->input->post("asuransi")
        );

        echo '<option value= "-">Produk Asuransi('.$getprodukasuransi->num_rows().')</option>';
        foreach ($getprodukasuransi->result() as $k) {
            echo '<option value="'.$k->id_produk.'">
                 '.$k->nama_produk.'
                 </option>';
        }
    }

    public function getpolisid()
    {
        $getpolisid = $this->mformula->getpolisid(
            $this->input->post("asuransi"),
            $this->input->post("produk_id"),
            $this->input->post("client")
        );

        echo '<option value= "-">ID Polis('.$getpolisid->num_rows().')</option>';
        foreach ($getpolisid->result() as $k) {
            echo '<option value="'.$k->id_polis_induk.'">
                 '.$k->id_polis_induk.'
                 </option>';
        }
    }


    //// utama end


    //// table formula function start
	public function ajax_data()
    {
        $page = $this->input->get('page');
        
        $produk = $this->input->get('produk');
        $asuransi = $this->input->get('asuransi');
        $nasabahid = $this->input->get('nasabahid');
        $polisid = $this->input->get('polis_id');

        $formulasession = array(
            'produk_id' => $produk,
            'asuransi_id' => $asuransi,
            'client_id' => $nasabahid,
            'polis_id' => $polisid
        );
        
        $this->session->set_userdata( $formulasession );

        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mformula->get($offset,$limit,$search,$produk,$asuransi,$nasabahid,$polisid);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->btnconfig = '<button class="btn btn-info btn-flat" id="import-'.$row->id_form.'"><i class="fa fa-upload"></i> Import CSV</button>
                    <script>
                    $(document).on("click", "#import-'.$row->id_form.'", function() {
                        $("#tableid").val("'.$row->id_form.'");
                        $("#modaluploadtable").modal("show");
                    });
                    </script>
            ';
            $row->btntable ='<button class="btn btn-info btn-flat" id="table-'.$row->id_form.'"><i class="fa fa-table"></i> Show Data</button>
                    <script>
                    $(document).on("click", "#table-'.$row->id_form.'", function() {
                        tableheader("'.$row->columnname.'","'.$row->rowname.'","'.$row->tablename.'");
                        $("#modaldatatable").modal("show");
                        setTimeout( function(){
                            datatablepagingtable("'.$row->id_form.'")
                            },200)
                        
                    });
                    </script>
            ';

            $row->btndownload ='<button class="btn btn-info btn-flat" id="download-'.$row->id_form.'"><i class="fa fa-download"></i> Template</button>
                    <script>
                    $(document).on("click", "#download-'.$row->id_form.'", function() {
                        downloadcsv("'.$row->columnname.'","'.$row->rowname.'","'.$row->tablename.'");
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
        $nasabahid = $this->input->get('nasabahid');
        $polisid = $this->input->get('polis_id');
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $getpage = $this->mformula->getpage($search,$produk,$asuransi,$nasabahid,$polisid);
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
        $getoption = $this->mformula->getoption(
            $this->input->post("asuransi"),
            $this->input->post("produk")
        );

        foreach ($getoption->result() as $k) {
            $field_list = explode("|", $k->field_list);
            //echo $field_list;
            for ($i=0; $i <count($field_list); $i++) { 
               echo '<option value="'.$field_list[$i].'">
                 '.$field_list[$i].'
                 </option>';
            }
            
        }
    }

    public function getoptiontblref()
    {
        $getoptiontblref = $this->mformula->getoptiontblref(
            $this->input->post("asuransi"),
            $this->input->post("produk"),
            $this->input->post("client"),
            $this->input->post("polisid")
        );

        foreach ($getoptiontblref->result() as $k) {
           echo '<option value="'.$k->tablename.'">
             '.$k->tablename.'
             </option>';
        
        }
    }



    public function savetable()
    {
        $savetable = $this->mformula->savetable(
            $this->input->post("asuransi"),
            $this->input->post("produk"),
            $this->input->post("client"),
            $this->input->post("polisid"),
            $this->input->post("tablename"),
            $this->input->post("rowname"),
            $this->input->post("columnname")
        );
        echo $savetable;
    }

    public function downloadcsv()
    {
        $column = $this->input->get('column');
        $row = $this->input->get('row');
        $tablename = $this->input->get('tablename');
        $header = $row."|".$column."|VALUE DATA";
        $output= $header;
                    
        header("Content-type: application/txt");
        header('Content-Disposition: attachment; filename="TEMPLATE_TABLE_'.$tablename.'.csv"');
        header("Pragma: no-cache");
        header("Expires: 0");
        $handle = fopen('php://output', 'w');
        fputs($handle,$output);
        fclose($handle);
        exit;
    }

    public function uploaddata()
    {
        $config['upload_path']          = './assets/upload/tableformula/';
        $config['allowed_types']        = 'csv';
        $config['overwrite']            = TRUE;
        $config['max_size']             = 100000;
        
        $this->load->library('upload', $config);
         
        if ( ! $this->upload->do_upload()){
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        } 
        else{
            //echo 1;
            $success_data = $this->upload->data();
            $file_name = $success_data['file_name'];
            $filetarget = $_SERVER['DOCUMENT_ROOT']."/muaman/assets/upload/tableformula/".$file_name;
            //echo $file_name;
            //$textinsert = "#include ".$this->input->get('filename');
            $handle = fopen($filetarget, "r");
            //$isexist = 0;
            $a=0;
            $bulkdata = '';
            $comma ='';
            //print_r($handle);
            while (!feof($handle)) { 
                $line_of_text = fgets($handle);
                //echo strpos($line_of_text, '\n');
               
                
                if($line_of_text!=''){
                    $dataarray ='';
                    $dataarray = explode("|", str_replace('"', '',trim($line_of_text)));
                    
                    if($dataarray[2]=='VALUE DATA'){
                        continue;
                    }else{    
                        if(strlen($dataarray[2])!=0)
                        $bulkdata = $bulkdata.$comma."(
                                    NULL,
                                    '".$this->input->post('tableid')."',
                                    '".$dataarray[0]."',
                                    '".$dataarray[1]."',
                                    '".$dataarray[2]."',
                                    NOW()
                        )";

                        $comma = ',';

                        $a++;
                    }
                } 
            }
            if($a>0){
                $insert1 = $this->mformula->insertbulkdatatable($bulkdata);
                echo $insert1;
            }
            fclose($handle);
            //redirect(base_url().'polis/bulkpurchase/');
        }  
    }


    public function ajax_datatable()
    {
        $page = $this->input->get('page');
        $tableid = $this->input->get('tableid');
        if($page == ''){
            $page = 1;
        }
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mformula->gettable($offset,$limit,$tableid);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {          
            $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    function pagingtable()
    {
        $tableid = $this->input->get('tableid');
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $getpage = $this->mformula->getpagetable($tableid);
        $countpage = 1;
        $limit = 10;
            foreach ($getpage->result() as $row) {
              $countpage = ceil(intval($row->page)/$limit);
            } 
            if($countpage>0){
                echo '<input type="hidden" id="countpagetable" value="'.$countpage.'">';
                echo '<button class="btn btn-flat btn-info pagetable1"><i class="fa fa-fast-backward"></i></button>';
                for ($i=1; $i <= $countpage ; $i++) { 
                  echo '<button class="btn btn-flat btn-info pagetable'.$i.'"">'.$i.'</button>';
                }
                echo '<button class="btn btn-flat btn-info pagetable'.$countpage.'"><i class="fa fa-fast-forward"></i></button>';
            }else{
                echo '0';
            }
    }

    //// table formula end

    /// gross setup start

    public function savesubtotal()
    {
        $savesubtotal = $this->mformula->savesubtotal(
            $this->input->post("varname"),
            $this->input->post("sourcetype"),
            $this->input->post("operator"),
            $this->input->post("formula")
        );
    }

    public function savetax()
    {
        $savetax = $this->mformula->savetax(
            $this->input->post("varname"),
            $this->input->post("sourcetype"),
            $this->input->post("operator"),
            $this->input->post("formula"),
            $this->input->post("valuetype")
        );
    }

    public function saveadj()
    {
        $saveadj = $this->mformula->saveadj(
            $this->input->post("varname"),
            $this->input->post("sourcetype"),
            $this->input->post("operator"),
            $this->input->post("formula"),
            $this->input->post("valuetype")
        );
    }

    /// gross setup end


    /// setup shares start
    public function saveshares()
    
    {
        $saveshares = $this->mformula->saveshares(
            $this->input->post("varname"),
            $this->input->post("sourcetype"),
            $this->input->post("operator"),
            $this->input->post("formula"),
            $this->input->post("valuetype"),
            $this->input->post("propto")
        );
    }

    /// setup shares end

    /// nett start
    public function deletenett()
    
    {
        $deletenett = $this->mformula->deletenett(
            $this->input->post("id")
        );
    }

    /// nett end

    public function delete()
    {
        $delete = $this->mformula->delete(
            $this->input->post("id")
        );
        if($delete>0){
            $deleteconfig = $this->mformula->deleteconfig(
                $this->input->post("id")
            );
        }
        echo $deleteconfig;
    }

    public function update()
    {
    $update = $this->mformula->update(
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

/* End of file formula.php */
/* Location: ./application/controllers/setup/formula.php */