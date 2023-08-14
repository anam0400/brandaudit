<?php
	function base_api($string = ''){
		$base = 'http://localhost/api_brand_audit/'.@$string;


		return $base;
	}

	function base_name(){
		$name = "Brand Audit";
		return $name;
	}

	function secure_allowed_position($arr = null){
		$CI =& get_instance();
		$dataMembers = $CI->db->get_where('mis_users', ['email' => $CI->session->userdata('userdata')->Username]);
		if ($dataMembers->num_rows() > 0){
			$dataMembers = $dataMembers->row();
			
			if (!in_array($dataMembers->jabatan, $arr)){
				$CI->session->set_flashdata('msg', show_msg("Mohon maaf, anda tidak memiliki akses.", "danger", "fa-times", "12px", "col-md-3"));
				redirect('admin/home');
			}
		}else{
			$CI->session->sess_destroy();
			redirect('auth');
		}
	}

	function secure_allowed_plan($arr = null){
		$CI =& get_instance();
		$dataMembers = $CI->db->get_where('mis_users', ['email' => $CI->session->userdata('userdata')->Username]);
		if ($dataMembers->num_rows() > 0){
			$dataMembers = $dataMembers->row();
			
			if (!in_array($dataMembers->plan, $arr)){
				redirect('admin/home');
			}
		}else{
			$CI->session->sess_destroy();
			redirect('auth');
		}
	}

	function swal($type = "succ", $content = ''){
		if ($type == "succ")
		{
			$text = "Yeayyyyy!";
			$icon = "success";
		}
		else
		{
			$text = "Oooppssss!";
			$icon = "error";
		}
		$html = "<script>swal.fire('".$text."', '".$content."', '".$icon."');</script>";
		return $html;
	}

	// MSG
	function show_msg($content='', $type='success', $icon='fa-info-circle', $size='14px', $col = "col-md-12") {
		if ($content != '') {
			return  '<p class="box-msg">
						<div class="small-box bg-' .$type .' '.$col.'">
							<div class="inner" style="font-size:' .$size .'">
								<i class="fa ' .$icon .'"></i>
								' .$content. '
							</div>
						</div>
				    </p>';
		}
	}

	function show_succ_msg($content='', $size='14px') {
		if ($content != '') {
			return   '<p class="box-msg">
				      <div class="info-box alert-success">
					      <div class="info-box-icon">
					      	<i class="fa fa-check-circle"></i>
					      </div>
					      <div class="info-box-content" style="font-size:' .$size .'">
				        	' .$content
				      	.'</div>
					  </div>
				    </p>';
		}
	}

	function show_err_msg($content='', $size='14px') {
		if ($content != '') {
			return   '<p class="box-msg">
				      <div class="info-box alert-error">
					      <div class="info-box-icon">
					      	<i class="fa fa-warning"></i>
					      </div>
					      <div class="info-box-content" style="font-size:' .$size .'">
				        	' .$content
				      	.'</div>
					  </div>
				    </p>';
		}
	}

	//Modal
	function show_my_modal($content='', $id='', $data='', $size='md') {
		$_ci = &get_instance();

		if ($content != '') {
			$view_content = $_ci->load->view($content, $data, TRUE);

			return '<div class="modal fade" id="' .$id .'" role="dialog">
					  <div class="modal-dialog modal-' .$size .'" role="document">
					    <div class="modal-content">
					        ' .$view_content .'
					    </div>
					  </div>
					</div>';
		}
	}

	function show_my_confirm($id='', $class='', $title='Konfirmasi', $yes = 'Ya', $no = 'Tidak') {
		$_ci = &get_instance();

		if ($id != '') {
			echo   '<div class="modal fade" id="' .$id .'" role="dialog">
					  <div class="modal-dialog modal-md" role="document">
					    <div class="modal-content">
					        <div class="col-md-offset-1 col-md-10 col-md-offset-1 well">
						      <h3 style="display:block; text-align:center;">' .$title .'</h3>
						      
						      <div class="col-md-6">
						        <button class="form-control btn btn-primary ' .$class .'"> <i class="glyphicon glyphicon-ok-sign"></i> ' .$yes .'</button>
						      </div>
						      <div class="col-md-6">
						        <button class="form-control btn btn-danger" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> ' .$no .'</button>
						      </div>
						    </div>
					    </div>
					  </div>
					</div>';
		}
	}
?>