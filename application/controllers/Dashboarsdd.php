<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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

    protected $table = "";

    function __construct()
    {
        parent::__construct();
        // redirectIfNotLogin();
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->helper('array');
        $this->load->helper('url');
        $this->load->library('crumbs');
        $this->load->library('form_validation');
        $this->load->model('modelFunction');
    }


    public function index()
    {
        // $this->crumbs->add('Dashboard', base_url() . 'dashboard');
        // $this->crumbs->add('Tambah Lokasi', base_url() . 'lokasi/add');
        $data['breadcrumb']    = $this->crumbs->output();
        if (isLogin()) :
            $data['titlePages']    = "Hi, " . getUserData()['name'] . " Welcome Back";
            $data['titleSubPages'] = 'Your dashboard';
            $data['basedTable']    = '';
        endif;
        $data['content'] = 'public/dashboard';
        $this->load->view('master', $data);
    }
}
