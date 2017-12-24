<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();

        if ($this->session->userdata('tipo') == FALSE || $this->session->userdata('tipo') == '2'):
        redirect(SITE.'login');
        endif;
        //$this->output->enable_profiler(TRUE);
        $this->load->model('order_model', 'moo');
        $this->load->model('station_model', 'poo');

    }

    public function index() {
            
            $data['titulo'] = "SyncRadio - Ordenes";
            $data['orders'] = $this->moo->see_orders();
            $this->load->view('order_view', $data);
            $this->load->view('footer_view');   
    }

    function add_order() {   
        if(isset($_POST) && count($_POST) > 0):
            $params = array(
                'id_sta'     => $this->input->post('station'),
                'number'     => $this->input->post('number'),
                'customer'   => $this->input->post('customer'),
                'contract'   => $this->input->post('contract'),
                'kind_order' => $this->input->post('kind'),
                'rack'       => $this->input->post('rack'),
                'version'    => $this->input->post('version'),
                'duration'   => $this->input->post('duration'),
                'start'      => $this->input->post('start'),
                'end'        => $this->input->post('end'),
                'hours'      => $this->input->post('hours'),
                'details'    => $this->input->post('details'),
                'seller'     => $this->input->post('seller'),
            );
            
            $insert_id = $this->moo->save($params);
            redirect('order');
        else:
            $data['titulo'] = "SyncRadio - Nueva orden";
            $data['list'] = $this->poo->get_rows();
            $this->load->view('order_new_view',$data);
        endif;
    }
    
    function edit_order($id) {

        $order = $this->moo->get_by_id($id);
        
        if(isset($order->id))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
                    'id_sta'     => $this->input->post('station'),
                    'number'     => $this->input->post('number'),
                    'customer'   => $this->input->post('customer'),
                    'contract'   => $this->input->post('contract'),
                    'kind_order' => $this->input->post('kind'),
                    'rack'       => $this->input->post('rack'),
                    'version'    => $this->input->post('version'),
                    'duration'   => $this->input->post('duration'),
                    'start'      => $this->input->post('start'),
                    'end'        => $this->input->post('end'),
                    'hours'      => $this->input->post('hours'),
                    'details'    => $this->input->post('details'),
                    'seller'     => $this->input->post('seller'),
                );

                $this->moo->alter($id,$params);            
                redirect('order');
            }
            else
            {
                $data['list'] = $this->poo->get_rows();
                $data['titulo'] = 'SyncRadio - Editar orden';
                $data['ord'] = $this->moo->get_by_id($id);
                $this->load->view('order_edit_view',$data);
            }
        }
        else
            show_error('La orden que intentas modificar no existe');
    }

    function delete_order($id) {
        
        $order = $this->moo->get_by_id($id);
        
        if(isset($order->id)):
            $this->moo->delete_by_id($id);
            redirect('order');
        else:
            show_error('La orden que intentas borrar no existe.');
        endif;
    }
}
