<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Motor extends CI_Controller
{
    protected $table = 'data_motor';
    protected $tbId  = 'motor_id';

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
        $getmerek = $this->input->post('motor_merek');
        $getnama  = $this->input->post('motor_nama');
        $setId = strtoupper(substr($getmerek, 0, 3) . substr($getnama, 0, 3) . random_string('alpha', 3));
        $send = [
            'motor_id' => $setId,
            'motor_nm' => $getnama,
            'motor_merek' => $getmerek
        ];

        $store = $this->modelFunction->insert($this->table, $send);
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
        $setId = "";
        $oldMerek = $this->input->post('old_merek');
        $getmerek = $this->input->post('motor_merek');
        $getnama  = $this->input->post('motor_nama');
        if ($oldMerek == $getmerek) {
            $setId = $id;
        } else {
            $setId = strtoupper(substr($getmerek, 0, 3) . substr($getnama, 0, 3) . random_string('alpha', 3));
        }

        $data = [
            'motor_id' => $setId,
            'motor_nm' => $getnama,
            'motor_merek' => $getmerek
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
