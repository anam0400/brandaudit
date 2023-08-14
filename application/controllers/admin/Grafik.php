<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik extends AUTH_Controller {
	function __construct()
	{
		parent::__construct();
		// secure_allowed_position(['administrator', 'mahasiswa']);
	}
	
	public function index()
	{
		$data = array(
			'active'		=> 'grafik',
			'headerTitle'	=> 'Halaman Grafik',
			// 'usersHere'		=> $this->M_admin->select('', '', '0', '8', 'Random')
		);

		if (@$_GET){
			$get = $_GET;
			$data['num_rows']	=  json_decode($this->api->CallAPI('POST', base_api('/api/v1/_getGrafik'), ['lokasi' => $get['lokasi']], 'Authorization:'.$this->userdata->data->token));
		}else{
			$data['num_rows']	=  json_decode($this->api->CallAPI('POST', base_api('/api/v1/_getGrafik'), false, 'Authorization:'.$this->userdata->data->token));
		}
		$this->backend->views('admin/grafik', $data);
	}

}
