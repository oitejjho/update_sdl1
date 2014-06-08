<?php

class Con_pro_daily_leave_report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_employee_info_detail');
        $this->load->model('mod_leave_detail');
        $this->load->model('mod_buil_sec_other');
         $this->load->model('mod_pro_attn_mismatch_report');
    }

    public function index() {
        $BuildingName = $this->session->userdata('BuildingName');
        $data['floorInfo'] = $this->mod_buil_sec_other->getFloor($BuildingName);
        $Floor = $this->session->userdata('Floor');
        $data['floor'] = $Floor;
        $Department = $this->session->userdata('Department');
        if ($this->session->userdata('Role') == 'Admin') {
            $employee_details = $this->mod_pro_attn_mismatch_report->specific_employee_information1($BuildingName);
        } else {
            $employee_details = $this->mod_pro_attn_mismatch_report->specific_employee_information2($BuildingName, $Floor);
        }
//        if ($this->session->userdata('Role') == 'Admin') {
//            $employee_details = $this->mod_pro_daily_first_half_attn_log->SuperAdminEmployeeInfo();
//        } else {
           // $BuildingName = $this->session->userdata('BuildingName');
           // $Floor = $this->session->userdata('Floor');
//$Department = $this->session->userdata('Department');
          //  $employee_details = $this->mod_set_employee_info_detail->specific_employee_information($BuildingName, $Floor);
        //}
        date_default_timezone_set('Asia/Dacca');
        $Date = date('Y-m-d', now());
        //echo $Date;
        
// echo "<pre>";
// print_r($Date);
// echo "</pre>";
// exit();
        $leave_details_cardno_list = $this->mod_leave_detail->get_leave_details_info($Date);
//         echo "<pre>";
// print_r($leave_details_cardno_list);
// echo "</pre>";
// exit();
        $leave_list = array();
        $leave_array = array();
        foreach ($leave_details_cardno_list as $cardno_list) {
            if ($this->check_array($cardno_list->CardNo, $employee_details)) {
                $leave_list['CardNo'] = $cardno_list->CardNo;
                $leave_list['Date'] = $cardno_list->Date;
                $leave_list['LeaveCategoryName'] = $cardno_list->LeaveCategoryName;
                $leave_list['ApprovedBy'] = $cardno_list->ApprovedBy;
                $leave_list['ApplicationNo'] = $cardno_list->ApplicationNo;
                $leave_list['Name'] = $cardno_list->Name;
                $leave_list['BuildingName'] = $cardno_list->BuildingName;
                $leave_list['Floor'] = $cardno_list->Floor;
                $leave_list['Line'] = $cardno_list->Line;
                $leave_list['Department'] = $cardno_list->Department;
                array_push($leave_array, $leave_list);
            }
        }
        $data['tbl_leave_report'] = $leave_array;
        $data['container'] = 'temp/daily_leave_report/daily_leave_report_ui';
        $this->load->view('main_page', $data);
    }

    public function search() {
        $BuildingName = $this->input->post('Building');
        $Floor = $this->input->post('Floor');
        $DepartmentName = $this->input->post('DepartmentSection');
        $Line = $this->input->post('LineUnit');
        $Date = $this->input->post('Date');
        $employee_details = $this->mod_set_employee_info_detail->specific_employee_information_report($BuildingName, $Floor, $DepartmentName, $Line);
        $now = date('Y-m-d', strtotime('-1 day', now()));
        $StartDate = date('Y-m-d', strtotime($Date));
        $daily_leave_log = $this->mod_leave_detail->search_daily_leave_by_time($StartDate);

        $leave_information = array();
        $leave_all = array();
//$leave_information = $daily_leave_log;

        foreach ($daily_leave_log as $daily_log) {
            if ($this->check_array($daily_log->CardNo, $employee_details)) {
                $leave_information['CardNo'] = $daily_log->CardNo;
                $leave_information['Date'] = $daily_log->Date;
                $leave_information['LeaveCategoryName'] = $daily_log->LeaveCategoryName;
                $leave_information['ApprovedBy'] = $daily_log->ApprovedBy;
                $leave_information['ApplicationNo'] = $daily_log->ApplicationNo;
                $leave_information['Name'] = $daily_log->Name;
                $leave_information['BuildingName'] = $daily_log->BuildingName;
                $leave_information['Floor'] = $daily_log->Floor;
                $leave_information['Line'] = $daily_log->Line;
                $leave_information['Department'] = $daily_log->Department;
                array_push($leave_all, $leave_information);
            }
        }
        $data['tbl_leave_report'] = $leave_all;
        $data['container'] = 'temp/daily_leave_report/daily_leave_report_ui';
        $this->load->view('main_page', $data);
//redirect('con_pro_attn_mismatch_report/index', 'refresh');
    }

    public function create() {
        $data['tbl_leave_category'] = $this->mod_leave_detail->get_leave_type_names();
        $data['container'] = 'temp/daily_leave_report/view';
        $this->load->view('main_page', $data);
    }

    public function get_image_designation_by_cardno() {
        $CardNo = $this->input->post('CardNo');
        $BuildingName = $this->session->userdata('BuildingName');
        $Floor = $this->session->userdata('Floor');
        $Result = $this->mod_leave_detail->get_image_designation($CardNo, $BuildingName, $Floor);
        echo json_encode($Result);
    }

    public function check_array($CardNo, $att_list_all) {
        foreach ($att_list_all as $att_list) {
            if ($CardNo == $att_list->CardNo)
                return TRUE;
        }
        return FALSE;
    }

}
