<?php

class Mod_monthly_wages_detail extends CI_Model {

//put your code here
    public $Month;
    public $Year;
    public $FormDate;
    public $ToDate;
    public $CardNo;
    public $Name;
    public $Designation;
    public $Grade;
    public $DateOfJoin;
    public $BuildingName;
    public $Floor;
    public $Department;
    public $Line;
    public $Parameter5;
    public $GrossSalary;
    public $Basic;
    public $HouseRent;
    public $MedicalAllowance;
    public $TravelAllowance;
    public $FoodAllowance;
    public $DailyWage;
    public $TotalWorkingDays;
    public $WorkDays;
    public $TotalAvailableToPay;
    public $OutStandingDues;
    public $TotalOverTimeHour;
    public $HourlyOTWage;
    public $AdditionalAllowance;
    public $HolidayWorkDays;
    public $Absent;
    public $LeaveOfEmpolyee;
    public $OverTimeHour;
    public $AdditionalOverTimeHour;
    public $NightShiftOverTimeHour;
    public $AttendanceBonus;
    public $StampCharge;
    public $HolidayNetPayable;
    public $NetPayable;
    public $NoOfOT;
    public $NoOfAOT;
    public $NoOfNight;

//Insert Query for Course================================================================
//    public function insert() {
//        $data = array(
//            'Month' => $this->Month,
//            'Year' => $this->Year,
//            'FormDate' => $this->FormDate,
//            'ToDate' => $this->ToDate,
//            'CardNo' => $this->CardNo,
//            'Name' => $this->Name,
//            'Designation' => $this->Designation,
//            'Grade' => $this->Grade,
//            'DateOfJoin' => $this->DateOfJoin,
//            'Parameter1' => $this->Parameter1,
//            'Parameter2' => $this->Parameter2,
//            'Parameter3' => $this->Parameter3,
//            'Parameter4' => $this->Parameter4,
//            'Parameter5' => $this->Parameter5,
//            'GrossSalary' => $this->GrossSalary,
//            'WorkDays' => $this->WorkDays,
//            'Absent' => $this->Absent,
//            'LeaveOfEmpolyee' => $this->LeaveOfEmpolyee,
//            'OverTimeHour' => $this->OverTimeHour,
//            'AdditionalOverTimeHour' => $this->AdditionalOverTimeHour,
//            'NightShiftOverTimeHour' => $this->NightShiftOverTimeHour,
//            'AttendanceBonus' => $this->AttendanceBonus,
//            'StampCharge' => $this->StampCharge,
//            'NetPayable' => $this->NetPayable
//        );
//
//        $this->db->insert('tbl_monthly_wages_detail', $data);
//    }

    public function insert_batch_random_data($data) {
        $this->db->insert_batch('tbl_monthly_wages_detail', $data);
    }

    public function insert_batch_monthly_report($data) {
        $this->db->insert_batch('tbl_monthly_wages_detail', $data);
    }

//Update Query in Course table ===========================================================
//View Course Information ===================================================


    public function get_building_by_name() {
        $this->db->distinct();
        $this->db->select('BuildingName');
        $this->db->from('tbl_monthly_wages_detail');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_floor_by_name($building) {
        $this->db->distinct();
        $this->db->select('Floor');
        $this->db->from('tbl_monthly_wages_detail');
        $this->db->where('BuildingName', $building);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_department_name($building, $floor) {
        $this->db->distinct();
        $this->db->select('Department');
        $this->db->from('tbl_monthly_wages_detail');
        if(!empty($building)){
        $this->db->where('BuildingName', $building);}
        $this->db->where('Floor', $floor);
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_line_name($building, $floor, $Department) {
        $this->db->distinct();
        $this->db->select('Line');
        $this->db->from('tbl_monthly_wages_detail');
        $this->db->where('BuildingName', $building);
        $this->db->where('Floor', $floor);
        $this->db->where('Department', $Department);
        $query = $this->db->get();
        return $query->result();
    }


    public function get_department_by_name($building, $floor) {
        $this->db->distinct();
        $this->db->select('Department');
        $this->db->from('tbl_employee_profile');
        $this->db->where('BuildingName', $building);
        $this->db->where('Floor', $floor);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_line_by_name($building, $floor, $Department) {
        $this->db->distinct();
        $this->db->select('Line');
        $this->db->from('tbl_employee_profile');
        $this->db->where('BuildingName', $building);
        $this->db->where('Floor', $floor);
        $this->db->where('Department', $Department);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_report($building, $floor, $Department, $line) {
        if ($line) {
            $line_query = "AND `Line` = '" . $line . "'";
        } else {
            $line_query = "";
        }
        $query = $this->db->query("SELECT * FROM tbl_monthly_wages_detail WHERE BuildingName = '" . $building . "' and Floor = '" . $floor . "' AND Department = '" . $Department . "' " . $line_query);
        return $query->result();
    }
    
     public function specific_employee_information_report($buildingName, $floor, $department, $line ,$month) {
        $this->db->select('*');
        $this->db->from('tbl_monthly_wages_detail');
        $this->db->like('BuildingName', $buildingName);
        $this->db->like('Floor', $floor);
        $this->db->like('Department', $department);
        $this->db->like('Line', $line);
        $this->db->like('Month', $month);
        $query = $this->db->get();
        return $query->result();
    } 
    
//    public function get_specific_report($building, $floor, $Department, $line, $month) {
//        if ($line) {
//            $line_query = "AND `Line` = '" . $line . "'";
//        } else {
//            $line_query = "";
//        }
//        //$query = $this->db->query("SELECT * FROM tbl_monthly_wages_detail WHERE BuildingName = '" . $building . "' and Floor = '" . $floor . "' AND Department = '" . $Department . "' AND Month = '" . $month . "' " . $line_query);
//        echo "SELECT * FROM tbl_monthly_wages_detail WHERE BuildingName = '" . $building . "' and Floor = '" . $floor . "' AND Department = '" . $Department . "' AND Month = '" . $month . "' " . $line_query;
//        exit();
//        //return $query->result();
//    }

    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_monthly_wages_detail');
        $this->db->order_by('CardNo asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetAllData() {
        $this->db->select('*');
        $this->db->from('tbl_monthly_wages_detail');
        $this->db->order_by('CardNo asc');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function MonthSpecificGetAllDataWith($month) {        
        $this->db->select('*');
        $this->db->from('tbl_monthly_wages_detail');
        $this->db->where('Month', $month);
        $this->db->order_by('CardNo asc');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function MonthSelectedGetAllDataWith($month) {        
        $this->db->select('*');
        $this->db->from('tbl_monthly_wages_detail');
        $this->db->where('Month', $month);
        $this->db->order_by('CardNo asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function GetAllDataArray($Month) {        
        $this->db->select('*');
        $this->db->from('tbl_monthly_wages_detail');
        $this->db->where('Month', $Month);
        $this->db->order_by('CardNo asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_monthly_wages_detail');
        $this->db->where('CardNo', $this->CardNo);
        $this->db->where('DateTime BETWEEN ' . '"' . date("Y-m-d H:i:s", strtotime($this->DateTime . ' 00:00:01')) . '"' . ' AND ' . '"' . date("Y-m-d H:i:s", strtotime($this->DateTime . ' 23:59:59')) . '"', NULL, FALSE);
        $query = $this->db->get();
        return $query->result();
    }

    public function update() {
        $data = array(
            'Month' => $this->Month,
            'Year' => $this->Year,
            'FormDate' => $this->FormDate,
            'ToDate' => $this->ToDate,
            'CardNo' => $this->CardNo,
            'Name' => $this->Name,
            'Designation' => $this->Designation,
            'Grade' => $this->Grade,
            'DateOfJoin' => $this->DateOfJoin,
            'BuildingName' => $this->BuildingName,
            'Floor' => $this->Floor,
            'Department' => $this->Department,
            'Line' => $this->Line,
            'Parameter5' => $this->Parameter5,
            'GrossSalary' => $this->GrossSalary,
            'Basic' => $this->Basic,
            'HouseRent' => $this->HouseRent,
            'TreatmentAllowance' => $this->TreatmentAllowance,
            'TravelAllowance' => $this->TravelAllowance,
            'FoodAllowance' => $this->FoodAllowance,
            'DailyWage' => $this->DailyWage,
            'TotalWorkingDays' => $this->TotalWorkingDays,
            'WorkDays' => $this->WorkDays,
            'TotalAvailableToPay' => $this->TotalAvailableToPay,
            'OutStandingDues' => $this->OutStandingDues,
            'TotalOverTimeHour' => $this->TotalOverTimeHour,
            'HourlyOTWage' => $this->HourlyOTWage,
            'AdditionalAllowance' => $this->AdditionalAllowance,
            'HolidayWorkDays' => $this->HolidayWorkDays,
            'Absent' => $this->Absent,
            'LeaveOfEmpolyee' => $this->LeaveOfEmpolyee,
            'OverTimeHour' => $this->OverTimeHour,
            'AdditionalOverTimeHour' => $this->AdditionalOverTimeHour,
            'NightShiftOverTimeHour' => $this->NightShiftOverTimeHour,
            'AttendanceBonus' => $this->AttendanceBonus,
            'StampCharge' => $this->StampCharge,
            'HolidayNetPayable' => $this->HolidayNetPayable,
            'NetPayable' => $this->NetPayable,
            'NoOfOT' => $this->NoOfOT,
            'NoOfAOT' => $this->NoOfAOT,
            'NoOfNight' => $this->NoOfNight
        );
        $this->db->where('CardNo', $this->CardNo);
        if ($this->db->update('tbl_monthly_wages_detail', $data)) {
            return TRUE;
        }
        return false;
    }

    public function truncate_table() {
        $this->db->truncate('tbl_monthly_wages_detail');
    }

    public function GetTotalDayCount() {
        $this->db->distinct();
        $this->db->select('Date');
        $query = $this->db->get('tbl_daily_attendance_log');
        return $query->num_rows();
    }

    public function GetTotalDays() {
        $this->db->distinct();
        $this->db->select('Date');
        $query = $this->db->get('tbl_daily_attendance_log');
        $query->num_rows();
        echo '<pre>';
        print_r($query->result_array());
        echo '</pre>';
        exit();
    }

    public function GetJoinResult() {
        //tbl_monthly_wages_details
        //['Month']//
        //['Year']//
        //['FormDate']//
        //['ToDate']//
        //['CardNo']
        //['Name']
        //['Designation']
        //['Grade']
        //['DateOfJoin']
        //['BuildingName']
        //['Floor']
        //['Department']
        //['Line']
        //['Parameter5']
        //['GrossSalary']
//        ['WorkDays']
//        ['HolidayWorkDays']
//        ['Absent']
//        ['LeaveOfEmpolyee']
//        ['OverTimeHour']
//        ['AdditionalOverTimeHour']
//        ['NightShiftOverTimeHour']
//        ['AttendanceBonus']
//        ['StampCharge']
//        ['HolidayNetPayable']
//        ['NetPayable']
//        ['NoOfOT']
//        ['NoOfAOT']
//        ['NoOfNight']

        $query = $this->db->query('SELECT tbl_daily_attendance_log.CardNo,tbl_employee_profile.Name, tbl_employee_profile.Designation,
                                   tbl_employee_profile.Grade,tbl_employee_profile.JoiningDate,tbl_employee_profile.GrossSalary,
                                   tbl_employee_profile.BuildingName,tbl_employee_profile.Floor,tbl_employee_profile.Department,tbl_employee_profile.Line,
                                   tbl_employee_profile.Parameter5
                                   FROM tbl_daily_attendance_log
                                   LEFT JOIN tbl_employee_profile ON tbl_daily_attendance_log.CardNo = tbl_employee_profile.CardNo
                                   GROUP BY tbl_daily_attendance_log.CardNo');
        return $query->result_array();
    }

}
