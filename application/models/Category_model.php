<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category_model extends CI_Model {

	 public function __construct() {
        parent::__construct();
    }

     var $table = 'categories';

    public function get_rows() {
    $this->db->from($this->table);
    $this->db->order_by('name_cat', 'ASC');
    $query = $this->db->get();

    return $query->result();
    }

}

/* End of file category_model.php */
/* Location: ./application/models/category_model.php */