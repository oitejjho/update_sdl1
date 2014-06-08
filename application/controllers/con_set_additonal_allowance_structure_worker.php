<?php

class Con_set_additonal_allowance_structure_worker extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_additonal_allowance_structure_worker');
        $this->load->helper('alert');
        //$this->load->helper('date');
        if (!$this->session->userdata('Email')) {
            redirect('con_set_user_login_info/login', 'refresh');
        }
    }

    public function view() {
        $data['tbl_additonal_allowance_structure_worker'] = $this->mod_set_additonal_allowance_structure_worker->view();
        $data['container'] = 'temp/additonal_allowance_structure_worker/view';
        $this->load->view('main_page', $data);
    }

    public function create() {
        $data['container'] = 'temp/additonal_allowance_structure_worker/create';
        $this->load->view('main_page', $data);
    }

    public function insert() {
        $this->mod_set_additonal_allowance_structure_worker->Head = $this->input->post('Head');
        $this->mod_set_additonal_allowance_structure_worker->WorkerAmount = $this->input->post('WorkerAmount');
        $this->mod_set_additonal_allowance_structure_worker->insert();
        $this->session->set_flashdata('msg', get_alert_by_id('101'));
        redirect('con_set_additonal_allowance_structure_worker/view', 'refresh');
    }

    public function edit() {
        if ($this->input->post('submit') == 'edit') {
            $this->mod_set_additonal_allowance_structure_worker->ID = $this->input->post('ID');
            $data['tbl_additonal_allowance_structure_worker'] = $this->mod_set_additonal_allowance_structure_worker->view_by_id();
            $data['container'] = 'temp/additonal_allowance_structure_worker/edit';
            $this->load->view('main_page', $data);
        }
        if ($this->input->post('submit') == 'delete') {
            $this->delete();
        }
    }

    public function update() {
        $this->mod_set_additonal_allowance_structure_worker->ID = $this->input->post('ID');
        $this->mod_set_additonal_allowance_structure_worker->Head = $this->input->post('Head');
        $this->mod_set_additonal_allowance_structure_worker->WorkerAmount = $this->input->post('WorkerAmount');
        $this->mod_set_additonal_allowance_structure_worker->update();
        $this->session->set_flashdata('msg', get_alert_by_id('102'));
        redirect('con_set_additonal_allowance_structure_worker/view', 'refresh');
    }

    public function delete() {
        $this->mod_set_additonal_allowance_structure_worker->delete_by_id($this->input->post('ID'));
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_set_additonal_allowance_structure_worker/view', 'refresh');
    }

}
