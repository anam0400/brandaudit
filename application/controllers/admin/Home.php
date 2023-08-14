<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends AUTH_Controller {
	function __construct()
	{
		parent::__construct();
		// secure_allowed_position(['administrator', 'mahasiswa']);
	}
	
	public function index()
	{
		$data = array(
			'active'		=> 'home',
			'headerTitle'	=> 'Halaman Awal',
			// 'usersHere'		=> $this->M_admin->select('', '', '0', '8', 'Random')
			'num_rows'			=> json_decode($this->api->CallAPI('POST', base_api('/api/v1/_getDashboard?select=num_rows'), false, 'Authorization:'.$this->userdata->data->token))
		);
		$this->backend->views('admin/home', $data);
	}

}
