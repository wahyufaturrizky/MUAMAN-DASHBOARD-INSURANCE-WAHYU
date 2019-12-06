<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Msetupfield extends CI_Model {

	public function getproduk()
	{
		$query = $this->db->query(
			"SELECT * FROM apm_produk where flag = '1'"

		);
		return $query;
	}

	public function getmaster()
	{
		$query = $this->db->query(
			"SELECT master_name FROM m_master_list where flag = '1'"

		);
		return $query;
	}

	function get($offset,$limit,$search,$produk){
		$query = $this->db->query('
			SELECT  

			id_field,caption,type_field,ex_value,lov,
			NULL btnedit,
			NULL btndelete,
			b.id_produk
			FROM apm_field_form a JOIN
			apm_produk b 
			ON
			a.`id_produk` = b.`id_produk`

			where 
			b.id_produk = \''.$produk.'\' and
			a.state = \'1\' '.$search.'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function getpage($search,$produk)
	{
		$query = $this->db->query('
			SELECT COUNT(id_field) page 
			FROM apm_field_form a JOIN
			apm_produk b 
			ON
			a.`id_produk` = b.`id_produk`
			where b.id_produk = \''.$produk.'\' and a.state = \'1\' '.$search.'
			');
		return $query;	
	}

	public function save($id_produk,$id_field,$caption,$type,$ex,$lov)
	{
		$query = $this->db->query("
		INSERT IGNORE INTO `apm_field_form` (
			  `id_produk`,
			  `id_field`,
			  `caption`,
			  `type_field`,
			  `ex_value`,
			  `lov`,
			  `state`
			)
		VALUES
		  (
		    '".$id_produk."',
		    '".$id_field."',
		    '".$caption."',
		    '".$type."',
		    '".$ex."',
		    '".$lov."',
		    '1'
		  )
			");
		return $this->db->affected_rows();			
	}

	public function update($id_produk,$id_field,$caption,$type,$ex,$lov)
	{
		$query = $this->db->query("
		REPLACE INTO `apm_field_form` (
			  `id_produk`,
			  `id_field`,
			  `caption`,
			  `type_field`,
			  `ex_value`,
			  `lov`,
			  `state`
			)
		VALUES
		  (
		    '".$id_produk."',
		    '".$id_field."',
		    '".$caption."',
		    '".$type."',
		    '".$ex."',
		    '".$lov."',
		    '1'
		  )
			");
		return $this->db->affected_rows();			
	}

	public function delete($id_produk,$id_field)
	{
		$query = $this->db->query("
		  UPDATE apm_field_form
		  set state = '0'
		  where id_produk = '".$id_produk."' and id_field= '".$id_field."'
			");
		return $this->db->affected_rows();			
	}
}




/* End of file Msetupfield.php */
/* Location: ./application/models/setup/Msetupfield.php */