<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . "/vendor/autoload.php";
class Scan extends AUTH_Controller {
	function __construct()
	{
		parent::__construct();
		if (@!$this->input->cookie('lokasiCookies')){
			
			$this->session->set_flashdata('msg', swal("warning", "Silahkan pilih lokasi Clean Up terlebih dahulu"));
			redirect('admin/home');
		}
		// secure_allowed_position(['administrator', 'mahasiswa']);
	}
	
	public function index()
	{
		$data = array(
			'active'		=> 'scan',
			'headerTitle'	=> 'Scanner',
			// 'usersHere'		=> $this->M_admin->select('', '', '0', '8', 'Random')
		);
		$this->backend->views('admin/scan', $data);
	}

	function cekQR()
	{
		$date = date('dMYHis');
		$imageData=$this->input->post('cat');
		$path 		= FCPATH."assets/qrcodescansemi/";


		if (!empty($this->input->post('cat'))) {
			error_log("Received" . "\r\n", 3, $path."Log.log");
		}

		$filteredData=substr($imageData, strpos($imageData, ",")+1);
		// $files = "data:image/png;base64,".$filteredData;


		$unencodedData=base64_decode($filteredData);
		// echo $unencodedData;
		// var_dump($this->userdata);	
		$fileName 	= $this->userdata->data->result->id_user.'qrcode'.$date.'.png';
		// echo $fileName;
		$fp = fopen( $path.$fileName, 'wb' );
		fwrite( $fp, $unencodedData);
		fclose( $fp );

		$paths = $path.$fileName;
		$type = pathinfo($paths, PATHINFO_EXTENSION);
		$data = file_get_contents($paths);
		$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

		// echo $base64;

		$data = $this->api->CallAPI_THIRD('POST', "https://api.products.aspose.app/barcode/recognize/apiRequestRecognize" , ['type' => '', 'quality'	=> 2, 'fileBase64' => $base64]);
		
		$data = json_decode($data);

		// var_dump($data);
		if ($data->success == true){
			
			$url = "https://api.products.aspose.app/barcode/recognize/recognizeresult/".$data->recognizeResultToken."?timeout=".time();

			$arr = array(
				'status' 	=> 200,
				'data'		=> array(
					'kode_brand'	=> "-",
					'brandCount'	=> 0,
					'recognizeResultTokenCount'	=> 1,
					'recognizeResultToken'	=> @$data->recognizeResultToken,
					'urlRecognizeResultToken'=> @$url,
				),
				'errCode'	=> NULL,
				'message'	=> 'recognizeResultToken berhasil didapatkan.'
			);			
		}else{
			// unlink($paths);
			$arr = array(
				'status' 	=> 200,
				'data'		=> array(
					'kode_brand'	=> "-",
					'brandCount'	=> 0,
					'recognizeResultTokenCount'	=> 0,
					'recognizeResultToken'	=> null,
					'urlRecognizeResultToken'=> null,
				),
				'errCode'	=> 'E-100',
				'message'	=> 'Pengiriman request gagal.'
			);
		}
		
		echo json_encode($arr);
	}

	public function getKodeBrand($kode = ''){
		if (@$this->input->cookie('lokasiCookies')){
			$cookies = $this->input->cookie('lokasiCookies');
			$cookies = explode(";", $cookies);
		}
		$data = $this->input->post();
		$data['recognizeResultToken'] = $kode;
		$url = "https://api.products.aspose.app/barcode/recognize/recognizeresult/".$data['recognizeResultToken']."?timeout=".time();
		$result = $this->api->CallAPI_THIRD('GET', $data['url']);
		// echo $result;
		$result = json_decode($result);

		if ($result->ready === true){
			if ($result->foundBarcodesCount == 1){
				preg_match("~<textarea*.*>(.*?)</textarea>~", $result->html, $result);

				if (count($result) > 1){
					$dataProduk = $this->api->CallAPI('POST', base_api('/api/v1/_getProduk?select=one'), array('kode_brand' => $result[1]), 'Authorization:'.$this->userdata->data->token);
					$dataProduk = json_decode($dataProduk);
					if($dataProduk->data->foundBrandsCount > 0){
						// Proses simpan data
							
						$arr = array(
							'produk_id'	=> $dataProduk->data->result->id,
							'jumlah'	=> 1,
							'berat'		=> 0.5,
							'lokasi'	=> $cookies[1],
							'latitude'	=> $cookies[2],
							'longitude'	=> $cookies[3],
							'catatan'	=> '',
						);
						$res = $this->api->CallAPI('PUT', base_api('/api/v1/_getKumpulSampah'), $arr, 'Authorization:'.$this->userdata->data->token);
						$res = json_decode($res);

						$arr = array(
							'status' 	=> 200,
							'data'		=> array(
								'kode_brand'	=> $result[1],
								'brandCount'	=> 1,
								'recognizeResultToken'	=> @$data['recognizeResultToken'],
								'urlRecognizeResultToken'=> @$url,
							),
							'errCode'	=> NULL,
							'message'	=> swal("succ", 'Produk berhasil discan.'.$dataProduk->data->result->id)
						); 
					}else{ 
						// unlink($paths);
						$arr = array(
							'status' 	=> 200,
							'data'		=> array(
								'kode_brand'	=> $result[1],
								'brandCount'	=> 0,
								'recognizeResultToken'	=> @$data['recognizeResultToken'],
								'urlRecognizeResultToken'=> @$url,
							),
							'errCode'	=> 'E-103',
							'message'	=> 'Produk tidak terdaftar di database.'
						);
					}
				}
			}else{
				// unlink($paths);
				$arr = array(
					'status' 	=> 200,
					'data'		=> array(
						'kode_brand'	=> "-",
						'brandCount'	=> 0,
						'recognizeResultToken'	=> @$data['recognizeResultToken'],
						'urlRecognizeResultToken'=> @$url,
					),
					'errCode'	=> 'E-102',
					'message'	=> 'Barcode tidak ditemukan.'
				);
			}
		}else{
			// unlink($paths);
			$arr = array(
				'status' 	=> 200,
				'data'		=> array(
					'kode_brand'	=> "-",
					'brandCount'	=> 0,
					'recognizeResultToken'	=> @$data['recognizeResultToken'],
					'urlRecognizeResultToken'=> @$url,
				),
				'errCode'	=> 'E-101',
				'message'	=> 'Barcode gagal dicapture.',
				'response'	=> json_encode($result)
			);
		}
		
		echo json_encode($arr);
	}

}