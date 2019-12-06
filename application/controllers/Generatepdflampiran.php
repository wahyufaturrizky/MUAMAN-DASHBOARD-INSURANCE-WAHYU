<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class generatepdflampiran extends CI_Controller {

	public function download()
	{
		$this->load->model('polis/bulkpurchase/mbulkpurchase');
		$getpolisdata = $this->mbulkpurchase->getpolispdf(
			base64_decode($this->input->get('nopolis')),
			base64_decode($this->input->get('nodetail'))
		);

		foreach ($getpolisdata->result() as $k) {
			$pemegang = $k->pemegang_polis;
			$periode = explode("-",$k->periode_start);
			if($periode[1]=='01'){
				$bulan = 'Januari';
			}elseif($periode[1]=='02'){
				$bulan = 'Februari';
			}elseif($periode[1]=='03'){
				$bulan = 'Maret';
			}elseif($periode[1]=='04'){
				$bulan = 'April';
			}elseif($periode[1]=='05'){
				$bulan = 'Mei';
			}elseif($periode[1]=='06'){
				$bulan = 'Juni';
			}elseif($periode[1]=='07'){
				$bulan = 'Juli';
			}elseif($periode[1]=='08'){
				$bulan = 'Agustus';
			}elseif($periode[1]=='09'){
				$bulan = 'September';
			}elseif($periode[1]=='10'){
				$bulan = 'Oktober';
			}elseif($periode[1]=='11'){
				$bulan = 'November';
			}elseif($periode[1]=='12'){
				$bulan = 'Desember';
			}

			// $jamkridapersen =0;
			// $intraasiapersen =0;
			// $reliancepersen = 0;
			// $mitrapersen = 0;
			// $bumidapersen =0;
			// $bnilifepersen =0;
			// $syariahpersen =0;
			// if($k->asuransi == 'PT. Jamkrida Jabar'){
			// 	$jamkridapersen = 100;
			// }elseif($k->asuransi == 'PT. Asuransi Intra Asia'){
			// 	$intraasiapersen = 100;
			// }elseif($k->asuransi == 'PT. Asuransi Jiwa Reliance Indonesia'){
			// 	$reliancepersen = 100;
			// }elseif($k->asuransi == 'PT. Asuransi Jasa Mitra Abadi (JMA)'){
			// 	$mitrapersen = 100;
			// }elseif($k->asuransi == 'PT. Bumida'){
			// 	$bumidapersen = 100;
			// }elseif($k->asuransi == 'PT. BNI Life Syariah Insurance'){
			// 	$bnilifepersen = 100;
			// }elseif($k->asuransi == 'PT. Asuransi Syariah Keluarga Indonesia'){
			// 	$syariahpersen = 100;
			// }
		}

		$getpurchasedata = $this->mbulkpurchase->getpurchasepdf(
			base64_decode($this->input->get('id_purchase'))
		);

		$pertanggungan=0;
		$premi = 0;
		foreach ($getpurchasedata->result() as $b) {
			$header = explode("|", $b->headerform);
			$datamember = explode("|", $b->data);
            for ($i=0; $i < count($header) ; $i++) {

	            if($header[$i] == 'Manfaat Asuransi Awal'){ 
	                $indexpertanggungan = $i;
	            }elseif($header[$i] == 'Kontribusi '){
	                $indexpremi = $i;
	            }
	        }
	        // echo $indexpertanggungan;
	        // echo $indexpremi;
	        // exit();
	        $pertanggungan = $pertanggungan+$datamember[$indexpertanggungan];
	        $premi = $premi + $datamember[$indexpremi];
		}

		$tglsekarang = date('d F Y');

		//$this->load->library('pdfgenerator');
		$data = array(
			"no_sertifikat" => base64_decode($this->input->get('nopolis')),
			"header" => $header,
			"pemegang" => $pemegang,
			"periode" => $bulan.' '.$periode[0],
			"premi" => $premi,
			"pertanggungan" => $pertanggungan,
			"purchase_data" => $getpurchasedata,
			"tglsekarang" => $tglsekarang
		);
 
	    $html = $this->load->view('generatepdflampiran',$data);
	    
	    //$this->pdfgenerator->generate($html,'contoh');
	}

}

/* End of file controllername.php */
/* Location: ./application/controllers/controllername.php */