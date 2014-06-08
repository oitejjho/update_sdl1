<?php

class Con_set_additional_reward_staff extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_additional_reward_staff');
        $this->load->helper('alert');
        $this->load->helper('date');
        if (!$this->session->userdata('Email')) {
            redirect('con_set_user_login_info/login', 'refresh');
        }
    }

    public function view() {
        $data['tbl_additional_reward_staff'] = $this->mod_set_additional_reward_staff->view();
        $data['container'] = 'temp/additional_reward_staff/view';
        $this->load->view('main_page', $data);
    }

    public function create() {
        $data['container'] = 'temp/additional_reward_staff/create';
        $this->load->view('main_page', $data);
    }

    public function insert() {
        $this->mod_set_additional_reward_staff->RewaredName = $this->input->post('RewaredName');
        $this->mod_set_additional_reward_staff->RewaredAmount = $this->input->post('RewaredAmount');
        $this->mod_set_additional_reward_staff->IsCalculatedOnBasic = $this->input->post('IsCalculatedOnBasic');
        $this->mod_set_additional_reward_staff->BasicXTime = $this->input->post('BasicXTime');
        $this->mod_set_additional_reward_staff->CompensatoryHolyday = $this->input->post('CompensatoryHolyday');
        //echo $this->input->post('RewaredName');
        $this->mod_set_additional_reward_staff->insert();
        $this->session->set_flashdata('msg', get_alert_by_id('101'));
        redirect('con_set_additional_reward_staff/view', 'refresh');
    }

    public function edit() {
        if ($this->input->post('submit') == 'edit') {
            $this->mod_set_additional_reward_staff->ID = $this->input->post('ID');
            $data['tbl_additional_reward_staff'] = $this->mod_set_additional_reward_staff->view_by_id();
            $data['container'] = 'temp/additional_reward_staff/edit';
            $this->load->view('main_page', $data);
        }
        if ($this->input->post('submit') == 'delete') {
            $this->delete();
        }
    }

    public function update() {        
        $this->mod_set_additional_reward_staff->RewaredName = $this->input->post('CardNo');
        $this->mod_set_additional_reward_staff->RewaredAmount = $this->input->post('RewaredAmount');
        $this->mod_set_additional_reward_staff->IsCalculatedOnBasic = $this->input->post('IsCalculatedOnBasic');
        $this->mod_set_additional_reward_staff->BasicXTime = $this->input->post('BasicXTime');
        $this->mod_set_additional_reward_staff->CompensatoryHolyday = $this->input->post('CompensatoryHolyday');
        $this->mod_set_additional_reward_staff->update();
        $this->session->set_flashdata('msg', get_alert_by_id('102'));
        redirect('con_set_additional_reward_staff/view', 'refresh');
    }

    public function delete() {
        $this->mod_set_additional_reward_staff->delete_by_id($this->input->post('ID'));
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_set_additional_reward_staff/view', 'refresh');
    }

}
