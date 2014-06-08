<?php

class Con_proc_leave_type_allocation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_leave_type_allocation');
        $this->load->model('mod_set_leave_catagory');
        $this->load->model('mod_set_employee_info_detail');
        $this->load->model('mod_leave_detail');
        $this->load->helper('alert');
        $this->load->helper('date');
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
        $tbl_leave_detail = array();
        $mydate = $this->input->post("mydate");
       
        $year = date('Y', strtotime($mydate[0]));
//        echo $year;
//        exit();
        $count = $this->input->post('NumberOfDays');
        $cardNo = $this->input->post('CardNo');
        foreach ($mydate as $amydate) {

            //echo $amydate." <br>";
            $data = array(
                'CardNo' => $this->input->post('CardNo'),
                'Date' => date('Y-m-d',strtotime($amydate)),
                'LeaveCategoryName' => $this->input->post('LeaveTypeName'),
                'Note' => $this->input->post('Note'),
                'ApprovedBy' => $this->session->userdata('Email'),
                'ApplicationNo' => $this->input->post('CardNo') . $amydate
            );
            array_push($tbl_leave_detail, $data);
        }
        $this->mod_leave_detail->insert_batch($tbl_leave_detail);
        $this->mod_leave_type_allocation->CardNo = $cardNo;
        $this->mod_leave_type_allocation->LeaveType = $this->input->post('LeaveTypeName');
        $this->mod_leave_type_allocation->Year = $year;
        $card_specific_leave_data = $this->mod_leave_type_allocation->view_by_id();
        foreach ($card_specific_leave_data as $a_data) {
            if ($a_data->LeaveType == $this->input->post('LeaveTypeName')) {
                if (($a_data->Days - $count) > 0) {
                    $this->mod_leave_type_allocation->Days = $a_data->Days - $count;
                    $this->mod_leave_type_allocation->update();
                    $this->session->set_flashdata('msg', get_alert_by_id('102'));
                } else {
                    $this->session->set_flashdata('msg', get_alert_by_id('105'));
                }
            }
        }
        redirect('con_pro_daily_leave_report/create', 'refresh');
    }
    
    public function edit_leave_allocation($cardNo) {
        
        //echo $cardNo.'<br/>';
        $aCardSpecificLeaves = $this->mod_leave_type_allocation->CardSpecificLeaveAllocation($cardNo);
//        echo '<pre>';
//        print_r($aCardSpecificLeaves);
//        echo '</pre>';
//        exit();
        $data['tbl_leave_allocation_edit'] = $aCardSpecificLeaves;
        $data['container'] = 'temp/leave_type_allocation/edit1';
        $this->load->view('main_page', $data);
    }
    
    public function edit() {
        if ($this->input->post('submit') == 'edit') {
            $this->mod_set_leave_catagory->ID = $this->input->post('ID');
            $data['tbl_leave_catagory'] = $this->mod_set_leave_catagory->view_by_id();
            $data['container'] = 'temp/leave_type_allocation/edit1';
            $this->load->view('main_page', $data);
        }
        if ($this->input->post('submit') == 'delete') {
            $this->delete();
        }
    }

    public function update() {
        $this->mod_set_leave_catagory->CatagoryName = $this->input->post('CatagoryName');
        $this->mod_set_leave_catagory->Days = $this->input->post('Days');
        $this->mod_set_leave_catagory->PaidUnpaid = $this->input->post('PaidUnpaid');
        $this->mod_set_leave_catagory->ShorfForm = $this->input->post('ShorfForm');
        $this->mod_set_leave_catagory->update();
        $this->session->set_flashdata('msg', get_alert_by_id('102'));
        redirect('con_set_leave_catagory/view', 'refresh');
    }
    public function UpdateCardSpecificLeaveAllocation(){
        date_default_timezone_get('Asia/Dacca');
        $year = date('Y', now());
        
        $this->mod_leave_type_allocation->CardNo = $this->input->post('CardNo');
        $this->mod_leave_type_allocation->Year = $year;
        
        $this->mod_leave_type_allocation->ShortForm='CL';
        $this->mod_leave_type_allocation->Days = $this->input->post('CL');
        $this->mod_leave_type_allocation->update_for_leave_allocation();
        
        $this->mod_leave_type_allocation->ShortForm='CH';
        $this->mod_leave_type_allocation->Days = $this->input->post('CH');
        $this->mod_leave_type_allocation->update_for_leave_allocation();
        
        $this->mod_leave_type_allocation->ShortForm='FL';
        $this->mod_leave_type_allocation->Days = $this->input->post('FL');
        $this->mod_leave_type_allocation->update_for_leave_allocation();
        
        $this->mod_leave_type_allocation->ShortForm='ML';
        $this->mod_leave_type_allocation->Days = $this->input->post('ML');
        $this->mod_leave_type_allocation->update_for_leave_allocation();
        
        $this->mod_leave_type_allocation->ShortForm='SL';
        $this->mod_leave_type_allocation->Days = $this->input->post('SL');
        $this->mod_leave_type_allocation->update_for_leave_allocation();
        
        $this->mod_leave_type_allocation->ShortForm='EL';
        $this->mod_leave_type_allocation->Days = $this->input->post('EL');
        $this->mod_leave_type_allocation->update_for_leave_allocation();
        
        $this->session->set_flashdata('msg', get_alert_by_id('102'));
        redirect('con_proc_leave_type_allocation/', 'refresh');
    }

    public function delete() {
        $this->mod_set_leave_catagory->ID = $this->input->post('ID');
        $this->mod_set_leave_catagory->delete();
        $this->session->set_flashdata('msg', get_alert_by_id('103'));
        redirect('con_set_leave_catagory/view', 'refresh');
    }

    public function InsertAllLeaves() {
        $tbl_employee_info = $this->mod_set_employee_info_detail->EmployeeInfoArray();
        $limit1 = count($tbl_employee_info) - 1;
        $tbl_leave_category = $this->mod_set_leave_catagory->LeaveCategoryArray();
        $limit2 = count($tbl_leave_category) - 1;
        $tbl_leave_type_allocation = array();
        for ($index1 = 0; $index1 <= $limit1; $index1++) {
            for ($index2 = 0; $index2 <= $limit2; $index2++) {
                $an_employee_leave_type_allocation['CardNo'] = $tbl_employee_info[$index1]['CardNo'];
                $an_employee_leave_type_allocation['LeaveType'] = $tbl_leave_category[$index2]['CatagoryName'];
                $an_employee_leave_type_allocation['ShortForm'] = $tbl_leave_category[$index2]['ShorfForm'];
                $an_employee_leave_type_allocation['Days'] = $tbl_leave_category[$index2]['Days'];
                $an_employee_leave_type_allocation['Year'] = '2014';
                array_push($tbl_leave_type_allocation, $an_employee_leave_type_allocation);
            }
        }
        $this->mod_leave_type_allocation->insert_batch($tbl_leave_type_allocation);
    }

    public function index() {
        date_default_timezone_get('Asia/Dacca');
        $year = date('Y', now());
        $all_card_leave_list = $this->mod_leave_type_allocation->GetYearDataArray($year);
        $limit = count($all_card_leave_list) - 1;
        $leave_details_list = array();
        for ($index = 0; $index < $limit; $index++) {
            $a_leave_details_list['CardNo'] = $all_card_leave_list[$index]['CardNo'];
            $a_leave_details_list[$all_card_leave_list[$index]['ShortForm']] = $all_card_leave_list[$index]['Days'];
            while ($all_card_leave_list[$index]['CardNo'] == $all_card_leave_list[$index + 1]['CardNo']) {
                $a_leave_details_list[$all_card_leave_list[$index + 1]['ShortForm']] = $all_card_leave_list[$index + 1]['Days'];
                $index++;
                if ($index == $limit)
                    break;
            }
            array_push($leave_details_list, $a_leave_details_list);
        }
//        echo '<pre>';
//        print_r($leave_details_list);
//        echo '</pre>';
//        exit();
        $data['tbl_leave_allocation_edit'] = $leave_details_list;
        $data['container'] = 'temp/leave_type_allocation/view';
        $this->load->view('main_page', $data);
    }

}