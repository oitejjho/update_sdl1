<?php

class Con_set_grade_mapping extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_grade_mapping');
        $this->load->helper('alert');
    }

    public function index() {
        $data['tbl_job_category'] = $this->mod_grade_mapping->get_job_category_name();
        $data['container'] = 'temp/grade_mapping/grade_mapping_ui';
        $this->load->view('main_page', $data);
    }

    public function create() {
        $data['tbl_job_category'] = $this->mod_grade_mapping->get_job_category_name();
        $data['container'] = 'temp/grade_mapping/grade_mapping_ui';
        $this->load->view('main_page', $data);
    }

    public function view() {
        $config['base_url'] = 'http://calla2z.com/sdl1/con_set_grade_mapping/view';
        $config['total_rows'] = $this->mod_grade_mapping->number_of_grades_mapping();
        $config['per_page'] = 10;
        $config['num_links'] = 5;
        $config['prev_link'] = '&laquo;';
        $config['next_link'] = '&raquo;';
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = ' </ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="">';
        $config['cur_tag_close'] = '</a></li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_open'] = '</li>';
        $config['last_link'] = FALSE;
        $config['first_link'] = FALSE;
        $this->pagination->initialize($config);
        if ($this->mod_grade_mapping->number_of_grades_mapping() > 0) {
            $data['tbl_grade_mapping'] = $this->mod_grade_mapping->view_for_list($config['per_page'], $this->uri->segment(3));
        }
        $data['container'] = 'temp/grade_mapping/grade_mapping_view';
        $this->load->view('main_page', $data);
    }

    public function get_grade_names() {
        $jobCatID = $this->input->post('Name');
        $Result = $this->mod_grade_mapping->get_grade_names($jobCatID);
        echo json_encode($Result);
    }

    public function get_designation_list() {
        $GradeID = $this->input->post('GradeName');
        $Result = $this->mod_grade_mapping->get_designation_list($GradeID);
        echo json_encode($Result);
    }

    public function get_mapping_keyword() {
        $DesignationID = $this->input->post('DesignationID');
        $Result = $this->mod_grade_mapping->get_grademapping_keyword($DesignationID);
        echo json_encode($Result);
    }

    public function insert() {
        $this->mod_grade_mapping->GradeMappingName = $this->input->post('GradeMappingName');
        $this->mod_grade_mapping->Description = $this->input->post('Description');
        $this->mod_grade_mapping->TreatmentAllowance = $this->input->post('TreatmentAllowance');
        $this->mod_grade_mapping->TravelAllowance = $this->input->post('TravelAllowance');
        $this->mod_grade_mapping->FoodAllowance = $this->input->post('FoodAllowance');
        $this->mod_grade_mapping->AttendanceBonus = $this->input->post('AttendanceBonus');
        $this->mod_grade_mapping->insert();
        $this->session->set_flashdata('msg', get_alert_by_id('101'));
        redirect('con_set_grade_mapping/view');
    }

    public function edit() {
        if ($this->input->post('submit') == 'edit') {
            $this->mod_grade_mapping->ID = $this->input->post('ID');
            $data['tbl_job_category'] = $this->mod_grade_mapping->get_job_category_name();
            $data['tbl_grade_mapping'] = $this->mod_grade_mapping->view_by_id();
            $data['container'] = 'temp/grade_mapping/edit';
            $this->load->view('main_page', $data);
        }
        if ($this->input->post('submit') == 'delete') {
            $this->delete();
        }
    }

    public function delete() {
        $this->mod_grade_mapping->delete_by_id($this->input->post('ID'));
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_set_grade_mapping/view', 'refresh');
    }

    public function update() {
        $this->mod_grade_mapping->Name = $this->input->post('GradeMappingName');
        $this->mod_grade_mapping->Descrip = $this->input->post('Description');
        $this->mod_grade_mapping->TreatmentAllowance = $this->input->post('TreatmentAllowance');
        $this->mod_grade_mapping->TravelAllowance = $this->input->post('TravelAllowance');
        $this->mod_grade_mapping->FoodAllowance = $this->input->post('FoodAllowance');
        $this->mod_grade_mapping->AttendanceBonus = $this->input->post('AttendanceBonus');
        if ($this->mod_grade_mapping->update()) {
            $this->session->set_flashdata('msg', 'Updated Successfully');
        } else {
            $this->session->set_flashdata('msg', 'Update Unsuccessfully');
        }
        redirect('con_set_work_hour_breakdown/view', 'refresh');
    }

}
