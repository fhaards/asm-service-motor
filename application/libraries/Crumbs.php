<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crumbs
{
    private $breadcrumbs = array();
    private $separator = ' ';
    private $start = '<ol class="az-content-breadcrumb py-2 mx-0 px-0">';
    private $end = '</ol>';

    public function __construct($params = array())
    {
        if (count($params) > 0) {
            $this->initialize($params);
        }
    }

    private function initialize($params = array())
    {
        if (count($params) > 0) {
            foreach ($params as $key => $val) {
                if (isset($this->{'_' . $key})) {
                    $this->{'_' . $key} = $val;
                }
            }
        }
    }

    function add($title, $href)
    {
        if (!$title or !$href)
            return;

        $this->breadcrumbs[] = array(
            'title' => $title,
            'href' => $href
        );
    }

    function output()
    {
        if ($this->breadcrumbs) {
            $output = $this->start;
            $output .= '<span class=""><a href="' . base_url('dashboard') . '" class=""> Dashboard </a></span>';
            // if (isAdmin()) {
            //     $output .= '<li><a href="' . base_url() . 'dashboard" class="hover:text-gray-700 hover:underline"> Dashboard  </a></li>';
            // }
            // else {
            //     $output .= '<li><a href="' . base_url('dashboard') . '" class="hover:text-gray-700 hover:underline"> Home  </a></li>';
            // }
            $output .= $this->separator;
            foreach ($this->breadcrumbs as $key => $crumb) {
                if ($key) {
                    $output .= $this->separator;
                }
                $lastBreadcrumb = (array_keys($this->breadcrumbs));
                if (end($lastBreadcrumb) == $key) {
                    $output .= '<span class="text-green-500 font-bold">' . $crumb['title'] . '</span>';
                } else {
                    $output .= '<span class="me-2"><a href="' . $crumb['href'] . '">' . $crumb['title'] . '</a></span>';
                }
            }
            return $output . $this->end . PHP_EOL;
        }
        return '';
    }
}
