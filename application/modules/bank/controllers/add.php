<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Add extends CI_Controller {
    
    function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('bank/mbank');
		$this->load->library('form_validation');
    }
    
    public function index()
    {
        $data['content'] = $this->load->view('bank/add', '', TRUE);

        if(isset($_POST) and !empty($_POST))
		{			
			//$this->load->library('form_validation');
            $this->form_validation->set_rules('display_name', 'Nama Lengkap', 'required|min_length[5]|trim');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[15]|trim');
            $this->form_validation->set_rules('phone', 'Telephone', 'required|min_length[8]|trim');

            echo '<pre>'; print_r($_POST); echo '</pre>';
            if ($this->form_validation->run() != FALSE)
            {

                $dataSave = [
                    'name' => $this->input->post('display_name'),
                    'email' => $this->input->post('email'),
                    'address' => $this->input->post('alamat'),
                    'telp' => $this->input->post('phone'),
                    'flag' => 1
                ];

                echo '<pre>'; print_r($dataSave); echo '</pre>';

                $isSave = $this->mbank->save( $dataSave );

                if($isSave)
                    $data['success'] = true;
                else
                    $data['success'] = false;

                /*
                    - Insert Databaser (return boolean)
                    - If True 
                    * Send Email
                    * Notification Success
                    * View Form
                    - If Else Notification Failed
                        * View Formvc ftr
                    
                */
            }
            
        }
        $this->load->view('layout', $data);
    }
}
