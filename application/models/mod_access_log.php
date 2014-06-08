<?php

class Mod_access_log extends CI_Model {

    public $CardNo;
    public $DateTime;
    public $Status;
    public $CreatedBy;
    public $CreatedOn;
    public $DelStatus;

    //Insert Query for Course================================================================
    public function insert($data) {
        $this->db->insert('tbl_access_log', $data);
    }
    
    public function insert_batch_random_data($data) {
        $this->db->insert_batch('tbl_access_log', $data);
    }

    //Update Query in Course table ===========================================================
    //View Course Information ===================================================
    public function view() {
        $this->db->select('*');
        $this->db->from('tbl_access_log');
        $query = $this->db->get();
        return $query->result();
    }

    public function view_by_id() {
        $this->db->select('*');
        $this->db->from('tbl_access_log');
        $this->db->where('CardNo', $this->CardNo);
        $this->db->where('DateTime BETWEEN ' . '"' . date("Y-m-d H:i:s", strtotime($this->DateTime . ' 00:00:01')) . '"' . ' AND ' . '"' . date("Y-m-d H:i:s", strtotime($this->DateTime . ' 23:59:59')) . '"', NULL, FALSE);
        $query = $this->db->get();
        return $query->result();
    }

    public function update() {
        $data = array(
            'RewaredName' => $this->RewaredName,
            'RewaredAmount' => $this->RewaredAmount,
            'IsCalculatedOnBasic' => $this->IsCalculatedOnBasic,
            'BasicXTime' => $this->BasicXTime,
            'CompensatoryHolyday' => $this->CompensatoryHolyday
        );
        $this->db->where('ID', $this->ID);
        if ($this->db->update('tbl_additional_reward_staff', $data)) {
            return TRUE;
        }
        return false;
    }

    public function getLongData() {
        $this->db->select('*');
        $this->db->from('tbl_access_log');
        $this->db->order_by('cardno asc, datetime asc');
        $query = $this->db->get();
        return $query->result();
    }

    public function getDateSpecificLongData1($date) {
        $first_date_time = $date . ' 00:00:01';
        $last_date_time = $date . ' 23:59:59';
        $query = $this->db->query("SELECT * FROM `tbl_access_log` WHERE DateTime between '" . $first_date_time . "' and '" . $last_date_time . "' group by CardNo order by CardNo asc");
//        echo '<pre>';
//        print_r("SELECT distinct(cardno) FROM `tbl_access_log_raw` WHERE intime between '".$first_date_time."' and '".$last_date_time."' order by CardNo asc");
//        echo '</pre>';
//        exit();
        return $query->result_array();
    }

    public function getDateSpecificLongData($date) {
//        echo $date;
//        exit();
        $first_date_time = $date . ' 00:00:01';
        $last_date_time = $date . ' 23:59:59';
        $this->db->select('*');
        $this->db->where('DateTime >=', date('Y-m-d H:i:s', strtotime($first_date_time)));
        $this->db->where('DateTime <=', date('Y-m-d H:i:s', strtotime($last_date_time)));
        $this->db->from('tbl_access_log');
        $this->db->order_by('cardno asc, datetime asc');
        $query = $this->db->get();
//        echo '<pre>';
//        print_r($query->result());
//        echo '</pre>';
//        exit();
        return $query->result();
    }
    public function GetTbl_access_data(){
        $query = $this->db->query('SELECT * FROM `tbl_access_log` where CreatedBy = "SYSTEM" and DateTime like "%-05-%" order by CardNo,DateTime');
        return $query->result_array();
    }
    public function EmptyTable1(){
        $query = $this->db->query('DELETE FROM `tbl_access_log` where CreatedBy = "SYSTEM" and DateTime like "%-05-%" ');
    }
    public function GetDateSpecificCardNo($date) {
        $first_date_time = $date . ' 00:00:01';
        $last_date_time = $date . ' 23:59:59';
        $query = $this->db->query("SELECT CardNo,DateTime FROM `tbl_access_log` where DateTime between '" . $first_date_time . "' and '" . $last_date_time . "' group by CardNo order by CardNo");
//        echo count($query->result_array());
//        exit();
        return $query->result_array();
    }

    public function EmptyTable() {
        $this->db->truncate('tbl_access_log');
    }

    public function getLongDataArray() {

        $this->db->select('*');
        $this->db->from('tbl_access_log');
        $this->db->order_by('cardno asc, datetime asc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function GetDistinctDates($Month) {

        $query = $this->db->query("SELECT DATE(`DateTime`) 
                                    FROM   tbl_access_log WHERE DateTime LIKE  '%-" . $Month . "-%'
                                    GROUP  BY DATE(`DateTime`)");
        return $query->result_array();
    }
    public function get_floor_specific_access_record($date){
        $query = $this->db->query("SELECT access_log.CardNo, access_log.DateTime, access_log.IP
                                FROM access_log
                                INNER JOIN tbl_employee_profile
                                ON access_log.CardNo=tbl_employee_profile.CardNo where DateTime LIKE '".$date."%' order by CardNo,DateTime");
        return $query->result_array();
    }

}
