<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_love_model extends CI_Model {

    var $table   = 'reports';
    var $station = '2';
    var $column  = array('folio','date_in','description','priority');
    var $order   = array('id' => 'asc');

    public function __construct() {
        parent::__construct();
    }

    private function _get_datatables_query() {
        
        $this->db->from($this->table);
        $this->db->join('categories', 'categories.id_cat = reports.id_cat', 'LEFT');
        $where = "reports.id_sta = $this->station AND reports.date_in BETWEEN DATE_SUB(CURDATE(),INTERVAL 1 DAY) AND CURDATE()";
        $this->db->where($where);
        $this->db->order_by("id", "desc");

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

    public function count_comments($id_rep) {
        $this->db->from('comments');
        $this->db->where('id_rep',$id_rep);
        return $this->db->count_all_results();
    }

    public function get_by_id($id) {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data) {
        $this->db->insert($this->table, $data);
        $this->db->insert('reports_backup', $data);
        return $this->db->insert_id();
    }

    public function update($where, $data) {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function delete_by_id($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }

    /*public function get_all_reports_bestia() {
        
        $query = $this->db->query('SELECT * FROM reports WHERE id_sta = 1 AND date_in BETWEEN DATE_SUB(CURDATE(),INTERVAL 1 DAY)  AND CURDATE()');
        return $query->result();
    }*/
    

    public function get_last_report() {
        $query = $this->db->query("
            SELECT
                MAX(folio) AS nextfolio
            FROM
                reports
            WHERE
                id_sta = 2
            LIMIT 1
            ");
        return $query->row();
    }
}
