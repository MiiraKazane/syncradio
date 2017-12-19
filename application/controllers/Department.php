<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Department extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('tipo') == FALSE || $this->session->userdata('tipo') != '1'):
        redirect(SITE.'login');
        endif;
        $this->load->model('department_model', 'moo');
    }

    public function index() {

        $data['titulo'] = 'SyncRadio - Departamentos';
        $this->load->view('department_view', $data);
        $this->load->view('footer_view');
    }

    public function ajax_list() {
        $list = $this->moo->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $dep) {
            $no++;
            $row = array();
            $row[] = $dep->name_dep;
            $row[] = $dep->extension_dep;
            $row[] = $this->moo->count_employees($dep->id_dep);
            $row[] = '<a class="btn btn-sm btn-default" href="javascript:void(0)" title="Editar Departamento" onclick="edit_department(' . "'" . $dep->id_dep . "'" . ')"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->moo->count_all(),
            "recordsFiltered" => $this->moo->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->moo->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $this->_validate();
        $data = array(
            'name_dep' => $this->input->post('nombre'),
            'extension_dep' => $this->input->post('extension')
        );
        $insert = $this->moo->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $this->_validate();
        $data = array(
            'name_dep' => $this->input->post('nombre'),
            'extension_dep' => $this->input->post('extension')
        );
        $this->moo->update(array('id_dep' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        $this->moo->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        //////////////////////////////////////////////////////////////////
        if ($this->input->post('nombre') == '') {
            $data['inputerror'][] = 'nombre';
            $data['error_string'][] = 'Ingresa nombre';
            $data['status'] = FALSE;
        } else {

            if (!$this->_validate_string($this->input->post('nombre'))) {
                $data['inputerror'][] = 'nombre';
                $data['error_string'][] = 'valor invalido';
                $data['status'] = FALSE;
            }
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    private function _validate_string($string) {
        $allowed = " ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyzáéíóú";
        for ($i = 0; $i < strlen($string); $i++) {
            if (strpos($allowed, substr($string, $i, 1)) === FALSE) {
                return FALSE;
            }
        }

        return TRUE;
    }

    private function _validate_number($string) {
        $allowed = "0123456789";
        for ($i = 0; $i < strlen($string); $i++) {
            if (strpos($allowed, substr($string, $i, 1)) === FALSE) {
                return FALSE;
            }
        }

        return TRUE;
    }

}
