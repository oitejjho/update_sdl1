<?php

class Con_set_employee_salary extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_grade_mapping');
        $this->load->model('mod_set_employee_salary');
        $this->load->helper('alert');
    }

    public function create() {
        $data['tbl_job_category'] = $this->mod_grade_mapping->get_job_category_name();
        $data['container'] = 'temp/employee_salary/create';
        $this->load->view('main_page', $data);
    }

    public function insert() {
        $engNumber = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
        $bangNumber = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
        if ($this->input->post('submit') == 'save') {
            $this->mod_set_employee_salary->CardNo = str_replace($bangNumber, $engNumber, $this->input->post('CardNo'));
            $this->mod_set_employee_salary->Designation = $this->input->post('DesignationName');
            $this->mod_set_employee_salary->Grade = $this->input->post('GradeName');
            $this->mod_set_employee_salary->GrossSalary = str_replace($bangNumber, $engNumber, $this->input->post('GrossSalary'));
            $this->mod_set_employee_salary->LastIncrementDate = date('Y-m-d', strtotime($this->input->post('LastIncrementDate')));
            $this->mod_set_employee_salary->LastIncrementMoney = str_replace($bangNumber, $engNumber, $this->input->post('LastIncrementMoney'));
            $this->mod_set_employee_salary->PromotionDate = date('Y-m-d', strtotime($this->input->post('PromotionDate')));
            $this->mod_set_employee_salary->OT = str_replace($bangNumber, $engNumber, $this->input->post('OT'));
            $this->mod_set_employee_salary->AttendanceBonus = str_replace($bangNumber, $engNumber, $this->input->post('AttendanceBonus'));
            $this->mod_set_employee_salary->OtherAllowance = str_replace($bangNumber, $engNumber, $this->input->post('OtherAllowance'));
            $this->mod_set_employee_salary->MedicalAllowance = str_replace($bangNumber, $engNumber, $this->input->post('MedicalAllowance'));
            $this->mod_set_employee_salary->TravelAllowance = str_replace($bangNumber, $engNumber, $this->input->post('TravelAllowance'));
            $this->mod_set_employee_salary->FoodAllowance = str_replace($bangNumber, $engNumber, $this->input->post('FoodAllowance'));
            $this->mod_set_employee_salary->OthAllowCal = $this->input->post('OthAllowCal');
            $this->mod_set_employee_salary->IsActive = $this->input->post('IsActive');
            $this->mod_set_employee_salary->insert();
            $this->session->set_flashdata('msg', 'আপনার তথ্য সফলভাবে সংরক্ষিত হয়েছে');
            redirect('con_set_employee_salary/create', 'refresh');
        } else if ($this->input->post('submit') == 'update') {
            $this->update();
        }
    }

    public function update() {
        $engNumber = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
        $bangNumber = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
        $this->mod_set_employee_salary->CardNo = $this->input->post('CardNoHidden');
        $this->mod_set_employee_salary->Designation = $this->input->post('DesignationName');
        $this->mod_set_employee_salary->Grade = $this->input->post('GradeName');
        $this->mod_set_employee_salary->GrossSalary = str_replace($bangNumber, $engNumber, $this->input->post('GrossSalary'));
        $this->mod_set_employee_salary->LastIncrementDate = date('Y-m-d', strtotime($this->input->post('LastIncrementDate')));
        $this->mod_set_employee_salary->LastIncrementMoney = str_replace($bangNumber, $engNumber, $this->input->post('LastIncrementMoney'));
        $this->mod_set_employee_salary->PromotionDate = date('Y-m-d', strtotime($this->input->post('PromotionDate')));
        $this->mod_set_employee_salary->OT = str_replace($bangNumber, $engNumber, $this->input->post('OT'));
        $this->mod_set_employee_salary->AttendanceBonus = str_replace($bangNumber, $engNumber, $this->input->post('AttendanceBonus'));
        $this->mod_set_employee_salary->OtherAllowance = str_replace($bangNumber, $engNumber, $this->input->post('OtherAllowance'));
        $this->mod_set_employee_salary->MedicalAllowance = str_replace($bangNumber, $engNumber, $this->input->post('MedicalAllowance'));
        $this->mod_set_employee_salary->TravelAllowance = str_replace($bangNumber, $engNumber, $this->input->post('TravelAllowance'));
        $this->mod_set_employee_salary->FoodAllowance = str_replace($bangNumber, $engNumber, $this->input->post('FoodAllowance'));
        $this->mod_set_employee_salary->OthAllowCal = $this->input->post('OthAllowCal');
        $this->mod_set_employee_salary->IsActive = $this->input->post('IsActive');
        $this->mod_set_employee_salary->update();
        $this->session->set_flashdata('msg', 'আপনার তথ্য সফলভাবে সংশোধিত হয়েছে');
        redirect('con_set_employee_salary/create', 'refresh');
    }

    public function get_employee_salary_by_cardno_json_result() {
        $this->mod_set_employee_salary->CardNo = $this->input->post('CardNo');
        $Result = $this->mod_set_employee_salary->view_by_cardno();
        echo json_encode($Result);
    }

    public function check_cardno_availibility() {
        $cardno = $this->input->post('cardno');
        if ($this->mod_set_employee_salary->check_cardno_avaibility($cardno)) {
            echo 'false';
        } else {
            echo 'true';
        }
    }

}
