<?php
class Mod_leave_detail extends CI_Model {
    public $CardNo;
    public $Date;
    public $LeaveCategoryName;
    public $ApprovedBy;
    public $ApplicationNo;

    //Insert Query for Course================================================================
    public function insert() {
        $data = array(
            'CardNo' => $this->CardNo,
            'Date' => $this->Date,
            'LeaveCategoryName' => $this->LeaveCategoryName,
            'ApprovedBy' => $this->ApprovedBy,
            'ApplicationNo' => $this->ApplicationNo
        );

        $this->db->insert('tbl_leave_detail', $data);
    }

    public function insert_batch($data) {
        $this->db->insert_batch('tbl_leave_detail', $data);
    }

    public function insert_batch_random_data($data) {
        $this->db->insert_batch('tbl_leave_detail', $data);
    }

    public function get_leave_details_info($date) {
        $query = $this->db->query("SELECT DISTINCT(lv.CardNo), lv.Date, lv.LeaveCategoryName, lv.ApprovedBy, lv.ApplicationNo, emp.Name, emp.BuildingName, emp.Floor, emp.Line, emp.Department FROM tbl_leave_detail as lv INNER JOIN tbl_employee_profile AS emp ON lv.CardNo = emp.CardNo WHERE lv.Date = '" . $date . "' GROUP BY (lv.CardNo)");
        return $query->result();
    }

    public function get_leave_type_names() {
        $this->db->select('CatagoryName');
        $this->db->from('tbl_leave_catagory');
        $query = $this->db->get();
        return $query->result();
    }
    public function get_leave_type_name($cardNo,$date){        
        $query = $this->db->query("SELECT LeaveCategoryName FROM `tbl_leave_detail` WHERE cardno = ".$cardNo." and date = '".$date."'");        
        return $query->result_array();        
    }

    //Update Query in Course table ===========================================================
    //View Course Information ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_leave_detail');
        $this->db->order_by('CardNo asc,Date asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_leave_detail');
        $this->db->where('CardNo', $this->CardNo);
        $this->db->where('Date BETWEEN ' . '"' . date("Y-m-d H:i:s", strtotime($this->Date . ' 00:00:01')) . '"' . ' AND ' . '"' . date("Y-m-d H:i:s", strtotime($this->Date . ' 23:59:59')) . '"', NULL, FALSE);
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_CardNo($CardNo, $Month) {
        $LikeDate = '2014-' . $Month . "-1 00:00:00";
        $Month = (int) $Month + 1;
        $LikeDateEnd = '2014-' . $Month . "-1 00:00:00";
        $this->db->select('*');
        $this->db->from('tbl_leave_detail');
        $this->db->where('CardNo', $CardNo);
        $this->db->where('Date BETWEEN ' . '"' . date("Y-m-d", strtotime($LikeDate)) . '"' . ' AND ' . '"' . date("Y-m-d", strtotime($LikeDateEnd)) . '"', NULL, FALSE);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update() {
        $data = array(
            'CardNo' => $this->CardNo,
            'Date' => $this->Date,
            'LeaveCategoryName' => $this->LeaveCategoryName,
            'ApprovedBy' => $this->ApprovedBy,
            'ApplicationNo' => $this->ApplicationNo
        );
        $this->db->where('CardNo', $this->CardNo);
        $this->db->where('Date', $this->Date);
        $this->db->update('tbl_leave_detail', $data);
    }

//    public function getLongData() {
//        
//        $this->db->select('*');
//        $this->db->from('tbl_access_log');
//        $this->db->order_by('cardno asc, datetime asc'); 
//        $query = $this->db->get();
//        return $query->result();
//       
//    }
    

    public function EmptyTable() {
        $this->db->truncate('tbl_leave_detail');
    }

    public function getLongDataArray() {

        $this->db->select('*');
        $this->db->from('tbl_leave_detail');
        $this->db->order_by('CardNo asc,Date asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function specific_employee_information_report($buildingName, $floor, $department, $line) {
        $this->db->select('*');
        $this->db->from('tbl_employee_profile');
        $this->db->like('BuildingName', $buildingName);
        $this->db->like('Floor', $floor);
        $this->db->like('Department', $department);
        $this->db->like('Line', $line);
        $query = $this->db->get();
        return $query->result();
    }

    public function search_daily_leave_by_time($startdate) {
        $query = $this->db->query("SELECT DISTINCT(lv.CardNo), lv.Date, lv.LeaveCategoryName, lv.ApprovedBy, lv.ApplicationNo, emp.Name, emp.BuildingName, emp.Floor, emp.Line, emp.Department FROM tbl_leave_detail as lv INNER JOIN tbl_employee_profile AS emp ON lv.CardNo = emp.CardNo WHERE lv.Date = '" . $startdate . "' GROUP BY (lv.CardNo)");
        return $query->result();
    }

    public function get_image_designation($cardno, $buildingname, $floor) {
        if ($this->session->userdata('Role') == 'Admin') {
            $this->db->select('pro.CardNo, pro.Image, pro.Designation, pro.BuildingName, pro.Name, pro.Floor, pro.Department, lev.LeaveType, lev.ShortForm, lev.Days, lev.Year');
            $this->db->from('tbl_employee_profile AS pro');
            $this->db->join('tbl_leave_type_allocation AS lev', 'pro.CardNo = lev.CardNo');
            $this->db->where('pro.CardNo', $cardno);
            $this->db->where('pro.BuildingName', $buildingname);
            //$this->db->where('pro.Floor', $floor);
            $query = $this->db->get();
            return $query->result_array();
        } else {
            $this->db->select('pro.CardNo, pro.Image, pro.Designation, pro.BuildingName, pro.Name, pro.Floor, pro.Department, lev.LeaveType, lev.ShortForm, lev.Days, lev.Year');
            $this->db->from('tbl_employee_profile AS pro');
            $this->db->join('tbl_leave_type_allocation AS lev', 'pro.CardNo = lev.CardNo');
            $this->db->where('pro.CardNo', $cardno);
            $this->db->where('pro.BuildingName', $buildingname);
            $this->db->where('pro.Floor', $floor);
            $query = $this->db->get();
            return $query->result_array();
        }
    }

    public function DateSpecificAllLeaves($date) {

//        $first_date = date('Y-m', strtotime($date)) . '-01';
//exit();
        $this->db->select('*');
        $this->db->where('Date', date('Y-m-d', strtotime($date)));
        //$this->db->where('Date <=', date('Y-m-t', strtotime($date)));
        $this->db->order_by('CardNo asc,Date asc');
        $query = $this->db->get('tbl_leave_detail');
        return $query->result_array();
    }

    public function GetAllLeaves($date) {

        $first_date = date('Y-m', strtotime($date)) . '-01';
//exit();
        $this->db->select('*');
        $this->db->where('Date >=', date('Y-m-d', strtotime($first_date)));
        $this->db->where('Date <=', date('Y-m-t', strtotime($date)));
        $this->db->order_by('CardNo asc,Date asc');
        $query = $this->db->get('tbl_leave_detail');
        return $query->result_array();
    }
    public function LeaveEntryDelete($cardNo,$date){
        $query = $this->db->query("DELETE FROM `tbl_leave_detail` WHERE CardNo = ".$cardNo." and Date = '".$date."'");        
    }
}
