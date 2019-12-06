<?php 

class Mbank extends CI_Model{

	function get(){
			$this->db->select('*');
			$this->db->from('apm_nasabah_group');
			$query = $this->db->get();

			if ($query->num_rows() > 0)
				return $query->result();
			else
				return false;
		
	}

	function save($data = array()) {

		if(isset($data['id']))
		{
			$this->db->where('id', $data['id']);
			$this->db->update('apm_nasabah_group', $data);
		} else {
			$this->db->insert('apm_nasabah_group', $data);
		}

		if ($this->db->affected_rows() > 0)
			return true;
		
	}


}