<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Station_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function see_stations() {

        $query = $this->db->get('stations');
        if ($query->num_rows() > 0):
            return $query->result();
        endif;
    }

    public function get_rows() {
        $this->db->from('stations');
        $this->db->order_by('id_sta', 'ASC');
        $query = $this->db->get();

        return $query->result();
    }

}
