<?php 

class Mbroker_user extends CI_Model{


	function getpage($search,$id_broker)
	{
		$query = $this->db->query('
			SELECT COUNT(*) page from 
			apm_broker_user a
			join 
			m_user_group b
			on
			a.part_of_id = b.id
			where a.id_broker = \''.$id_broker.'\' 
			and a.id_broker != \'\'
			and a.flag = \'1\'
			and b.isBroker = \'Y\' 
			'.$search.'
			');
		return $query;	
	}

	function getpartofid(){
		$query = $this->db->query('
			SELECT brokerdetailpos, id from m_user_group where isBroker = \'Y\'
			');
		return $query;
		
	}


	function get($id_broker,$offset,$limit,$search){
		$query = $this->db->query('
			SELECT 
			a.name,
			b.brokerdetailpos, 
			a.email, 
			\'<button class="btn btn-warning btn-flat" id="edit"><i class="fa fa-pencil"></i> Edit</button>\' ,
			\'<button class="btn btn-danger btn-flat" id="delete"><i class="fa fa-trash"></i> Delete</button>\',
			if(c.idapm_user is NULL,\'<button class="btn btn-info btn-flat" id="create"><i class="fa fa-user"></i> Create</button>\',
				\'<button class="btn btn-success btn-flat"><i class="fa fa-user"></i> Sudah Memiliki Akun</button>\'
			),
			a.id,
			a.part_of_id
			from apm_broker_user a
			join m_user_group b
			on
			a.part_of_id = b.id
			left join
			apm_user c
			on
			a.id = c.apm_broker_user_id
			where a.id_broker = \''.$id_broker.'\' and a.id_broker != \'\' and a.flag = \'1\' '.$search.'
			and b.isBroker = \'Y\'
			LIMIT '.$offset.','.$limit.'
			');
		return $query;
		
	}

	function update($nama,$part_of_id,$email,$id)
	{
		$query = $this->db->query(
			'
			UPDATE apm_broker_user
			SET 
			name = \''.addslashes($nama).'\',
			email = \''.$email.'\',
			part_of_id = \''.$part_of_id.'\'
			WHERE 
			id = \''.$id.'\'
			'
			);
		return $this->db->affected_rows();
	}

	function delete($id) 
	{
		$query = $this->db->query(
			'
			DELETE FROM apm_broker_user
			WHERE 
			id = \''.$id.'\'
			'
			);
		return $this->db->affected_rows();
	}	

	function uploadData2($file,$id_broker){
		$query = $this->db->query("
			LOAD DATA LOCAL INFILE '".$file."' 
			IGNORE 
			INTO TABLE apm_broker
			FIELDS TERMINATED BY ',' 
			OPTIONALLY ENCLOSED BY '\"' 
			LINES TERMINATED BY '\r\n' 
			IGNORE 1 LINES 
			(
				name,
				part_of_id,
				email
			)
			SET 
			apm_broker.`flag` = 1,
			id_broker = '$id_broker'
			");

		return $query;
	}

	function save($nama,$part_of_id,$email,$id_broker) {
		$query = $this->db->query(
			'
			INSERT INTO apm_broker_user
			(
				id_broker,
				name,
				email,
				part_of_id,
				flag
			)
			values(
				\''.$id_broker.'\',
				\''.addslashes($nama).'\',
				\''.$email.'\',
				\''.$part_of_id.'\',
				\'1\'
			)
			'
			);
		return $this->db->affected_rows();
		// if(isset($data['id']))
		// {
		// 	$this->db->where('id', $data['id']);
		// 	$this->db->update('apm_broker_user', $data);
		// } else {
		// 	$this->db->insert('apm_broker_user', $data);
		// }

		// if ($this->db->affected_rows() > 0)
		// 	return true;
		
	}

	function save_user($username,$password,$id_user,$part_of_id) {
		$query = $this->db->query(
			'
			INSERT INTO apm_user
			(
				username_xxx,
				password_xxx,
				group_user,
				apm_broker_user_id,
				flag
			)
			values(
				\''.addslashes($username).'\',
				\''.md5($password).'\',
				\''.$part_of_id.'\',
				\''.$id_user.'\',
				\'1\'
			)
			'
			);
		return $this->db->affected_rows();
	}



}