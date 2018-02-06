<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->library(array('session'));
        $this->load->model('phone_model');

        if(!$this->session->userdata('logged_in'))
            redirect('/user');
    }

    function index() {
        $this->phones_list();
    }

    function phones_list($offset=0) {
        $this->load->library('pagination');
        $this->load->helper('form');

        $data['header'] = $this->load->view('common/header', '', true);
        $data['footer'] = $this->load->view('common/footer', '', true);

        $data['phones'] = $this->phone_model->get_phones($offset);

        $config['base_url'] = base_url().'dashboard/phones_list';
        $config['total_rows'] = count($this->phone_model->get_phones());
        $config['per_page'] = 10;
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['cur_tag_open'] = '<li class="page-link active">';
        $config['cur_tag_close'] = '</li>';

        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';

        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);
        $data['pages'] = $this->pagination->create_links();

        $this->load->view('list', $data);
    }

    function phone_form($record_id=null) {
        $data['record'] = new stdClass();
        $data['record']->ID = '';
        $data['record']->name = '';
        $data['record']->phone = '';
        $data['record']->note = '';

        if(!is_null($record_id)) {
            $data['record'] = $this->phone_model->get_phone_by_id($record_id)[0];
        }
        $this->load->helper('form');

        $data['header'] = $this->load->view('common/header', '', true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $this->load->view('phone_form', $data);
    }

    function save_phone_action() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone number', 'trim|required');

        $data['header'] = $this->load->view('common/header', '', true);
        $data['footer'] = $this->load->view('common/footer', '', true);

        if($this->form_validation->run() == false) {
            $this->load->view('phone_form', $data);
            return;
        }

        $name = htmlspecialchars($this->input->post('name', true));
        $phone = htmlspecialchars($this->input->post('phone', true));
        $note = htmlspecialchars($this->input->post('note', true));

        if($_POST['ID'] == '') $result = $this->phone_model->insert_phone($name, $phone, $note);
        else $result = $this->phone_model->update_phone($_POST['ID'], $name, $phone, $note);

        if($result) {
            redirect(base_url());
        } else {
            $data['add_error'] = 'Something went wrong!';
            $this->load->view('phone_form', $data);
        }
    }

    function delete_phone_action($id) {
        if($this->phone_model->delete_phone($id))
            redirect(base_url());
    }

    function search() {
        $this->load->helper('form');
        $search = htmlspecialchars($this->input->post('search', true));
        $data['phones'] = $this->phone_model->search_phone($search);
        $data['pages'] = '';

        $data['header'] = $this->load->view('common/header', '', true);
        $data['footer'] = $this->load->view('common/footer', '', true);
        $this->load->view('list', $data);
    }
}