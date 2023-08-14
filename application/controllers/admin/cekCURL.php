<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . "/vendor/autoload.php";
class cekCURL extends AUTH_Controller {
	function __construct()
	{
		parent::__construct();
		// secure_allowed_position(['administrator', 'mahasiswa']);
	}
	
	public function index()
	{
		$data = $this->input->post();
		$url = "https://api.products.aspose.app/barcode/recognize/recognizeresult/22BC683623062D0FC3B8F2183E5C5DFA?timeout=".time();
		$result = $this->api->CallAPI_THIRD('GET', $url);

        echo $result;
	}
}