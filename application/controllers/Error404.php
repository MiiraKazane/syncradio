<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Error404 extends CI_Controller {

	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('tipo') == FALSE):
        redirect(SITE.'login');
        endif;
}
	public function index() {
	        $this->load->view('error404_view');
	}
}