<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    protected $table = 'data_trans';
    protected $tbId  = 'trans_id';

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
    }

    public function show($id = "")
    {
        $data  = [];
        $results = [];
        $resSparepart = [];
        $resTrans = [];
        $whereType = '(trans_tipe="1" and status = "Completed") or trans_tipe ="3"';
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where($whereType);
        if (!empty($id)) :
            $this->db->where('data_trans.trans_id', $id, TRUE);
        endif;
        $query = $this->db->get()->result_array();
        foreach ($query as $key => $q) {
            if (!empty($id)) :

                $getSpareData = $this->modelFunction->getAllById('data_trans_spart', 'id_trans', $id);
                foreach ($getSpareData as $keySpar => $spar) {
                    $resSparepart['data_sparepart'][$keySpar] = [
                        'sparepart_nm' => $spar['sparepart_nm'],
                        'sparepart_hrg' => $spar['sparepart_hrg'],
                        'sparepart_qty' => $spar['sparepart_qty'],
                        'sparepart_total_hrg' => $spar['sparepart_total_hrg']
                    ];
                }

                $resTrans = [
                    'trans_id' => $q['trans_id'],
                    'trans_tipe' => $q['trans_tipe'],
                    'cust_nm' => $q['cust_nm'],
                    'cust_tlp' => $q['cust_tlp'],
                    'trans_tgl' => $q['trans_tgl'],
                    'total_harga' => $q['total_harga'],
                    'uang_bayar' => $q['uang_bayar'],
                    'uang_kembali' => $q['uang_kembali'],
                    'status' => $q['status']
                ];

                $results = array_merge($resTrans, $resSparepart);
            else :
                $results[$key] = [
                    'trans_id' => $q['trans_id'],
                    'trans_tipe' => $q['trans_tipe'],
                    'cust_nm' => $q['cust_nm'],
                    'cust_tlp' => $q['cust_tlp'],
                    'trans_tgl' => $q['trans_tgl'],
                    'total_harga' => $q['total_harga'],
                    'uang_bayar' => $q['uang_bayar'],
                    'uang_kembali' => $q['uang_kembali'],
                    'status' => $q['status']
                ];
            endif;
        }
        $data['data'] = $results;
        echo json_encode($data);
    }

    public function insert()
    {
        $result = "";
        $idSparepart  = $this->input->post('id_sparepart', TRUE);

        /** SPAREPART */
        $nmSparepart  = 0;
        $hrgSparepart = 0;

        $dataBatch1 = array();


        /** SERVICE */
        $subTotalSpr = 0;

        // COUNT TOTAL
        $grandTotal = 0;
        $setupId  = strtoupper('SP-' . random_string('alpha', 2) . date('Ymd')   . date('his'));
        foreach ($idSparepart as $key => $val) :
            $newIdSpr     = $_POST['id_sparepart'][$key];
            $getQty       = $_POST['qty'][$key];
            $hrgSparepart = $_POST['hrg'][$key];
            $nmSparepart  = $_POST['nmspr'][$key];
            $subTotal     = $_POST['subtotal'][$key];
            $subTotalSpr += $subTotal;

            $dataBatch1[] = array(
                'id_trans'       => $setupId,
                'sparepart_id'   => $newIdSpr,
                'sparepart_nm'   => $nmSparepart,
                'sparepart_hrg'  => $hrgSparepart,
                'sparepart_qty'  => $getQty,
                'sparepart_total_hrg' => $subTotal
            );
        endforeach;
        $grandTotal = $subTotalSpr;
        $insert = $this->modelFunction->insert_batch('data_trans_spart', $dataBatch1);
        if ($insert) {
            $result = [
                'trans_id'      => $setupId,
                'trans_tipe'    => 3,
                'cust_nm'       => $this->input->post('cust_nm'),
                'cust_nm'       => $this->input->post('cust_nm'),
                'cust_tlp'      => $this->input->post('cust_tlp'),
                'trans_tgl'     => $this->input->post('trans_tgl'),
                'total_harga'   => $grandTotal,
                'status'        => 'Pending'
            ];
            $insertToTrans = $this->modelFunction->insert($this->table, $result);
            if ($insertToTrans) {
                echo json_encode(array(
                    "statusCode" => 200,
                    "responseId" => $setupId,
                ));
            } else {
                echo json_encode(array(
                    "statusCode" => 201,
                    "responseId" => "",
                ));
            }
        } else {
            echo json_encode(array(
                "statusCode" => 201,
                "responseId" => "",
            ));
        }
    }

    public function delete($id)
    {
        $this->modelFunction->delete('data_trans_spart', 'id_trans', $id);
        $storeFirst = $this->modelFunction->delete('data_trans_service', 'id_trans', $id);
        if ($storeFirst) {
            $store = $this->modelFunction->delete($this->table, $this->tbId, $id);
            if ($store) {
                echo json_encode(array(
                    "statusCode" => 200
                ));
            } else {
                echo json_encode(array(
                    "statusCode" => 201
                ));
            }
        } else {
            echo json_encode(array(
                "statusCode" => 201
            ));
        }
    }

    public function updateStatus($id)
    {
        $getSpartSelling = $this->modelFunction->getAllById('data_trans_spart', 'id_trans', $id);
        $dataStock = [];

        $uangBayar = $this->input->post('uang_bayar');
        $totalHrg  = $this->input->post('total_harga');
        $kembalian = $totalHrg - $uangBayar;
        $data = [
            'uang_bayar' => $uangBayar,
            'uang_kembali' => $kembalian,
            'status' => 'Completed',
        ];
        $this->db->where($this->tbId, $id);
        $store = $this->db->update($this->table, $data);
        if ($store) {
            // CHECK IF SPAREPART AVAILABLE
            if (!empty($getSpartSelling)) {
                foreach ($getSpartSelling as $sr) {
                    $getSpartIdSell  = $sr['sparepart_id'];
                    $getSpartQtySell = $sr['sparepart_qty'];
                    $getSpartStock   = $this->modelFunction->getAllById('data_spart_product', 'sparepart_prod_id', $getSpartIdSell);
                    foreach ($getSpartStock as  $sr) {
                        $getSpartStock = $sr['sparepart_prod_stock'] - $getSpartQtySell;
                        $dataStock[] = [
                            'sparepart_prod_id' => $getSpartIdSell,
                            'sparepart_prod_stock' => $getSpartStock,
                        ];
                    }
                }
                $storeQty = $this->db->update_batch('data_spart_product', $dataStock, 'sparepart_prod_id');
                if ($storeQty) {
                    echo json_encode(array(
                        "statusCode" => 200
                    ));
                } else {
                    echo json_encode(array(
                        "statusCode" => 210
                    ));
                }
            } else {
                echo json_encode(array(
                    "statusCode" => 200
                ));
            }
        } else {
            echo json_encode(array(
                "statusCode" => 210
            ));
        }
    }
}
