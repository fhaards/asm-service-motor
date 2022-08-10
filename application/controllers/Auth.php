<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->helper('url_helper');
		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->helper('array');
		$this->load->helper('url');
		$this->load->library('crumbs');
		$this->load->library('form_validation');
		$this->load->model('modelUser');
		$this->load->model('modelFunction');
	}

	public function index()
	{
		return redirect('login', 'refresh');
	}

	public function login()
	{
		redirectIfLogin();
		$data['content'] = 'public/auth-form';
		$this->load->view('master', $data);
	}

	public function validation()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$cek = $this->modelUser->cekLogin($username, $password);
		if ($cek) {
			$userData = $this->modelUser->findBy('username', $username);
			$data_session = array('username' => $username, 'status' => "login", 'userid' => $userData['user_id'], 'level' => $userData['level']);
			$this->session->set_userdata($data_session);
			echo "success";
		} else {
			echo "error";
		}
	}

	public function destroy()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}
