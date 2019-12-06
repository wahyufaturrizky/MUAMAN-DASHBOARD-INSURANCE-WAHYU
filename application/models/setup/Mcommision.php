<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mcommision extends CI_Model {



	function get($offset,$limit,$search){
		$query = $this->db->query('
			SELECT
			CONCAT(b.id_polis_induk,\' : \',b.id_polis_detail),
			third_party_id,
			commision_category,
			commision_type ,
			commision_rate,
			commision_amount,
			NULL btnedit,
			NULL btndelete,
			a.id id_form
			FROM muaman_commision a 
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
			FROM muaman_commision a 
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
				DELETE FROM muaman_commision WHERE id = '".$id."'
			");
			return $this->db->affected_rows();
	}



	function save(
        	 	$commision_category,
				$commision_type ,
				$commision_rate,
				$commision_amount,
				$third_party_id
        	){
			$query = $this->db->query("
				INSERT INTO muaman_commision (
				  	commision_category,
					commision_type ,
					commision_rate,
					commision_amount,
					third_party_id,
					polis_detail
				)
				VALUES
				  (
				    '{$commision_category}',
				    '{$commision_type}',
				    '{$commision_rate}',
				    '{$commision_amount}',
				    '{$third_party_id}',
				    '".$this->session->userdata('polisdetail')."'
				  );
			");
			return $this->db->affected_rows();
	}

	function update(
		$commision_category,
		$commision_type ,
		$commision_rate,
		$commision_amount,
		$third_party_id,
	 	$id
	)
	{
			$query = $this->db->query("
				UPDATE
				  `muaman_commision`
				SET
				  `commision_category` = '{$commision_category}',
				  `commision_type` = '{$commision_type}',
				  `commision_rate` = '{$commision_rate}',
				  `commision_amount` = '{$commision_amount}',
				  `third_party_id` = '{$third_party_id}'
				WHERE `id` = '{$id}';
			");
			return $this->db->affected_rows();
	}

}

/* End of file Mformasuransi.php */
/* Location: ./application/models/setup/Mformasuransi.php */