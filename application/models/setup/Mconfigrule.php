<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mconfigrule extends CI_Model {

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


	function get($offset,$limit,$search,$querybuild){
		$query = $this->db->query($querybuild.' '.$search.' LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function getpage($search,$querybuild)
	{
		$query = $this->db->query("
			SELECT COUNT(condition_order)page FROM (".$querybuild." ".$search.") temp
			");
		return $query;	
	}

	function delete($id)
	{
			$query = $this->db->query("
				DELETE FROM apm_rule WHERE rule_id = '".$id."'
			");
			return $this->db->affected_rows();
	}

	function deleteconfig($id)
	{
			$query = $this->db->query("
				DELETE FROM apm_rule_condition WHERE rule_id = '".$id."'
			");
			return $this->db->affected_rows();
	}

	function getoption()
	{
		$query = $this->db->query("
			SELECT id, formname FROM `apm_additional_form` a
				JOIN
				`apm_rule` b
				ON
				a.`asuransi_id` = b.`asuransi_id`
				AND
				a.`produk_id` = b.`produk_id`
				AND
				a.`user_id` = b.`client_id` 
				WHERE 
				b.`rule_id` = ".$this->session->userdata('ruleid')."
			");
		return $query;		
	}


	function save($bulkdata){
			$query = $this->db->query("
				INSERT INTO `apm_rule_condition` (
				  `condition_order`,
				  `rule_id`,
				  `fieldname`,
				  `value`,
				  `result`,
				  `formadditional`,
				  `createdtimestamp`
				)
				VALUES
				".$bulkdata."
				ON DUPLICATE KEY UPDATE 
				condition_order = VALUES(condition_order),
				rule_id = VALUES(rule_id),
				fieldname = VALUES(fieldname),
				result = VALUES(result),
				formadditional = VALUES (formadditional),
				createdtimestamp = VALUES (createdtimestamp)
			");
			return $this->db->affected_rows();
	}

	function update(
		$asid,
	 	$prodid,
	 	$client,
	 	$rule_name,
	 	$rule_field,
	 	$rule_id
	)
	{
			$query = $this->db->query("
				UPDATE
				  `apm_rule`
				SET
				  `rule_id` = 'rule_id',
				  `asuransi_id` = '{$asid}',
				  `produk_id` = '{$prodid}',
				  `client_id` = '{$client}',
				  `rule_name` = '{$rule_name}',
				  `rule_field` = '{$rule_field}',
				  `createdtimestamp` = NOW()
				WHERE `rule_id` = '{$rule_id}';
			");
			return $this->db->affected_rows();
	}

}

/* End of file Mformasuransi.php */
/* Location: ./application/models/setup/Mformasuransi.php */
