<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends AUTH_Controller {
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = array(
			'active'		=> 'pengguna',
			'headerTitle'	=> 'Pengguna',
		);

		$this->backend->views('admin/pengguna/list', $data);
	}

	public function getData()
	{
		$fetch = $this->api->CallAPI('POST', base_api('/api/v1/_getUsers?select=all'), false, 'Authorization:'.$this->userdata->data->token);
		// echo $fetch;
		$fetch = json_decode($fetch);

		if ($fetch->status == 200){
			$data = array(
				'active'		=> 'pengguna',
				'headerTitle'	=> 'pengguna',
				'data'			=> $fetch->data->result
			);
			$arr = array(
				'succ'	=> 1,
				'data'	=> $this->load->view('admin/pengguna/listData', $data, true),
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
			'active'		=> 'pengguna',
			'headerTitle'	=> 'pengguna',
		);
		$this->backend->views('admin/pengguna/add', $data);
	}

	public function addProccess()
	{
		$data = $this->input->post();
	
		$result = $this->api->CallAPI("PUT", base_api('/api/v1/_getUsers'), $data, 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){
		
			$this->session->set_flashdata('msg', swal("succ", "Data berhasil ditambahkan."));
			redirect('admin/pengguna');
		}
		else
		{
	
			$this->session->set_flashdata('msg', swal("err", "Data gagal ditambahkan."));
			redirect('admin/pengguna/add');
		}
	}

	public function edit($id = null)
	{
		$data = array(
			'active'		=> 'pengguna',
			'headerTitle'	=> 'pengguna',
			'id'			=> $id,
			'data'			=> json_decode($this->api->CallAPI("POST", base_api('/api/v1/_getUsers?select=one'), ['id_user' => $id], 'Authorization:'.$this->userdata->data->token))
		);
		$this->backend->views('admin/pengguna/edit', $data);
	}

	public function editProccess($id = null)
	{
		$data = $this->input->post();
		$data['id'] = $id;

		$result = $this->api->CallAPI("PATCH", base_api('/api/v1/_getUsers'), $data, 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil diubah."));
			redirect('admin/pengguna');
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal diubah.".$result->message));
			redirect('admin/pengguna/edit/'.$data['id']);
		}
	}

	public function delete($id = null)
	{
		$result = $this->api->CallAPI("DELETE", base_api('/api/v1/_getUsers'), ['id' => $id], 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil dihapus."));
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal dihapus."));
		}
		
		redirect('admin/pengguna');
	}


}
