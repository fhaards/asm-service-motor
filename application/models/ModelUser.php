<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
    protected $table = 'users';

    public function __construct()
    {
        $this->load->database();
    }

    // IS SUPER USER
    public function read()
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->like('level', 'operator');
        $query = $this->db->get();
        return $query->result_array();
    }

    function readAccount($table, $id)
    {
        $this->db->select('users.user_id as uid,users.username,users.name,users.user_status,users_account.*,contingent.contingent_id,contingent.contingent_name,contingent.contingent_address');
        $this->db->from($table);
        $this->db->join('users_account', 'users.user_id = users_account.user_id', 'INNER');
        $this->db->join('contingent', 'users_account.contingent_id = contingent.contingent_id', 'INNER');
        $this->db->where('users.user_id', $id);
        return $this->db->get()->row_array();
    }

    function readAccountAll()
    {
        $this->db->select('users.user_id as uid,users.username,users.name,users.user_status,users.level,users.created_at,
                        users_account.*,
                        contingent.contingent_id,contingent.contingent_name,contingent.contingent_address');
        $this->db->from('users');
        $this->db->join('users_account', 'users.user_id = users_account.user_id', 'INNER');
        $this->db->join('contingent', 'users_account.contingent_id = contingent.contingent_id', 'INNER');
        $this->db->where_not_in('users.level', 'superadmin');
        $this->db->order_by('created_at', 'desc');
        return $this->db->get()->result_array();
    }

    public function add()
    {
        $name       = $this->input->post('name');
        $gender     = $this->input->post('gender');
        $username   = $this->input->post('username');
        $password   = $this->input->post('password');
        $contId     = $this->input->post('contingent_id');
        $level      = 'user';
        $passNew    = password_hash($password, PASSWORD_DEFAULT);

        $data = array(
            'name' => $name,
            'username' => $username,
            'password' => $passNew,
            'created_at' => date("Y-m-d h:i:s"),
            'user_status' => '1',
            'level' => $level
        );
        $query = $this->db->insert($this->table, $data);
        $getIdRecents = $this->db->insert_id();
        if ($query) {
            $data2 = array(
                'user_id' => $getIdRecents,
                'contingent_id' => $contId,
                'gender' => $gender
            );
            $query2 = $this->db->insert('users_account', $data2);
            if ($query2) {
                $inActivities = array(
                    'activities_user' => $getIdRecents,
                    'activities_type' => 'Register',
                    'activities_text' => 'New Account',
                    'activities_date' => date("Y-m-d h:i:s")
                );
                $query3 = $this->db->insert('activities', $inActivities);
                return $query3;
            }
        } else {
            return false;
        }
    }


    public function getUbah($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function setUbah($id)
    {

        $nmU    = $this->input->post('name');
        $emU    = $this->input->post('username');
        $pwdU   = $this->input->post('password');
        $oldPw  = $this->input->post('oldpassword');

        $this->db->select('password');
        $this->db->from('users');
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        $getPw = $query->row_array()['password'];

        if ($getPw == $pwdU) {
            $newPw = $oldPw;
        } else {
            $newPw = password_hash($pwdU, PASSWORD_DEFAULT);
        }

        $data = array(
            'name' => $nmU,
            'username' => $emU,
            'password' => $newPw
        );

        $this->db->where('id_user', $id);
        $this->db->update('users', $data);
    }

    public function hapus_user($id)
    {
        $this->db->delete('users', array('id_user' => $id));
    }

    // IS OPERATOR

    public function readOp($id)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('id_user', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // OTHER FUNCTION

    function cekLogin($username, $password)
    {
        $userData = $this->db->get_where($this->table, ['username' => $username])->row_array();
        if (is_null($userData)) {
            return false;
        } else {
            return password_verify($password, $userData['password']);
        }
    }

    function cekUsername($username)
    {
        $userData = $this->db->get_where($this->table, ['username' => $username])->row_array();
        if (is_null($userData)) {
            return false;
        } else {
            return true;
        }
    }

    // function cekLogin($email, $password)
    // {
    //     $this->db->select('*');
    //     $this->db->from('users');
    //     $this->db->where("(users.email = '$email' OR users.username = '$email')");
    //     $query = $this->db->get();
    //     $userData  = $query->row_array();
    //     if (is_null($userData)) {
    //         return false;
    //     } else {
    //         return password_verify($password, $userData['password']);
    //     }
    // }


    function getLevelByusername($email)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array()['level'];
    }

    function findBy($fieldName, $value)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($fieldName, $value);
        $query = $this->db->get();
        return $query->row_array();
    }

    function findByEmailUser($value)
    {
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where("(users.email = '$value' OR users.username = '$value')");
        $query = $this->db->get();
        return $query->row_array();
    }


    function findByUserAccount($fieldName, $value)
    {
        $this->db->select('*');
        $this->db->from('users_account');
        $this->db->where($fieldName, $value);
        $query = $this->db->get();
        return $query->row_array();
    }
}
