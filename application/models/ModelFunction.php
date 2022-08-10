<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelFunction extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    function getAll($table)
    {
        $this->db->select('*');
        $this->db->from($table);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getAllById($table, $fieldName, $value)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($fieldName, $value);
        $query = $this->db->get();
        return $query->result_array();
    }


    function getRawById($table, $fieldName, $value)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($fieldName, $value);
        return $this->db->get();
    }

    function insert($table, $send)
    {
        return $this->db->insert($table,  $send);
    }

    function insert_batch($table, $dataBatch)
    {
        return $this->db->insert_batch($table,  $dataBatch);
    }

    public function delete($table, $fieldName, $id)
    {
        return $this->db->delete($table, array($fieldName => $id));
    }

    function findBy($table, $fieldName, $value)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($fieldName, $value);
        $query = $this->db->get();
        return $query->row_array();
    }
}
