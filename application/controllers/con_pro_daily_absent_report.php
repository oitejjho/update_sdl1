<?php

class Con_pro_daily_absent_report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_set_employee_info_detail');
        $this->load->model('mod_pro_daily_first_half_attn_log');
        $this->load->model('mod_monthly_wages_detail');
        $this->load->model('mod_access_log_raw');
        $this->load->model('mod_access_log');
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
        //714        
        date_default_timezone_set('Asia/Dacca');
        $StartDate = date('Y-m-d', now()); //date('Y-m-d', strtotime(now()));   
        $StartDate = date('Y-m-d', strtotime('-1 day', strtotime($StartDate)));
        $attendance_list = $this->mod_access_log->GetDateSpecificCardNo($StartDate);

        $limit1 = count($employee_details) - 1;
        $absent_employee_list = array();
        foreach ($employee_details as $an_employee_details) {
            $absent_employee['CardNo'] = $an_employee_details->CardNo;
            $absent_employee['Name'] = $an_employee_details->Name;
            $absent_employee['BuildingName'] = $an_employee_details->BuildingName;
            $absent_employee['Floor'] = $an_employee_details->Floor;
            $absent_employee['Department'] = $an_employee_details->Department;
            $absent_employee['Line'] = $an_employee_details->Line;
            if (!($this->CheckAttendance($an_employee_details->CardNo, $attendance_list))) {
                array_push($absent_employee_list, $absent_employee);
            }
        }
        $data['showDate'] = date('d-m-Y', strtotime('-1 day', now()));
        $data['tbl_absent_report'] = $absent_employee_list;
        $data['container'] = 'temp/daily_absent_report/daily_absent_report_ui';
        $this->load->view('main_page', $data);
    }

    public function Search() {
        $mydate = $this->input->post('Date');
        $StartDate = date('Y-m-d', strtotime(str_replace('-', '/', $mydate)));
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

        $attendance_list = $this->mod_access_log->GetDateSpecificCardNo($StartDate);

        $limit1 = count($employee_details) - 1;
        $absent_employee_list = array();
        foreach ($employee_details as $an_employee_details) {
            $absent_employee['CardNo'] = $an_employee_details->CardNo;
            $absent_employee['Name'] = $an_employee_details->Name;
            $absent_employee['BuildingName'] = $an_employee_details->BuildingName;
            $absent_employee['Floor'] = $an_employee_details->Floor;
            $absent_employee['Department'] = $an_employee_details->Department;
            $absent_employee['Line'] = $an_employee_details->Line;
            if (!($this->CheckAttendance($an_employee_details->CardNo, $attendance_list))) {
                array_push($absent_employee_list, $absent_employee);
            }
        }

        $data['showDate'] = $StartDate;

        $data['tbl_absent_report'] = $absent_employee_list;
        $data['container'] = 'temp/daily_absent_report/daily_absent_report_ui';
        $this->load->view('main_page', $data);
    }

    public function CheckAttendance($card_no, $attendance_list) {
        $limit = count($attendance_list) - 1;
        for ($index = 0; $index <= $limit; $index++) {
            if ($card_no == $attendance_list[$index]['CardNo'])
                return TRUE;
        }
        return FALSE;
    }

    public function excelExport() {
        date_default_timezone_set('Asia/Dacca');
        $now = date('Y-m-d', strtotime($this->input->post('hDate')));
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
        $attendance_list = $this->mod_access_log->GetDateSpecificCardNo($now);
        $limit1 = count($employee_details) - 1;
        $absent_employee_list = array();
        foreach ($employee_details as $an_employee_details) {
            $absent_employee['CardNo'] = $an_employee_details->CardNo;
            $absent_employee['Name'] = $an_employee_details->Name;
            $absent_employee['BuildingName'] = $an_employee_details->BuildingName;
            $absent_employee['Floor'] = $an_employee_details->Floor;
            $absent_employee['Department'] = $an_employee_details->Department;
            $absent_employee['Line'] = $an_employee_details->Line;
            if (!($this->CheckAttendance($an_employee_details->CardNo, $attendance_list))) {
                array_push($absent_employee_list, $absent_employee);
            }
        }
        $this->PopulateSalarySheet($absent_employee_list);
    }

    public function PopulateSalarySheet($first_half_attendance) {

        $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
        require_once APPPATH . "/third_party/PHPExcel.php";
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("RCIS")
                ->setLastModifiedBy("RCIS")
                ->setTitle("Absent Report")
                ->setSubject("CopyRight RCIS")
                ->setDescription("Absent Report")
                ->setKeywords("Absent Report")
                ->setCategory("Absent Report");
// Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ক্রমিক নং')
                ->setCellValue('B1', 'কার্ড নং')
                ->setCellValue('C1', 'নাম')
                ->setCellValue('D1', 'বিভাগ');

        
        $limit = count($first_half_attendance) - 1;
        for ($index = 0; $index <= $limit; $index++) {
            
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . ($index + 2), str_replace(range(0, 9), $bn_digits, $index + 1))
                    ->setCellValue('B' . ($index + 2), str_replace(range(0, 9), $bn_digits, $first_half_attendance[$index]['CardNo']))
                    ->setCellValue('C' . ($index + 2), $first_half_attendance[$index]['Name'])
                    ->setCellValue('D' . ($index + 2), $first_half_attendance[$index]['Department']);
        }


        $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
        date_default_timezone_set('Asia/Dacca');
        header('Content-Type: application/vnd.ms-excel');
        $fileName = date('d-m-Y_g:i_a', now());

        header("Content-Disposition: attachment;filename=Absent_Report_" . $fileName . ".xls ");
        header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    public function check_array($CardNo, $att_list_all) {
        foreach ($att_list_all as $att_list) {
            if ($CardNo == $att_list['CardNo'])
                return TRUE;
        }
        return FALSE;
    }

    public function attendanceRectifaction($cardNo) {
        $data['anEmployeeInfo'] = $this->mod_set_employee_info_detail->view_by_cardno_array($cardNo);
//        echo '<pre>';
//        print_r($anEmployeeInfo);
//        echo '</pre>';

        $data['container'] = 'temp/daily_absent_report/edit';
        $this->load->view('main_page', $data);
    }

    public function InsertAbsentEmployee() {
        $tbl_access_log = array();

        $in_array['CardNo'] = $this->input->post('CardNo');
        $in_array['DateTime'] = date('Y-m-d H:i:s', strtotime('-6 hours', strtotime($this->input->post('InTime'))));
        $in_array['Status'] = 'IN';
        $in_array['CreatedBy'] = $this->session->userdata('Email');
        $in_array['DelStatus'] = 'ACT';
        array_push($tbl_access_log, $in_array);

        $in_array['CardNo'] = $this->input->post('CardNo');
        $in_array['DateTime'] = date('Y-m-d H:i:s', strtotime('-6 hours', strtotime($this->input->post('OutTime'))));
        $in_array['Status'] = 'OUT';
        $in_array['CreatedBy'] = $this->session->userdata('Email');
        $in_array['DelStatus'] = 'ACT';
        array_push($tbl_access_log, $in_array);

//                echo '<pre>';
//        print_r($tbl_access_log);
//        echo '</pre>';
//        exit();
//        
//        $inTime = $this->input->post('InTime');
//        
//        date_default_timezone_get('Asia/Dacca');
//        $date = date('Y-m-d', now());
//        $inTime = $date . ' ' . $inTime;
//        $accessLogRawData['InTime'] = date('Y-m-d H:i:s', strtotime($inTime));
        $this->mod_access_log->insert_batch_random_data($tbl_access_log);
        redirect('con_pro_daily_absent_report/');
    }

    function db_backup() {
        $this->load->dbutil();

        $backup = & $this->dbutil->backup();
        $this->load->helper('file');
        write_file('/path/to/sdl1_backup.zip', $backup);

        $this->load->helper('download');
        force_download('sdl1_backup.zip', $backup);
    }

}
