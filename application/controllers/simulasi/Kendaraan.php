<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Kendaraan extends MY_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('premi/mpremikendaraan');
    }

    public function sum($id)
    {
        // echo '<pre>'; print_r($_POST); echo '</pre>';
        // foreach ($_POST['data'] as $key => $row) {
        //     $data[$row['name']] = (isset($row['value'])?$row['value']:'');
        // }
        $data = $_POST;
        $data['id_wilayah'] = $this->mpremikendaraan->getidwilayah($_POST['plat']);
        $data['coverage'] = $this->mpremikendaraan->getcoverage($_POST['coverage']);
        

        $this->load->view('simulasi/kendaraan_sum', $data);

    }

    public function summary($id)
    {
        foreach ($_POST['data'] as $key => $row) {
            $data[$row['name']] = (isset($row['value'])?$row['value']:'');
        }

        $data['id_wilayah'] = $this->mpremikendaraan->getidwilayah($data['plat']);
        $data['coverage'] = $this->mpremikendaraan->getcoverage($data['coverage']);
        
        $this->template();
        // echo '<pre>'; print_r($data); echo '</pre>';
        $this->load->view('simulasi/kendaraan_summary', $data);
        $this->footer();
    }
    public function asset($id)
    {
        // $this->setsessionbroker();
        $data['assets'] = $this->mpremikendaraan->getassets($id);

        if(isset($_POST) and !empty($_POST))
		{
            $yearNow = date("Y");
            $id_plat = $_POST['plat'];
            $id_coverage = $_POST['coverage'];
            
            
            $id_wilayah = $this->mpremikendaraan->getidwilayah($id_plat);
            $id_kategori_kendaraan = $this->mpremikendaraan->getkategorikendaraan($_POST['harga_kendaraan'], "Pribadi");

            $data = [
                'id_wilayah' => $id_wilayah,
                'id_coverage' => $id_coverage,
                'id_kategori_kendaraan' => $id_kategori_kendaraan
            ];

            $data['tahun_kendaraan'] = $_POST['tahun_kendaraan'];
            $selisihtahun = $yearNow - $data['tahun_kendaraan'];

            $data['asuransi'] = $this->mpremikendaraan->getasuransiwithrate($data);
            $data['harga_kendaraan'] = $_POST['harga_kendaraan'];
            
            $data['idplat'] = $_POST['plat'];

            $data['loading'] = $this->getloading($data['tahun_kendaraan'], $id_coverage);

            if(isset($_POST['srcc']) and !empty($_POST['srcc']))
            {
                $data['srcc'] = $this->getpricesrcc($data['harga_kendaraan'], $id_coverage);
            }

            if(isset($_POST['ts']) and !empty($_POST['ts']))
            {
                $data['ts'] = $this->getpricets($data['harga_kendaraan'], $id_coverage);
            }
            
            if(isset($_POST['eqvet']) and !empty($_POST['eqvet']))
            {
                $data['eqvet'] = $this->geteqvet($data['harga_kendaraan']);
            }

            if(isset($_POST['tsfwd']) and !empty($_POST['tsfwd']))
            {
                $data['tsfwd'] = $this->gettsfwd($data['harga_kendaraan']);
            }

            if(isset($_POST['tpl']) and !empty($_POST['tpl']))
            {
                $data['valtpl'] = $_POST['tpl'];
                $data['tpl'] = $this->gettpl($_POST['tpl'],'pribadi');
            }

            if(isset($_POST['pad']) and !empty($_POST['pad']))
            {
                $data['valpad'] = $_POST['pad'];
                $data['pad'] = $this->getpad($_POST['pad']);
            }

            if(isset($_POST['pap']) and !empty($_POST['pap']))
            {
                $tpap = 1;
                if(isset($_POST['tpap']) and !empty($_POST['tpap']))
                    $tpap = $_POST['tpap'];

                $data['valpap'] = $_POST['pap'];
                $data['valtpap'] = $_POST['tpap'];
                $data['pap'] = $this->getpap($_POST['pap'], $tpap);
            }
        
        }
        $data['plats'] = $this->mpremikendaraan->getplatkendaraan();

        $this->template();
        if(  ( isset($selisihtahun) and $selisihtahun > 12 and $id_coverage == 1) || ( isset($selisihtahun) and $selisihtahun > 15 and $id_coverage == 2) ) {
            $this->load->view('simulasi/kendaraan_noresult', $data);
        } else {
            $this->load->view('simulasi/kendaraan_assets', $data);
        }
        $this->footer();
        $this->load->view('simulasi/kendaraan_js'); 

    }

    public function index()
    {
        // $this->setsessionbroker();
        if(isset($_POST) and !empty($_POST))
		{
            $yearNow = date("Y");
            $id_plat = $_POST['plat'];
            $id_coverage = $_POST['coverage'];

            
            $selisihtahun = $yearNow - $tahunkendaraan;
            if((($selisihtahun > 12 and $id_coverage == 1) || ($selisihtahun > 15 and $id_coverage == 2))) {
                $this->template();
                $this->load->view('simulasi/no_result', $data);
                $this->footer(); 
                break;
            }
            

            // echo '<pre>'; print_r($_POST); echo '</pre>'; 
            $id_wilayah = $this->mpremikendaraan->getidwilayah($id_plat);
            $id_kategori_kendaraan = $this->mpremikendaraan->getkategorikendaraan($_POST['harga_kendaraan'], "Pribadi");

            $data = [
                'id_wilayah' => $id_wilayah,
                'id_coverage' => $id_coverage,
                'id_kategori_kendaraan' => $id_kategori_kendaraan
            ];

            $data['asuransi'] = $this->mpremikendaraan->getasuransiwithrate($data);
            $data['harga_kendaraan'] = $_POST['harga_kendaraan'];
            $data['tahun_kendaraan'] = $_POST['tahun_kendaraan'];
            $data['idplat'] = $_POST['plat'];

            $data['loading'] = $this->getloading($data['tahun_kendaraan'], $id_coverage);

            if(isset($_POST['srcc']) and !empty($_POST['srcc']))
            {
                $data['srcc'] = $this->getpricesrcc($data['harga_kendaraan'], $id_coverage);
            }

            if(isset($_POST['ts']) and !empty($_POST['ts']))
            {
                $data['ts'] = $this->getpricets($data['harga_kendaraan'], $id_coverage);
            }
            
            if(isset($_POST['eqvet']) and !empty($_POST['eqvet']))
            {
                $data['eqvet'] = $this->geteqvet($data['harga_kendaraan']);
            }

            if(isset($_POST['tsfwd']) and !empty($_POST['tsfwd']))
            {
                $data['tsfwd'] = $this->gettsfwd($data['harga_kendaraan']);
            }

            if(isset($_POST['tpl']) and !empty($_POST['tpl']))
            {
                $data['valtpl'] = $_POST['tpl'];
                $data['tpl'] = $this->gettpl($_POST['tpl'],'pribadi');
            }

            if(isset($_POST['pad']) and !empty($_POST['pad']))
            {
                $data['valpad'] = $_POST['pad'];
                $data['pad'] = $this->getpad($_POST['pad']);
            }

            if(isset($_POST['pap']) and !empty($_POST['pap']))
            {
                $tpap = 1;
                if(isset($_POST['tpap']) and !empty($_POST['tpap']))
                    $tpap = $_POST['tpap'];

                $data['valpap'] = $_POST['pap'];
                $data['valtpap'] = $_POST['tpap'];
                $data['pap'] = $this->getpap($_POST['pap'], $tpap);
            }

            // echo '<pre>'; print_r($asuransi); echo '</pre>';
            // echo '<pre>'; print_r($id_wilayah); echo '</pre>';

        
        }
        $data['plats'] = $this->mpremikendaraan->getplatkendaraan();
        
        $this->template();
        $this->load->view('simulasi/kendaraan', $data);
        $this->footer();

    }
    /* idcoverage
        1 = allrisk
        2 = tlo
    */
    function getloading($tahunkendaraan, $idcoverage) {
        $yearNow = date("Y");
        $selisihtahun = $yearNow - $tahunkendaraan;
        if($selisihtahun <= 5)
            return "0";

        
        if($idcoverage == 2) {
            switch ($selisihtahun) {
                case '6':
                    $rateloading = 0.05;
                    break;
                case '7':
                    $rateloading = 0.05;
                    break;
                case '8':
                    $rateloading = 0.05;
                    break;
                case '9':
                    $rateloading = 0.05;
                    break;
                case '10':
                    $rateloading = 0.05;
                    break;
                case '11':
                    $rateloading = 0.10;
                    break;
                case '12':
                    $rateloading = 0.15;
                    break;
                case '13':
                    $rateloading = 0.20;
                    break;
                case '14':
                    $rateloading = 0.25;
                    break;
                case '15':
                    $rateloading = 0.30;
                    break;
                default:
                    $rateloading = false;
                    break;
            }
        } 
        elseif($idcoverage == 1) {
            switch ($selisihtahun) {
                case '6':
                    $rateloading = 0.05;
                    break;
                case '7':
                    $rateloading = 0.10;
                    break;
                case '8':
                    $rateloading = 0.15;
                    break;
                case '9':
                    $rateloading = 0.20;
                    break;
                case '10':
                    $rateloading = 0.25;
                    break;
                case '11':
                    $rateloading = 0.30;
                    break;
                case '12':
                    $rateloading = 0.35;
                    break;
                default:
                    $rateloading = false;
                    break;
            }
        }

        return $rateloading;
    }


    /* variable up = uang pertanggungan */
    function getpad($up) {
        $pad = (0.5/100) * $up;
        return $pad;
    }

    /* variable up = uang pertanggungan */
    function getpap($up, $totalpenumpang = 1) {
        $pad = ((0.1/100) * $up) * $totalpenumpang;
        return $pad;
    }


    /* variable up = uang pertanggungan */
    function gettpl($up, $kendaraan) {
        if($kendaraan = 'pribadi') {
            if($up > 0 and $up <= 25000000) {
                $percentage = 1/100;
                $tpl = $percentage * $up;
            } elseif ($up > 25000000 and $up <= 50000000) {
                $tpl_1 = (1/100) * 25000000;
                $tpl_2 = (0.5/100) * ($up - 25000000);
                $tpl = $tpl_1 + $tpl_2;
            } elseif ($up > 50000000 and $up <= 100000000) {
                $percentage = 0.25/100;
                $tpl_1 = (1/100) * 25000000;
                $tpl_2 = (0.5/100) * ($up - 25000000);
                $tpl_3 = (0.25/100) * ($up - 50000000);
                $tpl = $tpl_1 + $tpl_2 + $tpl_3;;

            } elseif ($up > 100000000) {
                $tpl = 0;
            }

        }
        return $tpl;
    }

    /* variable harga kendaraan */
    function getpricesrcc($harga, $coverage) {
        if($coverage == 1)
            $srcc = (0.05/100) * $harga;
        elseif ($coverage == 2)
            $srcc = (0.035/100) * $harga;

        return $srcc;
        
    }

    /* variable harga kendaraan */
    function getpricets($harga, $coverage) {
        if($coverage == 1)
            $ts = (0.05/100) * $harga;
        elseif ($coverage == 2)
            $ts = (0.035/100) * $harga;

        return $ts;
        
    }

    /* variable harga kendaraan */
    function geteqvet($harga) {
        $eqvet = (0.1/100) * $harga;
        return $eqvet;
    }

    /* variable harga kendaraan */
    function gettsfwd($harga) {
        $tsfwd = (0.1/100) * $harga;
        return $tsfwd;
    }

    
    
}