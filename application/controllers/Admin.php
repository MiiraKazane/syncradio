<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('tipo') == NULL || $this->session->userdata('tipo') != '1'):
        redirect(SITE.'login');
        endif;
    }

    public function index() {

        $this->load->model('random_model');
        $data['titulo'] = 'SyncRadio - Bienvenido';
        //Totales
        $data['num_normal'] = $this->random_model->get_num_rep_normal();
        $data['num_bestia'] = $this->random_model->get_num_rep_bestia();
        $data['num_love']   = $this->random_model->get_num_rep_love();
        $data['num_super']  = $this->random_model->get_num_rep_super();
        // abiertos o pendientes
        $data['num_normal_unresolved'] = $this->random_model->get_num_rep_normal_unresolved();
        $data['num_bestia_unresolved'] = $this->random_model->get_num_rep_bestia_unresolved();
        $data['num_love_unresolved']   = $this->random_model->get_num_rep_love_unresolved();
        $data['num_super_unresolved']  = $this->random_model->get_num_rep_super_unresolved();
        
        $this->load->view('admin_view', $data);
        $this->load->view('footer_view');
    }

}
