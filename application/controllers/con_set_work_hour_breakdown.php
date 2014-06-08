<?php

class Con_set_work_hour_breakdown extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_work_hour_breakdown');
        $this->load->helper('alert');
        $this->load->helper('date'); 
        if (!$this->session->userdata('Email')) {
             redirect('con_set_user_login_info/login', 'refresh');
        }
    }

    public function view() {
        $data['tbl_work_hour_breakdown'] = $this->mod_set_work_hour_breakdown->view1();
        $data['sidebar'] = 'admin_manu_bar'; 
        $data['container'] = 'temp/work_hour_breakdown/view';
        $this->load->view('main_page', $data);
    }

    public function create() {
        $data['sidebar'] = 'admin_manu_bar';                
        $data['container'] = 'temp/work_hour_breakdown/create';
        $this->load->view('main_page', $data);
    }

    public function insert() {
        $this->mod_set_work_hour_breakdown->WorkHourName = $this->input->post('WorkHourName');
        $this->mod_set_work_hour_breakdown->StartTime = $this->input->post('StartTime');
        $this->mod_set_work_hour_breakdown->EndTime = $this->input->post('EndTime');
        $this->mod_set_work_hour_breakdown->Conditional = $this->input->post('Conditional');
        $this->mod_set_work_hour_breakdown->Priority = $this->input->post('Priority');
        $this->mod_set_work_hour_breakdown->TotalWorkingHour = $this->input->post('TotalWorkingHour');
        $this->mod_set_work_hour_breakdown->BasicStructure = $this->input->post('BasicStructure');
        $this->mod_set_work_hour_breakdown->insert();
        $this->session->set_flashdata('msg', get_alert_by_id('101'));
        redirect('con_set_work_hour_breakdown/view', 'refresh');
    }

    public function edit() {
        if ($this->input->post('submit') == 'edit') {
            $this->mod_set_work_hour_breakdown->ID = $this->input->post('ID');
            $data['tbl_work_hour_breakdown'] = $this->mod_set_work_hour_breakdown->view_by_id();
            $data['container'] = 'temp/work_hour_breakdown/edit';
            $this->load->view('main_page', $data);
//                        echo '<pre>';
//                        print_r($data['tbl_work_hour_breakdown']);
//                        echo '</pre>';
        }
        if ($this->input->post('submit') == 'delete') {
            $this->delete();
        }
    } 
    
    public function delete() {
        $this->mod_set_work_hour_breakdown->delete_by_id($this->input->post('ID'));
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_set_work_hour_breakdown/view', 'refresh');
    }

    public function update() {
        $this->mod_set_work_hour_breakdown->ID = $this->input->post('ID');
        $this->mod_set_work_hour_breakdown->WorkHourName = $this->input->post('WorkHourName');
        $this->mod_set_work_hour_breakdown->StartTime = $this->input->post('StartTime');
        $this->mod_set_work_hour_breakdown->EndTime = $this->input->post('EndTime');
        $this->mod_set_work_hour_breakdown->Conditional = $this->input->post('Conditional');
        $this->mod_set_work_hour_breakdown->Priority = $this->input->post('Priority');
        $this->mod_set_work_hour_breakdown->TotalWorkingHour = $this->input->post('TotalWorkingHour');
        $this->mod_set_work_hour_breakdown->BasicStructure = $this->input->post('BasicStructure');

        if ($this->mod_set_work_hour_breakdown->update()) {
            $this->session->set_flashdata('msg', 'Updated Successfully');
            
        } else {
            $this->session->set_flashdata('msg', 'Update Unsuccessfully');
        }
        redirect('con_set_work_hour_breakdown/view', 'refresh');
    }


}
