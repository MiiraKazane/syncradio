<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event_model extends CI_Model {

    var $table  = 'events';
    var $column = array('title','body');
    var $order  = array('id' => 'asc');

    public function __construct() {
        parent::__construct();
    }

    private function _get_datatables_query() {
        
        $this->db->from($this->table);
        $this->db->join('kind_events', 'kind_events.id_kind_event = events.id_kind_event');
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

    public function get_by_id($id) {
        $this->db->from($this->table);
        $this->db->join('kind_events', 'kind_events.id_kind_event = events.id_kind_event');
        $this->db->join('employees', 'employees.id_emp = events.id_emp');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data) {
        $this->db->insert($this->table, $data);

        $data = array(
            'url' => SITE."calendar/render/".$this->db->insert_id());
        $this->db->where('id', $this->db->insert_id());
        $this->db->update($this->table, $data);
        
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

    public function get_rows() {
    $this->db->from('kind_events');
    $this->db->order_by('name_kind_event', 'ASC');
    $query = $this->db->get();
    return $query->result();
}

    public function getAll(){
        $query = $this->db->get('events');
        if($query->num_rows() > 0):
            return $query->result();
        else:
            return null;
        endif;
    }
}
