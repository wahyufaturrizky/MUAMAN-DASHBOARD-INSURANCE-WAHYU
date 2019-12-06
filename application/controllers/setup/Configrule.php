<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Configrule extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('setup/mconfigrule');
    }

    public function index()
    {
        //$this->cekpriviledge();
        $data['fields'] = base64_decode($this->input->get("fields"));
        $data['ruleid'] = base64_decode($this->input->get("ruleid"));
        $data['name'] = base64_decode($this->input->get("name"));

        $sessruleid = array(
            'ruleid' => $data['ruleid'],
            'fields' => $data['fields']
        );
        
        $this->session->set_userdata( $sessruleid );

        $data['getasuransi'] = $this->mconfigrule->getasuransi();
        $data['getnasabah'] = $this->mconfigrule->getnasabah();
        $this->template();
        $this->load->view('setup/configrule/content',$data);
        $this->footer();
        $this->load->view('setup/configrule/content_js');   
    }

    public function getprodukasuransi()
    {
        $getprodukasuransi = $this->mconfigrule->getprodukasuransi(
            $this->input->post("asuransi")
        );

        echo '<option value= "-">Produk Asuransi('.$getprodukasuransi->num_rows().')</option>';
        foreach ($getprodukasuransi->result() as $k) {
            echo '<option value="'.$k->id_produk.'">
                 '.$k->nama_produk.'
                 </option>';
        }
    }

    public function getadditionalform()
    {
        $getadditionalform = $this->mconfigrule->getadditionalform(
            $this->input->post("asuransi"),
            $this->input->post("produk_id"),
            $this->input->post("client")
        );

        echo '<option value= "-">Form Tambahan('.$getadditionalform->num_rows().')</option>';
        foreach ($getadditionalform->result() as $k) {
            echo '<option value="'.$k->id.'">
                 '.$k->formname.'
                 </option>';
        }
    }

    public function ajax_data()
    {
        $page = $this->input->get('page');
        
        $searchvalue = addslashes($this->input->get('search'));
        if($page == ''){
            $page = 1;
        }

         if($searchvalue != ''){
             $search = "AND(t0.condition_order LIKE '%".$searchvalue."%' ";
             $rule_field = explode("|",$this->session->userdata('fields'));
             for ($i=0; $i <count($rule_field) ; $i++) { 
                $search = $search." OR t".$i.".`".$rule_field[$i]."` LIKE '%".$searchvalue."%' " ; 
             }
             $search = $search.")";
         }else{
            $search='';
         }  
        $limit = 10;
        $offset = ($page-1)*$limit; 

        $querybuild = $this->queryconfig();

        //echo $this->queryconfig();
        $data['getdata']= $this->mconfigrule->get($offset,$limit,$search,$querybuild);
        $rows = array();
        foreach ($data['getdata']->result() as $row) {
            $row->btnedit = '<button class="btn btn-warning btn-flat" id="edit-'.$row->condition_order.'"><i class="fa fa-pencil"></i> Edit</button>
                    <script>
                    $(document).on("click", "#edit-'.$row->condition_order.'", function() {
                       edit("'.$row->valuedata.'","'.$this->session->userdata('fields').'","'.$row->condition_order.'","'.$row->formadditional.'","'.$row->result.'")
                    });
                    </script>
            ';
            $row->btndelete ='<button class="btn btn-danger btn-flat" id="delete-'.$row->condition_order.'"><i class="fa fa-trash"></i> Delete</button>
                    <script>
                    $(document).on("click", "#delete-'.$row->condition_order.'", function() {
                       delete("'.$row->condition_order.'"); 
                    });
                    </script>
            ';
            $rows[] = array_values((array)$row);
        }
        $this->output->set_content_type('application/json');
        $data['ajax_data'] = json_encode(array('aaData'=> $rows));
        $this->load->view('ajax/ajax_data',$data);
    }

    function paging()
    {
        $searchvalue = addslashes($this->input->get('search'));
        if($searchvalue != ''){
             $search = "AND(t0.condition_order LIKE '%".$searchvalue."%' ";
             $rule_field = explode("|",$this->session->userdata('fields'));
             for ($i=0; $i <count($rule_field) ; $i++) { 
                $search = $search." OR t".$i.".`".$rule_field[$i]."` LIKE '%".$searchvalue."%' " ; 
             }
             $search = $search.")";
         }else{
            $search='';
         } 
         $querybuild = $this->queryconfig();
        $getpage = $this->mconfigrule->getpage($search,$querybuild);
        $countpage = 1;
        $limit = 10;
            foreach ($getpage->result() as $row) {
              $countpage = ceil(intval($row->page)/$limit);
            } 
            if($countpage>0){
                echo '<input type="hidden" id="countpage" value="'.$countpage.'">';
                echo '<button class="btn btn-flat btn-info page1"><i class="fa fa-fast-backward"></i></button>';
                for ($i=1; $i <= $countpage ; $i++) { 
                  echo '<button class="btn btn-flat btn-info page'.$i.'"">'.$i.'</button>';
                }
                echo '<button class="btn btn-flat btn-info page'.$countpage.'"><i class="fa fa-fast-forward"></i></button>';
            }else{
                echo '0';
            }
    }

    public function getoption()
    {
        $getoption = $this->mconfigrule->getoption();
        echo '<option value="">PILIHAN('.$getoption->num_rows().')</option>';
        foreach ($getoption->result() as $k) {
               echo '<option value="'.$k->id.'">
                 '.$k->formname.'
                 </option>';
        }
    }

    public function save()
    {
        $value = explode("|",$this->input->post("values"));
        $field = explode("|",$this->session->userdata('fields'));
        $conname = $this->input->post("conname");
        $result = $this->input->post("result");
        $addform = $this->input->post("addform");
        $comma ='';
        $bulkdata ='';
        for ($i=0; $i < count($value); $i++) { 
            $bulkdata = $bulkdata.$comma."(
                        '{$conname}',
                        '{$this->session->userdata('ruleid')}',
                        '{$field[$i]}',
                        '{$value[$i]}',
                        '{$result}',
                        '{$addform}',
                        NOW())";
            $comma =",";
        }

        $save = $this->mconfigrule->save(
            $bulkdata
        );
        echo $save;
    }

    public function delete()
    {
        $delete = $this->mconfigrule->delete(
            $this->input->post("id")
        );
        echo $delete;
    }

    public function update()
    {
    $update = $this->mconfigrule->update(
            $this->input->post("asuransi"),
            $this->input->post("produk"),
            $this->input->post("client"),
            $this->input->post("rulename"),
            $this->input->post("rulefield"),
            $this->input->post("id")
        );
        echo $update;
    }

    public function queryconfig()
    {
        $rule_field = explode("|",$this->session->userdata('fields'));
        $temptbl='';
        $join ='';
        $on = '';
        $select = '';
        $concat ='';
        for ($i=0; $i < count($rule_field) ; $i++) { 
            if($i>0){
                $on = " ON t0.condition_order = t".$i.".condition_order"; 
            }
            $temptbl = $temptbl.$join."
                        (SELECT 
                        `value` `".$rule_field[$i]."`,condition_order,formadditional,result,rule_id FROM apm_rule_condition 
                        WHERE fieldname = '".$rule_field[$i]."') t".$i."
                        ".$on;
 
            $join = " LEFT JOIN ";

            $select = $select."`".$rule_field[$i]."`,";
        }
        $concat = "CONCAT( IFNULL(`".str_replace("|", "`,'') ,'|',IFNULL(`", $this->session->userdata('fields') )."`,'')) as valuedata" ;
        $query = "select t0.condition_order,".$select." t0.result, b.formname, NULL btnedit,NULL btndelete ,t0.rule_id, t0.formadditional, ".$concat." FROM ".$temptbl." 
                  LEFT JOIN apm_additional_form b
                  ON
                  t0.formadditional = b.id
                  where t0.rule_id =".$this->session->userdata('ruleid');
        return $query;
    }
}

/* End of file configrule.php */
/* Location: ./application/controllers/setup/configrule.php */