<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Montir extends CI_Controller
{
    protected $table = 'data_montir';
    protected $tbId  = 'montir_id';

    function __construct()
    {
        parent::__construct();
        redirectIfNotLogin();
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->helper('array');
        $this->load->helper('url');
        $this->load->helper('string');
        $this->load->model('modelFunction');
    }

    public function index()
    {
        $data['data'] = $this->modelFunction->getAll($this->table);
        echo json_encode($data);
    }

    public function show($id)
    {
        $data['data'] = $this->modelFunction->getAllById($this->table, $this->tbId, $id);
        echo json_encode($data);
    }

    public function insert()
    {
        $setId = strtoupper('MRT' . random_string('numeric', 5));
        $data = [
            'montir_id'        => $setId,
            'montir_nm'        => $this->input->post('montir_nm'),
            'montir_tlp'       => $this->input->post('montir_tlp'),
            'montir_jk'        => $this->input->post('montir_jk'),
            'montir_tgl_lahir' => $this->input->post('montir_tgl_lahir'),
            'montir_alamat'    => $this->input->post('montir_alamat')
        ];

        $store = $this->modelFunction->insert($this->table, $data);
        if ($store) {
            echo json_encode(array(
                "statusCode" => 200
            ));
        } else {
            echo json_encode(array(
                "statusCode" => 201
            ));
        }
    }

    public function delete($id)
    {
        $storeFirst = $this->modelFunction->delete($this->table, $this->tbId, $id);
        if ($storeFirst) {
            echo json_encode(array(
                "statusCode" => 200
            ));
        } else {
            echo json_encode(array(
                "statusCode" => 201
            ));
        }
    }

    public function update($id)
    {
        $data = [
            'montir_nm'        => $this->input->post('montir_nm'),
            'montir_tlp'       => $this->input->post('montir_tlp'),
            'montir_jk'        => $this->input->post('montir_jk'),
            'montir_tgl_lahir' => $this->input->post('montir_tgl_lahir'),
            'montir_alamat'    => $this->input->post('montir_alamat')
        ];
        $this->db->where($this->tbId, $id);
        $store = $this->db->update($this->table, $data);
        if ($store) {
            echo json_encode(array(
                "statusCode" => 200
            ));
        } else {
            echo json_encode(array(
                "statusCode" => 201
            ));
        }
    }
}
