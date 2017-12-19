<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Random_model extends CI_Model {

	public function __construct() {
        parent::__construct();
    }

    public function get_num_rep_normal() {

    	$this->db->from('reports');
    	$this->db->where(array('id_sta' => NULL));
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function get_num_rep_bestia() {

    	$this->db->from('reports');
    	$this->db->where(array('id_sta' => 1));
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function get_num_rep_love() {

    	$this->db->from('reports');
    	$this->db->where(array('id_sta' => 2));
		$query = $this->db->get();
		return $query->num_rows();
    }

    public function get_num_rep_super() {

    	$this->db->from('reports');
    	$this->db->where(array('id_sta' => 3));
		$query = $this->db->get();
		return $query->num_rows();
    }

/////////////////////////////////////////////////////////////

    public function get_num_rep_normal_unresolved() {

        $this->db->from('reports');
        $where = "id_sta IS NULL AND status = 2";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_num_rep_bestia_unresolved() {

        $this->db->from('reports');
        $where = "id_sta = 1 AND status = 2";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_num_rep_love_unresolved() {

        $this->db->from('reports');
        $where = "id_sta = 2 AND status = 2";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function get_num_rep_super_unresolved() {

        $this->db->from('reports');
        $where = "id_sta = 3 AND status = 2";
        $this->db->where($where);
        $query = $this->db->get();
        return $query->num_rows();
    }
}

/* End of file random_model.php */
/* Location: ./application/models/random_model.php */