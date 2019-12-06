<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdiscount extends CI_Model {

	public function getasuransi()
		{
			$where ='';
			if($this->session->userdata('usergroup')=='3'){
				$where = 'WHERE id_asuransi = (select apm_asuransi_id from apm_user where idapm_user = \''.$this->session->userdata('userid').'\')';
			}
			$query = $this->db->query("
			SELECT DISTINCT a.id_asuransi, b.name nama_asuransi FROM 
			apm_produk_asuransi a
			JOIN
			apm_asuransi b
			ON
			a.`id_asuransi` = b.`id`
			".$where."
			");
			return $query;	
		}

		public function getnasabah()
		{
			$query = $this->db->query("
			SELECT 
				a.name,
				b.idapm_user id	
			FROM 
				apm_nasabah a
			join
				apm_user b
			on a.id = b.apm_nasabah_id
			and a.flag = 1
			");
			return $query;	
		}		

	public function getprodukasuransi($id_asuransi)
		{
			$query = $this->db->query("
				SELECT b.id_produk, b.nama_produk FROM `apm_produk_asuransi` a JOIN
				`apm_produk` b ON a.`id_produk` = b.`id_produk` AND a.`id_asuransi` = ".$id_asuransi."
			");
			return $query;	
		}

	public function getadditionalform($id_asuransi,$id_produk,$client)
		{
			$query = $this->db->query("
				SELECT id, formname from apm_additional_form 
				where 
				asuransi_id = '{$id_asuransi}' and
				produk_id = '{$id_produk}' and
				user_id = '{$client}'
			");
			return $query;	
		}		


	function get($offset,$limit,$search){
		$query = $this->db->query('
			SELECT
			CONCAT(b.id_polis_induk,\' : \',b.id_polis_detail),
			discount_by,
			discount_type ,
			discount_rate,
			discount_amount,
			NULL btnedit,
			NULL btndelete,
			a.id id_form
			FROM muaman_discount a 
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
			FROM muaman_discount a 
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
				DELETE FROM muaman_discount WHERE id = '".$id."'
			");
			return $this->db->affected_rows();
	}



	function save(
        	 	$discount_by,
				$discount_type ,
				$discount_rate,
				$discount_amount
        	){
			$query = $this->db->query("
				INSERT INTO muaman_discount (
				  	discount_by,
					discount_type ,
					discount_rate,
					discount_amount,
					polis_detail
				)
				VALUES
				  (
				    '{$discount_by}',
				    '{$discount_type}',
				    '{$discount_rate}',
				    '{$discount_amount}',
				    '".$this->session->userdata('polisdetail')."'
				  );
			");
			return $this->db->affected_rows();
	}

	function update(
		$discount_by,
		$discount_type ,
		$discount_rate,
		$discount_amount,
	 	$id
	)
	{
			$query = $this->db->query("
				UPDATE
				  `muaman_discount`
				SET
				  `discount_by` = '{$discount_by}',
				  `discount_type` = '{$discount_type}',
				  `discount_rate` = '{$discount_rate}',
				  `discount_amount` = '{$discount_amount}'
				WHERE `id` = '{$id}';
			");
			return $this->db->affected_rows();
	}

}

/* End of file Mformasuransi.php */
/* Location: ./application/models/setup/Mformasuransi.php */