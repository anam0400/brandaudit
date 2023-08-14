<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		if ($this->session->userdata('status') != null) {
			redirect('admin/home');
		} else {
			$this->load->view('login');
		}
	}

	public function secure()
	{
		$data = $this->input->post();
		$username = trim($data['email']);
		$password = trim($data['password']);

		$data = $this->api->CallAPI('POST', base_api('/api/v1/_getAuth'), ['username' => $username, 'password' => $password]);
		// var_dump($data);
		$data = json_decode($data);
		if ($data->status == "200") {
			date_default_timezone_set('Asia/Jakarta');
			$session = [
				'userdata'	=> array(
					'auth'		=> $data,
					'username'	=> $username
				),
				'status' 	=> "Loged in"
			];

			$this->session->set_userdata('file_manager', true);
			$this->session->set_userdata($session);
			if (@$this->input->get('redirect')) {
				$redirect = $this->input->get('redirect');
				// if (strtolower($redirect) == "aspirations"){
				// 	redirect('Administrator/Aspirations');
				// }
			} else {
				$data->data->redirect = "admin/home";
			}
		}

		echo json_encode($data);
	}

	public function signout()
	{
		$this->session->sess_destroy();
		redirect('auth');
	}
}
