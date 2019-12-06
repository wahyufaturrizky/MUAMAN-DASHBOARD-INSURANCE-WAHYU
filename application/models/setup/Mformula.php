<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mformula extends CI_Model {

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

		public function getsubtotal()
		{
			$query = $this->db->query("
			SELECT id,substructure, SUBSTR(Formula,1,1) opt, SUBSTR(Formula,2) `value` FROM`apm_rekonsiliasi_struktur` WHERE structure = 'SUBTOTAL'
			and asuransi_id = '".$this->session->userdata('asuransi_id')."'
			and produk_id = '".$this->session->userdata('produk_id')."'
			and client_id = '".$this->session->userdata('client_id')."'
			and polis_id = '".$this->session->userdata('polis_id')."'
			");
			return $query;	
		}		

		public function getadjustment()
		{
			$query = $this->db->query("
			SELECT id,substructure, SUBSTR(Formula,1,1) opt, SUBSTR(Formula,2) `value` FROM`apm_rekonsiliasi_struktur` WHERE structure = 'ADJUSTMENT'
			and asuransi_id = '".$this->session->userdata('asuransi_id')."'
			and produk_id = '".$this->session->userdata('produk_id')."'
			and client_id = '".$this->session->userdata('client_id')."'
			and polis_id = '".$this->session->userdata('polis_id')."'
			");
			return $query;	
		}

		public function gettax()
		{
			$query = $this->db->query("
			SELECT id,substructure, '+' opt , SUBSTR(Formula,2) `value` FROM`apm_rekonsiliasi_struktur` WHERE structure = 'TAX'
			and asuransi_id = '".$this->session->userdata('asuransi_id')."'
			and produk_id = '".$this->session->userdata('produk_id')."'
			and client_id = '".$this->session->userdata('client_id')."'
			and polis_id = '".$this->session->userdata('polis_id')."'
			");
			return $query;	
		}

		public function getshares()
		{
			$query = $this->db->query("
			SELECT id,substructure, '+' opt , SUBSTR(Formula,2) `value` , propto FROM`apm_rekonsiliasi_struktur` WHERE structure = 'SHARES'
			and asuransi_id = '".$this->session->userdata('asuransi_id')."'
			and produk_id = '".$this->session->userdata('produk_id')."'
			and client_id = '".$this->session->userdata('client_id')."'
			and polis_id = '".$this->session->userdata('polis_id')."'
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

	public function getpolisid($id_asuransi,$id_produk,$client)
		{
			$query = $this->db->query("
				SELECT id_polis_induk from polis_induk 
				where 
				asuransi_id = '{$id_asuransi}' and
				produk_id = '{$id_produk}' and
				client = '{$client}'
			");
			return $query;	
		}		


	function get($offset,$limit,$search,$produk,$asuransi,$userid,$polisid){
		$query = $this->db->query('
			SELECT
			tablename,
			rowname ,
			columnname,
			NULL btnconfig,
			NULL btntable,
			NULL btndownload,
			id id_form,
			asuransi_id,
			produk_id,
			client_id
			FROM apm_table_formula WHERE 
			produk_id = \''.$produk.'\' and
			polis_id = \''.$polisid.'\' and
			asuransi_id = \''.$asuransi.'\' AND
			client_id = \''.$userid.'\'
			'.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function getpage($search,$produk,$asuransi,$userid,$polisid)
	{
		$query = $this->db->query('
			SELECT COUNT(id) page 
			FROM apm_table_formula WHERE 
			produk_id = \''.$produk.'\' and
			polis_id = \''.$polisid.'\' and
			asuransi_id = \''.$asuransi.'\' AND
			client_id = \''.$userid.'\' '.$search.'
			');
		return $query;	
	}

	function gettable($offset,$limit,$tableid){
		$query = $this->db->query('
			SELECT
			column_value,
			row_value,
			data_value
			from apm_table_formula_values
			where table_id = \''.$tableid.'\'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function getpagetable($tableid)
	{
		$query = $this->db->query('
			SELECT COUNT(id) page 
			from apm_table_formula_values
			where table_id = \''.$tableid.'\'
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

	function getoptiontblref($asid,$prodid,$client,$polisid)
	{
		$query = $this->db->query("
			SELECT
			  `tablename`
			FROM
			  `apm_table_formula`
			WHERE 
				asuransi_id = '".$asid."' 
			AND 
				produk_id = '".$prodid."'
			AND 
				client_id = '".$client."'
			AND
				polis_id = '".$polisid."'  
			");
		return $query;		
	}


	function savetable(
        	 	$asid,
        	 	$prodid,
        	 	$client,
        	 	$polisid,
        	 	$tablename,
        	 	$rowname,
        	 	$columnname
        	){
			$query = $this->db->query("
				INSERT INTO `apm_table_formula` (
				  `id`,
				  `tablename`,
				  `rowname`,
				  `columnname`,
				  `asuransi_id`,
				  `produk_id`,
				  `client_id`,
				  `polis_id`,
				  `createdtimestamp`
				)
				VALUES
				  (
				    NULL,
				    '{$tablename}',
				    '{$rowname}',
				    '{$columnname}',
				    '{$asid}',
				    '{$prodid}',
				    '{$client}',
				    '{$polisid}',
				    NOW()
				  );
			");
			return $this->db->affected_rows();
	}


	function savesubtotal(
        	 	$varname,
        	 	$sourcetype,
        	 	$operator,
        	 	$formula
        	){
			$formula = $operator." ".$formula;
			$query = $this->db->query("
				INSERT INTO `apm_rekonsiliasi_struktur` (
					  `asuransi_id`,
					  `produk_id`,
					  `client_id`,
					  `polis_id`,
					  `structure`,
					  `substructure`,
					  `sourcetype`,
					  `valuetype`,
					  `propto`,
					  `Formula`,
					  `createdtimestamp`
					)
					VALUES
					  (
					    '{$this->session->userdata('asuransi_id')}',
					    '{$this->session->userdata('produk_id')}',
					    '{$this->session->userdata('client_id')}',
					    '{$this->session->userdata('polis_id')}',
					    'SUBTOTAL',
					    '{$varname}',
					    '{$sourcetype}',
					    NULL,
					    NULL,
					    '{$formula}',
					    NOW()
					  );
			");
			return $this->db->affected_rows();
	}

	function savetax(
        	 	$varname,
        	 	$sourcetype,
        	 	$operator,
        	 	$formula,
        	 	$valuetype
        	){
			$formula = $operator." ".$formula;
			$query = $this->db->query("
				INSERT INTO `apm_rekonsiliasi_struktur` (
					  `asuransi_id`,
					  `produk_id`,
					  `client_id`,
					  `polis_id`,
					  `structure`,
					  `substructure`,
					  `sourcetype`,
					  `valuetype`,
					  `propto`,
					  `Formula`,
					  `createdtimestamp`
					)
					VALUES
					  (
					    '{$this->session->userdata('asuransi_id')}',
					    '{$this->session->userdata('produk_id')}',
					    '{$this->session->userdata('client_id')}',
					    '{$this->session->userdata('polis_id')}',
					    'TAX',
					    '{$varname}',
					    '{$sourcetype}',
					    '{$valuetype}',
					    NULL,
					    '{$formula}',
					    NOW()
					  );
			");
			return $this->db->affected_rows();
	}

		function saveadj(
        	 	$varname,
        	 	$sourcetype,
        	 	$operator,
        	 	$formula,
        	 	$valuetype
        	){
			$formula = $operator." ".$formula;
			$propto ='';
			if($valuetype=='2'){
				$propto ='(SUBTOTAL)';
			}
			$query = $this->db->query("
				INSERT INTO `apm_rekonsiliasi_struktur` (
					  `asuransi_id`,
					  `produk_id`,
					  `client_id`,
					  `polis_id`,
					  `structure`,
					  `substructure`,
					  `sourcetype`,
					  `valuetype`,
					  `propto`,
					  `Formula`,
					  `createdtimestamp`
					)
					VALUES
					  (
					    '{$this->session->userdata('asuransi_id')}',
					    '{$this->session->userdata('produk_id')}',
					    '{$this->session->userdata('client_id')}',
					    '{$this->session->userdata('polis_id')}',
					    'ADJUSTMENT',
					    '{$varname}',
					    '{$sourcetype}',
					    '{$valuetype}',
					    '{$propto}',
					    '{$formula}',
					    NOW()
					  );
			");
			return $this->db->affected_rows();
	}


		function saveshares(
        	 	$varname,
        	 	$sourcetype,
        	 	$operator,
        	 	$formula,
        	 	$valuetype,
        	 	$propto
        	){
			$formula = $operator." ".$formula;
			$query = $this->db->query("
				INSERT INTO `apm_rekonsiliasi_struktur` (
					  `asuransi_id`,
					  `produk_id`,
					  `client_id`,
					  `polis_id`,
					  `structure`,
					  `substructure`,
					  `sourcetype`,
					  `valuetype`,
					  `propto`,
					  `Formula`,
					  `createdtimestamp`
					)
					VALUES
					  (
					    '{$this->session->userdata('asuransi_id')}',
					    '{$this->session->userdata('produk_id')}',
					    '{$this->session->userdata('client_id')}',
					    '{$this->session->userdata('polis_id')}',
					    'SHARES',
					    '{$varname}',
					    '{$sourcetype}',
					    '{$valuetype}',
					    '{$propto}',
					    '{$formula}',
					    NOW()
					  );
			");
			return $this->db->affected_rows();
	}

	function insertbulkdatatable($bulkdata){
			$query = $this->db->query("
				REPLACE INTO `apm_table_formula_values`
				VALUES
				".$bulkdata."
			");
			return $this->db->affected_rows();
	}

	function deletenett($id){
			$query = $this->db->query("
				DELETE from apm_rekonsiliasi_struktur where id = '".$id."'
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