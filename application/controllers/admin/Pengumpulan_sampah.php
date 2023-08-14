<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengumpulan_sampah extends AUTH_Controller {
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = array(
			'active'		=> 'pengumpulan sampah',
			'headerTitle'	=> 'Pengumpulan Sampah',
		);

		$data['num_rows'] = json_decode($this->api->CallAPI('POST', base_api('/api/v1/_getKumpulSampah'), ['group_by' => 'produk_id, lokasi'], 'Authorization:'.$this->userdata->data->token));
		
		$this->backend->views('admin/pengumpulan_sampah/list', $data);
	}

	public function getData()
	{
		$fetch = $this->api->CallAPI('POST', base_api('/api/v1/_getKumpulSampah?select=all&group_by=active&select=sum&column=jumlah'), ['group_by' => 'produk_id, lokasi'], 'Authorization:'.$this->userdata->data->token);
		
		$data['num_rows']	=  json_decode($this->api->CallAPI('POST', base_api('/api/v1/_getGrafik'), false, 'Authorization:'.$this->userdata->data->token));
		
		// echo $fetch;
	
		$fetch = json_decode($fetch);

		if ($fetch->status == 200){
			$data = array(
				'active'		=> 'pengumpulan sampah',
				'headerTitle'	=> 'Pengumpulan Sampah',
				'data'			=> $fetch->data->result,
				'dataRows'		=> $data['num_rows']
			);
			$arr = array(
				'succ'	=> 1,
				'data'	=> $this->load->view('admin/pengumpulan_sampah/listData', $data, true),
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
		
		if (@!$this->input->cookie('lokasiCookies')){
			
			$this->session->set_flashdata('msg', swal("warning", "Silahkan pilih lokasi Clean Up terlebih dahulu"));
			redirect('admin/home');
		}
		$data = array(
			'active'		=> 'pengumpulan sampah',
			'headerTitle'	=> 'Pengumpulan Sampah',
			'produk'		=> json_decode($this->api->CallAPI('POST', base_api('/api/v1/_getProduk?select=all'), false, 'Authorization:'.$this->userdata->data->token)),
		);
		$this->backend->views('admin/pengumpulan_sampah/add', $data);
	}

	public function cekData()
	{
		$data = $this->input->get();
		$dataProduk = $this->api->CallApi('POST', base_api('/api/v1/_getProduk?select=one'), ['kode_brand'=> $data['kode_brand']], 'Authorization:'.$this->userdata->data->token);

		$dataProduk = json_decode($dataProduk);
		if ($dataProduk->data->foundBrandsCount > 0){
			$arr = array(
				'status'			=> 200,
				'foundBrandsCount'	=> $dataProduk->data->foundBrandsCount,
				'data'				=> $dataProduk->data->result,
				'message'			=> swal("succ", 'Data produk ditemukan.')
			);
		}else{
			$arr = array(
				'status'			=> 200,
				'foundBrandsCount'	=> 0,
				'data'				=> null,
				'message'			=> swal("err", 'Data produk tidak ditemukan.')
			);
		}

		echo json_encode($arr);
	}

	public function addProccess()
	{
		if (@$this->input->cookie('lokasiCookies')){
			$cookies = $this->input->cookie('lokasiCookies');
			$cookies = explode(";", $cookies);
		}
		$data = $this->input->post();

		$dataProduk = $this->api->CallAPI('POST', base_api('/api/v1/_getProduk?select=one'), array('kode_brand' => $data['kode_brand']), 'Authorization:'.$this->userdata->data->token);
		$dataProduk = json_decode($dataProduk);
		if($dataProduk->data->foundBrandsCount > 0){
						// Proses simpan data
							
			$arr = array(
				'produk_id'	=> $dataProduk->data->result->id,
				'jumlah'	=> $data['jumlah'],
				'lokasi'	=> $cookies[1],
				'latitude'	=> $cookies[2],
				'longitude'	=> $cookies[3],
			);
			$res = $this->api->CallAPI('PUT', base_api('/api/v1/_getKumpulSampah'), $arr, 'Authorization:'.$this->userdata->data->token);
			
			$res = json_decode($res);


			$this->session->set_flashdata('msg', swal("succ", "Data berhasil discan."));
		}else{ 
			$this->session->set_flashdata('msg', swal("err", "Data gagal ditambahkan.".$dataProduk->message));
		}

		redirect('admin/pengumpulan_sampah/add');
	}

	public function edit($id_pengumpulan = '')
	{
		$data = array(
			'active'		=> 'pengumpulan sampah',
			'headerTitle'	=> 'Pengumpulan Sampah',
			'id_pengumpulan'=> $id_pengumpulan,
			'data'			=> json_decode($this->api->CallAPI("POST", base_api('/api/v1/_getKumpulSampah?select=one'), ['id_pengumpulan' => $id_pengumpulan], 'Authorization:'.$this->userdata->data->token))
		);
		$this->backend->views('admin/pengumpulan_sampah/edit', $data);
	}

	public function editProccess($id_pengumpulan = '')
	{
		$data = $this->input->post();
		$data['id_pengumpulan'] = $id_pengumpulan;

		$result = $this->api->CallAPI("PATCH", base_api('/api/v1/_getKumpulSampah'), $data, 'Authorization:'.$this->userdata->data->token);
		
		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil diubah."));
			redirect('admin/pengumpulan_sampah');
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal diubah.".$result->message));
			redirect('admin/pengumpulan_sampah/edit/'.$data['id_pengumpulan']);
		}
	}

	public function delete($id_pengumpulan = null)
	{
		$result = $this->api->CallAPI("DELETE", base_api('/api/v1/_getKumpulSampah'), ['id' => $id_pengumpulan], 'Authorization:'.$this->userdata->data->token);
		echo $result;
		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil dihapus."));
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal dihapus."));
		}
		
		redirect('admin/pengumpulan_sampah');
	}


}
