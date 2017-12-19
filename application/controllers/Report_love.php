<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Report_love extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('tipo') == FALSE):
            redirect(SITE.'login');
         endif;
        $this->load->model('report_love_model', 'moo');
        $this->load->model('category_model', 'cat');
    }

    public function index() {

        $data['titulo'] = 'Love 90.1 FM';
        $data['list'] = $this->cat->get_rows();
        $this->load->view('report_love_view', $data);
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
            $row[] = '<a class="btn btn-sm btn-default" data-toggle="tooltip" title="Ver reporte" href="report_bestia/report_all/' . "" . $rep->id . "" . '"><i class="glyphicon glyphicon-eye-open"></i></a><a class="btn btn-sm btn-default" href="javascript:void(0)" data-toggle="tooltip" title="Editar reporte" onclick="edit_report(' . "" . $rep->id . "" . ')"><i class="glyphicon glyphicon-pencil"></i></a>';
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

    public function ajax_see($id) {
        $data = $this->moo->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $this->_validate();
        $row = $this->moo->get_last_report();
        if($row->nextfolio == ''):
            $finalfolio = '10'.'02';
        else:
            $finalf = substr($row->nextfolio, 0, strlen($row->nextfolio) - 2);
            $finalfolio = ($finalf + 1).'02';
        endif;

        $data = array(
            'folio'       => $finalfolio,
            'priority'    => $this->input->post('prioridad'),
            'id_cat'      => $this->input->post('categoria'),
            'description' => $this->input->post('descripcion'),
            'status'      => $this->input->post('estatus'),
            'date_in'     => date("Y-m-d"),
            'time_in'     => date("H:i:s"),
            'id_sta'      => '2',
            'who'         => $this->session->userdata('id')
        );
        $insert = $this->moo->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $this->_validate();
        $data = array(
            'priority'    => $this->input->post('prioridad'),
            'id_cat'    => $this->input->post('categoria'),
            'description' => $this->input->post('descripcion'),
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
            $data['error_string'][] = 'Ingresa descripción';
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