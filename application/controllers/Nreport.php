<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Nreport extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('tipo') == FALSE) {
            redirect(site_url().'login');
        }
        $this->load->model('nreport_model', 'moo');
        $this->load->model('category_model', 'cat');
    }

    public function index() {
        
        $data['list'] = $this->cat->get_rows();
        $data['titulo'] = 'SyncRadio - reportes generales';
        $this->load->view('nreport_view', $data);
        $this->load->view('footer_view');

    }

    public function ajax_list() {
        $this->load->helper('tipos');
        $list = $this->moo->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $rep) {
            $no++;
            $row = array();
            $row[] = '<span class="center-block text-info" align="center">'.$rep->folio.'</span>';     
            $row[] = '<span class="center-block" align="center">'.see_tipo_reporte($rep->priority).'</span>';
            $row[] = $rep->description;
            $row[] = '<span class="center-block" align="center">'.see_status($rep->status).'</span>';
            $row[] = '<center><span class="badge badge-pill badge-dark">'.$this->moo->count_comments($rep->id).'</span></center>';
            $row[] = 
            '<div class="dropdown"><button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown">Acciones <span class="caret"></span></button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton"><li><a href="report_bestia/report_all/' . "" . $rep->id . "" . '"><i class="glyphicon glyphicon-eye-open"></i> Ver</a></li><li><a href="javascript:void(0)" onclick="edit_report(' . "'" . $rep->id . "'" . ')"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a></li><!--<li><a href="javascript:void(0)" onclick="delete_report(' . "'" . $rep->id . "'" . ')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a></li>--></div>';
            
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
        $row = $this->moo->get_last_report();
        if($row->nextfolio == ''):
            $finalfolio = '10'.'04';
        else:
            $finalf = substr($row->nextfolio, 0, strlen($row->nextfolio) - 2);
            $finalfolio = ($finalf + 1).'04';
        endif;

        $data = array(
            'folio'       => $finalfolio,
            'description' => $this->input->post('descripcion'),
            'date_in'     => date("Y-m-d"),
            'time_in'     => date("H:i:s"),
            'id_cat'      => $this->input->post('categoria'),
            'priority'    => $this->input->post('prioridad'),
            'status'      => $this->input->post('estatus'),
            'who'         => $this->session->userdata('id')
        );
        $insert = $this->moo->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $this->_validate();
        $data = array(
            'description' => $this->input->post('descripcion'),
            'id_cat'      => $this->input->post('categoria'),
            'priority'    => $this->input->post('prioridad'),
            'status'      => $this->input->post('estatus'),
            'who'         => $this->session->userdata('id')
        );
        $this->moo->update(array('id' => $this->input->post('id')), $data);
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

        if ($this->input->post('descripcion') == '') {
            $data['inputerror'][] = 'descripcion';
            $data['error_string'][] = 'Ingresa descripcion';
            $data['status'] = FALSE;
        }

        if ($this->input->post('categoria') == '') {
            $data['inputerror'][] = 'categoria';
            $data['error_string'][] = 'Selecciona una categoria';
            $data['status'] = FALSE;
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

}
