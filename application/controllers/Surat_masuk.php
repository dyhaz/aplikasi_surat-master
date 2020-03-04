<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->model('m_data');
		$this->load->model('m_cari');
	}
 
	public function index(){
		$this->load->database();
		$jumlah_data = $this->m_data->jumlah_data();
		$this->load->library('pagination');
		$config['base_url'] = base_url().'surat_masuk/index/';
		$config['total_rows'] = $jumlah_data;
		$config['per_page'] = 15;
		$from = $this->uri->segment(3);
		
		//Tambahan untuk styling
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        $config['first_link']='< Pertama ';
        $config['last_link']='Terakhir > ';
        $config['next_link']='> ';
        $config['prev_link']='< ';
		$this->pagination->initialize($config);		
		$data['user'] = $this->m_data->data($config['per_page'],$from);
		$this->load->view('surat_masuk',$data);

	}
	public function action_add()
	{
		$data = array(
			'no_surat' => $this -> input -> post('no_surat') ,
			'tanggal_masuk' => $this -> input -> post('tanggal_masuk') ,
			'pengirim' => $this -> input -> post('pengirim'),
			'penerima' => $this -> input -> post('penerima'),
			'perihal' => $this -> input -> post('perihal'),
			'lampiran' => $this -> input -> post('lampiran')  
		);
		$this -> db-> insert('surat_masuk',$data);
		redirect ('surat_masuk');
	}
	//Update one item
	public function update($id = NULL)
	{
		$this -> db-> where('id',$id);
		$data['content'] = $this -> db-> get('surat_masuk');
		$this -> load -> view('admin/update',$data);	
	}
	public function action_update($id='')
	{
		$data = array(
			'no_surat' => $this -> input -> post('no_surat') ,
			'tanggal_masuk' => $this -> input -> post('tanggal_masuk') ,
			'pengirim' => $this -> input -> post('pengirim'),
			'penerima' => $this -> input -> post('penerima'),
			'perihal' => $this -> input -> post('perihal'),
			'lampiran' => $this -> input -> post('lampiran')  
		);
		$this -> db-> where('id',$id);
		$this -> db-> update('surat_masuk',$data);
		redirect ('surat_masuk');
	}
	//Delete one item
	public function delete($id = NULL)
	{
		$this -> db-> where('id',$id);
		$this -> db-> delete('surat_masuk');

		redirect ('surat_masuk');	
	}
	//Search item
	public function hasil()
	{
		$data2['user'] = $this->m_cari->cari();
		$this->load->view('surat_masuk', $data2);
	}

}

