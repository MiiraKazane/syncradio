<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('tipo') == FALSE || $this->session->userdata('tipo') != '1'):
        redirect(SITE.'login');
        endif;
        //$this->output->enable_profiler(TRUE);
        $this->load->model('employee_model', 'moo');
        $this->load->model('department_model', 'poo');
    }

    public function index() {
            
            $this->load->helper('tipos');
            $data['employees'] = $this->moo->see_employees();
            $this->load->view('employee_view', $data);
            $this->load->view('footer_view');   
    }

    function add_employee() {   
        if(isset($_POST) && count($_POST) > 0):

            $config['file_name']     = $this->input->post('usuario');
            $config['upload_path']   = 'uploads/profiles/';
            $config['allowed_types'] = 'jpg';
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

            $params = array(
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
            
            $insert_id = $this->moo->save($params);
            redirect('employee');
        else:
            $data['list'] = $this->poo->get_rows();
            $this->load->helper('tipos');
            $this->load->view('employee_new_view',$data);
            $this->load->view('footer_view');
        endif;
    }

    public function save_employee() {
    
        $config['file_name']     = $this->input->post('usuario');
        $config['upload_path']   = 'uploads/profiles/';
        $config['allowed_types'] = 'jpg';
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
        $this->load->view('employee_view', $data);
        $this->load->view('footer_view');
    }
    
    function edit_employee($id) {

        $employee = $this->moo->get_by_id($id);
        if(isset($employee->id_emp))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {
                $params = array(
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
                
                $this->moo->alter($id,$params);
                redirect('employee');

            }
            else
            {
                $data['list'] = $this->poo->get_rows();
                $data['emp'] = $this->moo->get_by_id($id);
                $this->load->view('employee_edit_view',$data);
                $this->load->view('footer_view');
            }
        }
        else
            show_error('La orden que intentas modificar no existe');
    }

    function delete_employee($id) {
        
        $employee = $this->moo->get_by_id($id);
        
        if(isset($employee->id_emp)):
            $this->moo->delete_by_id($id);
            redirect('employee');
        else:
            show_error('El empleado que intentas borrar no existe.');
        endif;
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
