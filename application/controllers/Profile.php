<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {
        parent::__construct();

        if ($this->session->userdata('tipo') == FALSE):
        redirect(SITE.'login');
        endif;
        $this->load->model('employee_model', 'moo');
    }

	public function index(){}

	public function see_profile($id) {
        $this->load->helper('tipos');
        $data['titulo'] = 'SyncRadio - Perfil';
        $data['emp'] = $this->moo->get_by_id($id);
        $this->load->view('profile_view',$data);
        $this->load->view('footer_view');
       }
}