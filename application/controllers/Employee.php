<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('tipo') == FALSE || $this->session->userdata('tipo') != '1'):
        redirect(SITE.'login');
        endif;
        $this->load->model('employee_model', 'moo');
        $this->load->model('department_model', 'poo');
    }

    public function index() {
            
            $this->load->helper('tipos');
            $data['titulo'] = "SyncRadio - Empleados";
            $data['employees'] = $this->moo->see_employees();
            $this->load->view('employee_view', $data);
            $this->load->view('footer_view');   
    }

    public function new_employee() {
        $this->load->helper('form');

        $data['list'] = $this->poo->get_rows();
        $data['titulo'] = "SyncRadio - Nuevo empleado";
        $data['error'] = '';
        $this->load->view('employee_new_view', $data);
        $this->load->view('footer_view');   
    }

    public function save_employee() {
    
        $config['file_name']     = $this->input->post('usuario');
        $config['upload_path']   = 'uploads/profiles/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['remove_spaces'] = TRUE;

        $this->load->library('upload', $config);
        $this->upload->do_upload();

        $this->load->library('image_lib');
        $conf['image_library']  = 'gd2';
        $conf['source_image']   = $this->upload->data('full_path');
        $conf['create_thumb']   = FALSE;
        $conf['maintain_ratio'] = TRUE;
        $conf['width']          = 500;
        $conf['height']         = 500;
        $conf['new_image']      = 'uploads/thumbs/';

        $this->image_lib->clear();
        $this->image_lib->initialize($conf);
        $this->image_lib->resize();

        $data = array(
            'name_emp'          => $this->input->post('nombre'),
            'tipo_log'          => $this->input->post('rol'),
            'birth_date_emp'    => $this->input->post('fecha_nacimiento'),
            'email_emp'         => $this->input->post('email'),
            'rfc_emp'           => $this->input->post('rfc'),
            'curp_emp'          => $this->input->post('curp'),
            'nss_emp'           => $this->input->post('nss'),
            'sbc_emp'           => $this->input->post('sbc'),
            'social_reason_emp' => $this->input->post('rs'),
            'usu_emp'           => $this->input->post('usuario'),
            'pass_emp'          => $this->input->post('contrasena'),
            'lastname_emp'      => $this->input->post('apellido'),
            'job_emp'           => $this->input->post('puesto'),
            'id_dep'            => $this->input->post('departamento'),
            'telephone_emp'     => $this->input->post('telefono'),
            'contract_emp'      => $this->input->post('estatus'),
            'hire_date_emp'     => $this->input->post('ingreso'),
            'picture_emp'       => $this->upload->data('file_name')
        );
        $insert = $this->moo->save($data);
        $this->load->helper('tipos');
        $data['employees'] = $this->moo->see_employees();
        $data['titulo'] = "SyncRadio - Empleados";
        $this->load->view('employee_view', $data);
        $this->load->view('footer_view');
    }
    
    public function to_edit_employee($id) {

        $this->load->helper('form');
        $data['list']   = $this->poo->get_rows();
        $data['titulo'] = "SyncRadio - Editar empleado";
        $data['emp']  = $this->moo->get_by_id($id);
        $this->load->view('employee_edit_view', $data);
        $this->load->view('footer_view');
    }

    public function alter_employee() {

        $data = array(
            'name_emp'          => $this->input->post('nombre'),
            'tipo_log'          => $this->input->post('rol'),
            'birth_date_emp'    => $this->input->post('fecha_nacimiento'),
            'email_emp'         => $this->input->post('email'),
            'rfc_emp'           => $this->input->post('rfc'),
            'curp_emp'          => $this->input->post('curp'),
            'nss_emp'           => $this->input->post('nss'),
            'sbc_emp'           => $this->input->post('sbc'),
            'social_reason_emp' => $this->input->post('rs'),
            'usu_emp'           => $this->input->post('usuario'),
            'pass_emp'          => $this->input->post('contrasena'),
            'lastname_emp'      => $this->input->post('apellido'),
            'job_emp'           => $this->input->post('puesto'),
            'id_dep'            => $this->input->post('departamento'),
            'telephone_emp'     => $this->input->post('telefono'),
            'contract_emp'      => $this->input->post('estatus'),
            'hire_date_emp'     => $this->input->post('ingreso'),
        );

        $this->moo->alter($this->input->post('id'),$data);

        $data['employees'] = $this->moo->see_employees();
        $data['titulo'] = "SyncRadio - Empleados";
        $this->load->view('employee_view', $data);
        $this->load->view('footer_view');   
    }

    public function delete_employee($id) {
        $this->moo->delete_by_id($id);
    }

    public function if_exist() {  
     sleep(1);
    if($this->input->is_ajax_request()) {
        $username = $this->input->post('username');
        $query    = $this->moo->exists($username);

        if($query > 0)
            echo '<div class="text-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Ya existe</div>';
        else
            echo '<div class="text-success"><i class="fa fa-check" aria-hidden="true"></i> Disponible</div>';
        }    
    } 
}
