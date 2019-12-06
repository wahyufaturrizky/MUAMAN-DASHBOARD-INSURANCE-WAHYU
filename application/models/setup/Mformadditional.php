<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mformadditional extends CI_Model {

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


	public function inserttoadditional(
        	 	$asid,
        	 	$prodid,
        	 	$client,
        	 	$formname,
        	 	$filename
        	){
			$query = $this->db->query("
				INSERT INTO `apm_additional_form` (
				  `formname`,
				  `filename`,
				  `asuransi_id`,
				  `produk_id`,
				  `user_id`,
				  `state`,
				  `createdtimestamp`
				)
				VALUES
				  (
				    '{$formname}',
				    '{$filename}',
				    '{$asid}',
				    '{$prodid}',
				    '{$client}',
				    '1',
				    NOW()
				  )
				ON DUPLICATE KEY UPDATE 
					`formname` = VALUES(formname),
				  	`filename` = VALUES(filename),
				  	`asuransi_id` = VALUES(asuransi_id),
				  	`produk_id` = VALUES(produk_id),
				  	`user_id` = VALUES(user_id),
				  	`state` = VALUES(state),
				  	`createdtimestamp`= VALUES(createdtimestamp)
				  ;
			");
			return $this->db->affected_rows();
		}


	function get($offset,$limit,$search,$produk,$asuransi,$userid){
		$query = $this->db->query('
			SELECT formname, filename ,
			NULL btnedit,
			NULL btndelete,
			NULL btndownload,
			id id_form,
			asuransi_id,
			produk_id,
			user_id
			FROM apm_additional_form WHERE state = \'1\' 
			AND
			produk_id = \''.$produk.'\' and
			asuransi_id = \''.$asuransi.'\' AND
			user_id = \''.$userid.'\'
			'.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function getpage($search,$produk,$asuransi,$userid)
	{
		$query = $this->db->query('
			SELECT COUNT(id) page 
			FROM apm_additional_form WHERE state = \'1\' 
			AND
			produk_id = \''.$produk.'\' and
			asuransi_id = \''.$asuransi.'\' AND
			user_id = \''.$userid.'\' '.$search.'
			');
		return $query;	
	}

	function delete($id)
	{
			$query = $this->db->query("
				DELETE FROM apm_additional_form WHERE id = '".$id."'
			");
			return $this->db->affected_rows();
	}

}

/* End of file Mformasuransi.php */
/* Location: ./application/models/setup/Mformasuransi.php */