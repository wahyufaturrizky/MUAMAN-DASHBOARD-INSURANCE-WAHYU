<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mothers extends CI_Model {



	function get($offset,$limit,$search){
		$query = $this->db->query('
			SELECT
			CONCAT(b.id_polis_induk,\' : \',b.id_polis_detail),
			policy_cost,
			stamp_duty ,
			internal_admin_cost,
			insurer_admin_cost,
			NULL btnedit,
			NULL btndelete,
			a.id id_form
			FROM muaman_others a 
			join
			polis_induk b
			on
			a.polis_detail = b.id
			WHERE 
			polis_detail = \''.$this->session->userdata('polisdetail').'\' 
			'.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function getpage($search)
	{
		$query = $this->db->query('
			SELECT COUNT(a.id) page 
			FROM muaman_others a 
			join
			polis_induk b
			on
			a.polis_detail = b.id WHERE 
			polis_detail = \''.$this->session->userdata('polisdetail').'\' 
			'.$search.'
			');
		return $query;	
	}

	function delete($id)
	{
			$query = $this->db->query("
				DELETE FROM muaman_others WHERE id = '".$id."'
			");
			return $this->db->affected_rows();
	}



	function save(
        	 	$policy_cost,
				$stamp_duty ,
				$internal_admin_cost,
				$insurer_admin_cost
        	){
			$query = $this->db->query("
				INSERT INTO muaman_others (
				  	policy_cost,
					stamp_duty ,
					internal_admin_cost,
					insurer_admin_cost,
					polis_detail
				)
				VALUES
				  (
				    '{$policy_cost}',
				    '{$stamp_duty}',
				    '{$internal_admin_cost}',
				    '{$insurer_admin_cost}',
				    '".$this->session->userdata('polisdetail')."'
				  );
			");
			return $this->db->affected_rows();
	}

	function update(
		$policy_cost,
		$stamp_duty ,
		$internal_admin_cost,
		$insurer_admin_cost,
	 	$id
	)
	{
			$query = $this->db->query("
				UPDATE
				  `muaman_others`
				SET
				  `policy_cost` = '{$policy_cost}',
				  `stamp_duty` = '{$stamp_duty}',
				  `internal_admin_cost` = '{$internal_admin_cost}',
				  `insurer_admin_cost` = '{$insurer_admin_cost}'
				  WHERE `id` = '{$id}';
			");
			return $this->db->affected_rows();
	}

}

/* End of file Mformasuransi.php */
/* Location: ./application/models/setup/Mformasuransi.php */