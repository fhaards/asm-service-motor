<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Foo extends CI_Controller
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
        $data = $this->uuid->v4();
        echo json_encode($data);
    }
}
