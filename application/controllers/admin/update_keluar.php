<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Update_keluar extends CI_Controller {

	public function __construct()
	{
		parent ::__construct();
		//Load Dependencies
	}
	public function index()
	{
		$this->load->view('update_keluar');
	}
}

