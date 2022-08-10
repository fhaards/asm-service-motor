<?php

use FontLib\Table\Type\name;

defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    protected $table = 'users';
    protected $tbId  = 'user_id';

    function __construct()
    {
        parent::__construct();
        redirectIfNotLogin();
        $this->load->helper('form');
        $this->load->helper('date');
        $this->load->helper('array');
        $this->load->helper('url');
        $this->load->helper('string');
        $this->load->model('modelUser');
        $this->load->model('modelFunction');
    }

    public function index()
    {
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('level !=', 'superadmin');
        $data['data'] =  $this->db->get()->result_array();
        echo json_encode($data);
    }

    public function show($id)
    {
        $data['data'] = $this->modelFunction->getAllById($this->table, $this->tbId, $id);
        echo json_encode($data);
    }

    public function showUsername()
    {
        $username = $this->input->post('username');
        $this->db->where('username', $username);
        $query = $this->db->get($this->table);
        if ($query->num_rows() == 0) {
            echo json_encode(array(
                "statusCode" => 200,
                "msg" => "Username dapat digunakan",
            ));
        } else {
            echo json_encode(array(
                "statusCode" => 201,
                "msg" => "username tidak dapat digunakan",
            ));
        }
    }

    public function insert()
    {
        // 'name' => $this->input->post('name'),
        // 'email' => $this->input->post('email'),
        // 'password' => $this->input->post('password'),
        // 'level' => $this->input->post('level'),
        // 'telp' => $this->input->post('telp'),
        // 'alamat' => $this->input->post('alamat'),

        $password    = $this->input->post('password');
        $passwordNew = password_hash($password, PASSWORD_DEFAULT);

        $data = [
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $passwordNew,
            'password' => $this->input->post('password'),
            'level' => $this->input->post('level'),
            'telp' => $this->input->post('telp'),
            'alamat' => $this->input->post('alamat')
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
        // $oldPassword = $this->input->post('old_password');
        $password    = $this->input->post('password');
        if (empty($password)) {
            $newPass =  $this->input->post('old_password');
        } else {
            $newPass = password_hash($password, PASSWORD_DEFAULT);
        }

        $data = [
            'name' => $this->input->post('name'),
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'password' => $newPass,
            'level' => $this->input->post('level'),
            'telp' => $this->input->post('telp'),
            'alamat' => $this->input->post('alamat')
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
