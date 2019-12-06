<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function getuser()
	{
		$query = $this->db->query(
			'Select * from m_user_group
			'
			);
		return $query;
	}


	public function getdetail($id)
	{
		$query = $this->db->query(
		'Select a.id as id, b.usergroup as grup, a.admin as user
		from m_admin as a
		join
		m_user_group as b
		on
		a.usergroup = b.id
		where
		a.usergroup = '.$id
			);
		return $query;
	}

	public function getpriviledge($id)
	{
		$query = $this->db->query(
		'
		SELECT  a.id as parentid, a.`caption` as parent, a.`link`,  b.id, b.`caption` AS child, b.`link`, 
		IF((SELECT COUNT(idpriv) FROM menu_priviledge WHERE  usergroup = '.$id.' AND idmenuparent = a.`id` AND  idmenuchild = b.id )>0,
		CONCAT(\'<input type="checkbox" id="menu" value = "\',IF (b.id  IS NULL ,CONCAT('.$id.',\',\',a.`id`,\',\',0),CONCAT('.$id.',\',\',a.`id`,\',\',b.id) ),\'" class="minimal-red" checked >\'),

		IF((SELECT COUNT(idpriv) FROM menu_priviledge JOIN m_menu_parent ON menu_priviledge.`idmenuparent`= m_menu_parent.`id` WHERE usergroup =  '.$id.'  AND idmenuparent =   a.`id` AND isparent= \'n\' 
		)>0,CONCAT(\'<input type="checkbox" id="menu" value = "\',IF (b.id  IS NULL ,CONCAT('.$id.',\',\',a.`id`,\',\',0),CONCAT('.$id.',\',\',a.`id`,\',\',b.id) ),\'" class="minimal-red" checked >\'),
		
		CONCAT(\'<input type="checkbox" id="menu" value = "\',IF (b.id  IS NULL ,CONCAT('.$id.',\',\',a.`id`,\',\',0),CONCAT('.$id.',\',\',a.`id`,\',\',b.id) ),\'" class="minimal-red" >\'))) AS cek
		FROM
		m_menu_parent AS a 
		LEFT JOIN
		m_menu_child AS b
		ON
		a .id = b.`idparent`
		WHERE
		a.`ismenu`= \'Y\'
		ORDER BY  a.`id`,b.id asc
		'	
		);
		return $query;
	}

	public function clean($id)
	{
		$query = $this->db->query(
		'delete 
		from 
		menu_priviledge
		where
		usergroup = '.$id
			);
		return $query;
	}

	public function savepriviledge($menu)
	{
		$query = $this->db->query(
		'insert ignore into menu_priviledge(usergroup,idmenuparent,idmenuchild) values('.$menu.')'
			);
		return $query;
	}
}

/* End of file m_user.php */
/* Location: ./application/models/m_user.php */