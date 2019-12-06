<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

	public function getchartdata()
	{
		$query = $this->db->query('
			SELECT 
			name GROUPNAME,
			(SELECT COUNT(ID) FROM apm_nasabah WHERE apm_nasabah_type_id = apm_nasabah_type.id) jml
			FROM 
			apm_nasabah_type

		');
		return $query;
	}

}

/* End of file m_dashboard.php */
/* Location: ./application/models/m_dashboard.php */