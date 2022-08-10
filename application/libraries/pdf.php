<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Pdf extends Dompdf
{
    protected $ci;
    private $filename;

    public function __construct()
    {
        parent::__construct();
        $this->ci = &get_instance();
    }

    public function setFileName($filename)
    {
        $this->filename = $filename;
    }

    public function loadView($viewFile, $data = array())
    {
        $options = new Options();
        $options->setChroot($_SERVER["DOCUMENT_ROOT"] . '\asm_');
        $options->setDefaultFont('courier');
        $this->setOptions($options);
        // $_SERVER['DOCUMENT_ROOT'] . 'assets/plugins/bootstrap/css/bootstrap.css';
        // $based = $_SERVER['DOCUMENT_ROOT'];
        // $html = "<link type='text/css' href='$based/assets/css/azia.css' rel='stylesheet' />";
        $html = $this->ci->load->view($viewFile, $data, true);
        $this->loadHtml($html);
        $this->render();
        $this->stream($this->filename, ['Attachment' => 0]);
    }
}
