<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Service extends CI_Controller
{
    protected $table = 'data_service';
    protected $tbId  = 'service_id';

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
        $input1 = $this->input->post('service_nm');
        $input2  = $this->input->post('service_hrg');
        $setId = strtoupper('SRV' . random_string('alnum', 5));
        $send = [
            'service_id' => $setId,
            'service_nm' => $input1,
            'service_hrg' => $input2
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
        $input1  = $this->input->post('service_nm');
        $input2  = $this->input->post('service_hrg');
        $data = [
            'service_nm'  => $input1,
            'service_hrg' => $input2
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
