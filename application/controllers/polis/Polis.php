<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Polis extends MY_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('polis/mpolis');
        // $getbrokerdata= $this->mpolis->getbrokerdata(
        //      $this->session->userdata('userid')
        //     );
        
    }

    public function index()
    {
        $this->setsessionbroker();
        $data['getproduk'] = $this->mpolis->getproduct();
        $data['getasuransi'] = $this->mpolis->getasuransi();
        $data['getflag'] = $this->mpolis->getflag($this->session->userdata('part_of_id'));
        $this->template();
        $this->load->view('polis/content',$data);
        $this->footer();
        $this->load->view('polis/content_js'); 
    }

    
    public function setsessionbroker()
    {
        $getidbroker = $this->mpolis->getidbroker(
            $this->session->userdata('userid')
            );
        foreach ($getidbroker->result() as $row) {
            $broker_user_id = $row->apm_broker_user_id;
            $broker_id = $row->id_broker;
            $part_of_id = $row->part_of_id;
        }

        $brokersession = array(
            'broker_user_id' => $broker_user_id,
            'broker_id' => $broker_id,
            'part_of_id' => $part_of_id
        );
        
        $this->session->set_userdata($brokersession);
    }

    function rupiah($angka){
    
        $hasil_rupiah = "Rp " . number_format($angka);
        return $hasil_rupiah;
     
    }

    public function quotesave()
    {
        

        $save = $this->mpolis->save(
                    $this->input->post('registrasi'),
                    $this->input->post('periode1'),
                    $this->input->post('periode2'),
                    $this->input->post('produk'),
                    $this->input->post('rate'),
                    $this->input->post('premi'),
                    $this->input->post('namanasabah'),
                    $this->input->post('idnasabah'),
                    $this->input->post('idassets'),
                    $this->input->post('asuransi'),
                    $this->input->post('flag'),
                    $this->session->userdata('broker_id'),
                    $this->session->userdata('broker_user_id')
                 );
    }

    // public function save_user()
    // {
    //     $save = $this->masuransi->save_user(
    //                 $this->input->post('username'),
    //                 $this->input->post('password'),
    //                 $this->input->post('id_user')
    //              );
    // }

    // public function update()
    // {
    //     $update = $this->masuransi->update(
    //                 $this->input->post('nama'),
    //                 $this->input->post('alamat'),
    //                 $this->input->post('email'),
    //                 $this->input->post('telp'),
    //                 $this->input->post('id')
    //              );
    // }

    // public function delete()
    // {
    //     $delete =   $this->masuransi->delete(
    //                 $this->input->post('id')
    //              );
    // }

    public function ajax_data()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND a.name LIKE \'%'.$search.'%\' OR a.address LIKE \'%'.$search.'%\' OR a.telp LIKE \'%'.$search.'%\' OR a.email LIKE \'%'.$search.'%\' ';
        }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mpolis->get($offset,$limit,$search);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
         $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }



    function paging()
    {
         $search = addslashes($this->input->get('search'));
         if($search!= ''){
            $search = 'AND a.name LIKE \'%'.$search.'%\' OR a.address LIKE \'%'.$search.'%\' OR a.telp LIKE \'%'.$search.'%\' OR a.email LIKE \'%'.$search.'%\' ';
         }
         $getpage = $this->mpolis->getpage($search);
         $countpage = 1;
          $limit = 10;
            foreach ($getpage->result() as $row) {
              $countpage = ceil(intval($row->page)/$limit);
            } 

            echo '<input type="hidden" id="countpage" value="'.$countpage.'">';
            echo '<button class="btn btn-flat btn-info page1"><i class="fa fa-fast-backward"></i></button>';
            for ($i=1; $i <= $countpage ; $i++) { 
              echo '<button class="btn btn-flat btn-info page'.$i.'"">'.$i.'</button>';
            }
            echo '<button class="btn btn-flat btn-info page'.$countpage.'"><i class="fa fa-fast-forward"></i></button>';
    }

    function ajax_data_asset()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND c.requestDesc LIKE \'%'.$search.'%\' OR a.name LIKE \'%'.$search.'%\' OR b.name LIKE \'%'.$search.'%\' OR a.address LIKE \'%'.$search.'%\' OR a.tsi LIKE \'%'.$search.'%\' AND a.isProtected != \'Y\' ';
        }
        else{
        	$search = 'AND a.isProtected != \'Y\'';
        }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mpolis->getassets($offset,$limit,$search);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->tsi = $this->rupiah($row->tsi);
            $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    function pagingasset()
    {
         $search = addslashes($this->input->get('search'));
         if($search!= ''){
            $search = 'AND c.requestDesc LIKE \'%'.$search.'%\' OR a.name LIKE \'%'.$search.'%\' OR b.name LIKE \'%'.$search.'%\' OR a.address LIKE \'%'.$search.'%\' OR a.tsi LIKE \'%'.$search.'%\' AND a.isProtected != \'Y\' ';   
         }
         else{
        	$search = 'AND a.isProtected != \'Y\'';
         }
         $getpage = $this->mpolis->getpageassets($search);
         $countpage = 1;
          $limit = 10;
            foreach ($getpage->result() as $row) {
              $countpage = ceil(intval($row->page)/$limit);
            } 

            echo '<input type="hidden" id="countpageasset" value="'.$countpage.'">';
            echo '<button class="btn btn-flat btn-info pageasset1"><i class="fa fa-fast-backward"></i></button>';
            for ($i=1; $i <= $countpage ; $i++) { 
              echo '<button class="btn btn-flat btn-info pageasset'.$i.'"">'.$i.'</button>';
            }
            echo '<button class="btn btn-flat btn-info pageasset'.$countpage.'"><i class="fa fa-fast-forward"></i></button>';
    }



     function ajax_data_assetreq()
    {
        $page = $this->input->get('page');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'AND c.requestDesc LIKE \'%'.$search.'%\' OR a.name LIKE \'%'.$search.'%\' OR b.name LIKE \'%'.$search.'%\' OR a.address LIKE \'%'.$search.'%\' OR a.tsi LIKE \'%'.$search.'%\' AND a.isProtected = \'R\'';
        }
        else{
        	$search = 'AND a.isProtected = \'R\'';
        }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mpolis->getassets($offset,$limit,$search);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
         $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    function pagingassetreq()
    {
         $search = addslashes($this->input->get('search'));
         if($search!= ''){
            $search = 'AND c.requestDesc LIKE \'%'.$search.'%\' OR a.name LIKE \'%'.$search.'%\' OR b.name LIKE \'%'.$search.'%\' OR a.address LIKE \'%'.$search.'%\' OR a.tsi LIKE \'%'.$search.'%\' AND a.isProtected = \'R\'';   
         }
         else{
        	$search = 'AND a.isProtected = \'R\'';
         }
         $getpage = $this->mpolis->getpageassets($search);
         $countpage = 1;
          $limit = 10;
            foreach ($getpage->result() as $row) {
              $countpage = ceil(intval($row->page)/$limit);
            } 

            echo '<input type="hidden" id="countpageassetreq" value="'.$countpage.'">';
            echo '<button class="btn btn-flat btn-info pageassetreq1"><i class="fa fa-fast-backward"></i></button>';
            for ($i=1; $i <= $countpage ; $i++) { 
              echo '<button class="btn btn-flat btn-info pageassetreq'.$i.'"">'.$i.'</button>';
            }
            echo '<button class="btn btn-flat btn-info pageassetreq'.$countpage.'"><i class="fa fa-fast-forward"></i></button>';
    }

    function ajax_data_quote()
    {
        $whereflag = $this->getflagid($this->session->userdata('userid'));
        $page = $this->input->get('page');
        $flag = $this->input->get('flag');
        $search = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }
        if($search!= ''){
            $search = 'WHERE a.flag = '.$flag.' AND (a.name LIKE \'%'.$search.'%\' OR a.no_reg LIKE \'%'.$search.'%\' OR d.nama_produk LIKE \'%'.$search.'%\' OR e.name LIKE \'%'.$search.'%\' OR f.name LIKE \'%'.$search.'%\') AND '.$whereflag;
        }else{
            $search = 'WHERE a.flag = '.$flag.' AND '.$whereflag;
        }
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $data['getdata']= $this->mpolis->getpolis($offset,$limit,$search);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->tsi = $this->rupiah($row->tsi);
            $row->premi = $this->rupiah($row->premi);
            $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    function pagingquote()
    {   
         $whereflag = $this->getflagid($this->session->userdata('userid'));
         $search = addslashes($this->input->get('search'));
         $flag = $this->input->get('flag');
         if($search!= ''){
            $search = 'WHERE a.flag = '.$flag.' AND (a.name LIKE \'%'.$search.'%\' OR a.no_reg LIKE \'%'.$search.'%\' OR d.nama_produk LIKE \'%'.$search.'%\' OR e.name LIKE \'%'.$search.'%\' OR f.name LIKE \'%'.$search.'%\') AND '.$whereflag;         
         }
         else{
            $search = 'WHERE a.flag = '.$flag.' AND '.$whereflag;
         }
         $getpage = $this->mpolis->getpagepolis($search);
         $countpage = 1;
          $limit = 10;
            foreach ($getpage->result() as $row) {
              $countpage = ceil(intval($row->page)/$limit);
            } 

            echo '<input type="hidden" id="countpagequote" value="'.$countpage.'">';
            echo '<button class="btn btn-flat btn-info pagequote1"><i class="fa fa-fast-backward"></i></button>';
            for ($i=1; $i <= $countpage ; $i++) { 
              echo '<button class="btn btn-flat btn-info pagequote'.$i.'"">'.$i.'</button>';
            }
            echo '<button class="btn btn-flat btn-info pagequote'.$countpage.'"><i class="fa fa-fast-forward"></i></button>';
    }

    function formdetail()
    {
        $getprodukname = $this->mpolis->getprodukname($this->input->post('produk'));
        $produk= $getprodukname[0]['nama_produk'];
        $getform = strtolower(substr($produk, (strpos($produk," ")+1)));
        $cekifexist = $this->mpolis->cekifexist($getform);
        if($cekifexist->num_rows()>0){
            $data['getformvalue'] = $this->mpolis->getformvalue($getform,$this->input->post('noreg'));
            $this->load->view('polis/'.$getform,$data);
        }else{
            echo 
            '<script>
             function akseptasi() {
             }
            </script>';
        }
    }

    function akseptasikendaraan()
    {
        $this->mpolis->saveakseptasikendaraan(
              $this->input->post('registrasi'),      
              $this->input->post('no_polisi'),     
              $this->input->post('no_rangka'),     
              $this->input->post('penggunaan'),    
              $this->input->post('thp'),           
              $this->input->post('kondisi'),       
              $this->input->post('tjhpihak3'),     
              $this->input->post('tjhpenumpang'),  
              $this->input->post('papengemudi'),   
              $this->input->post('papenumpang'),   
              $this->input->post('lainnya'),       
              $this->input->post('informasi'),
              $this->input->post('namaitem'),
              $this->input->post('hargaitem')  
            );
    }

    public function getflagid($user)
    {
        $getidbrokeruser = $this->mpolis->getidbrokeruser($user);
        $getidpartofbroker = $this->mpolis->getidpartofbroker($getidbrokeruser[0]['apm_broker_user_id']);
        $getflagallowed = $this->mpolis->getflagallowed($getidpartofbroker[0]['part_of_id']);
        $idbroker = $getidpartofbroker[0]['id_broker'];
        $flagid ='';
        $comma = '';
        $whereflag ='a.apm_broker_id=\''.$idbroker.'\'';
        // if($getflagallowed->num_rows()>0){
        //     foreach ($getflagallowed->result() as $row) {
        //         $flagid = $flagid.$comma.$row->id;
        //         $comma =',';
        //     }

        //     $whereflag = 'a.apm_broker_id =\''.$idbroker.'\' AND a.flag IN ('.$flagid.')';
             
        // }
        //echo $whereflag;
        return $whereflag;
    }

    public function pdfform()
    {
    	 $noreg =$this->input->get('reg');
    	 $data['getpolisdata'] = $this->mpolis->getpolisdata($noreg);
    	 $this->load->view('pdfview/formdata',$data);

    }

    function sendemail()
    {
    	 $noreg =$this->input->get('reg');
    	 $email = $this->input->get('email');
    	//SMTP & mail configuration
		$config = array(
		    'protocol' => 'smtp',
		    'smtp_host' => 'ssl://smtp.gmail.com',
		    'smtp_port' => 465,
		    'smtp_user' => 'tyo.youichi@gmail.com', // change it to yours
			'smtp_pass' => 'nokia6300!', // change it to yours
		    'mailtype'  => 'html', 
		    'charset'   => 'iso-8859-1',
		    'wordwrap' => TRUE
		);
		$this->load->library('email', $config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		//Email content
		$htmlContent = '<h1>DOKUMENTASI AKSEPTASI POLIS</h1>';
		$htmlContent .= '<a href="http://172.16.33.148/apm/polis/polis/pdfform/?reg='.$noreg.'"><button>Download PDF</button></a>';

		$this->email->to('tyo.youichi@gmail.com');
		$this->email->from('tyo.youichi@gmail.com','INSCO');
		$this->email->subject('DOKUMENTASI AKSEPTASI POLIS');
		$this->email->message($htmlContent);

		//Send email
		if($this->email->send()){
		    echo '1';
		}
		else{
		    show_error($this->email->print_debugger());
		}
		// 		$config = Array(
		// 	'protocol' => 'smtp',
		// 	//'smtp_host' => 'ssl://tiramisu.qwords.net',
		// 	'smtp_host' => 'ssl://smtp.gmail.com',
		// 	'smtp_port' => 465,
		// 	'smtp_user' => 'reportfif@gmail.com', // change it to yours
		// 	'smtp_pass' => '@PKP123456', // change it to yours
		// 	//'smtp_user' => 'b2b.fif.sim@gmail.com', // change it to yours
		// 	//'smtp_pass' => '3mTPkP987&!', // change it to yours
		// 	'mailtype' => 'html',
		// 	'charset' => 'iso-8859-1',
		// 	'wordwrap' => TRUE
		// );
    }
    
}