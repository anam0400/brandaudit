<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maps extends AUTH_Controller {
	function __construct()
	{
		parent::__construct();
		// secure_allowed_position(['administrator', 'mahasiswa']);
	}
	
	public function index()
	{
		$data = array(
			'active'		=> 'maps',
			'headerTitle'	=> 'Maps',
			// 'usersHere'		=> $this->M_admin->select('', '', '0', '8', 'Random')
		);
		$this->backend->views('admin/maps', $data);
	}

}