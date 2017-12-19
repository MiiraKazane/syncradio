<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Spot extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('tipo') != '1' && $this->session->userdata('tipo') != '3' && $this->session->userdata('tipo') != '4'):
            redirect(SITE.'login');
        endif;
        $this->load->model('spot_model', 'moo');
        $this->load->model('station_model', 'sta');
    }

    public function index() {
        
        $data['list'] = $this->sta->see_stations();
        $data['titulo'] = 'SyncRadio - Control de spots';
        $this->load->view('spot_view', $data);
        $this->load->view('footer_view');

    }

    public function ajax_list() {
        $this->load->helper('tipos');
        $list = $this->moo->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $spot) {
            $no++;
            $row   = array();
            $row[] = '<span class="center-block text-danger" align="center">'.$spot->code_spot.'</span>';
            $row[] = $spot->version_spot;
            $row[] = $spot->customer_spot;
            $row[] = '<span class="center-block" align="center">'.$spot->acronym_sta.'</span>';
            $row[] = '<center>'.format_date($spot->expired_date_spot).'</center>';
            $row[] = validity($spot->expired_date_spot);
            $row[] = 
            '<div class="dropdown"><button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Acciones <span class="caret"></span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><li><a href="javascript:void(0)" onclick="edit_spot(' . "'" . $spot->id_spot . "'" . ')"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a></li><li><a href="javascript:void(0)" onclick="delete_spot(' . "'" . $spot->id_spot . "'" . ')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a></li></div>';
            $data[] = $row;
        }

        $output = array(
            "draw"            => $_POST['draw'],
            "recordsTotal"    => $this->moo->count_all(),
            "recordsFiltered" => $this->moo->count_filtered(),
            "data"            => $data,
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
            'code_spot'         => $this->input->post('codigo'),
            'id_sta_spot'       => $this->input->post('estacion'),
            'customer_spot'     => $this->input->post('cliente'),
            'version_spot'      => $this->input->post('version'),
            'expired_date_spot' => $this->input->post('expiracion'),
            'id_emp'            => $this->session->userdata('id')
        );
        $insert = $this->moo->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $this->_validate();
        $data = array(
            'code_spot'         => $this->input->post('codigo'),
            'id_sta_spot'       => $this->input->post('estacion'),
            'customer_spot'     => $this->input->post('cliente'),
            'version_spot'      => $this->input->post('version'),
            'expired_date_spot' => $this->input->post('expiracion'),
            'id_emp'            => $this->session->userdata('id')
        );
        $this->moo->update(array('id_spot' => $this->input->post('id')), $data);
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

        if ($this->input->post('codigo') == '') {
            $data['inputerror'][] = 'codigo';
            $data['error_string'][] = 'Ingresa código';
            $data['status'] = FALSE;
        }

        if ($this->input->post('version') == '') {
            $data['inputerror'][] = 'version';
            $data['error_string'][] = 'Ingresa versión';
            $data['status'] = FALSE;
        }

        if ($this->input->post('cliente') == '') {
            $data['inputerror'][] = 'cliente';
            $data['error_string'][] = 'Ingresa cliente';
            $data['status'] = FALSE;
        }

        if ($this->input->post('estacion') == '') {
            $data['inputerror'][] = 'estacion';
            $data['error_string'][] = 'Selecciona estación';
            $data['status'] = FALSE;
        }

        if ($this->input->post('expiracion') == '') {
            $data['inputerror'][] = 'expiracion';
            $data['error_string'][] = 'Selecciona fecha';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}
