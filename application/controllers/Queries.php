<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Queries extends CI_Controller {

	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('tipo') == FALSE && $this->session->userdata('tipo') != '1'):
        redirect(SITE.'login');
        endif;
    }

	public function index() {

		$this->load->view('queries_view');
        $this->load->view('footer_view');
    }

    public function see_results() {

    	$this->load->helper('tipos');

		$data['start'] = $this->input->post('date_start');
		$data['end']   = $this->input->post('date_end');
    	$this->load->model('queries_model');
    	$data['queue'] = $this->queries_model->get_queries($data['start'],$data['end']);
		$this->load->view('queries_view',$data);
        $this->load->view('footer_view');
	}
}
