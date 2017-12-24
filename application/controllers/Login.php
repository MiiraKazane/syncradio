<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('login_model', 'moo');
        $this->load->helper('form');
    }

    public function index() {

        if ($this->session->userdata('tipo') == ''):
            $data['token']  = $this->token();
            $this->load->view('login_view', $data);
        else:
            switch($this->session->userdata('tipo')){
                case 1:
                redirect(SITE.'admin');
                break;
                case 2:
                redirect(SITE.'calendar');
                break;
                case 3:
                redirect(SITE.'spot');
                break;
                case 4:
                redirect(SITE.'order');
                break;
            }
        endif;
    }

    public function new_user() {

        if ($this->input->post('token') == $this->session->userdata('token')) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $check_user = $this->moo->login_user($username, $password);
            if ($check_user) {
                $data = array(
                    'is_logued_in' => TRUE,
                    'id'           => $check_user->id_emp,
                    'tipo'         => $check_user->tipo_log,
                    'nombre'       => $check_user->usu_emp
                );
                $this->session->set_userdata($data);
                $this->index();
            }
        } else {
            redirect(SITE.'login');
        }
    }

    public function token() {

        $token = md5(uniqid(rand(), true));
        $this->session->set_userdata('token', $token);
        return $token;
    }

    public function logout_ci() {
        $this->session->sess_destroy();
        redirect(SITE.'login');
    }
}