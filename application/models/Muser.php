<?php 

class Muser extends CI_Model{

	function get($params = []){
		$this->db->select('*');
		$this->db->from('apm_nasabah');
		$strQueryWhere[] = "flag = 1";

		if(isset($params['id'])){
			$strQueryWhere[] = "id = " . $params['id'];
			$this->db->limit(1);
		}

		$condition = implode(" AND ",$strQueryWhere);
		$this->db->where($condition);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0)
			return $query->result();
		else
			return false;
		
	}

	function save($data = []) {

		if(isset($data['idapm_user']))
		{
            $save = [
                'group_user' => $data['group_user'],
                'flag'=> $data['flag']
            ];

            if(isset($data['password_xxx']) and !empty($data['password_xxx'])){
                $save['password_xxx'] = $data['password_xxx'];
            }

			$this->db->where('idapm_user', $data['idapm_user']);
			$this->db->update('apm_user', $save);
		} else {
			$this->db->insert('apm_user', $data);
		}

		if ($this->db->affected_rows() > 0)
			return true;
		
	}

	function deletebyidbroker($idbroker) {

		if($idbroker != null)
		{
            $delete = [
                'flag'=> 0
            ];


			$this->db->where('apm_broker_user_id', $idbroker);
			$this->db->delete('apm_user');
			//$this->db->update('apm_user', $delete);

			return true;
		}

		return false;
		
	}

	function deletebyidnasabah($idnasabah) {

		if($idnasabah != null)
		{
            $delete = [
                'flag'=> 0
            ];


			$this->db->where('apm_nasabah_id', $idnasabah);
			$this->db->delete('apm_user');
			//$this->db->update('apm_user', $delete);

			return true;
		}

		return false;
		
	}

	function deletebyidasuransi($idasuransi) {

		if($idasuransi != null)
		{
            $delete = [
                'flag'=> 0
            ];


			$this->db->where('apm_asuransi_id', $idasuransi);
			$this->db->delete('apm_user');
			//$this->db->update('apm_user', $delete);

			return true;
		}

		return false;
		
	}


}