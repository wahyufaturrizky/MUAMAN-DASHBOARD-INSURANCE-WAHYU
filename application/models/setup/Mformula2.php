<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mformula2 extends CI_Model {



	function get($offset,$limit,$search){
		$query = $this->db->query('
			SELECT
			CONCAT(b.id_polis_induk,\' : \',b.id_polis_detail),
			  `occupation_class`,
			  `age_min`,
			  `age_max`,
			  `gender`,
			  `year_period_min`,
			  `year_period_max`,
			  `premium_type`,
			  `sum_insurer`,
			  `premium_rate`,
			  `premium_amount`,
			  `currency`,
			  `active`,
			NULL btnedit,
			NULL btndelete,
			a.id id_form
			FROM muaman_formula a 
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
			FROM muaman_formula a 
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
				DELETE FROM muaman_formula WHERE id = '".$id."'
			");
			return $this->db->affected_rows();
	}



	function save(
        	 		$occupation_class,
					$age_min,
				    $age_max,
					$gender,
					$year_period_min,
					$year_period_max,
					$premium_type,
					$sum_insurer,
					$premium_rate,
					$premium_amount,
					$currency,
					$active
        	){
			$query = $this->db->query("
				INSERT INTO muaman_formula (
				  	occupation_class,
					age_min,
				    age_max,
					gender,
					year_period_min,
					year_period_max,
					premium_type,
					sum_insurer,
					premium_rate,
					premium_amount,
					currency,
					active,
					polis_detail
				)
				VALUES
				  (
				    '{$occupation_class}',
					'{$age_min}',
				    '{$age_max}',
					'{$gender}',
					'{$year_period_min}',
					'{$year_period_max}',
					'{$premium_type}',
					'{$sum_insurer}',
					'{$premium_rate}',
					'{$premium_amount}',
					'{$currency}',
					'{$active}',
				    '".$this->session->userdata('polisdetail')."'
				  );
			");
			return $this->db->affected_rows();
	}

	function update(
			$occupation_class,
			$age_min,
		    $age_max,
			$gender,
			$year_period_min,
			$year_period_max,
			$premium_type,
			$sum_insurer,
			$premium_rate,
			$premium_amount,
			$currency,
			$active,
			$id
	)
	{
			$query = $this->db->query("
				UPDATE
				  `muaman_formula`
				SET
				 	occupation_class 	= '{$occupation_class}',
					age_min	= '{$age_min}',
				    age_max = '{$age_max}',
					gender = '{$gender}',
					year_period_min = '{$year_period_min}',
					year_period_max = '{$year_period_max}',
					premium_type = '{$premium_type}',
					sum_insurer = '{$sum_insurer}',
					premium_rate = '{$premium_rate}',
					premium_amount = '{$premium_amount}',
					currency = '{$currency}',
					active = '{$active}'
				  WHERE `id` = '{$id}';
			");
			return $this->db->affected_rows();
	}

}

/* End of file Mformasuransi.php */
/* Location: ./application/models/setup/Mformasuransi.php */