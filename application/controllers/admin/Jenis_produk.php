<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_produk extends AUTH_Controller {
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = array(
			'active'		=> 'jenis produk',
			'headerTitle'	=> 'Jenis Produk',
		);

		$this->backend->views('admin/jenis_produk/list', $data);
	}

	public function getData()
	{
		$fetch = $this->api->CallAPI('POST', base_api('/api/v1/_getProdukJenis?select=all'), false, 'Authorization:'.$this->userdata->data->token);
		// echo $fetch;
		$fetch = json_decode($fetch);

		if ($fetch->status == 200){
			$data = array(
				'active'		=> 'jenis produk',
				'headerTitle'	=> 'Jenis Produk',
				'data'			=> $fetch->data->result
			);
			$arr = array(
				'succ'	=> 1,
				'data'	=> $this->load->view('admin/jenis_produk/listData', $data, true),
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
			'active'		=> 'jenis produk',
			'headerTitle'	=> 'Jenis Produk',
		);
		$this->backend->views('admin/jenis_produk/add', $data);
	}

	public function addProccess()
	{
		$data = $this->input->post();
		$data['user_id']	= $this->userdata->data->result->id_user;
	
		$result = $this->api->CallAPI("PUT", base_api('/api/v1/_getProdukJenis'), $data, 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){
		
			$this->session->set_flashdata('msg', swal("succ", "Data berhasil ditambahkan."));
			redirect('admin/jenis_produk');
		}
		else
		{
		
			$this->session->set_flashdata('msg', swal("err", "Data gagal ditambahkan."));
			redirect('admin/jenis_produk/add');
		}
	}

	public function edit($id = null)
	{
		$data = array(
			'active'		=> 'jenis produk',
			'headerTitle'	=> 'Jenis Produk',
			'id'			=> $id,
			'data'			=> json_decode($this->api->CallAPI("POST", base_api('/api/v1/_getProdukJenis?select=one'), ['id' => $id], 'Authorization:'.$this->userdata->data->token))
		);
		$this->backend->views('admin/jenis_produk/edit', $data);
	}

	public function editProccess($id = null)
	{
		$data = $this->input->post();
		$data['id'] = $id;

		$result = $this->api->CallAPI("PATCH", base_api('/api/v1/_getProdukJenis'), $data, 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil diubah."));
			redirect('admin/jenis_produk');
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal diubah."));
			redirect('admin/jenis_produk/edit/'.$data['id']);
		}
	}

	public function delete($id = null)
	{
		$result = $this->api->CallAPI("DELETE", base_api('/api/v1/_getProdukJenis'), ['id' => $id], 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil dihapus."));
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal dihapus."));
		}
		
		redirect('admin/jenis_produk');
	}


}
