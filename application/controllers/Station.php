<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Station extends CI_Controller {

		public function __construct() {
		parent::__construct();
		if ($this->session->userdata('tipo') != 2 && $this->session->userdata('tipo') != '1' && $this->session->userdata('tipo') != '3' && $this->session->userdata('tipo') != '4'):
            redirect(site_url() . 'login');
        endif;
		$this->load->model('station_model','moo');
	}

	public function index() {

		$this->load->helper('tipos');
		$data['estaciones'] = $this->moo->see_stations();
		$data['titulo'] = 'SyncRadio - Estaciones';
		$this->load->view('station_view', $data);
		$this->load->view('footer_view');
	}

}
