<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    var $table = 'orders';

    public function __construct() {
        parent::__construct();
    }

    public function see_orders() {

        $this->db->select('id, number, customer, contract, version, acronym_sta, kind_order');
        $this->db->from($this->table);
        $this->db->join('stations', 'stations.id_sta = orders.id_sta');
        $query = $this->db->get();
        if ($query->num_rows() > 0):
            return $query->result();
        else: 
            return NULL;
        endif;
    }

    public function get_by_id($id) {
        $this->db->from($this->table);
        $this->db->join('stations', 'stations.id_sta = orders.id_sta');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function alter($id,$data) {
        $this->db->update($this->table, $data, "id = $id");
    }

    public function delete_by_id($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        redirect(SITE . 'order');
    }
}
