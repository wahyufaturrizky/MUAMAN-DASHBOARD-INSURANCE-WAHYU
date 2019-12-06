<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_login');
		
	}

	public function loginpage()
	{
		$this->load->view('login/vlogin');
	}

	public function login()
	{

		$username = $this->input->post('username');
		$password = md5($this->input->post('password'));
		$cek= $this->m_login->logincek($username,$password);
		//if($cek != 'ERROR 500'){
			if ($cek->num_rows()==1){
			foreach ($cek->result() as $res) {
				$id = $res->id;
				$username = $res->admin;
				$group = $res->usergroup;
				$groupdesc = $res->groupdesc;
			}
				 $data = array(
				 	'userid' => $id,
				 	'username' =>$username,
				 	'usergroup' =>$group,
				 	'groupdesc' => $groupdesc 
				 	);
				$this->session->set_userdata($data);
				$this->m_login->insertlog();
			redirect(site_url().'/home/');
			}
			else{
				echo '<script>alert("User dan password tidak sesuai"); document.location.href="home/"</script>';
			}
		// }else{
		// 	echo '<script>alert("LOGIN QUERY ERROR"); document.location.href="home/"</script>';
		// }
	}

	public function index()
	{	
		if($this->session->userdata('userid')!=null){
		$this->cekpriviledge();
  		}
  		$this->load->model('m_dashboard');
  		$getchartdata = $this->m_dashboard->getchartdata();
  		$chart ='';
  		$coma='';
  		foreach ($getchartdata->result() as $r) {
  			$chart =  $chart.$coma.'{ name : \''.$r->GROUPNAME.'\',y : '.$r->jml.'
				}';
			$coma= ',';
		}
  		$data['result'] = $chart; 
		$this->template();
	 	$this->load->view('home/v_home',$data);
		$this->footer();
	}

	function logout(){
		$this->m_login->updatelog();
		$this->session->sess_destroy();
		echo '<script>alert("Anda Sudah Logout Terima Kasih");document.location.href="home/"</script>';
		
	}
	}

/* End of file home.php */
/* Location: ./application/controllers/home.php */