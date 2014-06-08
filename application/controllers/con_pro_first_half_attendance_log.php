<?php

class Con_pro_first_half_attendance_log extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_pro_daily_first_half_attn_log');
        $this->load->model('mod_monthly_wages_detail');
        $this->load->model('mod_buil_sec_other');
        $this->load->model('mod_pro_attn_mismatch_report');
    }

    public function index() {
        date_default_timezone_set('Asia/Dacca');
        $now = date('Y-m-d', now());
        $StartDate = $now . ' 00:00:01';
        $EndDate = $now . ' 10:59:59';
        $StartDate = date('Y-m-d H:i:s', strtotime($StartDate));
        $EndDate = date('Y-m-d H:i:s', strtotime($EndDate));
        $access_log = $this->mod_pro_daily_first_half_attn_log->access_log($StartDate, $EndDate);
        $data['tbl_first_half_log_report'] = $access_log;
        $data['container'] = 'temp/daily_attendance_log_report/first_half_attendence_log_view';
        $this->load->view('main_page', $data);
    }

    public function get_department_name() {
        $BuildingName = $this->input->post('Building');
        $Floor = $this->input->post('Floor');
        $DepartmentName = $this->mod_pro_daily_first_half_attn_log->get_department_by_name($BuildingName, $Floor);
        echo json_encode($DepartmentName);
    }

    public function get_line_name() {
        $BuildingName = $this->input->post('Building');
        $Floor = $this->input->post('Floor');
        $DepartmentName = $this->input->post('DepartmentSection');
        $LineName = $this->mod_pro_daily_first_half_attn_log->get_line_by_name($BuildingName, $Floor, $DepartmentName);
        echo json_encode($LineName);
    }

    public function search() {
        $mydate = $this->input->post('Date');
        $now = date('Y-m-d', strtotime(str_replace('-', '/', $mydate)));
        $StartDate = $now . ' 00:00:01';
        $EndDate = $now . ' 23:59:59';
        $StartDate = date('Y-m-d H:i:s', strtotime($StartDate));
        $EndDate = date('Y-m-d H:i:s', strtotime($EndDate));
        $access_log = $this->mod_pro_daily_first_half_attn_log->access_log_previous_date($StartDate, $EndDate);
        $data['tbl_first_half_log_report'] = $access_log;

        $data['container'] = 'temp/daily_attendance_log_report/first_half_attendence_log_view';
        $this->load->view('main_page', $data);
    }

    public function excelExport() {
        date_default_timezone_set('Asia/Dacca');
        $mydate = $this->input->post('hDate');
        $now = date('Y-m-d', strtotime(str_replace('-', '/', $mydate)));
        if (date('Y-m-d', strtotime($now)) == date('Y-m-d', now())) {
            $StartDate = $now . ' 00:00:01';
            $EndDate = $now . ' 23:59:59';
            $StartDate = date('Y-m-d H:i:s', strtotime($StartDate));
            $EndDate = date('Y-m-d H:i:s', strtotime($EndDate));
            $access_log = $this->mod_pro_daily_first_half_attn_log->access_log($StartDate, $EndDate);
        } else {
            $StartDate = $now . ' 00:00:01';
            $EndDate = $now . ' 23:59:59';
            $StartDate = date('Y-m-d H:i:s', strtotime($StartDate));
            $EndDate = date('Y-m-d H:i:s', strtotime($EndDate));
            $access_log = $this->mod_pro_daily_first_half_attn_log->access_log_previous_date($StartDate, $EndDate);
            $this->PopulateSalarySheet($access_log);
        }
        $this->PopulateSalarySheet($access_log);
    }

    public function PopulateSalarySheet($first_half_attendance) {        
        $bn_digits=array('০','১','২','৩','৪','৫','৬','৭','৮','৯');        
        require_once APPPATH . "/third_party/PHPExcel.php";
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("RCIS")
                ->setLastModifiedBy("RCIS")
                ->setTitle("First half Attendance")
                ->setSubject("CopyRight RCIS")
                ->setDescription("First half Attendance")
                ->setKeywords("First half Attendance")
                ->setCategory("First half Attendance");
// Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ক্রমিক নং')
                ->setCellValue('B1', 'কার্ড নং')
                ->setCellValue('C1', 'নাম')
                ->setCellValue('D1', 'প্রবেশের সময়')
                ->setCellValue('E1', 'বাহিরের সময়');

        $limit = count($first_half_attendance) - 1;
        for ($index = 0; $index <= $limit; $index++) {

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . ($index + 2), str_replace(range(0, 9),$bn_digits,$index + 1))
                    ->setCellValue('B' . ($index + 2), str_replace(range(0, 9),$bn_digits,$first_half_attendance[$index]['CardNo']))
                    ->setCellValue('C' . ($index + 2), $first_half_attendance[$index]['Name'])
                    ->setCellValue('D' . ($index + 2), str_replace(range(0, 9),$bn_digits,date('d-m-Y g:i:s a',strtotime('+6 hours',strtotime($first_half_attendance[$index]['InTime'])))))
                    ->setCellValue('E' . ($index + 2), str_replace(range(0, 9),$bn_digits,date('d-m-Y g:i:s a',strtotime('+6 hours',strtotime($first_half_attendance[$index]['OutTime'])))));
        }


        $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
        date_default_timezone_set('Asia/Dacca');
        header('Content-Type: application/vnd.ms-excel');
        $fileName = date('d-m-Y_g:i_a', now());

        header("Content-Disposition: attachment;filename=First_Half_Attendance_" . $fileName . ".xls ");
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

    public function retrieve_employee_information($card_no, $myvalue) {
        //$count = 0;
        $first_half_access_report = array();
        foreach ($myvalue as $rec_employee_info) {
            if ($card_no == $rec_employee_info->CardNo) {
                $first_half_access_report['Name'] = $rec_employee_info->Name;
                $first_half_access_report['CardNo'] = $rec_employee_info->CardNo;
                $first_half_access_report['Department'] = $rec_employee_info->Department;
                $first_half_access_report['Line'] = $rec_employee_info->Line;
                return $first_half_access_report;
            }
        }
//        $first_half_access_report['Name'] = 'Not Found';
//        $first_half_access_report['CardNo'] = 'Not Found';        
//        $first_half_access_report['Department'] = 'Not Found';
//        $first_half_access_report['Line'] = 'Not Found';        
//        return $first_half_access_report;
    }

}
