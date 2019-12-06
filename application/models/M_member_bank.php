<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_Member_Bank extends CI_Model {

	function master_nasabah()
	{
		$query = $this->db->query("
			SELECT 
				a.name,
				b.idapm_user	
			FROM 
				apm_nasabah a
			join
				apm_user b
			on a.id = b.apm_nasabah_id
			and a.flag = 1
		");

		return $query->result();
	}

	function getpage($search,$asuransi)
	{
		$query = $this->db->query('
			SELECT COUNT(member_id) page 
			FROM apm_member_bank
			where 
			id_nasabah = \''.$asuransi.'\' '.$search.'
			');
		return $query;	
	}

	function get($offset,$limit,$search,$asuransi){
		$query = $this->db->query('
			SELECT  
				member_id,
				member_name,
				member_tempat_lahir,
				member_tanggal_lahir,
				member_jenis_kelamin,
				id_nasabah
			FROM apm_member_bank
			where 
			id_nasabah = \''.$asuransi.'\'
			'.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */