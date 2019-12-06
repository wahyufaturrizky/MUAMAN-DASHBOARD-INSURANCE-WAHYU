<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mruletblrefrence extends CI_Model {

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


	function get($offset,$limit,$search,$produk,$asuransi,$userid){
		$query = $this->db->query('
			SELECT
			rule_name,
			rule_field ,
			NULL btnedit,
			NULL btndelete,
			NULL btnconfig,
			rule_id id_form,
			asuransi_id,
			produk_id,
			client_id
			FROM apm_rule WHERE 
			produk_id = \''.$produk.'\' and
			asuransi_id = \''.$asuransi.'\' AND
			client_id = \''.$userid.'\'
			'.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function getpage($search,$produk,$asuransi,$userid)
	{
		$query = $this->db->query('
			SELECT COUNT(rule_id) page 
			FROM apm_rule WHERE 
			produk_id = \''.$produk.'\' and
			asuransi_id = \''.$asuransi.'\' AND
			client_id = \''.$userid.'\' '.$search.'
			');
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

	function getoption($asid,$prodid)
	{
		$query = $this->db->query("
			SELECT CONCAT(field_mandatory_list,'|',field_list) field_list FROM `apm_generated_form` 
			WHERE id_asuransi = '".$asid."' 
			AND id_produk = '".$prodid."'  
			");
		return $query;		
	}


	function save(
        	 	$asid,
        	 	$prodid,
        	 	$client,
        	 	$rule_name,
        	 	$rule_field
        	){
			$query = $this->db->query("
				INSERT INTO `apm_rule` (
				  `rule_id`,
				  `asuransi_id`,
				  `produk_id`,
				  `client_id`,
				  `rule_name`,
				  `rule_field`,
				  `createdtimestamp`
				)
				VALUES
				  (
				    NULL,
				    '{$asid}',
				    '{$prodid}',
				    '{$client}',
				    '{$rule_name}',
				    '{$rule_field}',
				    NOW()
				  );
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