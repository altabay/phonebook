<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller
{

	function __construct()
	{
		parent::__construct();

		$this->load->library(array('session'));
		$this->load->model('user_model');
	}

	function index()
	{
		if (!$this->session->userdata('logged_in'))
			$this->login_from();
		else
			redirect(base_url() . '/dashboard', 'refresh');
	}

	function login_from()
	{
		$this->load->helper('form');

		$data['header'] = $this->load->view('common/header', '', true);
		$data['footer'] = $this->load->view('common/footer', '', true);

		$this->load->view('login', $data);
	}

	function login_action()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		$username = htmlspecialchars($this->input->post('username', true));
		$password = htmlspecialchars($this->input->post('password', true));

		$data['header'] = $this->load->view('common/header', '', true);
		$data['footer'] = $this->load->view('common/footer', '', true);

		if ($this->form_validation->run() == false) {
			$this->load->view('login', $data);
		} else {
			if ($this->user_model->resolve_user_login($username, $password)) {

				$user_id = $this->user_model->get_user_id_from_username($username);
				$user = $this->user_model->get_user($user_id);

				$this->session->set_userdata('user_id', (int)$user->ID);
                $this->session->set_userdata('username', (string)$user->username);
                $this->session->set_userdata('logged_in', (bool)true);

				redirect(base_url(), 'refresh');
			} else {
				$data['error'] = 'Wrong username or password.';
				$this->load->view('login', $data);
			}
		}
	}

	function logout_action()
	{
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
		}
		redirect(base_url());
	}
}