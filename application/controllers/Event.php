<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('tipo') == FALSE || $this->session->userdata('tipo') != '1'):
        redirect(SITE.'login');
        endif;

        $this->load->model('Event_model', 'moo');
        $this->load->helper('Tipos');
    }

    public function index() {

        $data['list'] = $this->moo->get_rows();
        $this->load->view('event_view', $data);
        $this->load->view('footer_view');
    }

    public function ajax_list() {
        
        $list = $this->moo->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $eve){
            $no++;
            $row = array();
            $row[] = '<span class="center-block" align="center">'.$eve->title.'</span>';     
            $row[] = $eve->body;
            $row[] = '<span class="center-block" align="center">'.unix_to_normal_show($eve->start).'</span>';
            $row[] = '<span class="center-block" align="center">'.unix_to_normal_show($eve->end).'</span>';
            $row[] = '<span class="center-block" align="center">'.$eve->name_kind_event.'</span>';
            $row[] = 
                '<div class="dropdown">
                  <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Acciones 
                  <span class="caret"></span></button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a href="javascript:void(0)" title="Editar evento" onclick="edit_event('.$eve->id.')"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a></li>
                    <li><a href="javascript:void(0)" title="Eliminar evento" onclick="delete_event('.$eve->id.')"><i class="fa fa-trash-o" aria-hidden="true"></i> Eliminar</a></li>
                  </div>';

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
        $row = $this->moo->get_by_id($id);
        $data = array(
            'id'            => $row->id,
            'title'         => $row->title,
            'body'          => $row->body,
            'start'         => unix_to_normal($row->start),
            'end'           => unix_to_normal($row->end),
            'id_kind_event' => $row->id_kind_event,
            'class'         => $row->class,
            'id_emp'        => $row->id_emp
        );
        echo json_encode($data);
    }

    public function ajax_add() {
        $this->_validate();
        $data = array(
            'title'         => $this->input->post('titulo'),
            'body'          => $this->input->post('descripcion'),
            'start'         => normal_to_unix($this->input->post('fecha_inicio')),
            'end'           => normal_to_unix($this->input->post('fecha_final')),
            'id_kind_event' => $this->input->post('categoria'),
            'class'         => $this->input->post('color'),
            'id_emp'        => $this->session->userdata('id')
            );
        $insert = $this->moo->save($data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $this->_validate();
        $data = array(
              'title'         => $this->input->post('titulo'),
              'body'          => $this->input->post('descripcion'),
              'start'         => normal_to_unix($this->input->post('fecha_inicio')),
              'end'           => normal_to_unix($this->input->post('fecha_final')),
              'class'         => $this->input->post('color'),
              'id_kind_event' => $this->input->post('categoria')
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

        //////////////////////////////////////////////////////////////////
        if ($this->input->post('titulo') == '') {
            $data['inputerror'][] = 'titulo';
            $data['error_string'][] = 'Ingresa titulo';
            $data['status'] = FALSE;
        }

        if ($this->input->post('descripcion') == '') {
            $data['inputerror'][] = 'descripcion';
            $data['error_string'][] = 'Ingresa descripción';
            $data['status'] = FALSE;
        }

        if ($this->input->post('fecha_inicio') == '') {
            $data['inputerror'][] = 'fecha_inicio';
            $data['error_string'][] = 'Ingresa fecha inicial';
            $data['status'] = FALSE;
        }

        if ($this->input->post('fecha_final') == '') {
            $data['inputerror'][] = 'fecha_final';
            $data['error_string'][] = 'Ingresa fecha final';
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