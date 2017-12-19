<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment extends CI_Controller {

	public function __construct() {
        parent::__construct();
        $this->load->model('comment_model', 'moo');
    }

    public function index() {}

    public function ajax_comments($id) {
        $list = $this->moo->get_comments($id);
        $data = array();
        foreach ($list as $com) {
            $row = array();
            $timeN = explode(':', $com->datetime); 
            $timeD = $timeN[0] . ":" . $timeN[1];
            if(!empty($com->picture_emp)):
           $row[] = '<div class="pull-left"><img width="60" height="60" class="img-responsive img-thumbnail" src="'.URL.'uploads/thumbs/'.$com->picture_emp.'"><br><small class="text-muted"></i><b>'.$com->usu_emp."</b><br>[$timeD]". '</small></div>';
                else:
            $row[] = '<div><img width="60" height="60" class="img-responsive img-thumbnail" src="'.URL.'assetss/img/default.png"><br><small class="text-muted"></i><b>'.$com->usu_emp."</b> [$timeD]".'</small></div>';
                endif;
            $row[] = $com->content_com;
            
            $data[] = $row;
        }

        $output = array("data"=>$data);
        echo json_encode($output);

    }

    public function ajax_add_comment() {
        $data = array(
            'content_com' => $this->input->post('comentario'),
            'id_rep'      => $this->input->post('id'),
            'id_emp'      => $this->session->userdata('id')
        );
        $insert = $this->moo->save_comment($data);
        echo json_encode(array("status" => TRUE));
    }

}