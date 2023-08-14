<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CookiesLoc extends AUTH_Controller {
	public function index()
	{ 
        $this->load->helper('cookie');

		$data	=	$this->input->post();
		$lokasi = $this->api->CallAPI('POST', base_api('/api/v1/_getLokasi?select=one'), ['id' => $data['id']], 'Authorization:'.$this->userdata->data->token);

		
		$fetch = json_decode($lokasi);

		if ($fetch->status == 200){
			$cookie = array(
				'name'   => 'lokasiCookies',
				'value'  => $fetch->data->result->id.";".$fetch->data->result->lokasi_nama.";".$fetch->data->result->latitude.";".$fetch->data->result->longitude,
				'expire' => time()+'86400',                                                                                   
				'secure' => TRUE
				);
			
			$result = $this->input->set_cookie($cookie);
			
			$arr = array(
				'succ'	=> 1,
				'data'	=> '',
				'message'=> swal("succ", 'Cookies berhasil disimpan.')
			);
		}else{
			$arr = array(
				'succ'	=> 0,
				'data'	=> '',
				'message'=> swal("err", 'Data gagal diambil.')
			);
		}

		echo json_encode($arr);
	}

	public function delCookies()
	{
		$this->load->helper('cookie');
		delete_cookie("lokasiCookies");

		redirect('admin/scan');
	}
}
?>