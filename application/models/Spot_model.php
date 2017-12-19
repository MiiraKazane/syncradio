<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Spot_model extends CI_Model {

    var $table  = 'spots';
    var $column = array('code_spot', 'version_spot', 'customer_spot','id_sta_spot','acronym_sta');
    var $order  = array('id_spot' => 'asc');

    public function __construct() {
        parent::__construct();
    }

    private function _get_datatables_query() {
        
        $this->db->from($this->table);
        $this->db->join('stations', 'stations.id_sta = spots.id_sta_spot');
        $this->db->order_by("id_spot", "desc");

        $i = 0;
        foreach ($this->column as $item) {
            if ($_POST['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column) - 1 == $i)
                    $this->db->group_end();
            }
            $column[$i] = $item;
            $i++;
        }
        if (isset($_POST['order'])) {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function get_by_id($id) {
        $this->db->from($this->table);
        $this->db->where('id_spot', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data) {
        $this->db->insert($this->table, $data);
        //$this->db->insert('reports_backup', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id) {
        $this->db->where('id_spot', $id);
        $this->db->delete($this->table);
    }
}
