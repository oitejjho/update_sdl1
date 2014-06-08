<?php

class Con_pro_attn_mismatch_report extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('mod_pro_attn_mismatch_report');
        $this->load->model('mod_access_log');
        $this->load->model('mod_incurrect_access_log');
        $this->load->model('mod_monthly_wages_detail');
        $this->load->model('mod_buil_sec_other');
    }

    public function insert() {
        date_default_timezone_set('Asia/Dacca');
        $cardno = $this->input->post("CardNo");
        $InTime = date('Y-m-d H:i:s', strtotime('-6 hours', strtotime($this->input->post('InTime'))));
        $OutTime = date('Y-m-d H:i:s', strtotime('-6 hours', strtotime($this->input->post('OutTime'))));
        //echo $cardno . '<br/>' . $InTime . '<br/>' . $OutTime;
        //exit();
        if (date('H:i:s', strtotime($InTime)) < date('H:i:s', strtotime('04:59:59'))) {
            $status = 'IN';
        } else {
            $status = 'OUT';
        }
        $Indata = array(
            "CardNo" => $cardno,
            "DateTime" => date('Y-m-d H:i:s', strtotime($InTime)),
            "Status" => $status,
            "CreatedBy" => $this->session->userdata('Email'),
            "DelStatus" => 'ACT'
        );
        if (date('H:i:s', strtotime($OutTime)) > date('H:i:s', strtotime('04:59:59'))) {
            $status = 'OUT';
        } else {
            $status = 'IN';
        }
        $Outdata = array(
            "CardNo" => $cardno,
            "DateTime" => date('Y-m-d H:i:s', strtotime($OutTime)),
            "CreatedBy" => $this->session->userdata('Email'),
            "Status" => $status,
            "DelStatus" => 'ACT'
        );
//        echo '<pre>';
//        print_r($Indata);
//        
//        echo '</pre>';
//        echo '<pre>';
//        print_r($Outdata);
//        
//        echo '</pre>';
        //exit();

        $this->mod_pro_attn_mismatch_report->UpdateIncurrenctAccessLog($cardno, $InTime);
        $this->mod_access_log->insert($Indata);
        $this->mod_access_log->insert($Outdata);

        redirect('con_pro_attn_mismatch_report/edit');
    }

    public function insert1() {
        date_default_timezone_set('Asia/Dacca');
        $cardno = $this->input->post("CardNo");
        $InTime = date('Y-m-d H:i:s', strtotime('-6 hours', strtotime($this->input->post('InTime'))));
        $OutTime = date('Y-m-d H:i:s', strtotime('-6 hours', strtotime($this->input->post('OutTime'))));
        //echo $cardno . '<br/>' . $InTime . '<br/>' . $OutTime;
        //exit();
        if (date('H:i:s', strtotime($InTime)) < date('H:i:s', strtotime('04:59:59'))) {
            $status = 'IN';
        } else {
            $status = 'OUT';
        }
        $Indata = array(
            "CardNo" => $cardno,
            "DateTime" => date('Y-m-d H:i:s', strtotime($InTime)),
            "Status" => $status,
            "CreatedBy" => $this->session->userdata('Email'),
            "DelStatus" => 'ACT'
        );
        if (date('H:i:s', strtotime($OutTime)) > date('H:i:s', strtotime('04:59:59'))) {
            $status = 'OUT';
        } else {
            $status = 'IN';
        }
        $Outdata = array(
            "CardNo" => $cardno,
            "DateTime" => date('Y-m-d H:i:s', strtotime($OutTime)),
            "CreatedBy" => $this->session->userdata('Email'),
            "Status" => $status,
            "DelStatus" => 'ACT'
        );
//        echo '<pre>';
//        print_r($Indata);
//        
//        echo '</pre>';
//        echo '<pre>';
//        print_r($Outdata);
//        
//        echo '</pre>';
//        exit();

        $this->mod_pro_attn_mismatch_report->UpdateIncurrenctAccessLog($cardno, $InTime);
        $this->mod_access_log->insert($Indata);
        $this->mod_access_log->insert($Outdata);

        redirect('con_pro_attn_mismatch_report/index', 'refresh');
        //redirect('con_pro_attn_mismatch_report/edit1/' . $cardno);
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
        date_default_timezone_set('Asia/Dacca');
        if ($this->input->post('Date')) {
            $mydate = $this->input->post('Date');
            $now = date('Y-m-d', strtotime(str_replace('-', '/', $mydate)));
        } else {
            $now = date('Y-m-d', strtotime('-1 day', now()));
        }
//        echo $now;
//        exit();
        $StartDate = $now . ' 00:00:01';
        $EndDate = $now . ' 23:59:59';
        $StartDate = date('Y-m-d H:i:s', strtotime($StartDate));
        $EndDate = date('Y-m-d H:i:s', strtotime($EndDate));
        //$StartDate = date('Y-m-d H:i:s', strtotime("2014-03-03 00:00:01"));
        //$EndDate = date('Y-m-d H:i:s', strtotime("2014-03-03 23:59:59"));
        $incorrect_access_log = $this->mod_pro_attn_mismatch_report->incorrect_access_log($StartDate, $EndDate);
        $mismatch_information = array();
        $abc = array();
        //$mismatch_information = $incorrect_access_log;

        foreach ($incorrect_access_log as $access_log) {
            $mismatch_information['CardNo'] = $access_log->CardNo;
            $mismatch_information['DateTime'] = $access_log->DateTime;
            $data12 = $this->retrieve_employee_information($access_log->CardNo, $employee_details);

            if ($data12 != NULL) {
                $mismatch_information['Name'] = $data12['Name'];
                $mismatch_information['BuildingName'] = $data12['BuildingName'];
                $mismatch_information['Floor'] = $data12['Floor'];
                $mismatch_information['Department'] = $data12['Department'];
                $mismatch_information['Line'] = $data12['Line'];
                array_push($abc, $mismatch_information);
            }
        }
        $data['showDate'] = $now;
        $data['tbl_mismatch_report'] = $abc;
        $data['container'] = 'temp/prev_attn_mismatch_report/previous_attn_mismatch_report';
        $this->load->view('main_page', $data);
    }

//    public function json_encode_result() {
//        $BuildingName = $this->session->userdata('BuildingName');
//        $data['floorInfo'] = $this->mod_buil_sec_other->getFloor($BuildingName);
//        $Floor = $this->session->userdata('Floor');
//        $data['floor'] = $Floor;
//        $Department = $this->session->userdata('Department');
//        if ($this->session->userdata('Role') == 'Admin') {
//            $employee_details = $this->mod_pro_attn_mismatch_report->specific_employee_information1($BuildingName);
//        } else {
//            $employee_details = $this->mod_pro_attn_mismatch_report->specific_employee_information2($BuildingName, $Floor);
//        }
//        date_default_timezone_set('Asia/Dacca');
//        if ($this->input->post('Date')) {
//            $mydate = $this->input->post('Date');
//            $now = date('Y-m-d', strtotime(str_replace('-', '/', $mydate)));
//        } else {
//            $now = date('Y-m-d', strtotime('-1 day', now()));
//        }
////        echo $now;
////        exit();
//        $StartDate = $now . ' 00:00:01';
//        $EndDate = $now . ' 23:59:59';
//        $StartDate = date('Y-m-d H:i:s', strtotime($StartDate));
//        $EndDate = date('Y-m-d H:i:s', strtotime($EndDate));
//        //$StartDate = date('Y-m-d H:i:s', strtotime("2014-03-03 00:00:01"));
//        //$EndDate = date('Y-m-d H:i:s', strtotime("2014-03-03 23:59:59"));
//        $incorrect_access_log = $this->mod_pro_attn_mismatch_report->incorrect_access_log($StartDate, $EndDate);
//        $mismatch_information = array();
//        $abc = array();
//        //$mismatch_information = $incorrect_access_log;
//
//        foreach ($incorrect_access_log as $access_log) {
//            $mismatch_information['CardNo'] = $access_log->CardNo;
//            $mismatch_information['DateTime'] = $access_log->DateTime;
//            $data12 = $this->retrieve_employee_information($access_log->CardNo, $employee_details);
//
//            if ($data12 != NULL) {
//                $mismatch_information['Name'] = $data12['Name'];
//                $mismatch_information['BuildingName'] = $data12['BuildingName'];
//                $mismatch_information['Floor'] = $data12['Floor'];
//                $mismatch_information['Department'] = $data12['Department'];
//                $mismatch_information['Line'] = $data12['Line'];
//                array_push($abc, $mismatch_information);
//            }
//        }
//        echo json_encode($abc);
//        //$data['tbl_mismatch_report'] = $abc;
//    }

    public function get_department_name() {
        $BuildingName = $this->input->post('Building');
        $Floor = $this->input->post('Floor');
        $DepartmentName = $this->mod_monthly_wages_detail->get_department_by_name($BuildingName, $Floor);

        echo json_encode($DepartmentName);
    }

    public function get_line_name() {
        $BuildingName = $this->input->post('Building');
        $Floor = $this->input->post('Floor');
        $DepartmentName = $this->input->post('Department');
        $LineName = $this->mod_monthly_wages_detail->get_line_by_name($BuildingName, $Floor, $DepartmentName);
        echo json_encode($LineName);
    }

    public function search() {
        $BuildingName = $this->input->post('Building');
        $Floor = $this->input->post('Floor');
        $DepartmentName = $this->input->post('DepartmentSection');
        $Line = $this->input->post('LineUnit');
        $Date = $this->input->post('Date');

        $employee_details = $this->mod_pro_attn_mismatch_report->specific_employee_information_report($BuildingName, $Floor, $DepartmentName, $Line);
        $now = date('Y-m-d', strtotime($Date));
        //echo $now;
        //exit();
        $StartDate = $now . ' 00:00:01';
        $EndDate = $now . ' 23:59:59';
        $StartDate = date('Y-m-d H:i:s', strtotime($StartDate));
        $EndDate = date('Y-m-d H:i:s', strtotime($EndDate));
        //$StartDate = date('Y-m-d H:i:s', strtotime("2014-03-01 00:00:01"));
        //$EndDate = date('Y-m-d H:i:s', strtotime("2014-03-01 23:59:59"));

        $incorrect_access_log = $this->mod_pro_attn_mismatch_report->incorrect_access_log($StartDate, $EndDate);

        $mismatch_information = array();
        $abc = array();
        //$mismatch_information = $incorrect_access_log;

        foreach ($incorrect_access_log as $access_log) {
            $mismatch_information['CardNo'] = $access_log->CardNo;
            $mismatch_information['DateTime'] = $access_log->DateTime;
            $data12 = $this->retrieve_employee_information($access_log->CardNo, $employee_details);
            if ($data12 != NULL) {
                $mismatch_information['Name'] = $data12['Name'];
                $mismatch_information['Department'] = $data12['Department'];
                $mismatch_information['Line'] = $data12['Line'];
                array_push($abc, $mismatch_information);
            }
        }

        $data['tbl_mismatch_report'] = $abc;
        $data['container'] = 'temp/prev_attn_mismatch_report/previous_attn_mismatch_report';
        $this->load->view('main_page', $data);
        //redirect('con_pro_attn_mismatch_report/index', 'refresh');
    }

    public function retrieve_employee_information($card_no, $myvalue) {
        //$count = 0;
        $abc = array();
        foreach ($myvalue as $rec_employee_info) {
            //$count++;

            if ($card_no == $rec_employee_info->CardNo) {
                $abc['Name'] = $rec_employee_info->Name;
                $abc['BuildingName'] = $rec_employee_info->BuildingName;
                $abc['Floor'] = $rec_employee_info->Floor;
                $abc['CardNo'] = $rec_employee_info->CardNo;
                $abc['Department'] = $rec_employee_info->Department;
                $abc['Line'] = $rec_employee_info->Line;
                return $abc;
            }
        }
//        $abc['Name'] = 'Not Found';
//        $abc['CardNo'] = 'Not Found';        
//        $abc['Department'] = 'Not Found';
//        $abc['Line'] = 'Not Found';        
//        return $abc;
    }

    public function edit() {
        $cardNo = $this->input->post('CardNo');
        $time = $this->input->post('Date');
        //echo $cardNo.'<br/>'.$time;
        //exit();
        $data['tbl_mismatch_report'] = $this->mod_pro_attn_mismatch_report->view_by_CardNo($cardNo, $time);
        $data['container'] = 'temp/prev_attn_mismatch_report/edit';
        $this->load->view('main_page', $data);
    }

    public function edit1() {
        $cardNo = $this->uri->segment(3);
        //   echo $cardNo;
        //echo $cardNo.'<br/>'.$time;
        //exit();
        $data['tbl_mismatch_report'] = $this->mod_pro_attn_mismatch_report->view_by_CardNo1($cardNo);
//          echo '<pre>';
//          print_r($data['tbl_mismatch_report']);
//          echo '</pre>';
        $data['container'] = 'temp/prev_attn_mismatch_report/edit';
        $this->load->view('main_page', $data);
    }

    public function systemGeneratedCurrection($Month) {
        $email = 'AUTO';
        $all_mismacthes = $this->mod_incurrect_access_log->getGruoupedData($Month);
//        echo '<pre>';
//        print_r($all_mismacthes);
//        echo '</pre>';
        //exit();
        $all_currect_data = array();
        $limit = count($all_mismacthes) - 1;
        $currect_data_index = 0;
        for ($index = 0; $index <= $limit; $index++) {
            $all_mismacthes[$index]['DelStatus'] = 'DEL';

            $all_currect_data[$currect_data_index]['CardNo'] = $all_mismacthes[$index]['CardNo'];
            $all_currect_data[$currect_data_index]['CreatedBy'] = $email;
            $all_currect_data[$currect_data_index]['DelStatus'] = 'ACT';

            $all_currect_data[$currect_data_index + 1]['CardNo'] = $all_mismacthes[$index]['CardNo'];
            $all_currect_data[$currect_data_index + 1]['CreatedBy'] = $email;
            $all_currect_data[$currect_data_index + 1]['DelStatus'] = 'ACT';

            if (date('H:i:s', strtotime($all_mismacthes[$index]['DateTime'])) >= date('H:i:s', strtotime('06:00:00'))) {
                $all_currect_data[$currect_data_index]['Status'] = 'IN';
                $all_currect_data[$currect_data_index + 1]['Status'] = 'OUT';
                $all_currect_data[$currect_data_index]['DateTime'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($all_mismacthes[$index]['DateTime'])) . ' 02:15:00'));
                $all_currect_data[$currect_data_index + 1]['DateTime'] = $all_mismacthes[$index]['DateTime'];
            } else {
                $all_currect_data[$currect_data_index]['Status'] = 'IN';
                $all_currect_data[$currect_data_index + 1]['Status'] = 'OUT';
                $all_currect_data[$currect_data_index]['DateTime'] = $all_mismacthes[$index]['DateTime'];
                $all_currect_data[$currect_data_index + 1]['DateTime'] = date('Y-m-d H:i:s', strtotime(date('Y-m-d', strtotime($all_mismacthes[$index]['DateTime'])) . ' 11:15:00'));
            }
            $currect_data_index+=2;
        }
        echo 'Data Truncating.....';
        $this->mod_incurrect_access_log->EmptyTable($Month);
        echo 'Data Inserting .....';
        $this->mod_incurrect_access_log->insert_batch_random_data($all_mismacthes);
        $this->mod_access_log->insert_batch_random_data($all_currect_data);
        echo 'Data Updated & Inserted';
    }

    public function excelExport() {
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
        date_default_timezone_set('Asia/Dacca');
        if ($this->input->post('hDate')) {
            $mydate = $this->input->post('hDate');
            $now = date('Y-m-d', strtotime(str_replace('-', '/', $mydate)));
        } else {
            $now = date('Y-m-d', strtotime('-1 day', now()));
        }

        $StartDate = $now . ' 00:00:01';
        $EndDate = $now . ' 23:59:59';
        $StartDate = date('Y-m-d H:i:s', strtotime($StartDate));
        $EndDate = date('Y-m-d H:i:s', strtotime($EndDate));
        //$StartDate = date('Y-m-d H:i:s', strtotime("2014-03-03 00:00:01"));
        //$EndDate = date('Y-m-d H:i:s', strtotime("2014-03-03 23:59:59"));
        $incorrect_access_log = $this->mod_pro_attn_mismatch_report->incorrect_access_log($StartDate, $EndDate);
        $mismatch_information = array();
        $abc = array();
        //$mismatch_information = $incorrect_access_log;

        foreach ($incorrect_access_log as $access_log) {
            $mismatch_information['CardNo'] = $access_log->CardNo;
            $mismatch_information['DateTime'] = $access_log->DateTime;
            $data12 = $this->retrieve_employee_information($access_log->CardNo, $employee_details);

            if ($data12 != NULL) {
                $mismatch_information['Name'] = $data12['Name'];
                $mismatch_information['BuildingName'] = $data12['BuildingName'];
                $mismatch_information['Floor'] = $data12['Floor'];
                $mismatch_information['Department'] = $data12['Department'];
                $mismatch_information['Line'] = $data12['Line'];
                array_push($abc, $mismatch_information);
            }
        }
        $this->PopulateSalarySheet($abc);
    }

    public function PopulateSalarySheet($first_half_attendance) {
//        echo '<pre>';
//        print_r($first_half_attendance);
//        echo '</pre>';
//        exit();

        $bn_digits = array('০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯');
        require_once APPPATH . "/third_party/PHPExcel.php";
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("RCIS")
                ->setLastModifiedBy("RCIS")
                ->setTitle("Mismatch Report")
                ->setSubject("CopyRight RCIS")
                ->setDescription("Absent Report")
                ->setKeywords("Absent Report")
                ->setCategory("Absent Report");
// Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ক্রমিক নং')
                ->setCellValue('B1', 'কার্ড নং')
                ->setCellValue('C1', 'নাম')
                ->setCellValue('D1', 'বিভাগ')
				->setCellValue('E1', 'প্রবেশ/বাহির সময় ');

        $limit = count($first_half_attendance) - 1;
        for ($index = 0; $index <= $limit; $index++) {

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . ($index + 2), str_replace(range(0, 9), $bn_digits, $index + 1))
                    ->setCellValue('B' . ($index + 2), str_replace(range(0, 9), $bn_digits, $first_half_attendance[$index]['CardNo']))
                    ->setCellValue('C' . ($index + 2), $first_half_attendance[$index]['Name'])
                    ->setCellValue('D' . ($index + 2), $first_half_attendance[$index]['Department'])
					->setCellValue('E' . ($index + 2), str_replace(range(0, 9), $bn_digits, date('d-m-Y g:i:s a', strtotime('+6 hours', strtotime($first_half_attendance[$index]['DateTime'])))));
        }


        $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
        date_default_timezone_set('Asia/Dacca');
        header('Content-Type: application/vnd.ms-excel');
        $fileName = date('d-m-Y_g:i_a', now());

        header("Content-Disposition: attachment;filename=Mismactch_Report_" . $fileName . ".xls ");
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

}
