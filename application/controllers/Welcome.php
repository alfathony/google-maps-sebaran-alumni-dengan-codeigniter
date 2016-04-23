<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {
	/**
	 * @author 		Yusuf Ayuba
	 * @since   	2016
	 */
	public function index()
	{
		$this->add();
	}
	public function add()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('alumni_model','alumni');
		$data['nama'] = '';
		$this->form_validation->set_rules('nama','Nama','trim|required');
		$this->form_validation->set_rules('wilayah','Wilayah Tinggal','trim|required');
		if ($this->form_validation->run()===FALSE) {
			$this->load->view('form_add',$data);
		} else {
			$data = array(
							'nm_alumni'=>$this->input->post('nama'),
							'id_wil' => $this->input->post('wilayah')
						);
			$this->alumni->create($data);
			$this->session->set_flashdata('message','Sukses, Data alumni berhasil ditambahkan');
			redirect('welcome','refresh');
		}
	}
	public function ajax()
	{
		$this->load->model('alumni_model','alumni');
		$cari = $this->input->post('cari');
		$limit =$this->input->post('page');
		$temp = $this->alumni->get_wil_ajax($cari,$limit)->result_array();
		echo json_encode($temp);
	}
	public function maps()
	{
		$this->load->model('alumni_model','alumni');
		$config = array();
		$config['center'] = 'jakarta';
		$config['zoom'] = 'auto';
		$this->googlemaps->initialize($config);
		$temp_result = $this->alumni->get_location()->result();
		$marker = array();
		foreach ($temp_result as $value) {
			$marker['position'] = $value->desa.', '.$value->prop;
			$marker['infowindow_content'] = ''.$value->nm_alumni.'<br>Lokasi: '.$value->desa.', '.$value->prop.'';
			$marker['title'] = ''.$value->nm_alumni.'\n'.$value->desa.', '.$value->prop.'';
			$this->googlemaps->add_marker($marker);	
		}
		$data['map'] = $this->googlemaps->create_map();
		$this->load->view('maps_view', $data);
	}
}