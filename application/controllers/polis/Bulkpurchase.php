<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulkpurchase extends MY_Controller {
	public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                $this->load->model('polis/bulkpurchase/mbulkpurchase');
        }

	public function index()
	{
		$data['getemail'] = $this->mbulkpurchase->getemail();
		$data['getasuransi'] = $this->mbulkpurchase->getasuransi();
		$this->template();
		$this->load->view('polis/bulkpurchase/content',$data);
		$this->load->view('layout/footer');
		$this->load->view('polis/bulkpurchase/content_js');
	}


	public function getprodukasuransi()
    {
        $getprodukasuransi = $this->mbulkpurchase->getprodukasuransi(
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
        $getpolisid = $this->mbulkpurchase->getpolisid(
            $this->input->post("asuransi"),
            $this->input->post("produk_id"),
            $this->session->userdata('userid')
        );

        echo '<option value= "-">ID Polis('.$getpolisid->num_rows().')</option>';
        foreach ($getpolisid->result() as $k) {
            echo '<option value="'.$k->id.'">
                 '.$k->id_polis_induk.' : '.$k->id_polis_detail.'
                 </option>';
        }
    }

	public function getheader()
	{
		$getheader = $this->mbulkpurchase->getheader(
            $this->input->post("asuransi"),
            $this->input->post("produk_id")
        );

		$example='';
		$headerall='';
        foreach ($getheader->result() as $k) {
            $headerall = $k->field_mandatory_list."|".$k->field_list;
            $example = $k->example_mandatory."|".$k->example;
        }
        echo '<input type="hidden" id="headercsv" value="'.$headerall.'">';
        echo '<input type="hidden" id="examplecsv" value="'.$example.'">';
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

    public function ajax_data()
    {
        $page = $this->input->get('page');
        $produk = $this->input->get('produk');
        $asuransi = $this->input->get('asuransi');
        $status = $this->input->get('status');
        $id_purchase = $this->input->get('id_purchase');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND `data` LIKE \'%'.$search.'%\' OR `status` LIKE \'%'.$search.'%\' ';
        }
        $limit = 10;
        $offset = ($page-1)*$limit;

        $data['getdata']= $this->mbulkpurchase->get($offset,$limit,$search,$produk,$asuransi,$status,$id_purchase);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->viewform ="<button class='btn btn-success btn-flat' id='viewform-".$row->id."'><i class='fa fa-clipboard'></i> Lihat</button>
                            <script>
                                $(document).on('click', '#viewform-".$row->id."', function(e) {
                                    viewform('".trim($row->data)."','".trim($row->headerform)."');
                                });
                            </script>
														";

			// additionalform
			$row->ruleadd = "<span><strong>NM</strong></span>";
			$polisadd = $this->mbulkpurchase->addformdata($row->purchase_id, $row->id_member)->result();

			$row->listadd = "
			<ol type=\"1\" id=\"additionalform_list\"></ol>
				<script>
					let data = ".json_encode($polisadd).";
					if ( data.length > 0 ) {
						for(let i = 0; i < data.length; i++){
							$('#additionalform_list').append('<li><a href=\"".site_url() . "assets/upload/additionalform/" ."'+data[i].filename+'\" target=\"_blank\">'+data[i].filename+'</a></li>');
						}
					} else {
						$('#additionalform_list').append('<div>N/A</div>');
					}
				</script>
			";

            if( $status == 'OPEN' && ($this->session->userdata('usergroup')=='2'|| $this->session->userdata('usergroup')=='8') ){
                $selected1='';
                $selected2='';
                $selected3='';

                $selectedM='';
                $selectedF='';

                if($row->markedas == 'APPROVE'){
                    $selected1='selected';
                }
                elseif($row->markedas == 'PENDING'){
                    $selected2='selected';
                }
                elseif($row->markedas == 'CANCEL'){
                    $selected3='selected';
                }


                $row->choose = '
                                <select class ="form-control choicemarked" id="choice-'.$row->id.'">
                                    <option value="-">TANDAI SEBAGAI</option>
                                    <option value="APPROVE" '.$selected1.'>APPROVE</option>
                                    <option value="PENDING" '.$selected2.'>PENDING</option>
                                    <option value="CANCEL" '.$selected3.'>CANCEL</option>
                                </select>
                                <script>
                                $(document).on("change", "#choice-'.$row->id.'", function(e) {
                                    checkedchoice( $(this).val(), "'.$row->id.'");
                                });
                                </script>
                                ';

                if($row->markedplus == 'F'){
                    $selectedF='selected';
                }
                elseif($row->markedplus == 'M'){
                    $selectedM='selected';
                }
                 $row->addform ="
                 				<button class='btn btn-success btn-flat' id='viewaddform-".$row->id."'><i class='fa fa-file'></i> Form Tambahan</button>
	                            <script>
	                                $(document).on('click', '#viewaddform-".$row->id."', function(e) {
	                                	$('#modaluseradd').modal('show');
	                                    $('#uaf_id_purchase').val('".$row->purchase_id."');
	                                    $('#uaf_id_member').val('".$row->id_member."');
	                                    getformtambahan('".$row->buyer."');
	                                    getaddform('".$row->purchase_id."','".$row->id_member."');
	                                });
	                            </script>
                            	";
            }elseif( $status == 'PENDING' && ($this->session->userdata('usergroup')=='2'|| $this->session->userdata('usergroup')=='8') ){
                $selected1='';
                $selected2='';
                $selected3='';

                if($row->markedas == 'APPROVE'){
                    $selected1='selected';
                }
                if($row->markedas == 'CANCEL'){
                    $selected3='selected';
                }

                $row->choose = '
                                <select class ="form-control choicemarked" id="choice-'.$row->id.'">
                                    <option value="-">TANDAI SEBAGAI</option>
                                    <option value="APPROVE" '.$selected1.'>APPROVE</option>
                                    <option value="CANCEL" '.$selected3.'>CANCEL</option>
                                </select>
                                <script>
                                $(document).on("change", "#choice-'.$row->id.'", function(e) {
                                    checkedchoice( $(this).val(), "'.$row->id.'");
                                });
                                </script>
                                ';
                    $row->addform = "
                            	<button class='btn btn-success btn-flat' id='viewaddform-".$row->id."'><i class='fa fa-file'></i> Form Tambahan</button>
	                            <script>
	                                $(document).on('click', '#viewaddform-".$row->id."', function(e) {
	                                	$('#modaluseradd').modal('show');
	                                    $('#uaf_id_purchase').val('".$row->purchase_id."');
	                                    $('#uaf_id_member').val('".$row->id_member."');
	                                    getformtambahan('".$row->buyer."');
	                                    getaddform('".$row->purchase_id."','".$row->id_member."');
	                                });
	                            </script>
	                            ";



            }elseif($status=='OPEN' && ($this->session->userdata('usergroup')=='1') ){
                $row->choose = '<span class="text-blue"><i class="fa fa-clipboard"></i> Menunggu Diproses Broker </span>';
                // $row->addform = '<span class="text-blue"><i class="fa fa-clipboard"></i> Menunggu Diproses Broker </span>';
				$row->addform = "
                				<button class='btn btn-flat btn-info' id='viewmemberaddform-".$row->id."'> UPLOAD FORM TAMBAHAN</button>
                				<script>
	                                $(document).on('click', '#viewmemberaddform-".$row->id."', function(e) {
	                                	$('#maf_id_purchase').val('".$row->purchase_id."');
	                                    $('#maf_id_member').val('".$row->id_member."');
	                                    $('#modalmemberadd').modal('show');
	                                    getaddform('".$row->purchase_id."','".$row->id_member."');
	                                    getmemberaddform('".$row->purchase_id."','".$row->id_member."');
	                                });
	                            </script>

                				";
            }elseif($status=='APPROVE'){
                $row->choose = '<span class="text-green"> <i class="fa fa-check"></i> Sudah Disetujui Broker </span>';
                $row->addform = '<span class="text-green"><i class="fa fa-clipboard"></i> Auto cover </span>';
            }elseif($status=='CANCEL'){
                $row->choose = '<span class="text-red"> <i class="fa fa-times"></i> Sudah Ditolak Broker </span>';
                // $row->addform = '<span class="text-red"><i class="fa fa-clipboard"></i> Tidak diperlukan </span>';
				$row->addform = "
                				<button class='btn btn-flat btn-info' id='viewmemberaddform-".$row->id."'> UPLOAD FORM TAMBAHAN</button>
                				<script>
	                                $(document).on('click', '#viewmemberaddform-".$row->id."', function(e) {
	                                	$('#maf_id_purchase').val('".$row->purchase_id."');
	                                    $('#maf_id_member').val('".$row->id_member."');
	                                    $('#modalmemberadd').modal('show');
	                                    getaddform('".$row->purchase_id."','".$row->id_member."');
	                                    getmemberaddform('".$row->purchase_id."','".$row->id_member."');
	                                });
	                            </script>

                				";
            }elseif($status=='PENDING'){


                $row->addform = "
                				<button class='btn btn-flat btn-info' id='viewmemberaddform-".$row->id."'> UPLOAD FORM TAMBAHAN</button>
                				<script>
	                                $(document).on('click', '#viewmemberaddform-".$row->id."', function(e) {
	                                	$('#maf_id_purchase').val('".$row->purchase_id."');
	                                    $('#maf_id_member').val('".$row->id_member."');
	                                    $('#modalmemberadd').modal('show');
	                                    getaddform('".$row->purchase_id."','".$row->id_member."');
	                                    getmemberaddform('".$row->purchase_id."','".$row->id_member."');
	                                });
	                            </script>

                				";
                $row->choose = '<span class="text-yellow"><i class="fa fa-hand-paper-o"></i> Pemohon diharap mengisi form tambahan </span>';
            }
         $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    public function ajax_data0()
    {
        $page = $this->input->get('page');
        $produk = $this->input->get('produk');
        $asuransi = $this->input->get('asuransi');
        //$status = $this->input->get('status');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND `a.id_purchase` LIKE \'%'.$search.'%\' OR d.`name` LIKE \'%'.$search.'%\' ';
        }
        $limit = 10;
        $offset = ($page-1)*$limit;

        $data['getdata']= $this->mbulkpurchase->get0($offset,$limit,$search,$produk,$asuransi);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->detail ="<button class='btn btn-success btn-flat' id='".$row->id_purchase."'><i class='fa fa-clipboard'></i> Lihat</button>
                            <script>
                                $(document).on('click', '#".$row->id_purchase."', function(e) {
                                    opendetaildata('".trim($row->id_purchase)."');
                                });
                            </script>";
            $row->upload = "
            				<button class='btn btn-success btn-flat' id='s-".$row->id_purchase."'><i class='fa fa-clipboard'></i> Upload PDF</button>
                            <script>
                                $(document).on('click', '#s-".$row->id_purchase."', function(e) {
                                    $('#sm_id_purchase').val('".$row->id_purchase."');
                                    $('#modalsertifikat').modal('show');
                                    getsertifikat('".$row->id_purchase."');
                                });
                            </script>

		                  	";

           $row->generatesertifikat = "<button class='btn btn-info btn-flat' id='g-".$row->id_purchase."-dw'><i class='fa fa-file'></i> Generate</button>
                            <script>
                                $(document).on('click', '#g-".$row->id_purchase."-dw', function(e) {
                                    window.location.href = '/generatepdf?id_purchase=".$row->id_purchase."&nopolis=".$row->id_polis_induk."&nodetail=".$row->id_polis_detail."';
                                });
                            </script>";

           $row->generatelampiran = "<button class='btn btn-info btn-flat' id='l-".$row->id_purchase."-dw'><i class='fa fa-file'></i> Generate</button>
                            <script>
                                $(document).on('click', '#l-".$row->id_purchase."-dw', function(e) {
                                    window.location.href = '/generatepdflampiran?id_purchase=".$row->id_purchase."';
                                });
                            </script>";

		   $row->download="<button class='btn btn-success btn-flat' id='s-".$row->id_purchase."-dw'><i class='fa fa-clipboard'></i> Open Document</button>
                            <script>
                                $(document).on('click', '#s-".$row->id_purchase."-dw', function(e) {
                                   	$('#modalsertifikatdw').modal('show');
                                    getsertifikat('".$row->id_purchase."');
                                });
                            </script>";

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
        $status = $this->input->get('status');
        $id_purchase = $this->input->get('id_purchase');

        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $getpage = $this->mbulkpurchase->getpage($search,$produk,$asuransi,$status,$id_purchase);
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

    function paging0()
    {
        $search = addslashes($this->input->get('search'));
        $asuransi = $this->input->get('asuransi');
        $produk = $this->input->get('produk');
        //$status = $this->input->get('status');
        // if($search!= ''){
        //     $search = 'AND a.id_field LIKE \'%'.$search.'%\' OR a.caption LIKE \'%'.$search.'%\'  ';
        // }
        $getpage0 = $this->mbulkpurchase->getpage0($search,$produk,$asuransi);
        $countpage = 1;
        $limit = 10;
            foreach ($getpage0->result() as $row) {
              $countpage = ceil(intval($row->page)/$limit);
            }
            if($countpage>0){
                echo '<input type="hidden" id="countpage0" value="'.$countpage.'">';
                echo '<button class="btn btn-flat btn-info page01"><i class="fa fa-fast-backward"></i></button>';
                for ($i=1; $i <= $countpage ; $i++) {
                  echo '<button class="btn btn-flat btn-info page0'.$i.'"">'.$i.'</button>';
                }
                echo '<button class="btn btn-flat btn-info page0'.$countpage.'"><i class="fa fa-fast-forward"></i></button>';
            }else{
                echo '0';
            }
    }

    public function uploadsertified()
    {
    	$id_purchase = $this->input->post('id_purchase');
    	$sm_desc = $this->input->post('sm_desc');
    	$filename = 'S-'.$id_purchase.'-'.date('Ymdhis').'.pdf';
            $config['upload_path']          = './assets/upload/sertifikat/';
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
            	echo $this->mbulkpurchase->updatesertifikat($id_purchase,$filename,$sm_desc);
            }
    }

    public function uploaddata()
    {
        $session_baru = array(
            'asid' => $this->input->post('modalasuransi'),
            'prodid' => $this->input->post('modalproduk'),
        );

        $this->session->set_userdata($session_baru);
        $config['upload_path']          = './assets/upload/polis/';
        $config['allowed_types']        = 'csv';
        $config['overwrite']            = TRUE;
        $config['max_size']             = 100000;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload()){
            $error = array('error' => $this->upload->display_errors());
            print_r($error);
        }
        else{

            $insertqueue = $this->mbulkpurchase->insertqueue();
            $purchase_id = 'PN-'.str_pad($insertqueue, 6, '0', STR_PAD_LEFT);
            $insertpurchase = $this->mbulkpurchase->insertpurchase(
                $this->input->post('id_asuransi'),
                $this->input->post('id_produk'),
                $purchase_id,
                $this->input->post('id_polis')
            );
            $success_data = $this->upload->data();
            $file_name = $success_data['file_name'];
            //echo $file_name;
            $filetarget = $_SERVER['DOCUMENT_ROOT']."/assets/upload/polis/".$file_name;
            $handle = fopen($filetarget, "r");
            $a=0;
            $bulkdatapolis = '';
            $bulkmember = '';
            $comma ='';
            $header ='';

            //echo($handle);


            // //cekingrule
            // $getrulefield= $this->mbulkpurchase->getrulefield(
            //     $this->input->post('id_asuransi'),
            //     $this->input->post('id_produk'),
            //     $this->input->post('id_polis')
            // );

            // $rule_field = $getrulefield[0]['rule_field'];
            // $fieldarray = explode("|", $rule_field);
            // $rule_id = $getrulefield[0]['rule_id'];
            // //cekingrule

            while (!feof($handle)) {
                $line_of_text = fgets($handle);
                if($a==0){
                    $headers = $line_of_text;
                    $header = explode("|", $headers);

                    for ($i=0; $i < count($header) ; $i++) {

                        if($header[$i] == 'NAMA LENGKAP'){
                            $indexnama = $i;
                        }elseif($header[$i] == 'Tanggal Lahir'){
                            $indextgllahir = $i;
                        }elseif($header[$i] == 'Usia'){
                            $indexusia = $i;
                        }elseif($header[$i] == 'MP (dalam bulan)'){
                            $indexmp = $i;
                        }elseif($header[$i] == 'Mulai Perjanjian'){
                            $indexmulaipjj = $i;
                        }elseif($header[$i] == 'Akhir Perjanjian'){
                            $indexakhirpjj = $i;
                        }elseif($header[$i] == 'Manfaat Asuransi Awal'){
                            $indexmanfaat = $i;
                        }elseif($header[$i] == 'Kontribusi'){
                            $indexkontribusi = $i;
                        }elseif($header[$i] == 'Ketentuan Underwriting'){
                            $indexunderwriting = $i;
                        }

                    }
                }
                elseif($line_of_text==''){
                    continue;
                }
                else{
                    //var_dump($headers);
                    //exit();

                    $dataarray ='';
                    $dataarray = explode("|", str_replace('"', '',trim($line_of_text)));
                    //var_dump($dataarray);

                    // exit();

                    $bulkdatapolis = $bulkdatapolis.$comma."(
                                NULL,
                                '".$this->input->post('id_asuransi')."',
                                '".$this->input->post('id_produk')."',
                                '".$dataarray[0]."',
                                '".$line_of_text."',
                                NULL,
                                NULL,
                                'OPEN',
                                CURDATE(),
                                CURTIME(),
                                'BULK',
                                '".$purchase_id."',
                                '".$this->input->post('email')."',
                                '".$this->session->userdata('userid')."',
                                '".$headers."',
                                NULL,
                                NULL,
                                NULL,
                                NULL,
                                NOW(),
                                NULL
                    )";

                    $bulkmember = $bulkmember.$comma."(
                                '".$dataarray[0]."',
                                '".$dataarray[$indexnama]."',
                                '".$dataarray[2]."',
                                '".$dataarray[3]."',
                                '".$dataarray[4]."',
                                '".$this->session->userdata('userid')."',
                                CURDATE(),
                                CURTIME()
                    )";

                    $comma = ',';


                }
                $a++;
            }
            echo $a;
            if($a>0){
                $insert1 = $this->mbulkpurchase->insertbulkdata($bulkdatapolis);
                $insert2 = $this->mbulkpurchase->insertbulkdata2($bulkmember);

                echo 1;
                echo $indexnama;
            }
            fclose($handle);
            //redirect(base_url().'polis/bulkpurchase/');
        }
    }


    public function updateflag()
    {
        $update = $this->mbulkpurchase->updateflag(
            $this->input->post('flag'),
            $this->input->post('id')
        );
    }

    public function addformtype()
    {
        $update = $this->mbulkpurchase->addform(
            $this->input->post('addform'),
            $this->input->post('id')
        );
    }

    public function updatestatusflag()
    {
        $update = $this->mbulkpurchase->updatestatusflag(
            $this->input->post('id_purchase')
            );
        if($update){
            $getemail = $this->mbulkpurchase->getemaildata(
                $this->input->post('id_purchase')
            );
            foreach ($getemail->result() as $k) {
                $email = $k->email;
                $status = $k->status;
                $proses = $this->sendemail($email, $status, $this->input->post('id_purchase'));
                if($proses==1){
                    $setmarkednull = $this->mbulkpurchase->setmarkednull(
                        $status,
                        $this->input->post('id_purchase')
                    );
                }
            }
        }
    }

    public function updateflagall()
    {
        $update = $this->mbulkpurchase->updateflagall(
            $this->input->post('flag'),
            $this->input->post('where'),
            $this->input->post('id_purchase')
        );
    }

    function sendemail($email, $status,$id_purchase)
    {
       //$email_attach = '';
        $email_tujuan = $email;
        $email_subject = 'STATUS - '.$status;
        $email_cc = $this->input->post('email_cc');
        $email_attach = $this->input->post('email_attachment');

        if($status=='APPROVE'){
            $keterangan = 'Pengajuan Polis Disetujui';
        }elseif($status=='PENDING'){
            $keterangan = 'Pengajuan Polis Ditunda dan perlu mengisi form tambahan';
        }elseif($status=='CANCEL'){
            $keterangan = 'Pengajuan Polis Ditolak';
        }

        $email_content = '<table style="background-color:#000"; border="0">';
        $a=1;
        $getdatastatus = $this->mbulkpurchase->getdatastatus($status,$id_purchase);
        foreach ($getdatastatus->result() as $k) {
           if($a==1){
                $header = '<tr style="background-color:#FFF"><td>'.str_replace("|", "</td><td>", $k->headerform).'</td><td>STATUS</td><td>KETERANGAN</td></tr>';
                $content = '<tr style="background-color:#FFF"><td>'.str_replace("|", "</td><td>", $k->data).'</td><td>'.$status.'</td><td>'.$keterangan.'</td></tr>';
                $email_content = $email_content.$header.$content;
           }else{
                $content = '<tr style="background-color:#FFF"><td>'.str_replace("|", "</td><td>", $k->data).'</td><td>'.$status.'</td><td>'.$keterangan.'</td></tr>';
                $email_content = $email_content.$content;
           }
           $a++;
        }


        $email_content = $email_content.'</table>';

        $config = Array(
            // 'protocol' => 'smtp',
            // 'smtp_host' => 'ssl://tiramisu.qwords.net',
            // 'smtp_port' => 465,
            // 'smtp_user' => 'reportfif@gmail.com', // change it to yours
            // 'smtp_pass' => '@PKP123456', // change it to yours
            // 'mailtype' => 'html',
            // 'charset' => 'iso-8859-1',
            // 'wordwrap' => TRUE
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('b2b.fif.sim@gmail.com', 'MUAMAN TEST');
        //$this->email->to('{$email_tujuan}');
        $this->email->to("$email_tujuan");
        //$this->email->cc('dev-cc@pkp.co.id, sd-cc@pkp.co.id');
        //$this->email->cc('');
        $this->email->bcc('');

        $timestamp = date('d.m.Y H:i');

        $this->email->subject("$email_subject");

        $data['content'] = $email_content;
        $body = $this->load->view('email/content_email', $data, TRUE);

        $this->email->message($body);
        $this->email->attach("$email_attach");

        //$this->email->send();
        //echo $this->email->print_debugger();
        if($this->email->send())
        {
            return 1;
        }else{
            show_error($this->email->print_debugger());
            return 0;
        }
    }

    public function queryrule($ruleid,$fields,$where)
    {
        $rule_field = explode("|",$fields);
        $temptbl='';
        $join ='';
        $on = '';
        $select = '';
        $concat ='';
        for ($i=0; $i < count($rule_field) ; $i++) {
            if($i>0){
                $on = " ON t0.condition_order = t".$i.".condition_order";
            }
            $temptbl = $temptbl.$join."
                        (SELECT
                        `value` `".$rule_field[$i]."`,condition_order,formadditional,result,rule_id FROM apm_rule_condition
                        WHERE fieldname = '".$rule_field[$i]."') t".$i."
                        ".$on;

            $join = " LEFT JOIN ";

        }
        $query = "select t0.result, b.formname, b.id formid FROM ".$temptbl."
                  LEFT JOIN apm_additional_form b
                  ON
                  t0.formadditional = b.id
                  where t0.rule_id =".$ruleid." ".$where;

        echo $query;
        $getresult= $this->mbulkpurchase->getresult($query);
        return $getresult;
    }

    public function viewsertifikat()
   	{
   		$getsertifikat = $this->mbulkpurchase->getsertifikat(
   			$id_purchase = $this->input->post('id_purchase')
   		);

   		foreach ($getsertifikat->result() as $a) {
   			echo '
   			<tr>
   				<td><a href="'.site_url().'/assets/upload/sertifikat/'.$a->sertifikat.'" target="_blank"><button class="btn btn-info btn-flat"><i class="fa fa-file"></i>'.$a->sertifikat.'</button></a></td>
   				<td>'.$a->description.'</td>
   				<td>'.$a->date_upload.'</td>
   			</tr>
   			';
   		}
   	}

   	public function getformtambahan()
   	{
   		$getformtambahan = $this->mbulkpurchase->getformtambahan(
   			$this->input->post('id_asuransi'),
   			$this->input->post('id_produk'),
   			$this->input->post('id_user')
   		);

   		foreach ($getformtambahan->result() as $a) {
   			echo '
   			<option value="'.$a->id.'">'.$a->formname.'</option>
   			';
   		}
   	}

   	public function saveuseraddform()
   	{
   		$saveuseraddform = $this->mbulkpurchase->saveuseraddform(
   			$this->input->post('id_purchase'),
   			$this->input->post('id_member'),
   			$this->input->post('id_addform')
   		);

   		echo $saveuseraddform;
   	}

   	public function viewaddform()
   	{
   		$getaddformdata = $this->mbulkpurchase->addformdata(
   			$id_purchase = $this->input->post('id_purchase'),
   			$id_member = $this->input->post('id_member')
   		);

   		foreach ($getaddformdata->result() as $a) {
   			if ($a->user_upload_form != 'BELUM DIUPLOAD MEMBER' ) {
   				$a->user_upload_form = '<a href="'.site_url().'/assets/upload/additionalform/'.$a->user_upload_form.'" target="_blank"><button class="btn btn-info btn-flat"><i class="fa fa-file"></i> '.$a->user_upload_form.'</button></a>';
   			}
   			echo '
   			<tr>
   				<td>'.$a->formname.'</td>
   				<td><a href="'.site_url().'/assets/upload/additionalform/'.$a->filename.'" target="_blank"><button class="btn btn-info btn-flat"><i class="fa fa-file"></i> '.$a->filename.'</button></a></td>
   				<td>'.$a->user_upload_form.'</td>
   				<td>'.$a->date_upload.'</td>
   			</tr>
   			';
   		}
   	}

   	public function getmemberaddform()
   	{
   		$getaddformdata = $this->mbulkpurchase->addformdata(
   			$id_purchase = $this->input->post('id_purchase'),
   			$id_member = $this->input->post('id_member')
   		);

   		foreach ($getaddformdata->result() as $a) {
   			echo '
   			<option value="'.$a->additional_form_id.'">'.$a->formname.'</option>
   			';
   		}
   	}

    public function uploadadditionalform()
    {
    	$id_purchase = $this->input->post('id_purchase');
    	$id_member = $this->input->post('id_member');
    	$id_addform = $this->input->post('id_addform');

		// change space with "_" (underscore)
    	$filename = str_replace(" ", "_",'AF-'.$id_purchase.'-'.$id_member.'-'.$id_addform.'.pdf');
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
            	echo $this->mbulkpurchase->updateformtambahan($id_purchase,$id_member,$id_addform,$filename);
            }
    }
}

/* End of file c_dailytask.php */
/* Location: ./application/controllers/upload/c_dailytask.php */
