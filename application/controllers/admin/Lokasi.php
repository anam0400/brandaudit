<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends AUTH_Controller {
	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$data = array(
			'active'		=> 'lokasi',
			'headerTitle'	=> 'Lokasi',
		);

		$this->backend->views('admin/lokasi/list', $data);
	}

	public function getData()
	{
		$fetch = $this->api->CallAPI('POST', base_api('/api/v1/_getLokasi?select=all'), false, 'Authorization:'.$this->userdata->data->token);
		// echo $fetch;
		$fetch = json_decode($fetch);

		if ($fetch->status == 200){
			$data = array(
				'active'		=> 'lokasi',
				'headerTitle'	=> 'Lokasi',
				'data'			=> $fetch->data->result
			);
			$arr = array(
				'succ'	=> 1,
				'data'	=> $this->load->view('admin/lokasi/listData', $data, true),
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
			'active'		=> 'lokasi',
			'headerTitle'	=> 'Lokasi',
		);
		$this->backend->views('admin/lokasi/add', $data);
	}

	public function addProccess()
{
    $data = $this->input->post();

    // Proses upload image
    if ($_FILES['image']['name']) {
        $config['upload_path'] = './upload/lokasi/'; // Ubah path sesuai dengan folder tempat Anda ingin menyimpan image
        $config['allowed_types'] = 'jpg|jpeg|png|gif';
        $config['max_size'] = 2048; // Batasan ukuran file dalam kilobita (KB)

        $this->load->library('upload', $config);
		$this->upload->initialize($config);

        if (!$this->upload->do_upload('image')) {
            // Jika upload gagal, tampilkan pesan error
            $error = $this->upload->display_errors();
            $this->session->set_flashdata('msg', swal("err", $error));
            redirect('admin/lokasi/add');
            return;
        }

        $file_data = $this->upload->data();
        $file_path = $file_data['file_name'];

        // Simpan data image ke database atau proses lainnya
        $data['image'] = $file_path;
    }

    $result = $this->api->CallAPI("PUT", base_api('/api/v1/_getLokasi'), $data, 'Authorization:'.$this->userdata->data->token);
    $result = json_decode($result);

    if ($result->status == 200){
        $this->session->set_flashdata('msg', swal("succ", "Data berhasil ditambahkan."));
        redirect('admin/lokasi');
    } else {
        $this->session->set_flashdata('msg', swal("err", "Data gagal ditambahkan."));
        redirect('admin/lokasi/add');
    }
}

	// public function addProccess()
	// {
	// 	$data = $this->input->post();
	
	// 	$result = $this->api->CallAPI("PUT", base_api('/api/v1/_getLokasi'), $data, 'Authorization:'.$this->userdata->data->token);

	// 	$result = json_decode($result);

	// 	if ($result->status == 200){
		
	// 		$this->session->set_flashdata('msg', swal("succ", "Data berhasil ditambahkan."));
	// 		redirect('admin/lokasi');
	// 	}
	// 	else
	// 	{
		
	// 		$this->session->set_flashdata('msg', swal("err", "Data gagal ditambahkan."));
	// 		redirect('admin/lokasi/add');
	// 	}
	// }

	public function edit($id = null)
	{
		$data = array(
			'active'		=> 'lokasi',
			'headerTitle'	=> 'Lokasi',
			'id'			=> $id,
			'data'			=> json_decode($this->api->CallAPI("POST", base_api('/api/v1/_getLokasi?select=one'), ['id' => $id], 'Authorization:'.$this->userdata->data->token))
		);
		$this->backend->views('admin/lokasi/edit', $data);
	}

	public function editProccess($id = null)
	{
		$data = $this->input->post();
		$data['id'] = $id;
		
		$result = $this->api->CallAPI("GET", base_api('/api/v1/_getLokasi'), $data, 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);
		
		// Proses upload gambar
        if ($_FILES['image']['name']) {
            $config['upload_path'] = './upload/lokasi/'; // Ubah path sesuai dengan folder tempat Anda ingin menyimpan gambar
            $config['allowed_types'] = 'jpg|jpeg|png|gif';
            $config['max_size'] = 2048; // Batasan ukuran file dalam kilobita (KB)

            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if (!$this->upload->do_upload('image')) {
                // Jika upload gagal, tampilkan pesan error
                $error = $this->upload->display_errors();
                $this->session->set_flashdata('msg', swal("err", $error));
                redirect('admin/lokasi/edit/'.$data['id']);
                return;
            }

            // Hapus gambar lama jika ada
            if (!empty($lokasi->image)) {
                $old_image_path = './upload/lokasi/'.$lokasi->image;
                if (file_exists($old_image_path)) {
                    unlink($old_image_path);
                }
            }

            // Perbarui data gambar
            $file_data = $this->upload->data();
            $file_path = $file_data['file_name'];
            $data['image'] = $file_path;
        }

		$result = $this->api->CallAPI("PATCH", base_api('/api/v1/_getLokasi'), $data, 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);
		
		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil diubah."));
			redirect('admin/lokasi');
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal diubah."));
			redirect('admin/lokasi/edit/'.$data['id']);
		}
	
	
	}


	public function status($id = null, $status = 0)
	{
		if ($status == 0){
			$text = "Dinonaktifkan";
		}else{
			$text = "Diaktifkan";
		}
		$result = $this->api->CallAPI("PATCH", base_api('/api/v1/_getLokasi'), ['id' => $id, 'status' => $status], 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil $text."));
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal $text."));
		}
		
		redirect('admin/lokasi');
	}

	public function delete($id = null)
	{
		$result = $this->api->CallAPI("DELETE", base_api('/api/v1/_getLokasi'), ['id' => $id], 'Authorization:'.$this->userdata->data->token);

		$result = json_decode($result);

		if ($result->status == 200){

			$this->session->set_flashdata('msg', swal("succ", "Data berhasil dihapus."));
		}
		else
		{
			$this->session->set_flashdata('msg', swal("err", "Data gagal dihapus."));
		}
		
		redirect('admin/lokasi');
	}


}
