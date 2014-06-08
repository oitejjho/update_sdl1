<?php

ini_set('max_execution_time', 6000);
ini_set('memory_limit', '512M');

class Con_proc_monthly_report_generate extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mod_daily_attendance_log');
        $this->load->model('mod_monthly_wages_detail');
        $this->load->model('mod_set_wages_breakdown');
        $this->load->model('mod_set_employee_info_detail');
        $this->load->model('mod_set_holiday_catagory');
        $this->load->model('mod_leave_detail');
        $this->load->model('mod_grade_mapping');
        $this->load->model('mod_leave_type_allocation');
        $this->load->model('mod_buil_sec_other');
        $this->load->helper('alert');
        $this->load->helper('date');
        $this->load->model('mod_set_employee_salary');
    }

//     function index() {        
//        $data['building_name'] = $this->mod_monthly_wages_detail->get_building_by_name();
//        $data['container'] = 'temp/wages_detail/employee_wages_detail';
//        $this->load->view('main_page', $data);
//    }

    public function search() {
        date_default_timezone_set('Asia/Dacca');
        $month = $this->input->post('Month');
        $building = $this->input->post('Building');
        $floor = $this->input->post('Floor');
        $Department = $this->input->post('DepartmentSection');
        $line = $this->input->post('LineUnit');
        echo '<pre>';
        print_r($this->input->post());
        echo '</pre>';
        exit();
//        echo $month;
//        exit();

        $data['tbl_monthly_wages_detail'] = $this->mod_monthly_wages_detail->specific_employee_information_report($building, $floor, $Department, $line, $month);
//        echo '<pre>';
//        print_r($data['tbl_monthly_wages_detail']);
//        echo '</pre>';
//        exit();
        $data['container'] = 'temp/wages_detail/employee_wages_detail';
        $this->load->view('main_page', $data);
    }

    public function view_monthly_report() {
//        echo 'This is monthly report view';
//        exit();
        date_default_timezone_set('Asia/Dacca');
        $now = date('m', now());
        $data['tbl_monthly_wages_detail'] = $this->mod_monthly_wages_detail->MonthSpecificGetAllDataWith($now - 1);
        //        echo '<pre>';
        //        print_r($data['tbl_monthly_wages_detail']);
        //        echo '</pre>';
        //        exit();
        $data['container'] = 'temp/wages_detail/employee_wages_detail';
        $this->load->view('main_page', $data);
    }

    public function get_department_name() {
        $BuildingName = $this->input->post('Building');
        $Floor = $this->input->post('Floor');
        $DepartmentName = $this->mod_monthly_wages_detail->get_department_name($BuildingName, $Floor);

        echo json_encode($DepartmentName);
    }

    public function view() {
        $building = $this->input->post('building');
        $floor = $this->input->post('floor');
        $Department = $this->input->post('Department');
        if ($this->input->post('line')) {
            $line = $this->input->post('line');
        } else {
            $line = '';
        }
        $data['tbl_monthly_wages_detail'] = $this->mod_monthly_wages_detail->get_report($building, $floor, $Department, $line);
//      echo $building;
//       echo $floor;
//        echo $Department;
//         echo $line;
        // echo print_r($data);
//        echo '</pre>';
        $data['container'] = 'temp/wages_detail/employee_wages_detail';
        $this->load->view('main_page', $data);
    }

    public function get_floor() {
        $building = $this->input->post('building_name');
        $query = $this->mod_monthly_wages_detail->get_floor_by_name($building);
        echo json_encode($query);
    }

    public function get_department() {
        $building = $this->input->post('building');
        $floor = $this->input->post('floor');
        $query = $this->mod_monthly_wages_detail->get_department_by_name($building, $floor);
        echo json_encode($query);
    }

    public function get_line() {
        $building = $this->input->post('building');
        $floor = $this->input->post('floor');
        $Department = $this->input->post('Department');
        $query = $this->mod_monthly_wages_detail->get_line_by_name($building, $floor, $Department);
        echo json_encode($query);
    }

    public function PopulateSalarySheet($Month) {
        $tbl_monthly_wages_detail = $this->mod_monthly_wages_detail->GetAllDataArray($Month);
        require_once APPPATH . "/third_party/PHPExcel.php";
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("RCIS")
                ->setLastModifiedBy("RCIS")
                ->setTitle("Opex Group")
                ->setSubject("CopyRight RCIS")
                ->setDescription("Salary Sheet")
                ->setKeywords("Salary Sheet")
                ->setCategory("Salary Sheet");
// Add some data
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'ক্রমিক নং')
                ->setCellValue('B1', 'নাম')
                ->setCellValue('C1', 'পদবী')
                ->setCellValue('D1', 'কার্ডনং')
                ->setCellValue('E1', 'যোগদানের তারিখ')
                ->setCellValue('F1', 'গ্রেড')
                ->setCellValue('G1', 'সর্বমোট বর্তমান বেতন/মজুরী')
                ->setCellValue('H1', 'মূল বেতন/মজুরী')
                ->setCellValue('I1', 'বাড়ী ভাড়া')
                ->setCellValue('J1', 'চিকিৎসা ভাতা')
                ->setCellValue('K1', 'যাতায়াত ভাতা')
                ->setCellValue('L1', 'খাদ্য ভাতা')
                ->setCellValue('M1', 'দেনিক মোট বেতন/মজুরী')
                ->setCellValue('N1', 'মোট দিন')
                ->setCellValue('O1', 'অনুমোদিত ছুটি')
                ->setCellValue('P1', 'অনুপস্থিত')
                ->setCellValue('Q1', 'হাজিরা')
                ->setCellValue('R1', 'মোট প্রাপ্য বেতন/মজুরী')
                ->setCellValue('S1', 'বকেয়া প্রাপ্য')
                ->setCellValue('T1', 'ওভারটাইম ঘন্টা')
                ->setCellValue('U1', 'ওভারটাইম(প্রতি ঘন্টা)')
                ->setCellValue('V1', 'ওভারটাইম প্রাপ্য টাকা')
                ->setCellValue('W1', 'ভাতা টাকা')
                ->setCellValue('X1', 'উপ: ভাতা (হাজিরা)')
                ->setCellValue('Y1', 'টিফিন সংখ্যা')
                ->setCellValue('Z1', 'টিফিন টাকা')
                ->setCellValue('AA1', 'মোট প্রাপ্য টাকা')
                ->setCellValue('AB1', 'প্রদত্ত অগ্রিম বেতন/মজুরী')
                ->setCellValue('AC1', 'স্ট্যাম্প চার্জ')
                ->setCellValue('AD1', 'সর্ব শেষ প্রাপ্য টাকা')
                ->setCellValue('AE1', 'স্বাক্ষর');
        $limit = count($tbl_monthly_wages_detail) - 1;
        for ($index = 0; $index <= $limit; $index++) {

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . ($index + 2), $index + 1)
                    ->setCellValue('B' . ($index + 2), $tbl_monthly_wages_detail[$index]['Name'])
                    ->setCellValue('C' . ($index + 2), $tbl_monthly_wages_detail[$index]['Designation'])
                    ->setCellValue('D' . ($index + 2), $tbl_monthly_wages_detail[$index]['CardNo'])
                    ->setCellValue('E' . ($index + 2), $tbl_monthly_wages_detail[$index]['DateOfJoin'])
                    ->setCellValue('F' . ($index + 2), $tbl_monthly_wages_detail[$index]['Grade'])
                    ->setCellValue('G' . ($index + 2), $tbl_monthly_wages_detail[$index]['GrossSalary'])
                    ->setCellValue('H' . ($index + 2), $tbl_monthly_wages_detail[$index]['Basic'])//not present in db table
                    ->setCellValue('I' . ($index + 2), $tbl_monthly_wages_detail[$index]['HouseRent'])//not present in db table
                    ->setCellValue('J' . ($index + 2), $tbl_monthly_wages_detail[$index]['MedicalAllowance'])//
                    ->setCellValue('K' . ($index + 2), $tbl_monthly_wages_detail[$index]['TravelAllowance'])//
                    ->setCellValue('L' . ($index + 2), $tbl_monthly_wages_detail[$index]['FoodAllowance'])//
                    ->setCellValue('M' . ($index + 2), $tbl_monthly_wages_detail[$index]['DailyWage'])//
                    ->setCellValue('N' . ($index + 2), $tbl_monthly_wages_detail[$index]['TotalWorkingDays'])//
                    ->setCellValue('O' . ($index + 2), $tbl_monthly_wages_detail[$index]['LeaveOfEmpolyee'])
                    ->setCellValue('P' . ($index + 2), $tbl_monthly_wages_detail[$index]['Absent'])
                    ->setCellValue('Q' . ($index + 2), $tbl_monthly_wages_detail[$index]['WorkDays'])
                    ->setCellValue('R' . ($index + 2), $tbl_monthly_wages_detail[$index]['TotalAvailableToPay'])//
                    ->setCellValue('S' . ($index + 2), $tbl_monthly_wages_detail[$index]['OutStandingDues'])//
                    ->setCellValue('T' . ($index + 2), $tbl_monthly_wages_detail[$index]['OverTimeHour'] + $tbl_monthly_wages_detail[$index]['AdditionalOverTimeHour'] + $tbl_monthly_wages_detail[$index]['NightShiftOverTimeHour'])
                    ->setCellValue('U' . ($index + 2), $tbl_monthly_wages_detail[$index]['HourlyOTWage'])
                    ->setCellValue('V' . ($index + 2), ($tbl_monthly_wages_detail[$index]['OverTimeHour'] + $tbl_monthly_wages_detail[$index]['AdditionalOverTimeHour'] + $tbl_monthly_wages_detail[$index]['NightShiftOverTimeHour']) * $tbl_monthly_wages_detail[$index]['HourlyOTWage'])
                    ->setCellValue('W' . ($index + 2), $tbl_monthly_wages_detail[$index]['OtherAllowance'])
                    ->setCellValue('X' . ($index + 2), $tbl_monthly_wages_detail[$index]['AttendanceBonus'])
                    ->setCellValue('Y' . ($index + 2), $tbl_monthly_wages_detail[$index]['NoOfAOT'])
                    ->setCellValue('Z' . ($index + 2), $tbl_monthly_wages_detail[$index]['NoOfAOT'] * 20.00)
                    ->setCellValue('AA' . ($index + 2), $tbl_monthly_wages_detail[$index]['HolidayNetPayable'] + $tbl_monthly_wages_detail[$index]['TotalAvailableToPay'] + $tbl_monthly_wages_detail[$index]['OutStandingDues'] + (($tbl_monthly_wages_detail[$index]['OverTimeHour'] + $tbl_monthly_wages_detail[$index]['AdditionalOverTimeHour'] + $tbl_monthly_wages_detail[$index]['NightShiftOverTimeHour']) * $tbl_monthly_wages_detail[$index]['HourlyOTWage']) + $tbl_monthly_wages_detail[$index]['OtherAllowance'] + $tbl_monthly_wages_detail[$index]['AttendanceBonus'] + ($tbl_monthly_wages_detail[$index]['NoOfAOT'] * 20.00))
                    ->setCellValue('AB' . ($index + 2), '0')
                    ->setCellValue('AC' . ($index + 2), $tbl_monthly_wages_detail[$index]['StampCharge'])
                    ->setCellValue('AD' . ($index + 2), $tbl_monthly_wages_detail[$index]['NetPayable']);
        }


        $objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Opex Group.xls"');
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

    public function Retrieve_employee_information($card_no, $myvalue) {
        //$count = 0;
        $abc = array();
        foreach ($myvalue as $rec_employee_info) {
            //$count++;
            if ($card_no == $rec_employee_info->CardNo) {
                $abc['Name'] = $rec_employee_info->Name;
                $abc['Designation'] = $rec_employee_info->Designation;
                $abc['Grade'] = $rec_employee_info->Grade;
                $abc['JoiningDate'] = $rec_employee_info->JoiningDate;
                $abc['BuildingName'] = $rec_employee_info->BuildingName;
                $abc['Floor'] = $rec_employee_info->Floor;
                $abc['Department'] = $rec_employee_info->Department;
                $abc['Line'] = $rec_employee_info->Line;
                return $abc;
            }
        }
        $abc['Name'] = 'Not Found';
        $abc['Designation'] = 'Not Found';
        $abc['Grade'] = 'Not Found';
        $abc['JoiningDate'] = date('m-d-y', strtotime('1900-01-01'));
        $abc['BuildingName'] = 'Not Found';
        $abc['Floor'] = 'Not Found';
        $abc['Department'] = 'Not Found';
        $abc['Line'] = 'Not Found';

        return $abc;


        //$data['container'] = 'temp/employee_detail/employee_info_detail';
        //$this->load->view('main_page', $data);
    }

    public function CardSpecificWorkingDays($holidayList, $data_tbl_daily_whole, $cardNo) {
        $limit = count($data_tbl_daily_whole) - 1;
        $limit1 = count($holidayList) - 1;
        $cardWorkDays = array();
        for ($index = 0; $index <= $limit; $index++) {
            if ($data_tbl_daily_whole[$index]['CardNo'] == $cardNo) {
                for ($index1 = 0; $index1 <= $limit1; $index1++) {
                    if ($data_tbl_daily_whole[$index]['Date'] == $holidayList[$index1]['HolidayDate'])
                        array_push($cardWorkDays, $data_tbl_daily_whole[$index]);
                }
            }
        }
        return $cardWorkDays;
    }

    public function HolidaySalaryCalculation($holidayList, $data_tbl_daily_whole, $cardNo, $daily_ot_wage) {
        $cardWorkDays = $this->CardSpecificWorkingDays($holidayList, $data_tbl_daily_whole, $cardNo);
        $totalWorkHour = 0;
        $compensetory_holidays = count($cardWorkDays);
        $limit = count($cardWorkDays) - 1;
        for ($index = 0; $index <= $limit; $index++) {
            $totalWorkHour+=$cardWorkDays[$index]['TotalWorkedHour'];
        }
        //echo 'Card No : ' . $cardNo . '<br/>';
        //echo 'Holiday Salary : ' . $totalWorkHour * $daily_ot_wage . '<br/>';
        //update tbl_leave_allocation
        return $totalWorkHour * $daily_ot_wage;
    }

    public function Salary_distribution($tbl_monthly_wages_detail) {
        $tiffin_allowance = 20.00;
        $dinner = 60.00;
        $total_ot_salary = 0;
        $limit = count($tbl_monthly_wages_detail) - 1;
        $holidayList = $this->mod_set_holiday_catagory->GetAllHolidays($tbl_monthly_wages_detail[0]['ToDate']);
        $data_tbl_daily_whole = $this->mod_daily_attendance_log->getLongDataArray($tbl_monthly_wages_detail[0]['Month']);
        $month_days = date('t', strtotime($tbl_monthly_wages_detail[0]['ToDate']));
        for ($index = 0; $index <= $limit; $index++) {
            $no_of_tiffin = $tbl_monthly_wages_detail[$index]['NoOfAOT'];
            $tbl_monthly_wages_detail[$index]['TotalOverTimeHour'] = $tbl_monthly_wages_detail[$index]['OverTimeHour'] + $tbl_monthly_wages_detail[$index]['AdditionalOverTimeHour'] + $tbl_monthly_wages_detail[$index]['NightShiftOverTimeHour'];
            if ($tbl_monthly_wages_detail[$index]['OT']) {
                $total_ot_salary = $tbl_monthly_wages_detail[$index]['TotalOverTimeHour'] * $tbl_monthly_wages_detail[$index]['HourlyOTWage'];
            }
            $tbl_monthly_wages_detail[$index]['Absent'] = $tbl_monthly_wages_detail[$index]['TotalWorkingDays'] - $tbl_monthly_wages_detail[$index]['WorkDays'] - $tbl_monthly_wages_detail[$index]['LeaveOfEmpolyee'];
            if ($tbl_monthly_wages_detail[$index]['Absent'] > 0 || $tbl_monthly_wages_detail[$index]['NotInTime'] > 2) {
                $tbl_monthly_wages_detail[$index]['AttendanceBonus'] = 0;
            }
            if ($tbl_monthly_wages_detail[$index]['OtherAllowance']) {
                if ($tbl_monthly_wages_detail[$index]['OthAllowCal'] == 'M')
                    $tbl_monthly_wages_detail[$index]['OtherAllowance'] = number_format((float) ((($tbl_monthly_wages_detail[$index]['OtherAllowance'] / $month_days) * ($month_days - $tbl_monthly_wages_detail[$index]['Absent']))), 2, '.', '');
            }
            if ($tbl_monthly_wages_detail[$index]['HolidayWorkDays'] > 0) {
                $tbl_monthly_wages_detail[$index]['HolidayNetPayable'] = number_format((float) (round($this->HolidaySalaryCalculation($holidayList, $data_tbl_daily_whole, $tbl_monthly_wages_detail[$index]['CardNo'], $tbl_monthly_wages_detail[$index]['HourlyOTWage']))), 2, '.', '');
            }                                                                                                  //3417.333333333333+1864+250+200+650=6381.333333333333
            $tbl_monthly_wages_detail[$index]['TotalAvailableToPay'] = number_format((float) ((($tbl_monthly_wages_detail[$index]['Basic'] / $month_days) * ($month_days - $tbl_monthly_wages_detail[$index]['Absent'])) + $tbl_monthly_wages_detail[$index]['HouseRent'] + $tbl_monthly_wages_detail[$index]['MedicalAllowance'] + $tbl_monthly_wages_detail[$index]['TravelAllowance'] + $tbl_monthly_wages_detail[$index]['FoodAllowance']), 2, '.', '');
            $total = number_format((float) ($tbl_monthly_wages_detail[$index]['HolidayNetPayable'] + $tbl_monthly_wages_detail[$index]['TotalAvailableToPay'] + $tbl_monthly_wages_detail[$index]['OutStandingDues'] + $total_ot_salary + $tbl_monthly_wages_detail[$index]['OtherAllowance'] + $tbl_monthly_wages_detail[$index]['AttendanceBonus'] + ($no_of_tiffin * $tiffin_allowance)), 2, '.', '');                            
            $tbl_monthly_wages_detail[$index]['NetPayable'] = number_format((float) (($total - $tbl_monthly_wages_detail[$index]['StampCharge'])), 2, '.', '');
        }

        //$this->UpdateLeaveAllocationTable($tbl_monthly_wages_detail);
        $this->mod_monthly_wages_detail->insert_batch_monthly_report($tbl_monthly_wages_detail);
        //$this->PopulateSalarySheet($tbl_monthly_wages_detail[0]['Month']);
    }

    public function GetWorkingDays($holidayList, $a_date) {
        $limit = count($holidayList) - 1;
        $end_date = date('t', strtotime($a_date));
        $workingDayList = array();
        $year_month_string = date('Y-m', strtotime($a_date));
        for ($start_date = 1, $index = 0; $start_date <= $end_date; $start_date++) {
            $work_date = date('Y-m-d', strtotime($year_month_string . '-' . $start_date));
            if (date('Y-m-d', strtotime($work_date)) < date('Y-m-d', strtotime($holidayList[$index]['HolidayDate']))) {
                array_push($workingDayList, $work_date);
            } else if (date('Y-m-d', strtotime($work_date)) > date('Y-m-d', strtotime($holidayList[$index]['HolidayDate']))) {
                array_push($workingDayList, $work_date);
            } else {
                if ($index < $limit) {
                    $index++;
                }
            }
        }
        return $workingDayList;
    }

    public function IsHoliDay($work_date, $holidayList) {
        $limit = count($holidayList) - 1;
        for ($index = 0; $index <= $limit; $index++) {
            if ($work_date == $holidayList[$index]['HolidayDate'])
                return TRUE;
        }
        return FALSE;
    }

    public function EmployeeLeaveCount($card_no, $leaveList) {
        $limit = count($leaveList) - 1;
        $no_of_leave = 0;
        for ($index = 0; $index <= $limit; $index++) {
            if ($card_no == $leaveList[$index]['CardNo']) {

                $no_of_leave+=1;
            }
        }
        ///update leave_allocation table
        return $no_of_leave;
    }

    public function GetAllowances($CardNo, $tbl_employee_salary) {
        $EmployeeSalaryStructure = array();
        $limit = count($tbl_employee_salary) - 1;
        for ($index = 0; $index <= $limit; $index++) {
            if ($CardNo == $tbl_employee_salary[$index]['CardNo']) {
                $EmployeeSalaryStructure['GrossSalary'] = $tbl_employee_salary[$index]['GrossSalary'];
                $EmployeeSalaryStructure['OT'] = $tbl_employee_salary[$index]['OT'];
                $EmployeeSalaryStructure['AttendanceBonus'] = $tbl_employee_salary[$index]['AttendanceBonus'];
                $EmployeeSalaryStructure['OtherAllowance'] = $tbl_employee_salary[$index]['OtherAllowance'];
                $EmployeeSalaryStructure['MedicalAllowance'] = $tbl_employee_salary[$index]['MedicalAllowance'];
                $EmployeeSalaryStructure['TravelAllowance'] = $tbl_employee_salary[$index]['TravelAllowance'];
                $EmployeeSalaryStructure['FoodAllowance'] = $tbl_employee_salary[$index]['FoodAllowance'];
                $EmployeeSalaryStructure['OthAllowCal'] = $tbl_employee_salary[$index]['OthAllowCal'];
                return $EmployeeSalaryStructure;
            }
        }
        $EmployeeSalaryStructure['GrossSalary'] = 0;
        $EmployeeSalaryStructure['OT'] = 0;
        $EmployeeSalaryStructure['AttendanceBonus'] = 0;
        $EmployeeSalaryStructure['OtherAllowance'] = 0;
        $EmployeeSalaryStructure['MedicalAllowance'] = 0;
        $EmployeeSalaryStructure['TravelAllowance'] = 0;
        $EmployeeSalaryStructure['FoodAllowance'] = 0;
        $EmployeeSalaryStructure['OthAllowCal'] = 'M';
        return $EmployeeSalaryStructure;
    }

    public function UpdateLeaveAllocationTable($tbl_monthly_wages_detail) {
        $date = $tbl_monthly_wages_detail[0]['Year'] . '-' . $tbl_monthly_wages_detail[0]['Month'] . '-01';
        $tbl_leave_type_allocation = $this->mod_leave_type_allocation->GetYearDataArray(date('Y', strtotime($date)));
        $leaveList = $this->mod_leave_detail->GetAllLeaves($date);
        $limit1 = count($leaveList) - 1;
        $limit2 = count($tbl_leave_type_allocation) - 1;
        for ($index1 = 0; $index1 <= $limit1; $index1++) {
            for ($index2 = 0; $index2 <= $limit2; $index2++) {
                if (($leaveList[$index1]['CardNo'] == $tbl_leave_type_allocation[$index2]['CardNo']) && ($leaveList[$index1]['LeaveCategoryName'] == $tbl_leave_type_allocation[$index2]['LeaveType'])) {
                    $tbl_leave_type_allocation[$index2]['Days']-=1;
                }
            }
        }
        $limit1 = count($tbl_monthly_wages_detail) - 1;
        for ($index1 = 0; $index1 <= $limit1; $index1++) {
            if ($tbl_monthly_wages_detail[$index1]['HolidayWorkDays'] > 0) {
                for ($index2 = 0; $index2 <= $limit2; $index2++) {
                    if (($tbl_monthly_wages_detail[$index1]['CardNo'] == $tbl_leave_type_allocation[$index2]['CardNo']) && ($tbl_leave_type_allocation[$index2]['LeaveType'] == 'Compensatory Holiday')) {
                        $tbl_leave_type_allocation[$index2]['Days']+=$tbl_monthly_wages_detail[$index1]['HolidayWorkDays'];
                    }
                }
            }
        }
        $this->mod_leave_type_allocation->EmptyTable();
        $this->mod_leave_type_allocation->insert_batch($tbl_leave_type_allocation);
        $this->mod_monthly_wages_detail->insert_batch_monthly_report($tbl_monthly_wages_detail);
    }

    public function GenerateMonthlyReport($Month) {
        $tbl_daily_attendance_log = $this->mod_daily_attendance_log->getLongDataArray($Month);
        //echo count($tbl_daily_attendance_log) . '<br/>'; //        
        $tbl_employee_salary = $this->mod_set_employee_salary->get_long_data_array();
        //echo count($tbl_employee_salary);
        //exit();
        $tbl_employee_profile = $this->mod_set_employee_info_detail->view();
        $holidayList = $this->mod_set_holiday_catagory->GetAllHolidays($tbl_daily_attendance_log[0]['Date']);
        $leaveList = $this->mod_leave_detail->GetAllLeaves($tbl_daily_attendance_log[0]['Date']);
        $month_days = date('t', strtotime($tbl_daily_attendance_log[0]['Date']));

        //$workingDayList = $this->GetWorkingDays($holidayList, $tbl_daily_attendance_log[0]['Date']);
        //$working_days = count($workingDayList);
        $limit = count($tbl_daily_attendance_log) - 1;
        $tbl_monthly_wages_detail = array();
        for ($index = 0; $index < $limit; $index++) {
            $date = explode('-', $tbl_daily_attendance_log[$index]['Date']);
            $a_monthly_wages_detail['Month'] = $date[1];
            $a_monthly_wages_detail['Year'] = $date[0];
            $a_monthly_wages_detail['FormDate'] = $tbl_daily_attendance_log[$index]['Date'];
            $a_monthly_wages_detail['ToDate'] = $tbl_daily_attendance_log[$index]['Date'];
            $a_monthly_wages_detail['CardNo'] = $tbl_daily_attendance_log[$index]['CardNo'];

            $an_employee_info = $this->Retrieve_employee_information($tbl_daily_attendance_log[$index]['CardNo'], $tbl_employee_profile);
            $a_monthly_wages_detail['Name'] = $an_employee_info['Name'];
            $a_monthly_wages_detail['Designation'] = $an_employee_info['Designation'];
            $a_monthly_wages_detail['Grade'] = $an_employee_info['Grade'];
            $a_monthly_wages_detail['DateOfJoin'] = $an_employee_info['JoiningDate'];
            $a_monthly_wages_detail['BuildingName'] = $an_employee_info['BuildingName'];
            $a_monthly_wages_detail['Floor'] = $an_employee_info['Floor'];
            $a_monthly_wages_detail['Department'] = $an_employee_info['Department'];
            $a_monthly_wages_detail['Line'] = $an_employee_info['Line'];

            $EmployeeSalaryStructure = $this->GetAllowances($tbl_daily_attendance_log[$index]['CardNo'], $tbl_employee_salary);
            $a_monthly_wages_detail['GrossSalary'] = $EmployeeSalaryStructure['GrossSalary'];
            $a_monthly_wages_detail['OT'] = $EmployeeSalaryStructure['OT'];
            $a_monthly_wages_detail['AttendanceBonus'] = $EmployeeSalaryStructure['AttendanceBonus'];
            $a_monthly_wages_detail['OtherAllowance'] = $EmployeeSalaryStructure['OtherAllowance'];
            $a_monthly_wages_detail['MedicalAllowance'] = $EmployeeSalaryStructure['MedicalAllowance'];
            $a_monthly_wages_detail['TravelAllowance'] = $EmployeeSalaryStructure['TravelAllowance'];
            $a_monthly_wages_detail['FoodAllowance'] = $EmployeeSalaryStructure['FoodAllowance'];
            $a_monthly_wages_detail['OthAllowCal'] = $EmployeeSalaryStructure['OthAllowCal'];

            $a_monthly_wages_detail['Basic'] = ($a_monthly_wages_detail['GrossSalary'] - ($a_monthly_wages_detail['MedicalAllowance'] + $a_monthly_wages_detail['TravelAllowance'] + $a_monthly_wages_detail['FoodAllowance'])) / 1.4;
            $a_monthly_wages_detail['HouseRent'] = number_format((float) ($a_monthly_wages_detail['Basic'] * 0.4), 2, '.', '');
            $a_monthly_wages_detail['DailyWage'] = number_format((float) ($a_monthly_wages_detail['GrossSalary'] / $month_days), 2, '.', '');
            $a_monthly_wages_detail['TotalWorkingDays'] = $month_days - count($holidayList);
            $a_monthly_wages_detail['TotalAvailableToPay'] = 0;
            $a_monthly_wages_detail['OutStandingDues'] = 0;
            $a_monthly_wages_detail['TotalOverTimeHour'] = 0;
            $a_monthly_wages_detail['HourlyOTWage'] = number_format((float) ($a_monthly_wages_detail['Basic'] / 104), 2, '.', '');
            $a_monthly_wages_detail['Absent'] = 0;
            $a_monthly_wages_detail['NotInTime'] = 0;
            //Check tbl_leave_detail
            $no_of_leave = $this->EmployeeLeaveCount($a_monthly_wages_detail['CardNo'], $leaveList);
            $a_monthly_wages_detail['LeaveOfEmpolyee'] = $no_of_leave;
            //update tbl_leave_type_allocation
            if ($this->IsHoliDay($tbl_daily_attendance_log[$index]['Date'], $holidayList)) {
                $a_monthly_wages_detail['WorkDays'] = 0;
                $a_monthly_wages_detail['HolidayWorkDays'] = 1;
                //$a_monthly_wages_detail['LeaveOfEmpolyee'] = 1;
            } else {
                $a_monthly_wages_detail['WorkDays'] = 1;
                $a_monthly_wages_detail['HolidayWorkDays'] = 0;
                //$a_monthly_wages_detail['LeaveOfEmpolyee'] = 0;
                if ($tbl_daily_attendance_log[$index]['InTime'] == 0) {
                    $a_monthly_wages_detail['NotInTime'] = 1;
                }
            }
            $a_monthly_wages_detail['OverTimeHour'] = $tbl_daily_attendance_log[$index]['OverTimeHour'];
            $a_monthly_wages_detail['AdditionalOverTimeHour'] = $tbl_daily_attendance_log[$index]['AdditionalOverTimeHour'];
            $a_monthly_wages_detail['NightShiftOverTimeHour'] = $tbl_daily_attendance_log[$index]['NihgtShiftOverTimeHour'];
            $a_monthly_wages_detail['StampCharge'] = 10;
            $a_monthly_wages_detail['HolidayNetPayable'] = 0;
            $a_monthly_wages_detail['NetPayable'] = 0;
            $a_monthly_wages_detail['NoOfOT'] = $tbl_daily_attendance_log[$index]['OT'];
            $a_monthly_wages_detail['NoOfAOT'] = $tbl_daily_attendance_log[$index]['AOT'];
            $a_monthly_wages_detail['NoOfNight'] = $tbl_daily_attendance_log[$index]['Night'];
            while ($tbl_daily_attendance_log[$index]['CardNo'] == $tbl_daily_attendance_log[$index + 1]['CardNo']) {
                $a_monthly_wages_detail['ToDate'] = $tbl_daily_attendance_log[$index + 1]['Date'];
                if ($this->IsHoliDay($tbl_daily_attendance_log[$index + 1]['Date'], $holidayList)) {
                    $a_monthly_wages_detail['HolidayWorkDays'] += 1;
                    //$a_monthly_wages_detail['LeaveOfEmpolyee'] += 1;
                } else {
                    $a_monthly_wages_detail['WorkDays'] += 1;
                    if ($tbl_daily_attendance_log[$index + 1]['InTime'] == 0) {
                        $a_monthly_wages_detail['NotInTime']+=1;
                    }
                }
                $a_monthly_wages_detail['OverTimeHour'] += $tbl_daily_attendance_log[$index + 1]['OverTimeHour'];
                $a_monthly_wages_detail['AdditionalOverTimeHour'] += $tbl_daily_attendance_log[$index + 1]['AdditionalOverTimeHour'];
                $a_monthly_wages_detail['NightShiftOverTimeHour'] += $tbl_daily_attendance_log[$index + 1]['NihgtShiftOverTimeHour'];
                $a_monthly_wages_detail['NoOfOT'] += $tbl_daily_attendance_log[$index + 1]['OT'];
                $a_monthly_wages_detail['NoOfAOT'] += $tbl_daily_attendance_log[$index + 1]['AOT'];
                $a_monthly_wages_detail['NoOfNight'] += $tbl_daily_attendance_log[$index + 1]['Night'];
                $index++;
                if ($index == $limit)
                    break;
            }
            array_push($tbl_monthly_wages_detail, $a_monthly_wages_detail);
        }
        $this->Salary_distribution($tbl_monthly_wages_detail);
    }

    public function get_line_name() {
        $BuildingName = $this->input->post('Building');
        $Floor = $this->input->post('Floor');
        $DepartmentName = $this->input->post('Department');
        $LineName = $this->mod_monthly_wages_detail->get_line_name($BuildingName, $Floor, $DepartmentName);
        echo json_encode($LineName);
    }
    

}

?>
