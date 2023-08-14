<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instansi extends AUTH_Controller {
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = array(
			'active'		=> 'instansi',
			'headerTitle'	=> 'Instansi',
		);

		$this->backend->views('admin/instansi/list', $data);
	}

	public function getData()
	{
		$fetch = $this->api->CallAPI('POST', base_api('/api/v1/_getInstansi?select=all'), false, 'Authorization:'.$this->userdata->data->token);
		// echo $fetch;
		$fetch = json_decode($fetch);

		if ($fetch->status == 200){
			$data = array(
				'active'		=> 'instansi',
				'headerTitle'	=> 'Instansi',
				'data'			=> $fetch->data->result
			);
			$arr = array(
				'succ'	=> 1,
				'data'	=> $this->load->view('admin/instansi/listData', $data, true),
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
			'active'		=> 'instansi',
			'headerTitle'	=> 'Instansi',
		);
		$this->backend->views('admin/instansi/add', $data);
	}

	public function addProccess()
	{
		$data = $this->input->post();
		$data['user_id']	= $this->userdata->data->result->id_user;
	
		$result = $this->api->CallAPI("PUT", base_api('/api/v1/_getInstansi'), $data, 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){
		
			$this->session->set_flashdata('msg', swal("succ", "Data berhasil ditambahkan."));
			redirect('admin/instansi');
		}
		else
		{
		
			$this->session->set_flashdata('msg', swal("err", "Data gagal ditambahkan."));
			redirect('admin/instansi/add');
		}
	}

	public function edit($id = null)
	{
		$data = array(
			'active'		=> 'instansi',
			'headerTitle'	=> 'Instansi',
			'id'			=> $id,
			'data'			=> json_decode($this->api->CallAPI("POST", base_api('/api/v1/_getInstansi?select=one'), ['id' => $id], 'Authorization:'.$this->userdata->data->token))
		);
		$this->backend->views('admin/instansi/edit', $data);
	}

	public function editProccess($id = null)
	{
		$data = $this->input->post();
		$data['id'] = $id;

		$result = $this->api->CallAPI("PATCH", base_api('/api/v1/_getInstansi'), $data, 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil diubah."));
			redirect('admin/instansi');
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal diubah."));
			redirect('admin/instansi/edit/'.$data['id']);
		}
	}

	public function delete($id = null)
	{
		$result = $this->api->CallAPI("DELETE", base_api('/api/v1/_getInstansi'), ['id' => $id], 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil dihapus."));
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal dihapus."));
		}
		
		redirect('admin/instansi');
	}


}
