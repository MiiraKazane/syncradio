<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Comment_model extends CI_Model {

	var $table  = 'comments';
	var $column = array('folio','date_in','description','priority');
    var $order  = array('id_com' => 'asc');

    public function __construct() {
        parent::__construct();
    }

    public function get_comments($id) {
        $this->db->select('content_com, datetime, usu_emp, picture_emp');
        $this->db->from($this->table);
        $this->db->join('employees', 'employees.id_emp = comments.id_emp', 'LEFT');
        $this->db->where('id_rep', $id);
        $query = $this->db->get();

        return $query->result();
    }

    public function count_comments($id_rep) {
        $this->db->from('comments');
        $this->db->where('id_rep',$id_rep);
        return $this->db->count_all_results();
    }

    public function save_comment($data) {
        $this->db->insert('comments', $data);
        return $this->db->insert_id();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
}

/* End of file comment_model.php */
/* Location: ./application/models/comment_model.php */