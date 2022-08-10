<?php
defined('BASEPATH') or exit('No direct script access allowed');

class WEB_Controller extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/userguide3/general/urls.html
     */

    protected $content1 = "motor";
    protected $content2 = "service";
    protected $content3 = "spart-cat";
    protected $content4 = "spart-prod";
    protected $content5 = "montir";
    protected $content6 = "transaksi";
    protected $content7 = "penjualan";
    protected $content8 = "user";

    function __construct()
    {
        parent::__construct();
        redirectIfNotLogin();
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->helper('array');
        $this->load->helper('url');
        $this->load->library('crumbs');
        $this->load->library('form_validation');
        $this->load->model('modelFunction');
    }


    /** Dashboard */
    public function dashboard()
    {
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Hi, " . getUserData()['name'] . " Welcome Back";
            $data['titleSubPages'] = 'Your dashboard';
            $data['basedTable']    = '';
        endif;
        $data['content'] = 'public/dashboard';
        $this->load->view('master', $data);
    }

    /** DATA SERVICES */
    public function showService()
    {
        redirectIfNotFrontdesk();
        $this->crumbs->add('Servis', base_url() . 'service/show');
        // $this->crumbs->add('Tambah Lokasi', base_url() . 'lokasi/add');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Data Service";
            $data['titleSubPages'] = '';
            $data['titleContent'] = $this->content2;
        endif;
        $data['content'] = 'public/service/index';
        $this->load->view('master', $data);
    }

    /** DATA MOTOR */
    public function showMotor()
    {
        redirectIfNotFrontdesk();
        $this->crumbs->add('Motor', base_url() . 'motor/show');
        // $this->crumbs->add('Tambah Lokasi', base_url() . 'lokasi/add');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Data Motor";
            $data['titleSubPages'] = '';
            $data['titleContent'] = $this->content1;
        endif;
        $data['content'] = 'public/motor/index';
        $this->load->view('master', $data);
    }

    /** DATA SPAREPART */
    public function showSpartCat()
    {
        redirectIfNotPartman();
        $this->crumbs->add('Sparepart Category', base_url() . 'spart-cat');
        // $this->crumbs->add('Tambah Lokasi', base_url() . 'lokasi/add');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Sparepart Category";
            $data['titleSubPages'] = '';
            $data['titleContent'] = $this->content3;
        endif;
        $data['content'] = 'public/sparepart/read_category';
        $this->load->view('master', $data);
    }

    public function showSpartProd()
    {
        redirectIfNotPartman();
        $this->crumbs->add('Sparepart Product', base_url() . 'spart-prod');
        // $this->crumbs->add('Tambah Lokasi', base_url() . 'lokasi/add');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Sparepart Product";
            $data['titleSubPages'] = '';
            $data['titleContent'] = $this->content4;
        endif;
        $data['content'] = 'public/sparepart/read_product';
        $this->load->view('master', $data);
    }



    /** DATA TRANSAKSI */
    public function showTransaksi()
    {
        redirectIfNotFrontdesk();
        $this->crumbs->add('Transaksi', base_url() . 'transaksi');
        // $this->crumbs->add('Tambah Lokasi', base_url() . 'lokasi/add');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Data Transaksi";
            $data['titleSubPages'] = '';
            $data['titleContent'] = $this->content6;
        endif;
        $data['content'] = 'public/transaksi/index';
        $this->load->view('master', $data);
    }

    public function addTransaksi()
    {
        redirectIfNotFrontdesk();
        $this->crumbs->add($this->content6, base_url() . 'transaksi');
        $this->crumbs->add("Tambah " . $this->content6, base_url() . 'transaksi/add');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Transaksi Services";
            $data['titleSubPages'] = '';
            $data['titleContent'] = $this->content6;
        endif;
        $data['content'] = 'public/transaksi/add';
        $this->load->view('master', $data);
    }

    public function detailTransaksi($id)
    {
        redirectIfNotFrontdesk();
        $this->crumbs->add($this->content6, base_url() . 'transaksi');
        $this->crumbs->add("Detail " . $this->content6, base_url() . 'transaksi/detail');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Detail Transaksi";
            $data['titleSubPages'] = '';
            $data['UrlId'] = $id;
            $data['getData'] = $this->modelFunction->getRawById('data_trans', 'trans_id', $id)->row_array();
            $data['titleContent'] = $this->content6;
        endif;
        $data['content'] = 'public/transaksi/detail';
        $this->load->view('master', $data);
    }


    /** DATA PENJUALAN */
    public function showPenjualan()
    {
        redirectIfNotFrontdesk();
        $this->crumbs->add('Penjualan', base_url() . 'penjualan');
        // $this->crumbs->add('Tambah Lokasi', base_url() . 'lokasi/add');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Data Penjualan";
            $data['titleSubPages'] = '';
            $data['titleContent'] = $this->content7;
        endif;
        $data['content'] = 'public/penjualan/index';
        $this->load->view('master', $data);
    }

    public function addPenjualan()
    {
        redirectIfNotFrontdesk();
        $this->crumbs->add($this->content6, base_url() . 'transaksi');
        $this->crumbs->add("Tambah " . $this->content6, base_url() . 'transaksi/add-sparepart');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Transaksi Spareparts";
            $data['titleSubPages'] = '';
            $data['titleContent'] = $this->content7;
        endif;
        $data['content'] = 'public/penjualan/add';
        $this->load->view('master', $data);
    }

    public function detailPenjualan($id)
    {
        redirectIfNotFrontdesk();
        $this->crumbs->add($this->content6, base_url() . 'penjualan');
        $this->crumbs->add("Detail " . $this->content6, base_url() . 'penjualan/detail');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Detail Penjualan";
            $data['titleSubPages'] = '';
            $data['UrlId'] = $id;
            $data['getData'] = $this->modelFunction->getRawById('data_trans', 'trans_id', $id)->row_array();
            $data['titleContent'] = $this->content7;
        endif;
        $data['content'] = 'public/penjualan/detail';
        $this->load->view('master', $data);
    }

    /** DATA MONTIR */
    public function showMontir()
    {
        redirectIfNotSuperadmin();
        $this->crumbs->add('Montir', base_url() . 'montir');
        // $this->crumbs->add('Tambah Lokasi', base_url() . 'lokasi/add');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Data Montir";
            $data['titleSubPages'] = '';
            $data['titleContent'] = $this->content5;
        endif;
        $data['content'] = 'public/montir/index';
        $this->load->view('master', $data);
    }

    /** DATA USER */
    public function showUser()
    {
        redirectIfNotSuperadmin();
        $this->crumbs->add('Users', base_url() . 'user/show');
        // $this->crumbs->add('Tambah Lokasi', base_url() . 'lokasi/add');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Data User";
            $data['titleSubPages'] = '';
            $data['titleContent'] = $this->content8;
        endif;
        $data['content'] = 'public/user/index';
        $this->load->view('master', $data);
    }
}
