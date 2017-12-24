<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Calendar extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('tipo') === NULL):
        redirect(SITE.'login');
        endif;
        $this->load->model('Event_model', 'moo');
    }

    public function index() {
        $data['titulo'] = 'SyncRadio - Calendario de eventos';
        $this->load->view('calendar_view',$data);
        $this->load->view('app');
    }

    public function getAll(){
        if($this->input->is_ajax_request()):
            $events = $this->moo->getAll();
            $datos = array("success" => 1,"result" => $events);
            echo json_encode($datos);
        endif;
    }

    public function render($id = 0){
        $this->load->helper('tipos');

        if($id != 0):
            $row = $this->moo->get_by_id($id);
            $string = '<link rel="stylesheet" href="'.URL.'assetss/css/bootstrap.css">';
            $string .= '<div class="container"><center><legend><div><h3 class="text-info">'.$row->title.'</h3></div></legend></center>';
            $string .= '<b>Descripción:</b> <p>'.$row->body.'</p>';
            $string .= '<b>Fecha Inicio:</b> '.unix_to_normal($row->start).'<br>';
            $string .= '<b>Fecha de fin:</b> '.unix_to_normal($row->end).'<br>';
            $string .= '<b>Categoría:</b> '.$row->name_kind_event.'<br>';
            $string .= '<b>Publicado por:</b> '.$row->usu_emp.'<br>';
            $string .= '<br><br>';
            echo $string .= '<a target=_parent href="'.SITE.'Calendar/render_max/'.$id.'" class="btn btn-info pull-left">Ver mas</a></div>';
        endif;
    }

    public function render_max($id){
            $this->load->helper('tipos');
            $data['row'] = $this->moo->get_by_id($id);
            $this->load->view('event_max_view',$data);
            $this->load->view('footer_view');
    }
}