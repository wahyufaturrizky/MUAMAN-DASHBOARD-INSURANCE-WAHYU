<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Memailblast extends CI_Model {

    function getpage($search)
    { 
        $query = $this->db->query('
            SELECT COUNT(*) page from apm_template_email where flag = \'1\' '.$search.'
            ');
        return $query;  
    }

    function get($offset,$limit,$search){
        $query = $this->db->query('
            SELECT 
			email_tujuan,
			content_email,
			attachment_email,
			createdDate,
			sentTimeStamp,
            \'<button class="btn btn-warning btn-flat" id="edit"><i class="fa fa-pencil"></i> Edit</button>
             <button class="btn btn-danger btn-flat" id="delete"><i class="fa fa-trash"></i> Delete</button>\',
            id
            from apm_manual_email where flag = \'1\' '.$search.'
            LIMIT '.$offset.','.$limit.'
            ');
        return $query;
        
    }

    function listfile(){
        $query = $this->db->query("
            SELECT 
                filename,
                path_file
            FROM 
                apm_file_generated
            WHERE 
                flag = 1 
            ");
        return $query;
        
    }

}

/* End of file modelName.php */
/* Location: ./application/models/modelName.php */