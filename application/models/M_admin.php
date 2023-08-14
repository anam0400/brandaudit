<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function select($id = '', $email = '', $offset = '', $limit = '', $random = ''){
		if ($id != ''){
			$this->db->where('id', $id);
		}

		if ($email != ''){
			$this->db->where('email', $email);
		}
		
		if ($offset != '' || $limit != '') {
			$this->db->limit($limit, $offset);
		}

		if ($random != ''){
			$this->db->order_by('rand()');
		}

					$this->db->from('mis_users');
		$response = $this->db->get();
		return $response;
	}

	public function save($data){
		date_default_timezone_set('asia/jakarta');
		$arr = array(
			'email'				=> $data->email,
			'jabatan'			=> $data->jabatan,
			'plan'				=> $data->plan,
			'wallet'			=> $data->wallet,
			'qrcode'			=> $data->qrcode,
			'date_registered'	=> date('Y-m-d H:i:s')
		);

		$response = $this->db->insert('mis_users', $arr);
		return $response;
	}

	public function delete($arr){
		return $this->db->delete('mis_users', $arr);
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */