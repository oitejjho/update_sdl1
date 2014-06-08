<?php

class Con_leave_detail extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_leave_detail');
        $this->load->helper('alert');
        $this->load->helper('date');
    }

    public function view() {
        $data['tbl_detail'] = $this->mod_leave_detail->view();
        $data['container'] = 'temp/leave_detail/view';
        $this->load->view('main_page', $data);
    }

    public function create() {
        $data['container'] = 'temp/leave_detail/create';
        $this->load->view('main_page', $data);
    }

    public function insert() {
        $this->mod_leave_detail->CardNo = $this->input->post('CardNo');
        $this->mod_leave_detail->Date = $this->input->post('Date');
        $this->mod_leave_detail->LeaveCategoryName = $this->input->post('LeaveCategoryName');
        $this->mod_leave_detail->ApprovedBy = $this->input->post('ApprovedBy');
        $this->mod_leave_detail->ApplicationNo = $this->input->post('ApplicationNo');
        $this->mod_leave_detail->insert();
        $this->session->set_flashdata('msg', get_alert_by_id('101'));
        redirect('con_leave_detail/view', 'refresh');
    }

    public function edit() {
        if ($this->input->post('submit') == 'edit') {
            $this->mod_leave_detail->ID = $this->input->post('ID');
            $data['tbl_detail'] = $this->mod_leave_detail->view_by_id();
            $data['container'] = 'temp/leave_detail/edit';
            $this->load->view('main_page', $data);
        }
        if ($this->input->post('submit') == 'delete') {
            $this->delete();
        }
    }

    public function update() {
        $this->mod_leave_detail->CardNo = $this->input->post('CardNo');
        $this->mod_leave_detail->Date = $this->input->post('Date');
        $this->mod_leave_detail->LeaveCategoryName = $this->input->post('LeaveCategoryName');
        $this->mod_leave_detail->ApprovedBy = $this->input->post('ApprovedBy');
        $this->mod_leave_detail->ApplicationNo = $this->input->post('ApplicationNo');
        $this->mod_leave_detail->update();
        $this->session->set_flashdata('msg', get_alert_by_id('102'));
        redirect('con_leave_detail/view', 'refresh');
    }

    public function delete() {
        $this->mod_leave_detail->ID = $this->input->post('ID');
        $this->mod_leave_detail->delete();
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_leave_detail/view', 'refresh');
    }

}
