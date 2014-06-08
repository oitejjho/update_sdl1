<?php

class Con_access_log extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_access_log');
        $this->load->helper('alert');
        $this->load->helper('date');
        echo 'good';
        echo 'babab';
        echo 'best';
    }

    public function view() {
        $data['tbl_log'] = $this->mod_access_log->view();
        $data['container'] = 'temp/employee_access_log/view';
        $this->load->view('main_page', $data);
    }

    public function create() {
        $data['container'] = 'temp/employee_access_log/create';
        $this->load->view('main_page', $data);
    }

    public function insert() {
        $this->mod_access_log->CardNo = $this->input->post('CardNo');
        $this->mod_access_log->DateTime = $this->input->post('DateTime');
        $this->mod_access_log->Status = $this->input->post('Status');
        $this->mod_access_log->insert();
        $this->session->set_flashdata('msg', get_alert_by_id('101'));
        redirect('con_access_log/view', 'refresh');
    }

    public function edit() {
        if ($this->input->post('submit') == 'edit') {
            $this->mod_access_log->ID = $this->input->post('ID');
            $data['tbl_log'] = $this->mod_access_log->view_by_id();
            $data['container'] = 'temp/log/edit';
            $this->load->view('main_page', $data);
        }
        if ($this->input->post('submit') == 'delete') {
            $this->delete();
        }
    }

    public function update() {
        $this->mod_access_log->CardNo = $this->input->post('CardNo');
        $this->mod_access_log->DateTime = $this->input->post('DateTime');
        $this->mod_access_log->Status = $this->input->post('Status');
        $this->mod_access_log->CreatedBy = $this->input->post('CreatedBy');
        $this->mod_access_log->CreatedOn = $this->input->post('CreatedOn');
        $this->mod_access_log->DelStatus = $this->input->post('DelStatus');
        $this->mod_access_log->update();
        $this->session->set_flashdata('msg', get_alert_by_id('102'));
        redirect('con_access_log/view', 'refresh');
    }

    public function delete() {
        $this->mod_access_log->ID = $this->input->post('ID');
        $this->mod_access_log->delete();
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_access_log/view', 'refresh');
    }

}
