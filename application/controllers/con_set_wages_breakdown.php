<?php
class Con_set_wages_breakdown extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_wages_breakdown');
        $this->load->helper('alert');
        $this->load->helper('date');
        if (!$this->session->userdata('Email')) {
             redirect('con_set_user_login_info/login', 'refresh');
        }
    }

    public function view() {
        $data['tbl_wages_breakdown'] = $this->mod_set_wages_breakdown->view();
        $data['container'] = 'temp/wages_breakdown/view';
        $this->load->view('main_page', $data);
    }

    public function create() {
        $data['container'] = 'temp/additonal_allowance_structure_worker/create';
        $this->load->view('main_page', $data);
    }

    public function insert() {
        $this->mod_set_wages_breakdown->Head = $this->input->post('Head');
        $this->mod_set_wages_breakdown->Percentage = $this->input->post('Percentage');
        $this->mod_set_wages_breakdown->insert();
        $this->session->set_flashdata('msg', 'Inserted Successfully');
        redirect('con_set_wages_breakdown/view', 'refresh');
    }

    public function edit() {
        if ($this->input->post('submit') == 'edit') {
            $this->mod_set_wages_breakdown->ID = $this->input->post('ID');
            $data['tbl_wages_breakdown'] = $this->mod_set_wages_breakdown->view_by_id();
            $data['container'] = 'temp/wages_breakdown/edit';
            $this->load->view('main_page', $data);
        }
        if ($this->input->post('submit') == 'delete') {
            $this->delete();
        }
    }
    
    public function delete() {
        $this->mod_set_wages_breakdown->delete_by_id($this->input->post('ID'));
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_set_wages_breakdown/view', 'refresh');
    }

    public function update() {
        $this->mod_set_wages_breakdown->ID = $this->input->post('ID');
        $this->mod_set_wages_breakdown->Head = $this->input->post('Head');
        $this->mod_set_wages_breakdown->Percentage = $this->input->post('Percentage');
        $this->mod_set_wages_breakdown->update();
        if ($this->mod_set_wages_breakdown->update()) {
            $this->session->set_flashdata('msg', 'Updated Successfully');
        } else {
            $this->session->set_flashdata('msg', 'Update Unsuccessfully');
        }
        redirect('con_set_wages_breakdown/view', 'refresh');
        
    }
}
