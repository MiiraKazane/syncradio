<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Queries_model extends CI_Model {

	public function __construct() {
        parent::__construct();
    }


    public function get_queries($start,$end) {
    $this->db->from('reports');
    $this->db->join('categories', 'categories.id_cat = reports.id_cat');
    $this->db->where('date_in >=', $start);
	$this->db->where('date_in <=', $end);
   	return $this->db->get()->result();
	}

}

