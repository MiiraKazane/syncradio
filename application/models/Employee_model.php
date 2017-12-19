<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {

    var $table = 'employees';

    public function __construct() {
        parent::__construct();
    }

    public function see_employees() {

    $this->db->select('id_emp, lastname_emp, name_emp, name_dep, job_emp, telephone_emp, email_emp');
        $this->db->from($this->table);
        $this->db->join('departments', 'departments.id_dep = employees.id_dep','left');
        $query = $this->db->get();
        if ($query->num_rows() > 0):
            return $query->result();
        else: 
            return $this->db->last_query();
        endif;
    }

    public function get_by_id($id) {
        $this->db->from($this->table);
        $this->db->join('departments', 'departments.id_dep = employees.id_dep','LEFT');
        $this->db->where('id_emp', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function save($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function alter($id,$data) {
        $this->db->update($this->table, $data, "id_emp = $id");
    }

    public function delete_by_id($id) {
        $this->db->where('id_emp', $id);
        $this->db->delete($this->table);
        redirect(SITE . 'employee');
    }

    function exists($username) {
        $where = "usu_emp = '$username'";
        $this->db->where($where);
        $this->db->from($this->table);
        $query = $this->db->get();
        return $query->num_rows();
    }

}
