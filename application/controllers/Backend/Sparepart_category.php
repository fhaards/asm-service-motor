<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sparepart_category extends CI_Controller
{
    protected $table = 'data_spart_category';
    protected $tbId  = 'sparepart_cat_id';

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
        $result = [];
        $totalP = [];
        $query  = $this->modelFunction->getAll($this->table);
        foreach ($query as $k => $val) {
            $getId = $val['sparepart_cat_id'];
            $this->db->select("COUNT(sparepart_prod_id) AS total_prod");
            $this->db->from("data_spart_product");
            $this->db->where('data_spart_product.category', $getId, TRUE);
            $getProd = $this->db->get()->row_array();
            $totalP = (int)$getProd['total_prod'];
            $result[] = [
                'sparepart_cat_id' => $val['sparepart_cat_id'],
                'sparepart_cat_code' => $val['sparepart_cat_code'],
                'sparepart_cat_nm' => $val['sparepart_cat_nm'],
                'sparepart_total' => $totalP
            ];
        }

        $data['data'] = $result;
        echo json_encode($data);
    }

    public function show($id)
    {
        $data['data'] = $this->modelFunction->getAllById($this->table, $this->tbId, $id);
        echo json_encode($data);
    }

    public function insert()
    {
        $newCode = "";
        $getCode = $this->input->post('sparepart_cat_code');
        $getName = $this->input->post('sparepart_cat_nm');
        if (empty($getCode)) :
            $newCode = substr($getName, 0, 1) . random_string('alnum', 2);
        else :
            $newCode =  $this->input->post('sparepart_cat_code');
        endif;

        $data = [
            'sparepart_cat_code' => strtoupper($newCode),
            'sparepart_cat_nm' => $getName
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
            'sparepart_cat_code' => $this->input->post('sparepart_cat_code'),
            'sparepart_cat_nm' => $this->input->post('sparepart_cat_nm'),
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
