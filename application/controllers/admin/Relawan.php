<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Relawan extends AUTH_Controller {
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = array(
			'active'		=> 'relawan',
			'headerTitle'	=> 'Relawan',
		);

		$this->backend->views('admin/relawan/list', $data);
	}

	public function getData()
	{
		$fetch = $this->api->CallAPI('POST', base_api('/api/v1/_getRelawan?select=all'), false, 'Authorization:'.$this->userdata->data->token);
		// echo $fetch;
		$fetch = json_decode($fetch);

		if ($fetch->status == 200){
			$data = array(
				'active'		=> 'relawan',
				'headerTitle'	=> 'Relawan',
				'data'			=> $fetch->data->result
			);
			$arr = array(
				'succ'	=> 1,
				'data'	=> $this->load->view('admin/relawan/listData', $data, true),
				'message'=> 'Data berhasil diambil.'
			);
			
		}else{
			$arr = array(
				'succ'	=> 0,
				'data'	=> '',
				'message'=> 'Data gagal diambil.'
			);
		}

		echo json_encode($arr);
	}

	public function add()
	{
		$data = array(
			'active'		=> 'relawan',
			'headerTitle'	=> 'Relawan',
			'organisasi'	=> json_decode($this->api->CallAPI('POST', base_api('/api/v1/_getInstansi?select=all'), ['jenis_instansi'	=> 'organisasi'], 'Authorization:'.$this->userdata->data->token))
		);
		$this->backend->views('admin/relawan/add', $data);
	}

	public function addProccess()
	{
		$data = $this->input->post();
		$data['user_id']	= $this->userdata->data->result->id_user;

		if ($data['jenis_relawan'] == "perorangan"){
			$data['instansi_nama'] = "";
		}
		

		$result = $this->api->CallAPI("PUT", base_api('/api/v1/_getRelawan'), $data, 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){
		
			$this->session->set_flashdata('msg', swal("succ", "Data berhasil ditambahkan."));
			redirect('admin/relawan');
		}
		else
		{
	
			$this->session->set_flashdata('msg', swal("err", "Data gagal ditambahkan.".$result->message));
			redirect('admin/relawan/add');
		}
	}

	public function edit($id = null)
	{
		$data = array(
			'active'		=> 'relawan',
			'headerTitle'	=> 'Relawan',
			'id'			=> $id,
			'data'			=> json_decode($this->api->CallAPI("POST", base_api('/api/v1/_getRelawan?select=one'), ['id_relawan' => $id], 'Authorization:'.$this->userdata->data->token)),
			'organisasi'	=> json_decode($this->api->CallAPI('POST', base_api('/api/v1/_getInstansi?select=all'), ['jenis_instansi'	=> 'organisasi'], 'Authorization:'.$this->userdata->data->token))
		);
		$this->backend->views('admin/relawan/edit', $data);
	}

	public function editProccess($id = null)
	{
		$data = $this->input->post();
		$data['id'] = $id;
		
		if ($data['jenis_relawan'] == "perorangan"){
			$data['instansi_nama'] = "null";
		}

		$result = $this->api->CallAPI("PATCH", base_api('/api/v1/_getRelawan'), $data, 'Authorization:'.$this->userdata->data->token);
		
		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil diubah."));
			redirect('admin/relawan');
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal diubah.".$result->message));
			redirect('admin/relawan/edit/'.$data['id']);
		}
	}

	public function delete($id = null)
	{
		$result = $this->api->CallAPI("DELETE", base_api('/api/v1/_getRelawan'), ['id' => $id], 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil dihapus."));
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal dihapus."));
		}
		
		redirect('admin/relawan');
	}


}
