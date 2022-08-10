<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Reports extends CI_Controller
{
	protected $table  = 'data_trans';

	function __construct()
	{
		parent::__construct();
		redirectIfNotLogin();
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->helper('array');
		$this->load->helper('url');
		$this->load->helper('string');
		$this->load->helper('directory');
		$this->load->helper("file");
		$this->load->library('form_validation');
		$this->load->library('crumbs');
		$this->load->model('modelFunction');
		$this->load->library('pdf');
	}

	/*
	| -------------------------------------------------------------------------
	| SPAREPARTS
	| -------------------------------------------------------------------------
	*/

	public function sparepart($id = "")
	{
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->setFileName = "report-spareparts.pdf";
		$data['title_pdf'] = 'SEMUA DATA SPAREPARTS';
		$data['tipe_data'] = 'all';

		$result = [];
		$totalP = [];

		$this->db->select('*');
		$this->db->from('data_spart_product');
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
		$data['item'] = $result;
		$this->pdf->loadView('public/reports/report_sparepart', $data);
	}
	public function sparepartByDate($id = "")
	{
		$date = $id;
		$newDate = date('d-F-Y', strtotime($date));
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->setFileName = "report-spareparts.pdf";
		$data['title_pdf'] = 'SEMUA DATA SPAREPARTS , TANGGAL : ' . $newDate;
		$data['tipe_data'] = 'all';

		$result = [];
		$totalP = [];


		$this->db->select('*');
		$this->db->from('data_spart_product');
		$this->db->join('data_spart_category', 'data_spart_category.sparepart_cat_id = data_spart_product.category');
		// $this->db->where('data_spart_product.created_at', $newDate, TRUE);
		$this->db->where("DATE_FORMAT(created_at,'%Y-%m-%d')", $id);
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
		$data['item'] = $result;
		$this->pdf->loadView('public/reports/report_sparepart', $data);
	}

	public function sparepartByMonth($id = "")
	{
		$date = $id;
		$newDate = date('d-F-Y', strtotime($date));
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->setFileName = "report-spareparts.pdf";
		$data['title_pdf'] = 'SEMUA DATA SPAREPARTS , TANGGAL : ' . $newDate;
		$data['tipe_data'] = 'all';

		$result = [];
		$totalP = [];


		$this->db->select('SUM()');
		$this->db->from('data_spart_product');
		$this->db->join('data_spart_category', 'data_spart_category.sparepart_cat_id = data_spart_product.category');
		// $this->db->where('data_spart_product.created_at', $newDate, TRUE);
		$this->db->where("MONTH(created_at)", $id);
		$query = $this->db->get()->result_array();
		echo json_encode($query);
		exit;
		$data['item'] = $result;
		$this->pdf->loadView('public/reports/report_sparepart', $data);
	}

	/*
	| -------------------------------------------------------------------------
	| TRANSAKSI
	| -------------------------------------------------------------------------
	*/

	public function transaksi($id = "")
	{
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->setFileName = "report-transaksi.pdf";
		$data['tipe_data'] = 'harian';
		$getSpareData = [];

		$resultSparepart = "";
		$getService = [];
		$countService = 0;
		$results = [];


		$data['title_pdf'] = 'SEMUA DATA TRANSAKSI';
		$whereType = '(trans_tipe="1" or trans_tipe = "2")';
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('data_motor', 'data_motor.motor_id = data_trans.cust_motor');
		$this->db->join('data_montir', 'data_montir.montir_id = data_trans.montir');
		$this->db->where($whereType);
		$query = $this->db->get()->result_array();
		foreach ($query as $key => $q) {
			$idtr = $q['trans_id'];

			$countHrgSpr = 0;
			$countQty = 0;
			$resSparepart = [];
			$resService = [];
			$countService = 0;


			/** SPAREPARTS */
			$getSpareData = $this->modelFunction->getAllById('data_trans_spart', 'id_trans', $idtr);
			if (empty($getSpareData)) {
				$resSparepart['data_sparepart'] = null;
				$resSparepart['subtotal_hrg'] = null;
			} else {
				foreach ($getSpareData as $keySpar => $spar) {
					$resSparepart['data_sparepart'][$keySpar] = [
						'sparepart_nm' => $spar['sparepart_nm'],
						'sparepart_hrg' => $spar['sparepart_hrg'],
						'sparepart_qty' => $spar['sparepart_qty'],
						'sparepart_total_hrg' => $spar['sparepart_total_hrg']
					];
					$countQty 	  += $spar['sparepart_qty'];
					$countHrgSpr  += $spar['sparepart_total_hrg'];
				}
			}
			$resSparepart['total_qty'] = $countQty;
			$resSparepart['subtotal_hrg'] = $countHrgSpr;


			/** SERVICE */
			$getService = $this->modelFunction->getAllById('data_trans_service', 'id_trans', $idtr);
			foreach ($getService as $kServ => $vServ) {
				$countService += $vServ['service_hrg'];
				$resService['data_service'][$kServ] = [
					'service_nm' => $vServ['service_nm'],
					'service_hrg' => $vServ['service_hrg'],
				];
				$resService['total_service'] = $countService;
			}

			$resTrans = [
				'trans_id' => $q['trans_id'],
				'trans_tipe' => $q['trans_tipe'],
				'cust_nm' => $q['cust_nm'],
				'cust_tlp' => $q['cust_tlp'],
				'cust_motor' => $q['motor_nm'],
				'trans_tgl' => $q['trans_tgl'],
				'montir' => $q['montir_nm'],
				'total_harga' => $q['total_harga'],
				'uang_bayar' => $q['uang_bayar'],
				'uang_kembali' => $q['uang_kembali'],
			];
			$results[] = array_merge($resTrans, $resService, $resSparepart);
		}

		// echo json_encode($results);
		// exit;

		$this->db->select('SUM(total_harga) as grandtotal_hrg');
		$this->db->from($this->table);
		$this->db->where($whereType);
		$count = $this->db->get()->row_array();

		$data['item']  = $results;
		$data['count'] = $count;
		$this->pdf->loadView('public/reports/report_transaksi', $data);
	}

	public function transaksiByDate($id = "")
	{
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->setFileName = "report-transaksi.pdf";
		$data['title_pdf'] = 'SEMUA DATA TRANSAKSI ,TANGGAL : ' . $id;
		$data['tipe_data'] = 'harian';

		$whereType = '(trans_tipe="1" or trans_tipe = "2")';
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->join('data_motor', 'data_motor.motor_id = data_trans.cust_motor');
		$this->db->join('data_montir', 'data_montir.montir_id = data_trans.montir');
		$this->db->where('data_trans.trans_tgl', $id, TRUE);
		$this->db->where($whereType);
		$query = $this->db->get()->result_array();
		foreach ($query as $key => $q) {
			$idtr = $q['trans_id'];

			$countHrgSpr = 0;
			$countQty = 0;
			$resSparepart = [];
			$resService = [];
			$countService = 0;


			/** SPAREPARTS */
			$getSpareData = $this->modelFunction->getAllById('data_trans_spart', 'id_trans', $idtr);
			if (empty($getSpareData)) {
				$resSparepart['data_sparepart'] = null;
				$resSparepart['subtotal_hrg'] = null;
			} else {
				foreach ($getSpareData as $keySpar => $spar) {
					$resSparepart['data_sparepart'][$keySpar] = [
						'sparepart_nm' => $spar['sparepart_nm'],
						'sparepart_hrg' => $spar['sparepart_hrg'],
						'sparepart_qty' => $spar['sparepart_qty'],
						'sparepart_total_hrg' => $spar['sparepart_total_hrg']
					];
					$countQty 	  += $spar['sparepart_qty'];
					$countHrgSpr  += $spar['sparepart_total_hrg'];
				}
			}
			$resSparepart['total_qty'] = $countQty;
			$resSparepart['subtotal_hrg'] = $countHrgSpr;


			/** SERVICE */
			$getService = $this->modelFunction->getAllById('data_trans_service', 'id_trans', $idtr);
			foreach ($getService as $kServ => $vServ) {
				$countService += $vServ['service_hrg'];
				$resService['data_service'][$kServ] = [
					'service_nm' => $vServ['service_nm'],
					'service_hrg' => $vServ['service_hrg'],
				];
				$resService['total_service'] = $countService;
			}

			$resTrans = [
				'trans_id' => $q['trans_id'],
				'trans_tipe' => $q['trans_tipe'],
				'cust_nm' => $q['cust_nm'],
				'cust_tlp' => $q['cust_tlp'],
				'cust_motor' => $q['motor_nm'],
				'trans_tgl' => $q['trans_tgl'],
				'montir' => $q['montir_nm'],
				'total_harga' => $q['total_harga'],
				'uang_bayar' => $q['uang_bayar'],
				'uang_kembali' => $q['uang_kembali'],
			];
			$results[] = array_merge($resTrans, $resService, $resSparepart);
		}

		$this->db->select('SUM(total_harga) as grandtotal_hrg');
		$this->db->from($this->table);
		$this->db->where('data_trans.trans_tgl', $id, TRUE);
		$this->db->where($whereType);
		$count = $this->db->get()->row_array();

		$data['item']  = $results;
		$data['count'] = $count;
		$this->pdf->loadView('public/reports/report_transaksi', $data);
	}

	public function transaksiByMonth($id = "")
	{
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->setFileName = "report-transaksi.pdf";
		$data['title_pdf'] = 'SEMUA DATA TRANSAKSI ,BULAN : ' . $id;
		$data['tipe_data'] = 'bulanan';

		$this->db->select('*,COUNT(trans_id) AS total_trans');
		$this->db->from($this->table);
		$this->db->where("MONTH(trans_tgl)", $id);
		$this->db->group_by('trans_tgl');
		$query = $this->db->get()->result_array();

		$this->db->select('trans_tgl,SUM(total_harga) as grandtotal_hrg,');
		$this->db->from($this->table);
		$this->db->where("MONTH(trans_tgl)", $id);
		$this->db->group_by('trans_tgl');
		$count = $this->db->get()->row_array();

		$data['item']  = $query;
		$data['count'] = $count;
		$this->pdf->loadView('public/reports/report_transaksi', $data);
	}

	/*
	| -------------------------------------------------------------------------
	| PENJUALAN
	| -------------------------------------------------------------------------
	*/

	public function penjualan($id = "")
	{
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->setFileName = "report-penjualan.pdf";
		$data['title_pdf'] = 'SEMUA DATA PENJUALAN SPAREPARTS';
		$data['tipe_data'] = 'all';

		$this->db->select('*');
		$this->db->from('data_trans_spart');
		$this->db->join('data_trans', 'data_trans.trans_id = data_trans_spart.id_trans');
		$query = $this->db->get()->result_array();

		$this->db->select('SUM(sparepart_qty) as grandtotal_qty,SUM(sparepart_total_hrg) as grandtotal_hrg');
		$this->db->from('data_trans_spart');
		$count = $this->db->get()->row_array();

		$data['item']  = $query;
		$data['count'] = $count;
		$this->pdf->loadView('public/reports/report_penjualan', $data);
	}

	public function penjualanByDate($id = "")
	{
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->setFileName = "report-penjualan.pdf";
		$data['title_pdf'] = 'SEMUA DATA PENJUALAN SPAREPARTS ,TANGGAL : ' . $id;
		$data['tipe_data'] = 'all';

		$this->db->select('*');
		$this->db->from('data_trans_spart');
		$this->db->join('data_trans', 'data_trans.trans_id = data_trans_spart.id_trans');
		$this->db->where('data_trans.trans_tgl', $id, TRUE);
		$query = $this->db->get()->result_array();

		$this->db->select('SUM(sparepart_qty) as grandtotal_qty,SUM(sparepart_total_hrg) as grandtotal_hrg');
		$this->db->from('data_trans_spart');
		$this->db->join('data_trans', 'data_trans.trans_id = data_trans_spart.id_trans');
		$this->db->where('data_trans.trans_tgl', $id, TRUE);
		$count = $this->db->get()->row_array();

		$data['item']  = $query;
		$data['count'] = $count;
		$this->pdf->loadView('public/reports/report_penjualan', $data);
	}

	public function penjualanByMonth($id = "")
	{
		$this->pdf->setPaper('A4', 'landscape');
		$this->pdf->setFileName = "report-penjualan.pdf";

		$dateObj   = DateTime::createFromFormat('!m', $id);
		$monthName = $dateObj->format('F');

		$data['title_pdf'] = 'SEMUA DATA PENJUALAN SPAREPARTS , BULAN : ' . $monthName;
		$data['tipe_data'] = 'bulanan';

		$this->db->select('data_trans.trans_id,data_trans.trans_tgl');
		$this->db->select('SUM(sparepart_qty) as sparepart_qty,SUM(sparepart_total_hrg) as sparepart_total_hrg');
		$this->db->from('data_trans_spart');
		$this->db->join('data_trans', 'data_trans.trans_id = data_trans_spart.id_trans');
		$this->db->where("MONTH(trans_tgl)", $id);
		$this->db->group_by('trans_tgl');
		$query = $this->db->get()->result_array();

		$this->db->select('SUM(sparepart_qty) as grandtotal_qty,SUM(sparepart_total_hrg) as grandtotal_hrg');
		$this->db->from('data_trans_spart');
		$this->db->join('data_trans', 'data_trans.trans_id = data_trans_spart.id_trans');
		$this->db->where("MONTH(trans_tgl)", $id);
		$this->db->where('data_trans.trans_tipe', 3, TRUE);
		$count = $this->db->get()->row_array();

		$data['item']  = $query;
		$data['count'] = $count;
		$this->pdf->loadView('public/reports/report_penjualan', $data);
	}
}
