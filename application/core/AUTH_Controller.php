<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AUTH_Controller extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->library('API');
		$this->load->model('M_admin');
	    $this->load->library('ciqrcode');
		date_default_timezone_set('asia/jakarta');

		$this->session->set_flashdata('segment', explode('/', $this->uri->uri_string()));
		if ($this->session->userdata('status') == '') {
			redirect('Auth');
		}else{
			$data = $this->api->CallAPI('POST', base_api('/api/v1/_getUsers?select=one') , ['username' => $this->session->userdata('userdata')['username']], 'Authorization:'. $this->session->userdata('userdata')['auth']->data->token);
			// echo $data;
			$data = json_decode($data);

			if ($data->status == 401){
				$this->session->sess_destroy();
				redirect('Auth');
			}else{
				$this->session->userdata('userdata')['auth']->data->token = $data->data->token;

				$this->userdata = $data;
			}
			
		}
	}

}

/* End of file MY_Auth.php */
/* Location: ./application/core/MY_Auth.php */