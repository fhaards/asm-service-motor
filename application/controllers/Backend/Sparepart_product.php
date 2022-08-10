<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sparepart_product extends CI_Controller
{
    protected $table = 'data_spart_product';
    protected $tbId  = 'sparepart_prod_id';

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

        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('data_spart_category', 'data_spart_category.sparepart_cat_id = data_spart_product.category');
        $query = $this->db->get()->result_array();
        foreach ($query as $k => $val) {
            $getId = $val['sparepart_prod_id'];
            $this->db->select("COUNT(sparepart_id) AS total_in");
            $this->db->from("data_trans_spart");
            $this->db->where('sparepart_id', $getId, TRUE);
            $getProd = $this->db->get()->row_array();
            $totalP = (int)$getProd['total_in'];

            $result[] = [
                'sparepart_prod_id' => $val['sparepart_prod_id'],
                'sparepart_prod_nm' => $val['sparepart_prod_nm'],
                'sparepart_cat_nm' => $val['sparepart_cat_nm'],
                'sparepart_prod_hrg' => $val['sparepart_prod_hrg'],
                'sparepart_prod_stock' => $val['sparepart_prod_stock'],
                'created_at' => $val['created_at'],
                'updated_at' => $val['updated_at'],
                'sparepart_total_in' => $totalP . " <small class='text-muted'> Transaksi</small>",
            ];
        }
        $data['data'] = $result;
        echo json_encode($data);
    }

    public function show($id)
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('data_spart_category', 'data_spart_category.sparepart_cat_id = data_spart_product.category');
        $this->db->where('data_spart_product.sparepart_prod_id', $id);
        $query = $this->db->get();
        $data['data'] = $query->result_array();
        echo json_encode($data);
    }

    public function readyStock()
    {
        $data['data'] = $this->modelFunction->getAllById($this->table, 'sparepart_prod_stock >', 0);
        echo json_encode($data);
    }

    public function insert()
    {
        $setId   = "";
        // $getId   = $this->input->post('sparepart_prod_id');
        $input1  = $this->input->post('category');
        $input2  = $this->input->post('sparepart_prod_nm');

        $uidCat    = $this->modelFunction->findBy('data_spart_category', 'sparepart_cat_id', $input1);
        $getUidCat = $uidCat['sparepart_cat_code'];
        $getRand   = random_string('numeric', 1) . random_string('alpha', 1) . random_string('numeric', 3);
        $setId     = strtoupper($getUidCat . $getRand);

        // if (empty($getId)) :
        //     $setId = strtoupper('PRD' . random_string('numeric', 5));
        // else :
        //     $setId = strtoupper($getId . random_string('numeric', 5));
        // endif;

        $send = [
            'sparepart_prod_id' => $setId,
            'category' => $input1,
            'sparepart_prod_nm' => $input2,
            'sparepart_prod_hrg' => $this->input->post('sparepart_prod_hrg'),
            'sparepart_prod_desc' => $this->input->post('sparepart_prod_desc'),
            'sparepart_prod_stock' => $this->input->post('sparepart_prod_stock'),
            'created_at' => date('Y-m-d H:i:s'),
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
        $input1  = $this->input->post('category');
        $data = [
            'category' => $input1,
            'sparepart_prod_nm' => $this->input->post('sparepart_prod_nm'),
            'sparepart_prod_hrg' => $this->input->post('sparepart_prod_hrg'),
            'sparepart_prod_desc' => $this->input->post('sparepart_prod_desc'),
            'updated_at' => date('Y-m-d H:i:s')
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

    public function updateStock($id)
    {
        $newstock  = $this->input->post('new_stock');
        $data = [
            'sparepart_prod_stock' => $newstock
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
