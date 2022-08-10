<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Counter extends CI_Controller
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

    public function dashboard()
    {
        $countMotor   = $this->db->count_all_results('data_motor');
        $countService = $this->db->count_all_results('data_service');
        $countMontir  = $this->db->count_all_results('data_montir');

        $countTrans = $this->db->count_all_results('data_trans');
        $countTransAmount = $this->db->select('(SELECT SUM(data_trans.total_harga) FROM data_trans) AS amout')->get()->row();

        $countSpartAmount = $this->db->select('(SELECT SUM(data_trans_spart.sparepart_total_hrg) FROM data_trans_spart) AS amout')->get()->row();
        $countSpartQty    = $this->db->select('(SELECT SUM(data_trans_spart.sparepart_qty) FROM data_trans_spart) AS qtys')->get()->row();

        $result = [
            'count_motor' => $countMotor,
            'count_service' => $countService,
            'count_montir' => $countMontir,
            'count_transaksi' => $countTrans,
            'count_transaksi_amount' => $countTransAmount->amout,
            'count_sparepart_qty' => $countSpartQty->qtys,
            'count_sparepart_amount' => $countSpartAmount->amout
        ];
        echo json_encode($result);
    }

    public function statistikTransaksi($tahun = "")
    {
        $resultData = [];
        $months = ['01' => 'Jan', '02' => 'Feb.', '03' => 'Mar.', '04' => 'Apr.', '05' => 'Mei', '06' => 'Jun.', '07' => 'Jul.', '08' => 'Agu.', '09' => 'Sep.', '10' => 'Okt.', '11' => 'Nov.', '12' => 'Des.'];
        foreach ($months as $num => $name) {
            $setFill = $tahun . '-' . $num;
            $this->db->select('SUM(total_harga) as total');
            $this->db->from('data_trans');
            $this->db->where("DATE_FORMAT(trans_tgl,'%Y-%m')", $setFill);
            $data = $this->db->get()->result_array();
            foreach ($data as $val) {
                $resultData[] = [
                    'bulan' => $name,
                    'pendapatan' => (int)$val['total'],
                ];
            }
        }
        echo json_encode($resultData);
    }
}
