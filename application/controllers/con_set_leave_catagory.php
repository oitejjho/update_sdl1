<?php

class Con_set_leave_catagory extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_leave_catagory');
        $this->load->helper('alert');
        $this->load->helper('date');        
        if (!$this->session->userdata('Email')) {
            redirect('con_set_user_login_info/login', 'refresh');
        }
    }

    public function view() {
        $data['tbl_leave_catagory'] = $this->mod_set_leave_catagory->view();
        $data['container'] = 'temp/leave_catagory/view';
        $this->load->view('main_page', $data);
    }
    
    public function create() {
        $data['container'] = 'temp/leave_catagory/create';
        $this->load->view('main_page', $data);
    }    
    
    public function insert() {
        $this->mod_set_leave_catagory->CatagoryName = $this->input->post('CatagoryName');
        $this->mod_set_leave_catagory->Days = $this->input->post('Days');
        $this->mod_set_leave_catagory->PaidUnpaid = $this->input->post('PaidUnpaid');
        $this->mod_set_leave_catagory->ShorfForm = $this->input->post('ShorfForm');
        $this->mod_set_leave_catagory->save();
        $this->session->set_flashdata('msg', get_alert_by_id('101'));
        redirect('con_set_leave_catagory/view', 'refresh');
    }

    public function edit() {
        if ($this->input->post('submit') == 'edit') {
            $this->mod_set_leave_catagory->ID = $this->input->post('ID');
            $data['tbl_leave_catagory'] = $this->mod_set_leave_catagory->view_by_id();
            $data['container'] = 'temp/leave_catagory/edit';
            $this->load->view('main_page', $data);
        }
        if ($this->input->post('submit') == 'delete') {
            $this->delete();
        }
    }

    public function update() {
        $this->mod_set_leave_catagory->ID = $this->input->post('ID');
        $this->mod_set_leave_catagory->CatagoryName = $this->input->post('CatagoryName');
        $this->mod_set_leave_catagory->Days = $this->input->post('Days');
        $this->mod_set_leave_catagory->PaidUnpaid = $this->input->post('PaidUnpaid');
        $this->mod_set_leave_catagory->ShorfForm = $this->input->post('ShorfForm');
        $this->mod_set_leave_catagory->update();
        $this->session->set_flashdata('msg', get_alert_by_id('102'));
        redirect('con_set_leave_catagory/view', 'refresh');
    }

    public function delete() {
        $this->mod_set_leave_catagory->delete_by_id($this->input->post('ID'));
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_set_leave_catagory/view', 'refresh');
    }

}
