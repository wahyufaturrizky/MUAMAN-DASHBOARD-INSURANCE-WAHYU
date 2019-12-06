<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Api extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->helper(array('form', 'url'));
		date_default_timezone_set('Asia/Jakarta');
        $this->load->model('mbank');
        $this->load->model('mbranch');
		$this->load->library('form_validation');
    }

    public function bankhtml()
    {
        
        if( $this->input->post('token') == $_SESSION['csrf_token'] )
		{
            $banks = $this->mbank->get();
            
            echo '<div class="form-group <?php if(form_error(\'bank\')) echo \'has-error\'; ?>">';
            echo '<label for="bank">Bank</label>';
			echo '<select id="bank" name="bank"  class="form-control"  tabindex="2">'."\n";
			echo '<option disabled selected> -- Bank -- </option>'."\n";
			foreach ($banks as $bank) {
                echo "<option value=\"".$bank->id."\">". ucwords(strtolower($bank->name)) . "</option>\n";
			}
            echo "</select>\n";
            echo "</div>";
		}
    }

    public function branchhtml()
    {
        
        if( $this->input->post('bank') and ($this->input->post('token') == $_SESSION['csrf_token'] ) )
		{
            $vdata['idbank'] = $this->input->post('bank');
            $branchs = $this->mbranch->get($vdata);
            echo '<div class="form-group <?php if(form_error(\'branch\')) echo \'has-error\'; ?>">';
            echo '<label for="branch">Cabang</label>';
			echo '<select id="branch" name="branch"  class="form-control"  tabindex="2">'."\n";
			echo '<option disabled selected> -- Cabang -- </option>'."\n";
			foreach ($branchs as $branch) {
                echo "<option value=\"".$branch->id."\">". ucwords(strtolower($branch->name)) . "</option>\n";
			}
            echo "</select>\n";
            echo "</div>";
		}
    }

    public function branchdata()
    {
        
        if( $this->input->post('branch') and ($this->input->post('token') == $_SESSION['csrf_token'] ) )
		{
            $vdata['id'] = $this->input->post('branch');
            $branchs = $this->mbranch->get($vdata)[0];
            
            $result = json_encode($branchs);

            echo $result;

		}
    }

}
