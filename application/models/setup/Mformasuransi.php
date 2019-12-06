<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mformasuransi extends CI_Model {

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

	public function getprodukasuransi($id_asuransi)
		{
			$query = $this->db->query("
				SELECT b.id_produk, b.nama_produk FROM `apm_produk_asuransi` a JOIN
				`apm_produk` b ON a.`id_produk` = b.`id_produk` AND a.`id_asuransi` = ".$id_asuransi."
			");
			return $query;	
		}		

	public function getfieldlist($id_produk)
		{
			$query = $this->db->query("
				SELECT id_field, caption, ex_value FROM `apm_field_form` where id_produk = '".$id_produk."' and state = 1 and mandatory ='0'
			");
			return $query;	
		}

	public function save($id_asuransi,$id_produk,$field_id,$field_caption,$example,$mandatory_id,$mandatory_caption,$mandatory_example)
		{
			$query = $this->db->query("
				INSERT IGNORE INTO `apm_generated_form` (
				  `id_form`,
				  `id_asuransi`,
				  `id_produk`,
				  `field_id_list`,
				  `field_list`,
				  `example`,
				  `field_id_mandatory_list`,
				  `field_mandatory_list`,
				  `example_mandatory`
				)
				VALUES
				  (
				    NULL,
				    '".$id_asuransi."',
				    '".$id_produk."',
				    '".$field_id."',
				    '".$field_caption."',
				    '".$example."',
				    '".$mandatory_id."',
				    '".$mandatory_caption."',
				    '".$mandatory_example."'
				  )
			");
			return $this->db->affected_rows();
		}

		public function update($id_asuransi,$id_produk,$field_id,$field_caption,$example,$mandatory_id,$mandatory_caption,$mandatory_example)
		{
			$query = $this->db->query("
				INSERT INTO `apm_generated_form` (
				  `id_asuransi`,
				  `id_produk`,
				  `field_id_list`,
				  `field_list`,
				  `example`,
				  `field_id_mandatory_list`,
				  `field_mandatory_list`,
				  `example_mandatory`
				)
				VALUES
				  (
				    '".$id_asuransi."',
				    '".$id_produk."',
				    '".$field_id."',
				    '".$field_caption."',
				    '".$example."',
				    '".$mandatory_id."',
				    '".$mandatory_caption."',
				    '".$mandatory_example."'
				  )
				ON DUPLICATE KEY UPDATE 
				field_id_list = VALUES(field_id_list),
				field_list = VALUES(field_list),
				example = VALUES(example),
				field_id_mandatory_list = VALUES(field_id_mandatory_list),
				field_mandatory_list = VALUES(field_mandatory_list),
				example_mandatory = VALUES(example_mandatory)

			");
			return $this->db->affected_rows();
		}

	function get($offset,$limit,$search,$produk,$asuransi){
		$query = $this->db->query('
			SELECT 
			if( length(field_id_list)>0, 
				CONCAT(field_id_mandatory_list,\'|\',field_id_list),
				field_id_mandatory_list 
				) 
			field_id,
			if( length(field_list)>0,
				CONCAT(field_mandatory_list,\'|\',field_list),
				field_mandatory_list 
				)
			field_caption,
			NULL btnedit,
			NULL btndelete,
			NULL btnopen,
			NULL btndownload,
			id_form,
			example,
			field_list,
			field_id_list,
			field_id_mandatory_list,
			field_mandatory_list,
			example_mandatory
			FROM apm_generated_form 
			where 
			id_produk = \''.$produk.'\' and
			id_asuransi = \''.$asuransi.'\'
			'.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function getpage($search,$produk,$asuransi)
	{
		$query = $this->db->query('
			SELECT COUNT(id_form) page 
			FROM apm_generated_form 
			where 
			id_produk = \''.$produk.'\' and
			id_asuransi = \''.$asuransi.'\' '.$search.'
			');
		return $query;	
	}

	function inserttotemp($data)
	{
		$query = $this->db->query('
			INSERT ignore INTO `apm_field_temp` (
				  `id_user`,
				  `field_id`,
				  datestamp,
				  field_order,
				  id_form,
				  id_produk
				)
				VALUES
			'.$data.'
			');
		return $query;	
	}

	function getform($id_form)
	{
		$query = $this->db->query('
			SELECT a.*
			FROM apm_field_form a
			JOIN 
			apm_field_temp b
			on
			a.id_field = b.field_id
			and
			a.id_produk = b.id_produk
			where 
			id_form = \''.$id_form.'\' AND b.`id_user` = \''.session_id().'\'
			and datestamp =curdate()
			ORDER BY b.`field_order` ASC
			');
		return $query;	
	}

	function getprovinsi()
	{
		$query = $this->db->query('
			SELECT * from master_provinsi
			');
		return $query;	
	}

	function getgender()
	{
		$query = $this->db->query('
			SELECT * from master_gender
			');
		return $query;	
	}

	function getkota($provinsi_id)
	{
		$query = $this->db->query('
			SELECT * from master_kota where id_provinsi = \''.$provinsi_id.'\'
			');
		return $query;	
	}

	function getkecamatan($kota_id)
	{
		$query = $this->db->query('
			SELECT * from master_kecamatan where id_kota = \''.$kota_id.'\'
			');
		return $query;	
	}

	function getkelurahan($kecamatan_id)
	{
		$query = $this->db->query('
			SELECT * from master_kelurahan where id_kecamatan = \''.$kecamatan_id.'\'
			');
		return $query;	
	}

	function cleartemp()
	{
		$query = $this->db->query("
			DELETE FROM apm_field_temp where id_user = '".session_id()."' 
			");
		return $query;	
	}

	function getmandatoryfield($id_produk)
	{
	
		$query = $this->db->query("
			SELECT id_field, caption, ex_value FROM `apm_field_form` where state = 1 and mandatory ='1' order by mandatory_order
		");
		return $query;	
	}
}

/* End of file Mformasuransi.php */
/* Location: ./application/models/setup/Mformasuransi.php */