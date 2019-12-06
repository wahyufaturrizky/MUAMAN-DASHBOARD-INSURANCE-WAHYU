<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Asuransi extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->helper(array('form', 'url'));
        $this->load->model('masuransi');
        $this->load->model('muser');
        $this->load->model('mbank');
        $this->load->model('mbranch');
		$this->load->library('form_validation');
    }

    public function index()
    {
        $vdata['asuransi'] = $this->masuransi->get();
        $data['content'] = $this->load->view('asuransi/list', $vdata, TRUE);
        $data['bottomActionScript'] = $this->load->view('asuransi/bottomActionScript', '', TRUE);
        $this->load->view('layout', $data);
    }

    public function delete($idasuransi)
	{

		$data['flag'] = 0;
		$data['id'] = $idasuransi;
        $result= $this->masuransi->save($data);
        $result= $this->muser->deletebyidasuransi($idasuransi);
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

            $this->form_validation->set_rules('username','Username','trim|required|min_length[3]|is_unique[apm_user.username_xxx]');
            $this->form_validation->set_rules('pass', 'Password', 'required|min_length[6]');
            $this->form_validation->set_rules('repass', 'Confirm Password', 'required|matches[pass]|min_length[6]');

            if ($this->form_validation->run() != false)
            {

                $dataSave = [
                    'name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('alamat'),
                    'telp' => $this->input->post('phone'),
                    'flag' => 1
                ];

                $idasuransi = $this->masuransi->save( $dataSave );

                $dataUser = [
                    'username_xxx' => strtolower(str_replace(" ","",$this->input->post('username'))),
                    'password_xxx' => md5( $this->input->post('pass') ),
                    'group_user' => 3,
                    'apm_asuransi_id' => $idasuransi,
                    'flag'=> 1
                ];

                $isSave = $this->muser->save( $dataUser );

                if ($isSave)
					redirect(base_url("asuransi?status=1"));

            }
            
        }
        
        $data['bottomActionScript'] = $this->load->view('asuransi/bottomActionScript', '', TRUE);
        $data['content'] = $this->load->view('asuransi/add', '', TRUE);
        
        $this->load->view('layout', $data);
    }

    public function edit($id)
    {
        $vdata['id'] = $id;
        $vdata['asuransi'] = $this->masuransi->get(
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

                $resasuransi = $this->masuransi->save( $dataSave );

                if($this->input->post('pass')) {
                    $dataUser = [
                        'idapm_user' => $this->input->post('iduser'),
                        'password_xxx' => md5( $this->input->post('pass') ),
                        'group_user' => 3,
                        'flag'=> 1
                    ];
                    $resUser = $this->muser->save( $dataUser );
                }

                

                if ($resasuransi)
					redirect(base_url("asuransi?status=1"));

            }
            
        }
        
        $data['content'] = $this->load->view('asuransi/edit', $vdata, TRUE);
        $data['bottomActionScript'] = $this->load->view('asuransi/bottomActionScript', '', TRUE);
        $this->load->view('layout', $data);
    }
}
