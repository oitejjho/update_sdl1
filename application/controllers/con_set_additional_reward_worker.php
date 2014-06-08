<?php

class Con_set_additional_reward_worker extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_additional_reward_worker');
        $this->load->helper('alert');
        $this->load->helper('date');
        if (!$this->session->userdata('Email')) {
            redirect('con_set_user_login_info/login', 'refresh');
        }
    }

    public function view() {
        $data['tbl_additional_reward_worker'] = $this->mod_set_additional_reward_worker->view();
//		echo '<pre>';
//                print_r($data['tbl_additional_reward_worker']);
//                echo '</pre>';
        $data['container'] = 'temp/additional_reward_worker/view';
        $this->load->view('main_page', $data);
    }

    public function create() {
        $data['container'] = 'temp/additional_reward_worker/create';
        $this->load->view('main_page', $data);
    }

    public function insert() {

        $this->mod_set_additional_reward_worker->RewaredName = $this->input->post('RewaredName');
        $this->mod_set_additional_reward_worker->Days = $this->input->post('Days');
        $this->mod_set_additional_reward_worker->RewaredAmount = $this->input->post('RewaredAmount');
        $this->mod_set_additional_reward_worker->IsCalculatedOnBasic = $this->input->post('IsCalculatedOnBasic');
        $this->mod_set_additional_reward_worker->BasicXTime = $this->input->post('BasicXTime');
        $this->mod_set_additional_reward_worker->CompensatoryHolyday = $this->input->post('CompensatoryHolyday');
        $this->mod_set_additional_reward_worker->insert();
        $this->session->set_flashdata('msg', get_alert_by_id('101'));
        redirect('con_set_additional_reward_worker/view', 'refresh');
    }

    public function edit() {
        if ($this->input->post('submit') == 'edit') {
            $this->mod_set_additional_reward_worker->ID = $this->input->post('ID');
            $data['tbl_additional_reward_worker'] = $this->mod_set_additional_reward_worker->view_by_id();
            $data['container'] = 'temp/additional_reward_worker/edit';
            $this->load->view('main_page', $data);
        }
        if ($this->input->post('submit') == 'delete') {
            $this->delete();
        }
    }

    public function update() {
        $this->mod_set_additional_reward_worker->ID = $this->input->post('ID');
        $this->mod_set_additional_reward_worker->RewaredName = $this->input->post('RewaredName');

        $this->mod_set_additional_reward_worker->RewaredAmount = $this->input->post('RewaredAmount');
        $this->mod_set_additional_reward_worker->IsCalculatedOnBasic = $this->input->post('IsCalculatedOnBasic');
        $this->mod_set_additional_reward_worker->BasicXTime = $this->input->post('BasicXTime');
        $this->mod_set_additional_reward_worker->CompensatoryHolyday = $this->input->post('CompensatoryHolyday');
        $this->mod_set_additional_reward_worker->update();
        $this->session->set_flashdata('msg', get_alert_by_id('102'));
        redirect('con_set_additional_reward_worker/view', 'refresh');
    }

    public function delete() {
        $this->mod_set_additional_reward_worker->delete_by_id($this->input->post('ID'));
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_set_additional_reward_worker/view', 'refresh');
    }

}
