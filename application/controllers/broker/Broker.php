<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Broker extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper(array('form', 'url'));
        $this->load->model('mbroker');
        $this->load->model('muser');
        $this->load->model('mbank');
        $this->load->model('mbranch');
		$this->load->library('form_validation');
    }

    public function index()
    {
        $vdata['broker'] = $this->mbroker->get();
        $data['content'] = $this->load->view('broker/list', $vdata, TRUE);
        $data['bottomActionScript'] = $this->load->view('broker/bottomActionScript', '', TRUE);
        $this->load->view('layout', $data);
    }

    public function delete($idbroker)
	{

		$data['flag'] = 0;
		$data['id'] = $idbroker;
        $result= $this->mbroker->save($data);
    }
    
    public function userdelete($id)
	{

		$data['flag'] = 0;
		$data['id'] = $id;
        $result= $this->mbroker->saveuser($data);
        $result= $this->muser->deletebyidbroker($id);
	}
    
    public function add()
    {
        if(isset($_POST) and !empty($_POST))
		{			
			$this->load->library('form_validation');
            $this->form_validation->set_rules('display_name', 'Nama Lengkap', 'required|min_length[5]|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[15]|trim');
            $this->form_validation->set_rules('phone', 'Telephone', 'required|min_length[8]|integer|trim');

            if ($this->form_validation->run() != false)
            {

                $dataSave = [
                    'name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('alamat'),
                    'telp' => $this->input->post('phone'),
                    'flag' => 1
                ];

                $isSave = $this->mbroker->save( $dataSave );


                if ($isSave)
					redirect(base_url("broker?status=1"));

            }
            
        }
        
        $data['bottomActionScript'] = $this->load->view('broker/bottomActionScript', '', TRUE);
        $data['content'] = $this->load->view('broker/add', '', TRUE);
        
        $this->load->view('layout', $data);
    }

    public function userlist($idbroker)
    {
        $vbroker['id'] = $vdata['idbroker'] = $idbroker;
        //$vuserbroker['idbroker'] = $idbroker;
        $vdata['broker'] = $this->mbroker->get($vbroker)[0];
        $vdata['userBroker'] = $this->mbroker->getUser($vdata);
        $data['content'] = $this->load->view('broker/listuser', $vdata, TRUE);
        $data['bottomActionScript'] = $this->load->view('broker/bottomActionScript', '', TRUE);
        $this->load->view('layout', $data);
    }

    public function useradd($idbroker)
    {
        if(isset($_POST) and !empty($_POST))
		{			
			$this->load->library('form_validation');
            $this->form_validation->set_rules('display_name', 'Nama Lengkap', 'required|min_length[5]|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('part', 'Bagian', 'required|trim|integer');

            $this->form_validation->set_rules('username','Username','trim|required|min_length[3]|is_unique[apm_user.username_xxx]');
            $this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('repass', 'Confirm Password', 'required|matches[pass]|min_length[6]');

            if ($this->form_validation->run() != false)
            {

                $dataSave = [
                    'name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'part' => $this->input->post('part'),
                    'idbroker' =>$idbroker,
                    'flag' => 1
                ];

                $iduserbroker = $this->mbroker->saveuser( $dataSave );

                $dataUser = [
                    'username_xxx' => strtolower(str_replace(" ","",$this->input->post('username'))),
                    'password_xxx' => md5( $this->input->post('pass') ),
                    'group_user' => 2,
                    'apm_broker_user_id' => $iduserbroker,
                    'flag'=> 1
                ];

                $isSave = $this->muser->save( $dataUser );

                if ($isSave)
					redirect(base_url("broker/user/".$idbroker."?status=1"));

            }
            
        }
        
        $data['content'] = $this->load->view('broker/adduser', '', TRUE);
        
        $this->load->view('layout', $data);
    }

    public function useredit($id, $idbroker)
    {
        $vdata['id'] = $id;
        $vdata['userBroker'] = $this->mbroker->getUser(
            [
                'id'=> $vdata['id'],
                'idbroker'=> $idbroker
                ]
        )[0];
          

        if(isset($_POST) and !empty($_POST))
		{			
			$this->load->library('form_validation');
            $this->form_validation->set_rules('display_name', 'Nama Lengkap', 'required|min_length[5]|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('part', 'Bagian', 'required|trim|integer');

            if($this->input->post('pass')) {
                $this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('repass', 'Confirm Password', 'required|matches[pass]|min_length[6]');
            }

            if ($this->form_validation->run() != false)
            {

                $dataSave = [
                    'id' => $id,
                    'name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'part' => $this->input->post('part'),
                    'idbroker' =>$idbroker,
                    'flag' => 1
                ];

                $reuserbroker = $this->mbroker->saveuser( $dataSave );
                if($this->input->post('pass')) {
                    $dataUser = [
                        'idapm_user' => $this->input->post('iduser'),
                        'username_xxx' => strtolower(str_replace(" ","",$this->input->post('username'))),
                        'password_xxx' => md5( $this->input->post('pass') ),
                        'group_user' => 2,
                        'apm_broker_user_id' => $idbroker,
                        'flag'=> 1
                    ];
                    $resUser = $this->muser->save( $dataUser );
                }

                

                if ($reuserbroker)
					redirect(base_url("broker/user/".$idbroker."?status=1"));

            }
            
        }
        
        $data['content'] = $this->load->view('broker/edituser', $vdata, TRUE);
        
        $this->load->view('layout', $data);
    }

    public function edit($id)
    {
        $vdata['id'] = $id;
        $vdata['broker'] = $this->mbroker->get(
            [
                'id'=> $vdata['id']
                ]
        )[0];

      
        
        if(isset($_POST) and !empty($_POST))
		{			
			$this->load->library('form_validation');
            $this->form_validation->set_rules('display_name', 'Nama Lengkap', 'required|min_length[5]|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[15]|trim');
            $this->form_validation->set_rules('phone', 'Telephone', 'required|min_length[8]|integer|trim');

            $this->form_validation->set_rules('iduser', 'ID User', 'required');

            if($this->input->post('pass')) {
                $this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
                $this->form_validation->set_rules('repass', 'Confirm Password', 'required|matches[pass]|min_length[6]');
            }

            
            if ($this->form_validation->run() != false)
            {

                $dataSave = [
                    'id' => $id,
                    'name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('alamat'),
                    'telp' => $this->input->post('phone'),
                    'flag' => 1
                ];

                $resBroker = $this->mbroker->save( $dataSave );

                if($this->input->post('pass')) {
                    $dataUser = [
                        'idapm_user' => $this->input->post('iduser'),
                        'password_xxx' => md5( $this->input->post('pass') ),
                        'group_user' => 2,
                        'flag'=> 1
                    ];
                    $resUser = $this->muser->save( $dataUser );
                }

                

                if ($resBroker)
					redirect(base_url("broker?status=1"));

            }
            
        }
        
        $data['content'] = $this->load->view('broker/edit', $vdata, TRUE);
        $data['bottomActionScript'] = $this->load->view('broker/bottomActionScript', '', TRUE);
        $this->load->view('layout', $data);
    }
}
