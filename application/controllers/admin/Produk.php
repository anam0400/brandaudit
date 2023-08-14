<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends AUTH_Controller {
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = array(
			'active'		=> 'produk',
			'headerTitle'	=> 'Produk',
		);

		$this->backend->views('admin/produk/list', $data);
	}

	public function getData()
	{
		$fetch = $this->api->CallAPI('POST', base_api('/api/v1/_getProduk?select=all'), false, 'Authorization:'.$this->userdata->data->token);
		// echo $fetch;
		$fetch = json_decode($fetch);

		if ($fetch->status == 200){
			$data = array(
				'active'		=> 'produk',
				'headerTitle'	=> 'Produk',
				'data'			=> $fetch->data->result
			);
			$arr = array(
				'succ'	=> 1,
				'data'	=> $this->load->view('admin/produk/listData', $data, true),
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

	public function add($kodeBrand = '')
	{
		$data = array(
			'active'		=> 'produk',
			'headerTitle'	=> 'Produk',
			'kodeBrand'		=> $kodeBrand,
			'perusahaan'	=> json_decode($this->api->CallAPI('POST', base_api('/api/v1/_getInstansi?select=all'), ['jenis_instansi'	=> 'perusahaan'], 'Authorization:'.$this->userdata->data->token)),
			'jenis_produk'	=> json_decode($this->api->CallAPI('POST', base_api('/api/v1/_getProdukJenis?select=all'), false, 'Authorization:'.$this->userdata->data->token))
		);
		$this->backend->views('admin/produk/add', $data);
	}

	public function addProccess()
	{
		$data = $this->input->post();
	
		$result = $this->api->CallAPI("PUT", base_api('/api/v1/_getProduk'), $data, 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil ditambahkan."));
			redirect('admin/produk');
		}
		else
		{
	
			$this->session->set_flashdata('msg', swal("err", "Data gagal ditambahkan.".$result->message));
			redirect('admin/produk/add');
		}
	}

	public function edit($id = null)
	{
		$data = array(
			'active'		=> 'produk',
			'headerTitle'	=> 'Produk',
			'id'			=> $id,
			'data'			=> json_decode($this->api->CallAPI("POST", base_api('/api/v1/_getProduk?select=one'), ['id' => $id], 'Authorization:'.$this->userdata->data->token)),
			'perusahaan'	=> json_decode($this->api->CallAPI('POST', base_api('/api/v1/_getInstansi?select=all'), ['jenis_instansi'	=> 'perusahaan'], 'Authorization:'.$this->userdata->data->token)),
			'jenis_produk'	=> json_decode($this->api->CallAPI('POST', base_api('/api/v1/_getProdukJenis?select=all'), false, 'Authorization:'.$this->userdata->data->token))
		);
		$this->backend->views('admin/produk/edit', $data);
	}

	public function editProccess($id = null)
	{
		$data = $this->input->post();
		$data['id'] = $id;
		

		$result = $this->api->CallAPI("PATCH", base_api('/api/v1/_getProduk'), $data, 'Authorization:'.$this->userdata->data->token);
		
		$result = json_decode($result);


		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil diubah."));
			redirect('admin/produk');
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal diubah.".$result->message));
			redirect('admin/produk/edit/'.$data['id']);
		}
	}

	public function delete($id = null)
	{
		$result = $this->api->CallAPI("DELETE", base_api('/api/v1/_getProduk'), ['id' => $id], 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil dihapus."));
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal dihapus."));
		}
		
		redirect('admin/produk');
	}


}
