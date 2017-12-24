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

}
